<?php
/* elegro Crypto Payment support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('bugspatrol_woocommerce_elegro_payment_theme_setup')) {
    add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_woocommerce_elegro_payment_theme_setup', 1 );
    function bugspatrol_woocommerce_elegro_payment_theme_setup() {
        if (is_admin()) {
            add_filter( 'bugspatrol_filter_required_plugins', 'bugspatrol_woocommerce_elegro_payment_required_plugins' );
        }
    }
}

// Check if elegro Crypto Payment installed and activated
if ( !function_exists( 'bugspatrol_exists_woocommerce_elegro_payment' ) ) {
    function bugspatrol_exists_woocommerce_elegro_payment() {
        return function_exists('init_Elegro_Payment');
    }
}


// Filter to add in the required plugins list
if ( !function_exists( 'bugspatrol_woocommerce_elegro_payment_required_plugins' ) ) {
    function bugspatrol_woocommerce_elegro_payment_required_plugins($list=array()) {
        if (in_array('elegro-payment', (array)bugspatrol_storage_get('required_plugins')))
            $list[] = array(
                'name' 		=> esc_html__('elegro Crypto Payment', 'bugspatrol'),
                'slug' 		=> 'elegro-payment',
                'required' 	=> false
            );
        return $list;
    }
}
