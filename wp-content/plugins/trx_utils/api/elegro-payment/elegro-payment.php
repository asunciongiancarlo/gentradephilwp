<?php

// Remove API keys from dummy data
if ( !function_exists( 'trx_utils_elegro_payment_filter_export_options' ) ) {
    add_filter( 'trx_utils_filter_export_options', 'trx_utils_elegro_payment_filter_export_options' );
    function trx_utils_elegro_payment_filter_export_options( $options ) {
        if (isset($options['woocommerce_elegro_settings'])) {
            unset($options['woocommerce_elegro_settings']);
        }
        return $options;
    }
}