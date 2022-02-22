<?php

/**
 * Class Advanced_Ads_Tracking_Installer
 *
 * Install the custom ajax-handler into WP_CONTENT and add database information
 */
class Advanced_Ads_Tracking_Installer {

	const SOURCE_HANDLER = 'nowp-ajax-handler.php';
	const DEST_HANDLER = 'ajax-handler.php';
	const VERSION_OPTION = 'ajax_dropin_version';
	/**
	 * WordPress Filesystem
	 *
	 * @var WP_Filesystem_Base
	 */
	private $filesystem;

	/**
	 * The destination to write the handler to
	 *
	 * @var string
	 */
	private $dest_file;

	/**
	 * The source file for the handler
	 *
	 * @var string
	 */
	private $source_file;

	/**
	 * Last written drop-in version
	 *
	 * @var string
	 */
	private $ajax_dropin_version = '1.20';

	/**
	 * WordPress database abstraction
	 *
	 * @var wpdb
	 */
	private $db;

	/**
	 * Instance of the tracking plugin
	 *
	 * @var Advanced_Ads_Tracking_Plugin
	 */
	private $plugin;

	/**
	 * Advanced_Ads_Tracking_Installer constructor.
	 */
	public function __construct() {
		WP_Filesystem();
		$this->filesystem  = $GLOBALS['wp_filesystem'];
		$this->db          = $GLOBALS['wpdb'];
		$this->source_file = trailingslashit( WP_PLUGIN_DIR . '/' . AAT_BASE_DIR ) . self::SOURCE_HANDLER;
		$this->dest_file   = trailingslashit( WP_CONTENT_DIR ) . self::DEST_HANDLER;
		$this->plugin      = Advanced_Ads_Tracking_Plugin::get_instance();

		if ( ( defined( 'ADVANCED_ADS_TRACKING_LEGACY_AJAX' ) && ADVANCED_ADS_TRACKING_LEGACY_AJAX ) || $this->plugin->get_tracking_method() === 'ga' ) {
			$this->uninstall();
		}
	}

	/**
	 * Check if AJAX handler exists.
	 *
	 * @return bool
	 */
	private function handler_exists() {
		return $this->filesystem->exists( $this->dest_file );
	}

	/**
	 * Print error message from the installer
	 *
	 * @param $message
	 */
	public function installer_notice( $message ) {
		add_action( 'advanced-ads-notices',
			function () use ( $message ) {
				?>
				<div class="notice notice-error">
					<p><?php echo $message; ?></p>
				</div>
				<?php
			} );
	}

	/**
	 * Try to write the ajax handler to wp-content dir
	 *
	 * @return bool Whether the dropin file was written.
	 */
	private function write_handler() {
		if ( defined( 'ADVANCED_ADS_TRACKING_LEGACY_AJAX' ) && ADVANCED_ADS_TRACKING_LEGACY_AJAX ) {
			return false;
		}

		// check if the handler either exists and is writable or if parent dir is writable
		if ( ( $this->handler_exists() && ! $this->filesystem->is_writable( $this->dest_file ) ) || ! $this->filesystem->is_writable( WP_CONTENT_DIR ) ) {
			// phpcs:disable WordPress.Security.EscapeOutput 
			$message = __( 'The Advanced Ads AJAX tracking drop-in could not be written.' );
			/* translators: 1: WP_CONTENT_DIR 2: <code>wp-config.php</code> 3: <code>define( 'ADVANCED_ADS_TRACKING_LEGACY_AJAX', true )</code> */
			$message .= '<br>' . sprintf( __( 'Please make sure the directory %1$s is writable or add the following to your %2$s: %3$s.', 'advanced-ads-tracking' ), '<code>' . WP_CONTENT_DIR . '</code>', '<code>wp-config.php</code>', '<code>define( \'ADVANCED_ADS_TRACKING_LEGACY_AJAX\', true )</code>' );
			/* translators: %s is <code>wp-admin/admin-ajax.php</code> */
			$message .= '<br>' . sprintf( 'Falling back to %s', '<code>wp-admin/admin-ajax.php</code>' );
			// phpcs:enable WordPress.Security.EscapeOutput
			$this->installer_notice( $message );

			return false;
		}

		$written = $this->filesystem->put_contents(
			$this->dest_file,
			vsprintf(
				$this->filesystem->get_contents( $this->source_file ),
				$this->gather_variables()
			)
		);
		if ( ! $written ) {
			return $written;
		}

		return $this->check_integrity();
	}

	/**
	 * Install the custom ajax handler if environment permits it.
	 * Override if installed version is too old.
	 */
	public function install() {
		if ( ! is_admin() || wp_doing_ajax() || ! class_exists( 'Advanced_Ads', false ) ) {
			return;
		}

		$options = $this->plugin->options();

		if (
			( ! array_key_exists( 'method', $options ) || 'frontend' === $options['method'] )
			&& ! ( defined( 'ADVANCED_ADS_TRACKING_LEGACY_AJAX' ) && ADVANCED_ADS_TRACKING_LEGACY_AJAX )
			&& ( ! $this->handler_exists() || $this->needs_update( $options ) )
		) {
			if ( $this->write_handler() && $this->needs_update( $options ) ) {
				$options[ self::VERSION_OPTION ] = $this->generate_version_hash();
				$this->plugin->update_options( $options );
			}
		}
	}

	/**
	 * Remove the installed ajax handler.
	 */
	public function uninstall() {
		$this->filesystem->delete( $this->dest_file );
	}

	/**
	 * Check if the installed ajax handler needs an update.
	 *
	 * @param array $options Options for add-on.
	 *
	 * @return bool
	 */
	private function needs_update( $options ) {
		return ! isset( $options[ self::VERSION_OPTION ] ) || $options[ self::VERSION_OPTION ] !== $this->generate_version_hash();
	}

	/**
	 * Add the full path to the Debugger Class.
	 *
	 * @return string
	 */
	private function get_debugger_file() {
		try {
			$reflection = new ReflectionClass( 'Advanced_Ads_Tracking_Debugger' );

			return $reflection->getFileName();
		} catch ( ReflectionException $e ) {
			return '';
		}
	}

	/**
	 * Get the bots from the main plugin and this add-on.
	 *
	 * @return array list of bots.
	 */
	private function get_bots() {
		$plugin = Advanced_Ads::get_instance();
		$bots   = array();
		if ( method_exists( $plugin, 'get_bots' ) ) {
			$bots = $plugin->get_bots();
		}

		return Advanced_Ads_Tracking_Util::get_instance()->add_bots_triggering_ajax( $bots );
	}

	/**
	 * Generate a version hash to check if the drop-in needs to be rewritten.
	 *
	 * @return string
	 */
	private function generate_version_hash() {
		static $hash;
		if ( ! is_null( $hash ) ) {
			return $hash;
		}

		$hash = wp_hash( implode( '', $this->gather_variables() ) . $this->ajax_dropin_version, self::VERSION_OPTION );

		return $hash;
	}

	/**
	 * Gather the variables needed for writing the drop-in
	 *
	 * @return array
	 */
	private function gather_variables() {
		static $vars;
		if ( ! is_null( $vars ) ) {
			return $vars;
		}

		// see wp-includes/wp-db.php for documentation.
		list( $host, $port, $socket, $is_ipv6 ) = $this->db->parse_db_host( $this->db->dbhost );
		if ( $is_ipv6 && extension_loaded( 'mysqlnd' ) ) {
			$host = "[$host]";
		}

		$vars = array(
			'db_host'       => $host, // 1
			'db_user'       => $this->db->dbuser, // 2
			'db_password'   => $this->db->dbpassword, // 3
			'db_name'       => $this->db->dbname, // 4
			'db_port'       => $port, // 5
			'db_socket'     => $socket, // 6
			'table_prefix'  => $this->db->get_blog_prefix(), // 7
			'debug_file'    => Advanced_Ads_Tracking_Debugger::get_debug_file_path(), // 8
			'debug_enabled' => Advanced_Ads_Tracking_Debugger::debugging_enabled() ? 'true' : 'false', // 9
			'debug_id'      => get_option( Advanced_Ads_Tracking_Debugger::DEBUG_OPT, array( 'id' => 0 ) )['id'], // 10
			'debug_handler' => $this->get_debugger_file(), // 11
			'bots'          => implode("','", array_map('strtolower',array_map('wp_unslash', $this->get_bots()))), //12
		);

		return $vars;
	}

	/**
	 * Make sure that the custom ajax handler does not expose database credentials to the public.
	 *
	 * @return bool
	 */
	private function check_integrity() {
		$response = wp_remote_post( content_url( self::DEST_HANDLER ) );
		if ( is_wp_error( $response ) ) {
			return false;
		}
		/** @var WP_HTTP_Requests_Response $response */
		$response = $response['http_response'];

		if ( $response->get_response_object()->body === 'no ads' ) {
			return true;
		}
		// if the response is anything other than 'no ads', there's an issue on the website.
		// phpcs:disable WordPress.Security.EscapeOutput 
		$message = __( 'The Advanced Ads AJAX tracking drop-in created unexpected output and has been removed.' );
		/* translators: 1: <code>wp-config.php</code> 2: <code>define( 'ADVANCED_ADS_TRACKING_LEGACY_AJAX', true )</code> */
		$message .= '<br>' . sprintf( __( 'Please check your server setup or add the following to your %1$s: %2$s.', 'advanced-ads-tracking' ), '<code>wp-config.php</code>', '<code>define( \'ADVANCED_ADS_TRACKING_LEGACY_AJAX\', true )</code>' );
		/* translators: %s is <code>wp-admin/admin-ajax.php</code> */
		$message .= '<br>' . sprintf( 'Falling back to %s', '<code>wp-admin/admin-ajax.php</code>' );
		// phpcs:enable WordPress.Security.EscapeOutput
		$this->installer_notice( $message );
		$this->uninstall();

		return false;
	}
}
