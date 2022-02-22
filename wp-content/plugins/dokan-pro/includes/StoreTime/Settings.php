<?php

namespace WeDevs\DokanPro\StoreTime;

/**
 * Dokan Pro Store Open Close
 * Multiple Time Settings.
 *
 * @since 3.5.0
 */
class Settings {

    /**
     * Load automatically when class initiate
     *
     * @since 3.5.0
     *
     * @uses actions hook
     * @uses filter hook
     *
     * @return void
     */
    public function __construct() {
        // Added multiple fields for store open close multiple time settings.
        add_filter( 'dokan_pro_scripts', [ $this, 'register_scripts' ] );
        add_filter( 'dokan_store_time', [ $this, 'save_store_times' ] );
        add_filter( 'dokan_is_store_open', [ $this, 'check_seller_store_is_open' ], 10, 4 );

        // Added store all time open status & multiple slot for store multiple time settings.
        add_filter( 'dokan_store_time_template', [ $this, 'update_store_time_template' ] );
        add_filter( 'dokan_store_time_arguments', [ $this, 'update_store_time_template_args' ], 10, 2 );
        add_action( 'after_dokan_store_time_settings_form', [ $this, 'added_store_times' ], 10, 2 );
    }

    /**
     * Added script for store open close multiple time.
     *
     * @since 3.5.0
     *
     * @param array $scripts
     *
     * @return array
     */
    public function register_scripts( $scripts ) {
        // Use minified libraries if SCRIPT_DEBUG is turned off
        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

        $scripts['dokan-pro-store-open-close-time'] = [
            'src'       => DOKAN_PRO_PLUGIN_ASSEST . '/js/dokan-pro-store-open-close-time' . $suffix . '.js',
            'deps'      => [ 'jquery' ],
            'version'   => defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? time() : DOKAN_PRO_PLUGIN_VERSION,
            'in_footer' => true,
        ];

        return $scripts;
    }

    /**
     * Save store open close times here.
     *
     * @since 3.5.0
     *
     * @param array $dokan_store_time
     *
     * @return array
     */
    public function save_store_times( $dokan_store_time ) {
        if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['_wpnonce'] ), 'dokan_store_settings_nonce' ) ) {
            return;
        }

        $dokan_store_times = [];
        $store_days        = ! empty( $_POST['store_day'] ) ? wc_clean( wp_unslash( $_POST['store_day'] ) ) : [];

        foreach ( $store_days as $day ) {
            $opening_times = ! empty( $_POST['opening_time'][ $day ] ) ? wc_clean( wp_unslash( $_POST['opening_time'][ $day ] ) ) : [];
            $closing_times = ! empty( $_POST['closing_time'][ $day ] ) ? wc_clean( wp_unslash( $_POST['closing_time'][ $day ] ) ) : [];
            $store_status  = 'open';

            // Save working status & opening, closing times array in 12 hours format.
            $dokan_store_times[ $day ] = [
                'status'       => $store_status,
                'opening_time' => $this->get_formatted_store_times( $store_status, $opening_times ),
                'closing_time' => $this->get_formatted_store_times( $store_status, $closing_times ),
            ];
        }

        return $dokan_store_times;
    }

    /**
     * Save store opening or closing times in 12 hours format.
     *
     * @since 3.5.0
     *
     * @param string $store_status
     * @param array  $time_types   eg: $opening_times or $closing_times
     *
     * @return array
     */
    public function get_formatted_store_times( $store_status, $time_types ) {
        $times = [];

        foreach ( $time_types as $time_type ) {
            $formatted_time = '';

            if ( 'open' === $store_status && ! empty( $time_type ) ) {
                $formatted_time = \DateTimeImmutable::createFromFormat(
                    wc_time_format(),
                    $time_type,
                    new \DateTimeZone( dokan_wp_timezone_string() )
                )->format( 'g:i a' );
            }

            $times[] = $formatted_time;
        }

        return $times;
    }

    /**
     * Check vendor store is open or close.
     *
     * @since 3.5.0
     *
     * @param bool   $store_open
     * @param string $store_status
     * @param array  $dokan_store_time
     * @param array  $vendor_infos
     *
     * @return bool
     */
    public function check_seller_store_is_open( $store_open, $store_status, $dokan_store_time, $vendor_infos ) {
        if ( 'open' !== $store_status ) {
            return $store_open;
        }

        if ( empty( $dokan_store_time['opening_time'] ) || empty( $dokan_store_time['closing_time'] ) ) {
            return true;
        }

        // Vendor vacation support
        $vendor_vacation_active = ! empty( $vendor_infos['setting_go_vacation'] ) ? $vendor_infos['setting_go_vacation'] : '';
        $vendor_vacation_style  = ! empty( $vendor_infos['settings_closing_style'] ) ? $vendor_infos['settings_closing_style'] : '';

        if ( 'yes' === $vendor_vacation_active && 'instantly' === $vendor_vacation_style ) {
            return false;
        }

        $current_date          = dokan_current_datetime()->format( 'Y-m-d' );
        $vendor_vacation_dates = ( ! empty( $vendor_infos['seller_vacation_schedules'] ) && is_array( $vendor_infos['seller_vacation_schedules'] ) ) ? $vendor_infos['seller_vacation_schedules'] : [];

        foreach ( $vendor_vacation_dates as $vacation_date ) {
            if ( ( $current_date >= $vacation_date['from'] ) &&
                ( $current_date <= $vacation_date['to'] ) &&
                'yes' === $vendor_vacation_active
            ) {
                return false;
            }
        }

        $dokan_time   = dokan_current_datetime();
        $current_time = $dokan_time->format( 'H:i' );

        $dokan_store_time['opening_time'] = (array) $dokan_store_time['opening_time'];
        $dokan_store_time['closing_time'] = (array) $dokan_store_time['closing_time'];
        $times_length                     = count( $dokan_store_time['opening_time'] );

        for ( $index = 0; $index < $times_length; $index++ ) {
            $dokan_open_time  = $dokan_time->modify( $dokan_store_time['opening_time'][ $index ] )->format( 'H:i' );
            $dokan_close_time = $dokan_time->modify( $dokan_store_time['closing_time'][ $index ] )->format( 'H:i' );

            // Checked formatted opening and closing time by using formatted current time.
            if ( $dokan_open_time <= $current_time && $dokan_close_time >= $current_time ) {
                return true;
            }
        }

        return $store_open;
    }

    /**
     * Update store time template location for multi slot times.
     *
     * @since 3.5.0
     *
     * @param string $template
     *
     * @return string
     */
    public function update_store_time_template( $template ) {
        $time_format = wc_time_format();

        $data = [
            'step'           => 'h:i' === strtolower( $time_format ) ? '60' : '30',
            'format'         => $time_format,
            'placeholder'    => '00:00',
            'selectDefault'  => __( 'Select your store open days', 'dokan' ),
            'openingMaxTime' => 'h:i' === strtolower( $time_format ) ? '23:00' : '11:30 pm',
            'openingMinTime' => 'h:i' === strtolower( $time_format ) ? '00:00' : '12:00 am',
            'closingMaxTime' => 'h:i' === strtolower( $time_format ) ? '23:59' : '11:59 pm',
            'closingMinTime' => 'h:i' === strtolower( $time_format ) ? '00:59' : '12:29 am',
        ];

        wp_localize_script( 'dokan-pro-store-open-close-time', 'dokanMultipleTime', $data );
        wp_enqueue_script( 'dokan-pro-store-open-close-time' );

        // Load store open close action button from here.
        return 'store-times/store-times';
    }

    /**
     * Update store time template arguments for load multiple store times.
     *
     * @since 3.5.0
     *
     * @param array $args
     * @param array $dokan_store_info
     *
     * @return array
     */
    public function update_store_time_template_args( $args, $dokan_store_info ) {
        $args = [
            'pro'                   => true,
            'label_end'             => __( 'Closing time(s)', 'dokan' ),
            'store_info'            => $dokan_store_info,
            'dokan_days'            => dokan_get_translated_days(),
            'active_day'            => [],
            'label_start'           => __( 'Opening time(s)', 'dokan' ),
            'settings_label'        => __( 'Choose Business Days', 'dokan' ),
            'store_day_placeholder' => __( 'Select your store open days', 'dokan' ),
        ];

        return $args;
    }

    /**
     * Show stores multiple time settings field here.
     *
     * @since 3.5.0
     *
     * @param string $current_day
     * @param string $store_status
     *
     * @return void
     */
    public function added_store_times( $current_day, $store_status ) {
        $store_info       = dokan_get_store_info( dokan_get_current_user_id() );
        $dokan_store_time = isset( $store_info['dokan_store_time'] ) ? $store_info['dokan_store_time'] : '';

        if (
            empty( $dokan_store_time[ $current_day ] ) ||
            empty( $dokan_store_time[ $current_day ]['opening_time'] ) ||
            empty( $dokan_store_time[ $current_day ]['closing_time'] )
        ) {
            return;
        }

        $times_length = count( (array) $dokan_store_time[ $current_day ]['opening_time'] );

        for ( $index = 1; $index < $times_length; ++$index ) {
            $args = [
                'pro'              => true,
                'current_day'      => $current_day,
                'index'            => $index,
                'dokan_store_time' => $dokan_store_time,
            ];

            // Load multiple store times from here.
            dokan_get_template_part( 'store-times/add-new-time', '', $args );
        }
    }
}
