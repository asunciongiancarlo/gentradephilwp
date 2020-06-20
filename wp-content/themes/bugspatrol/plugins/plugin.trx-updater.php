<?php
/* ThemeREX Updater support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('bugspatrol_trx_updater_theme_setup')) {
    add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_trx_updater_theme_setup', 1 );
    function bugspatrol_trx_updater_theme_setup() {
        // Register shortcode in the shortcodes list
        if (is_admin()) {
            add_filter( 'bugspatrol_filter_required_plugins',				'bugspatrol_trx_updater_required_plugins' );
        }
    }
}

// Check if Instagram Widget installed and activated
if ( !function_exists( 'bugspatrol_exists_trx_updater' ) ) {
    function bugspatrol_exists_trx_updater() {
        return function_exists( 'trx_updater_load_plugin_textdomain' );
    }
}


// Filter to add in the required plugins list
if ( !function_exists( 'bugspatrol_trx_updater_required_plugins' ) ) {
    function bugspatrol_trx_updater_required_plugins($list=array()) {
        if (in_array('trx_updater', bugspatrol_storage_get('required_plugins'))) {
            $path = bugspatrol_get_file_dir('plugins/install/trx_updater.zip');
            if (file_exists($path)) {
                $list[] = array(
                    'name' 		=> esc_html__('ThemeREX Updater', 'bugspatrol'),
                    'slug' 		=> 'trx_updater',
                    'source'	=> $path,
                    'version'   => '1.3.5',
                    'required' 	=> false
                );
            }
        }
        return $list;
    }
}