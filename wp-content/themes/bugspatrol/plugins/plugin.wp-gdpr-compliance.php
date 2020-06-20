<?php
/* WP GDPR Compliance support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('bugspatrol_wp_gdpr_compliance_theme_setup')) {
    add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_wp_gdpr_compliance_theme_setup', 1 );
    function bugspatrol_wp_gdpr_compliance_theme_setup() {
        if (is_admin()) {
            add_filter( 'bugspatrol_filter_required_plugins', 'bugspatrol_wp_gdpr_compliance_required_plugins' );
        }
    }
}

// Check if Instagram Widget installed and activated
if ( !function_exists( 'bugspatrol_exists_wp_gdpr_compliance' ) ) {
    function bugspatrol_exists_wp_gdpr_compliance() {
        return defined( 'WP_GDPR_Compliance_VERSION' );
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'bugspatrol_wp_gdpr_compliance_required_plugins' ) ) {
        function bugspatrol_wp_gdpr_compliance_required_plugins($list=array()) {
        if (in_array('wp_gdpr_compliance', (array)bugspatrol_storage_get('required_plugins')))
            $list[] = array(
                'name'         => esc_html__('WP GDPR Compliance', 'bugspatrol'),
                'slug'         => 'wp-gdpr-compliance',
                'required'     => false
            );
        return $list;
    }
}
