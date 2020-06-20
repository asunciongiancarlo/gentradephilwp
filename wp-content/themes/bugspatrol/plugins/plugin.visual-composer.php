<?php
/* WPBakery PageBuilder support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('bugspatrol_vc_theme_setup')) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_vc_theme_setup', 1 );
	function bugspatrol_vc_theme_setup() {
		if (bugspatrol_exists_visual_composer()) {
			add_action('bugspatrol_action_add_styles',		 				'bugspatrol_vc_frontend_scripts' );
		}
		if (is_admin()) {
			add_filter( 'bugspatrol_filter_required_plugins',					'bugspatrol_vc_required_plugins' );
		}
	}
}

// Check if WPBakery PageBuilder installed and activated
if ( !function_exists( 'bugspatrol_exists_visual_composer' ) ) {
	function bugspatrol_exists_visual_composer() {
		return class_exists('Vc_Manager');
	}
}

// Check if WPBakery PageBuilder in frontend editor mode
if ( !function_exists( 'bugspatrol_vc_is_frontend' ) ) {
	function bugspatrol_vc_is_frontend() {
		return (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true')
			|| (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'bugspatrol_vc_required_plugins' ) ) {
		function bugspatrol_vc_required_plugins($list=array()) {
		if (in_array('visual_composer', bugspatrol_storage_get('required_plugins'))) {
			$path = bugspatrol_get_file_dir('plugins/install/js_composer.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' 		=> esc_html__('WPBakery PageBuilder', 'bugspatrol'),
					'slug' 		=> 'js_composer',
					'source'	=> $path,
                    'version'   => '6.1',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Enqueue VC custom styles
if ( !function_exists( 'bugspatrol_vc_frontend_scripts' ) ) {
		function bugspatrol_vc_frontend_scripts() {
		if (file_exists(bugspatrol_get_file_dir('css/plugin.visual-composer.css')))
			wp_enqueue_style( 'bugspatrol-plugin-visual-composer-style',  bugspatrol_get_file_url('css/plugin.visual-composer.css'), array(), null );
	}
}

?>