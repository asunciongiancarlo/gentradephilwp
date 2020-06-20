<?php

// Check if shortcodes settings are now used
if ( !function_exists( 'bugspatrol_shortcodes_is_used' ) ) {
	function bugspatrol_shortcodes_is_used() {
        $tem = '';
        if(isset($_REQUEST['page'])) $tem = $_REQUEST['page'];
		return bugspatrol_options_is_used() 															// All modes when Theme Options are used
			|| (is_admin() && isset($_POST['action']) 
					&& in_array($_POST['action'], array('vc_edit_form', 'wpb_show_edit_form')))		// AJAX query when save post/page
			|| (is_admin() && $tem=='vc-roles')										// VC Role Manager
			|| (function_exists('bugspatrol_vc_is_frontend') && bugspatrol_vc_is_frontend());			// VC Frontend editor mode
	}
}

// Width and height params
if ( !function_exists( 'bugspatrol_shortcodes_width' ) ) {
	function bugspatrol_shortcodes_width($w="") {
		return array(
			"title" => esc_html__("Width", 'trx_utils'),
			"divider" => true,
			"value" => $w,
			"type" => "text"
		);
	}
}
if ( !function_exists( 'bugspatrol_shortcodes_height' ) ) {
	function bugspatrol_shortcodes_height($h='') {
		return array(
			"title" => esc_html__("Height", 'trx_utils'),
			"desc" => wp_kses_data( __("Width and height of the element", 'trx_utils') ),
			"value" => $h,
			"type" => "text"
		);
	}
}

// Return sc_param value
if ( !function_exists( 'bugspatrol_get_sc_param' ) ) {
	function bugspatrol_get_sc_param($prm) {
		return bugspatrol_storage_get_array('sc_params', $prm);
	}
}

// Set sc_param value
if ( !function_exists( 'bugspatrol_set_sc_param' ) ) {
	function bugspatrol_set_sc_param($prm, $val) {
		bugspatrol_storage_set_array('sc_params', $prm, $val);
	}
}

// Add sc settings in the sc list
if ( !function_exists( 'bugspatrol_sc_map' ) ) {
	function bugspatrol_sc_map($sc_name, $sc_settings) {
		bugspatrol_storage_set_array('shortcodes', $sc_name, $sc_settings);
	}
}

// Add sc settings in the sc list after the key
if ( !function_exists( 'bugspatrol_sc_map_after' ) ) {
	function bugspatrol_sc_map_after($after, $sc_name, $sc_settings='') {
		bugspatrol_storage_set_array_after('shortcodes', $after, $sc_name, $sc_settings);
	}
}

// Add sc settings in the sc list before the key
if ( !function_exists( 'bugspatrol_sc_map_before' ) ) {
	function bugspatrol_sc_map_before($before, $sc_name, $sc_settings='') {
		bugspatrol_storage_set_array_before('shortcodes', $before, $sc_name, $sc_settings);
	}
}

// Compare two shortcodes by title
if ( !function_exists( 'bugspatrol_compare_sc_title' ) ) {
	function bugspatrol_compare_sc_title($a, $b) {
		return strcmp($a['title'], $b['title']);
	}
}



/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'bugspatrol_shortcodes_settings_theme_setup' ) ) {
//	if ( bugspatrol_vc_is_frontend() )
	if ( (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true') || (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline') )
		add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_shortcodes_settings_theme_setup', 20 );
	else
		add_action( 'bugspatrol_action_after_init_theme', 'bugspatrol_shortcodes_settings_theme_setup' );
	function bugspatrol_shortcodes_settings_theme_setup() {
		if (bugspatrol_shortcodes_is_used()) {

			// Sort templates alphabetically
			$tmp = bugspatrol_storage_get('registered_templates');
			ksort($tmp);
			bugspatrol_storage_set('registered_templates', $tmp);

			// Prepare arrays 
			bugspatrol_storage_set('sc_params', array(
			
				// Current element id
				'id' => array(
					"title" => esc_html__("Element ID", 'trx_utils'),
					"desc" => wp_kses_data( __("ID for current element", 'trx_utils') ),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
			
				// Current element class
				'class' => array(
					"title" => esc_html__("Element CSS class", 'trx_utils'),
					"desc" => wp_kses_data( __("CSS class for current element (optional)", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
			
				// Current element style
				'css' => array(
					"title" => esc_html__("CSS styles", 'trx_utils'),
					"desc" => wp_kses_data( __("Any additional CSS rules (if need)", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
			
			
				// Switcher choises
				'list_styles' => array(
					'ul'	=> esc_html__('Unordered', 'trx_utils'),
					'ol'	=> esc_html__('Ordered', 'trx_utils'),
					'iconed'=> esc_html__('Iconed', 'trx_utils')
				),

				'yes_no'	=> bugspatrol_get_list_yesno(),
				'on_off'	=> bugspatrol_get_list_onoff(),
				'dir' 		=> bugspatrol_get_list_directions(),
				'align'		=> bugspatrol_get_list_alignments(),
				'float'		=> bugspatrol_get_list_floats(),
				'hpos'		=> bugspatrol_get_list_hpos(),
				'show_hide'	=> bugspatrol_get_list_showhide(),
				'sorting' 	=> bugspatrol_get_list_sortings(),
				'ordering' 	=> bugspatrol_get_list_orderings(),
				'shapes'	=> bugspatrol_get_list_shapes(),
				'sizes'		=> bugspatrol_get_list_sizes(),
				'sliders'	=> bugspatrol_get_list_sliders(),
				'controls'	=> bugspatrol_get_list_controls(),
                'categories'=> is_admin() && bugspatrol_get_value_gp('action')=='vc_edit_form' && substr(bugspatrol_get_value_gp('tag'), 0, 4)=='trx_' && isset($_POST['params']['post_type']) && $_POST['params']['post_type']!='post'
                                ? bugspatrol_get_list_terms(false, bugspatrol_get_taxonomy_categories_by_post_type($_POST['params']['post_type']))
                                : bugspatrol_get_list_categories(),
				'columns'	=> bugspatrol_get_list_columns(),
				'images'	=> array_merge(array('none'=>"none"), bugspatrol_get_list_images("images/icons", "png")),
				'icons'		=> array_merge(array("inherit", "none"), bugspatrol_get_list_icons()),
				'locations'	=> bugspatrol_get_list_dedicated_locations(),
				'filters'	=> bugspatrol_get_list_portfolio_filters(),
				'formats'	=> bugspatrol_get_list_post_formats_filters(),
				'hovers'	=> bugspatrol_get_list_hovers(true),
				'hovers_dir'=> bugspatrol_get_list_hovers_directions(true),
				'schemes'	=> bugspatrol_get_list_color_schemes(true),
				'animations'		=> bugspatrol_get_list_animations_in(),
				'margins' 			=> bugspatrol_get_list_margins(true),
				'blogger_styles'	=> bugspatrol_get_list_templates_blogger(),
				'forms'				=> bugspatrol_get_list_templates_forms(),
				'posts_types'		=> bugspatrol_get_list_posts_types(),
				'googlemap_styles'	=> bugspatrol_get_list_googlemap_styles(),
				'field_types'		=> bugspatrol_get_list_field_types(),
				'label_positions'	=> bugspatrol_get_list_label_positions()
				)
			);

			// Common params
			bugspatrol_set_sc_param('animation', array(
				"title" => esc_html__("Animation",  'trx_utils'),
				"desc" => wp_kses_data( __('Select animation while object enter in the visible area of page',  'trx_utils') ),
				"value" => "none",
				"type" => "select",
				"options" => bugspatrol_get_sc_param('animations')
				)
			);
			bugspatrol_set_sc_param('top', array(
				"title" => esc_html__("Top margin",  'trx_utils'),
				"divider" => true,
				"value" => "inherit",
				"type" => "select",
				"options" => bugspatrol_get_sc_param('margins')
				)
			);
			bugspatrol_set_sc_param('bottom', array(
				"title" => esc_html__("Bottom margin",  'trx_utils'),
				"value" => "inherit",
				"type" => "select",
				"options" => bugspatrol_get_sc_param('margins')
				)
			);
			bugspatrol_set_sc_param('left', array(
				"title" => esc_html__("Left margin",  'trx_utils'),
				"value" => "inherit",
				"type" => "select",
				"options" => bugspatrol_get_sc_param('margins')
				)
			);
			bugspatrol_set_sc_param('right', array(
				"title" => esc_html__("Right margin",  'trx_utils'),
				"desc" => wp_kses_data( __("Margins around this shortcode", 'trx_utils') ),
				"value" => "inherit",
				"type" => "select",
				"options" => bugspatrol_get_sc_param('margins')
				)
			);

			bugspatrol_storage_set('sc_params', apply_filters('bugspatrol_filter_shortcodes_params', bugspatrol_storage_get('sc_params')));

			// Shortcodes list
			//------------------------------------------------------------------
			bugspatrol_storage_set('shortcodes', array());
			
			// Register shortcodes
			do_action('bugspatrol_action_shortcodes_list');

			// Sort shortcodes list
			$tmp = bugspatrol_storage_get('shortcodes');
			uasort($tmp, 'bugspatrol_compare_sc_title');
			bugspatrol_storage_set('shortcodes', $tmp);
		}
	}
}
?>