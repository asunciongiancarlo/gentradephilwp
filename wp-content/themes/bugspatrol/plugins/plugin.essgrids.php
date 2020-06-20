<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('bugspatrol_essgrids_theme_setup')) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_essgrids_theme_setup', 1 );
	function bugspatrol_essgrids_theme_setup() {
		// Register shortcode in the shortcodes list
		if (is_admin()) {
			add_filter( 'bugspatrol_filter_required_plugins',				'bugspatrol_essgrids_required_plugins' );
		}
	}
}


// Check if Ess. Grid installed and activated
if ( !function_exists( 'bugspatrol_exists_essgrids' ) ) {
	function bugspatrol_exists_essgrids() {
		return defined('EG_PLUGIN_PATH');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'bugspatrol_essgrids_required_plugins' ) ) {
		function bugspatrol_essgrids_required_plugins($list=array()) {
		if (in_array('essgrids', bugspatrol_storage_get('required_plugins'))) {
			$path = bugspatrol_get_file_dir('plugins/install/essential-grid.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' 		=> esc_html__('Essential Grid', 'bugspatrol'),
					'slug' 		=> 'essential-grid',
					'source'	=> $path,
                    'version'   => '2.3.5',
					'required' 	=> false
					);
			}
		}
		return $list;
	}
}
?>