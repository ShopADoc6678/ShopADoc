<?php

define( 'AAT_BASE_PATH', plugin_dir_path( __FILE__ ) );
define( 'AAT_BASE_URL', plugin_dir_url( __FILE__ ) );
define( 'AAT_BASE_DIR', dirname( plugin_basename( __FILE__ ) ) );
// used as prefix for wp options; used as gettext domain; used as script/ admin namespace
define( 'AAT_SLUG', 'advads-tracking' );
define( 'AAT_VERSION', '1.8.18' );

define( 'AAT_PLUGIN_URL', 'https://wpadvancedads.com' );
define( 'AAT_PLUGIN_NAME', 'Tracking' );

// autoload
require_once AAT_BASE_PATH . '/vendor/autoload_52.php';
