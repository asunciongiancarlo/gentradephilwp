<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('bugspatrol_booked_theme_setup')) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_booked_theme_setup', 1 );
	function bugspatrol_booked_theme_setup() {
		// Register shortcode in the shortcodes list
		if (bugspatrol_exists_booked()) {
			add_action('bugspatrol_action_add_styles', 					'bugspatrol_booked_frontend_scripts');


		}
		if (is_admin()) {

			add_filter( 'bugspatrol_filter_required_plugins',				'bugspatrol_booked_required_plugins' );
		}
	}
}


// Check if plugin installed and activated
if ( !function_exists( 'bugspatrol_exists_booked' ) ) {
	function bugspatrol_exists_booked() {
		return class_exists('booked_plugin');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'bugspatrol_booked_required_plugins' ) ) {
		function bugspatrol_booked_required_plugins($list=array()) {
		if (in_array('booked', bugspatrol_storage_get('required_plugins'))) {
			$path = bugspatrol_get_file_dir('plugins/install/booked.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' 		=> esc_html__('Booked', 'bugspatrol'),
					'slug' 		=> 'booked',
					'version'   => '2.2.5',
					'source'	=> $path,
					'required' 	=> false
					);
			}
		}
		return $list;
	}
}

// Enqueue custom styles
if ( !function_exists( 'bugspatrol_booked_frontend_scripts' ) ) {
		function bugspatrol_booked_frontend_scripts() {
		if (file_exists(bugspatrol_get_file_dir('css/plugin.booked.css')))
			wp_enqueue_style( 'bugspatrol-plugin-booked-style',  bugspatrol_get_file_url('css/plugin.booked.css'), array(), null );
	}
}


// Lists
//------------------------------------------------------------------------

// Return booked calendars list, prepended inherit (if need)
if ( !function_exists( 'bugspatrol_get_list_booked_calendars' ) ) {
	function bugspatrol_get_list_booked_calendars($prepend_inherit=false) {
		return bugspatrol_exists_booked() ? bugspatrol_get_list_terms($prepend_inherit, 'booked_custom_calendars') : array();
	}
}



// Filter to add in the required plugins list
if ( !function_exists( 'bugspatrol_booked_required_plugins' ) ) {
        function bugspatrol_booked_required_plugins($list=array()) {
        if (in_array('booked', (array)bugspatrol_storage_get('required_plugins'))) {
            $path = bugspatrol_get_file_dir('plugins/install/booked.zip');
            if (!empty($path) && file_exists($path)) {
                $list[] = array(
                    'name'         => esc_html__('Booked', 'bugspatrol'),
                    'slug'         => 'booked',
                    'source'    => $path,
                    'required'     => false
                );
            }
            $path = bugspatrol_get_file_dir( 'plugins/install/booked-calendar-feeds.zip' );
            if ( !empty($path) && file_exists($path) ) {
                $list[] = array(
                    'name'     => esc_html__( 'Booked Calendar Feeds', 'bugspatrol' ),
                    'slug'     => 'booked-calendar-feeds',
                    'source'   => $path,
                    'version'  => '1.1.5',
                    'required' => false,
                );
            }
            $path = bugspatrol_get_file_dir( 'plugins/install/booked-frontend-agents.zip' );
            if ( !empty($path) && file_exists($path) ) {
                $list[] = array(
                    'name'     => esc_html__( 'Booked Front-End Agents', 'bugspatrol' ),
                    'slug'     => 'booked-frontend-agents',
                    'source'   => $path,
                    'version'  => '1.1.15',
                    'required' => false,
                );
            }
            $path = bugspatrol_get_file_dir( 'plugins/install/booked-woocommerce-payments.zip' );
            if ( !empty($path) && file_exists($path) ) {
                $list[] = array(
                    'name'     => esc_html__( 'WooCommerce addons - Booked Payments with WooCommerce', 'bugspatrol' ),
                    'slug'     => 'booked-woocommerce-payments',
                    'source'   => $path,
                    'version'  => '1.4.9',
                    'required' => false,
                );
            }
        }
        return $list;
    }
}
?>