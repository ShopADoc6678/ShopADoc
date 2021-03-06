<?php

$email_sched = __( 'every day', 'advanced-ads-tracking' );
if ( $sched === 'weekly' ) {
	$email_sched = __( 'every Monday', 'advanced-ads-tracking' );
} elseif ( $sched === 'monthly' ) {
	$email_sched = __( 'first day of the month', 'advanced-ads-tracking' );
}
?>
<?php if ( ! empty( $recipients ) ) : ?>
	<a id="send-immediate-report" class="button button-secondary" href="#"><?php _e( 'send email', 'advanced-ads-tracking' ); ?></a><span id="send-email-spinner-spinner" style="margin:4px;display:inline-block;"></span>
	<p class="description"><?php _e( 'Send a report immediately to the listed email addresses', 'advanced-ads-tracking' ); ?>&nbsp;( <?php echo str_replace( ',', ', ', $recipients ); ?> )</p>
	<p id="immediate-report-notice"></p>
	<p style="background-color:#00A0D2;color:#fff;padding:2px;">
		<?php
		/* Translators: 1: cron job schedule (e.g. 'daily'), 2: current timezone */
		echo esc_html( sprintf( __( 'Email will be sent %1$s at 00:15 %2$s', 'advanced-ads-tracking' ), $email_sched, Advanced_Ads_Tracking_Util::get_timezone_name() ) );
		?>
	</p>
<?php else : ?>
	<p class="description"><?php _e( 'Add and save a recipient before sending a test email.', 'advanced-ads-tracking' ); ?></p>
	<?php
endif;
