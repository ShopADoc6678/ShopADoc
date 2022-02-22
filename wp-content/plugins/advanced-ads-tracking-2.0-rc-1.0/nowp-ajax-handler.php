<?php
/**
 * AJAX Drop-in to track ads.
 *
 * This method speeds up ad tracking by a factor of 100 compared to wp-admin/admin-ajax.php
 * If you wish not to use this tracking method, please set the constant ADVANCED_ADS_TRACKING_LEGACY_AJAX,
 * i.e. define( 'ADVANCED_ADS_TRACKING_LEGACY_AJAX', true ) in your wp-config.php
 */
// phpcs:disable WordPress.Security.NonceVerification
// phpcs:disable WordPress.PHP.NoSilencedErrors.Discouraged
// phpcs:disable WordPress.DateTime.RestrictedFunctions

$start_time = microtime( true );

// set some headers to avoid caching.
$headers = array(
	'X-Content-Type-Options: nosniff',
	'Cache-Control: no-cache, must-revalidate, max-age=0, smax-age=0',
	'Expires: Sat, 26 Jul 1997 05:00:00 GMT',
	'X-Accel-Expires: 0',
	'X-Robots-Tag: noindex',
);
foreach ( $headers as $header ) {
	@header( $header, true );
}
header_remove( 'Last-Modified' );

// ensure headers are send.
flush();
ob_flush();

// do not stop when user ended the connection.
@ignore_user_abort( true );

if ( ! isset( $_POST['ads'] ) || empty( $_POST['ads'] ) || ! is_array( $_POST['ads'] ) ) {
	die( 'no ads' );
}

if ( empty( $_POST['action'] ) || 'aatrack-records' !== $_POST['action'] ) {
	die( 'nothing to do' );
}

// needles
$bots       = array( '%12$s' );
$user_agent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? strtolower( stripslashes( $_SERVER['HTTP_USER_AGENT'] ) ) : '';
if ( ! empty( $user_agent ) ) {
	foreach ( $bots as $bot ) {
		if ( strpos( $user_agent, $bot ) !== false ) {
			die( 'not tracking bots' );
		}
	}
}

@date_default_timezone_set( 'UTC' );

// open db connection
// phpcs:disable WordPress.DB.RestrictedFunctions
// 1: host, 2: user, 3: password, 4: db name, 5: port, 6: socket.
$mysqli = @mysqli_connect( '%1$s', '%2$s', '%3$s', '%4$s', '%5$d', '%6$s' );
if ( ! $mysqli ) {
	die( 'Could not connect to database' );
}

foreach ( array_map( 'intval', $_POST['ads'] ) as $ad_id ) {
	if ( empty( $ad_id ) ) {
		continue;
	}
	adt_track( $ad_id, $mysqli );

	// 9: debugging active, 10: ad_id to debug.
	if ( '%9$s' === 'true' || (int) '%10$d' === $ad_id ) {
		// 10: debugger file path
		require_once '%11$s';
		( new Advanced_Ads_Tracking_Debugger() )->log(
			(int) $ad_id,
			'%7$sadvads_impressions', // 7: table prefix.
			round( ( microtime( true ) - $start_time ) * 1000 ),
			'Frontend',
			'%8$s' // 8: debug file.
		);
	}
}

mysqli_close( $mysqli );

/**
 * Write impression to database.
 *
 * @param int    $ad_id  The ID of the ad to track.
 * @param mysqli $mysqli DB instance.
 */
function adt_track( $ad_id, $mysqli ) {
	$ts = advads_timestamp();
	// 7: table prefix.
	$success = mysqli_query( $mysqli, "INSERT INTO `%7$sadvads_impressions` (`ad_id`, `timestamp`, `count`) VALUES (${ad_id}, ${ts}, 1) ON DUPLICATE KEY UPDATE `count` = `count`+ 1" );

	if ( ! $success ) {
		echo 'Impression could not be saved.';
	}
}

/**
 * Get timestamp string; only do this once per request.
 *
 * @return string
 */
function advads_timestamp() {
	static $ts;
	if ( ! is_null( $ts ) ) {
		return $ts;
	}
	$ts    = gmdate( 'Y-m-d H:i:s', time() );
	$week  = abs( date( 'W', strtotime( $ts ) ) );
	$month = abs( date( 'm', strtotime( $ts ) ) );

	if ( 52 <= $week && 1 === $month ) {
		// Fix for the new year inconsistency.
		$ts = date( 'ym01dH', strtotime( $ts ) );
	} elseif ( 12 === $month && in_array( $week, array( 1, 53 ), true ) ) {
		$ts = date( 'ym52dH', strtotime( $ts ) );
	} else {
		// ensure wp local time.
		$ts = date( 'ymWdH', strtotime( $ts ) );
	}

	$ts = substr( $ts, 0, strlen( $ts ) - 2 );
	$ts .= '06';

	return $ts;
}

die();
