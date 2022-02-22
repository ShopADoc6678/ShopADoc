<?php

namespace WeDevs\DokanPro\Admin\Notices;

/**
 * Admin notices handler class
 *
 * @since 3.4.3
 */
class Manager {
    /**
     * Class constructor
     */
    public function __construct() {
        $this->init_classes();
        $this->init_hooks();
    }

    /**
     * Register all notices classes to chainable container
     *
     * @since 3.4.3
     *
     * @return void
     */
    private function init_classes() {
        new DokanLiteMissing();
        new WhatsNew();
    }

    /**
     * Load Hooks
     *
     * @since 3.4.3
     *
     * @return void
     */
    private function init_hooks() {
        // limited time table rate shipping remove notice, will be removed in near future
        add_action( 'dokan_loaded', [ $this, 'display_table_rate_shipping_notice' ], 20 );
    }

    /**
     * Needed extra wrapper because Manager class was loaded on Dokan pro constractor and module object was loading later on
     *
     * @since 3.4.3
     *
     * @return void
     */
    public function display_table_rate_shipping_notice() {
        if ( 'dokan-starter' === dokan_pro()->get_plan() && current_user_can( 'activate_plugins' ) ) {
            add_filter( 'dokan_admin_notices', [ $this, 'remove_table_rate_shipping_module_notice' ] );
            add_action( 'wp_ajax_dismiss_table_rate_shipping_removed_notice', [ $this, 'ajax_dismiss_table_rate_shipping_removed_notice' ] );
        }
    }

    /**
     * Display dismiss Table Rate Shipping module notice
     *
     * @since 3.4.3
     *
     * @param array $notices
     *
     * @return array
     */
    public function remove_table_rate_shipping_module_notice( $notices ) {
        if ( 'yes' === get_option( 'dismiss_table_rate_shipping_removed_notice', 'no' ) ) {
            return $notices;
        }

        // check installation time
        $installed_time      = get_option( 'dokan_installed_time' );
        $notice_remove_time  = dokan_current_datetime()->modify( '2022-01-02' )->getTimestamp();
        if ( $installed_time > $notice_remove_time ) {
            return $notices;
        }

        $notices[] = [
            'type'        => 'alert',
            'title'       => __( 'Table Rate Shipping has been removed from Dokan Starter package.', 'dokan' ),
            /* translators: %s permalink settings url */
            'description' => __( 'Due to a technical error on our end, we deployed the Table rate shipping module to the Starter package. It is available in Professional and upper packages now.', 'dokan' ),
            'priority'    => 1,
            'show_close_button' => true,
            'ajax_data'   => [
                'action' => 'dismiss_table_rate_shipping_removed_notice',
                'nonce'  => wp_create_nonce( 'dismiss_table_rate_shipping_removed_nonce' ),
            ],
            'actions'     => [
                [
                    'type'   => 'primary',
                    'text'   => __( 'Upgrade Now', 'dokan' ),
                    'action' => 'https://wedevs.com/dokan/pricing',
                    'target' => '_blank',
                ],
            ],
        ];

        return $notices;
    }

    /**
     * Dismiss Table Rate Shipping module ajax action.
     *
     * @since 3.4.3
     *
     * @return void
     */
    public function ajax_dismiss_table_rate_shipping_removed_notice() {
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['nonce'] ) ), 'dismiss_table_rate_shipping_removed_nonce' ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'dokan' ) );
        }

        if ( ! current_user_can( 'activate_plugins' ) ) {
            wp_send_json_error( __( 'You do not have permission to perform this action.', 'dokan' ) );
        }

        update_option( 'dismiss_table_rate_shipping_removed_notice', 'yes' );

        wp_send_json_success();
    }
}
