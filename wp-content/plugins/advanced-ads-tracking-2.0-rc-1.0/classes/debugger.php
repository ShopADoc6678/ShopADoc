<?php

/**
 * Class Advanced_Ads_Tracking_Debugger
 *
 * DONT ADD EXTERNAL DEPENDENCIES TO THIS CLASS AS IT WILL BREAK THE CUSTOM AJAX HANDLER
 */
class Advanced_Ads_Tracking_Debugger {
	const DEBUG_OPT = 'advads_track_debug';
	const DEBUG_FILENAME_OPT = 'advads_track_debug_filename';
	const DEBUG_HOURS = 48;
	const HEADERS = array( 'Date', 'Database Table', 'Ad ID', 'Remote IP', 'Handler', 'URL', 'User Agent', 'Execution Time' );

	/**
	 * Get the debug filename.
	 *
	 * @return string
	 */
	public static function get_debug_filename() {
		return get_option( self::DEBUG_FILENAME_OPT ) ?: self::generate_debug_filename();
	}

	/**
	 * Get the debug file path.
	 *
	 * @return string
	 */
	public static function get_debug_file_path() {
		return WP_CONTENT_DIR . '/' . self::get_debug_filename();
	}

	/**
	 * Get the URL to the debug file.
	 *
	 * @return string
	 */
	public static function get_debug_file_url() {
		return content_url( self::get_debug_filename() );
	}

	/**
	 * Check if debugging constant is set and match the settings in the database.
	 *
	 * @return bool Whether the settings have been changed.
	 */
	public static function check_debugging_constant() {
		$option = get_option( self::DEBUG_OPT );
		if (
			// either we don't have an option set, but the constant is there
			( empty( $option ) && self::parse_debug_constant() )
			// or we have an option, but the value of option and constant do not match
			|| ( isset( $option['id'] ) && ( self::parse_debug_constant() && self::parse_debug_constant() !== $option['id'] ) )
		) {
			return update_option(
				self::DEBUG_OPT,
				[
					'id'   => self::parse_debug_constant(),
					'time' => 0,
				]
			);
		}

		// if the option's time is 0, but the constant is not true or int, delete the option
		if ( ( isset( $option['time'] ) && empty( $option['time'] ) ) && ! self::parse_debug_constant() ) {
			return delete_option( self::DEBUG_OPT );
		}

		return false;
	}

	/**
	 * Check if the debug option as an expiration time, and delete the option.
	 */
	public static function delete_expired_option() {
		$debug_option = get_option( self::DEBUG_OPT, false );
		if ( $debug_option && ! empty( $debug_option['time'] ) && time() > $debug_option['time'] + ( 3600 * self::DEBUG_HOURS ) ) {
			delete_option( self::DEBUG_OPT );
		}
	}

	/**
	 * Check whether debugging is enabled.
	 *
	 * @param null|int $id
	 *
	 * @return bool
	 */
	public static function debugging_enabled( $id = null ) {
		static $enabled;
		$id = (int) $id;
		if ( isset( $enabled[ $id ] ) ) {
			return $enabled[ $id ];
		}

		$option = get_option( self::DEBUG_OPT, false );
		if ( ! is_array( $option ) && isset( $option['id'] ) ) {
			return $enabled[ $id ] = false;
		}

		// if the option id is an integer, check if the current id is enabled
		if ( is_int( $option['id'] ) ) {
			return $enabled[ $id ] = $option['id'] === $id;
		}

		return $enabled[ $id ] = (bool) $option['id'];
	}

	/**
	 * Get a writeable file handle for the debug file.
	 *
	 * @param string|null $debug_file Optional full path to a debug file (used in custom AJAX handler).
	 *
	 * @return bool|false|resource
	 */
	protected static function get_debug_file_handle( $debug_file = null ) {
		if ( is_null( $debug_file ) ) {
			$debug_file = self::get_debug_file_path();
		}
		// phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fopen
		$handle = fopen( $debug_file, 'a' );
		if ( empty( filesize( $debug_file ) ) ) {
			// Write headers to logging csv.
			self::write_headers( $handle );
		}

		return $handle;
	}

	/**
	 * Write the debug information to the debug file.
	 *
	 * @param int         $id             The ad id.
	 * @param string      $table          The impression logging table.
	 * @param int         $execution_time Execution time of tracking method in milliseconds.
	 * @param string      $handler        Optional. The handler used for tracking.
	 * @param string|null $debug_file     Optional. Full path to the debug file.
	 */
	public static function log( $id, $table, $execution_time, $handler = '', $debug_file = null ) {
		$handle = self::get_debug_file_handle( $debug_file );
		if ( empty( $handler ) && function_exists( 'get_option' ) ) {
			$options = Advanced_Ads_Tracking_Plugin::get_instance()->options();
			if ( isset( $options['method'] ) ) {
				$handler = $options['method'];
				if ( 'frontend' === $options['method'] ) {
					$handler = 'Legacy Frontend';
					if ( self::is_cache_busting() ) {
						$handler = 'AJAX Cache Busting';
					}
				}
			}
		}

		fputcsv(
			$handle,
			array(
				self::date_i18n( 'Y-m-d H:i:s' ),
				$table,
				$id,
				sprintf( "'%s", self::get_ip() ),
				$handler,
				self::get_url(),
				self::get_user_agent(),
				$execution_time,
			)
		);

		// phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fclose
		fclose( $handle );
	}


	/**
	 * Write CSV headers to the debug file.
	 *
	 * @param resource $handle Writable file handle for the debug file.
	 */
	private static function write_headers( $handle ) {
		// prevent duplicate headers.
		static $written = false;
		if ( $written ) {
			return;
		}
		$written = true;
		fputcsv( $handle, self::HEADERS );
	}

	/**
	 * Get the remote IP address.
	 *
	 * @return string
	 */
	private static function get_ip() {
		return isset( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR'] : '';
	}

	/**
	 * Localize the date format if possible, i.e. if WordPress is loaded
	 *
	 * @param string $format The date format.
	 *
	 * @return string
	 */
	private static function date_i18n( $format ) {
		if ( function_exists( 'date_i18n' ) ) {
			return date_i18n( $format );
		}

		// phpcs:ignore WordPress.DateTime.RestrictedFunctions
		return date( $format );
	}

	/**
	 * Get the referring URL.
	 * If this is AJAX-tracked, get the post ID instead of the request UI.
	 *
	 * @return string
	 */
	private static function get_url() {
		// phpcs:disable WordPress.Security.NonceVerification.Missing
		$url = '';
		if ( self::is_cache_busting() ) {
			$args = json_decode( stripslashes( $_POST['deferedAds'][0]['ad_args'] ) );
			if ( isset( $args->url_parameter ) ) {
				$url = $args->url_parameter;
			}
		} elseif ( isset( $_POST['referrer'] ) ) {
			$url = preg_replace( '/[^a-z-_0-9:\/#?&.]/i', '', $_POST['referrer'] );
		}
		// phpcs:enable WordPress.Security.NonceVerification.Missing
		$url = ( empty( $url ) && isset( $_SERVER['REQUEST_URI'] ) ) ? $_SERVER['REQUEST_URI'] : $url;
		$url = rtrim( $url, '/' );
		if ( empty( $url ) ) {
			$url = '/';
		}

		return $url;
	}

	/**
	 * Check whether cache busting is enabled.
	 *
	 * @return bool
	 */
	private static function is_cache_busting() {
		return isset( $_POST['deferedAds'][0]['ad_args'] );
	}

	/**
	 * Get the user agent.
	 *
	 * @return string
	 */
	private static function get_user_agent() {
		return isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : '';
	}

	/**
	 * Trigger the ajax-handler.php installer to account for changed debugging.
	 */
	public static function trigger_installer_update() {
		$plugin  = Advanced_Ads_Tracking_Plugin::get_instance();
		$options = $plugin->options();
		if ( array_key_exists( 'ajax_dropin_version', $options ) ) {
			unset( $options['ajax_dropin_version'] );
			$plugin->update_options( $options );
		}
	}

	/**
	 * Check the value of the debugging constant.
	 *
	 * @return bool|int bool for global debugging, int if enabled for single ad.
	 */
	private static function parse_debug_constant() {
		static $constant;
		if ( ! is_null( $constant ) ) {
			return $constant;
		}
		// not defined ==> false.
		if ( ! defined( 'ADVANCED_ADS_TRACKING_DEBUG' ) ) {
			return $constant = false;
		}

		// is true boolean ==> use value.
		if ( is_bool( ADVANCED_ADS_TRACKING_DEBUG ) ) {
			return $constant = ADVANCED_ADS_TRACKING_DEBUG;
		}

		// is an integer, if 0 or 1 treat as bool, int otherwise.
		if ( is_int( ADVANCED_ADS_TRACKING_DEBUG ) ) {
			if ( ADVANCED_ADS_TRACKING_DEBUG < 2 ) {
				return $constant = (bool) ADVANCED_ADS_TRACKING_DEBUG;
			}

			return $constant = ADVANCED_ADS_TRACKING_DEBUG;
		}

		// string value 'false'.
		if ( ADVANCED_ADS_TRACKING_DEBUG === 'false' ) {
			return $constant = false;
		}

		// string value 'true'.
		if ( ADVANCED_ADS_TRACKING_DEBUG === 'true' ) {
			return $constant = true;
		}

		// is greater than 1 ==> use intval.
		if ( ADVANCED_ADS_TRACKING_DEBUG > 1 ) {
			return $constant = (int) ADVANCED_ADS_TRACKING_DEBUG;
		}

		// something else, constant is set ==> so true.
		return $constant = true;
	}

	/**
	 * Generate a unique name for the debug file and save it to the database.
	 *
	 * @return string filename
	 */
	private static function generate_debug_filename() {
		// domain name without scheme.
		$domain = str_replace( '.', '_', preg_replace( '#^https?://([a-z0-9-.]+)/?.*?$#i', '$1', get_home_url() ) );
		// create a unique filename.
		$filename = sprintf(
			'advanced-ads-tracking-%s-%s.csv',
			$domain,
			wp_hash( implode( '', array( $domain, time() ) ) )
		);
		// save the filename to the db.
		add_option( self::DEBUG_FILENAME_OPT, $filename );


		return $filename;
	}
}
