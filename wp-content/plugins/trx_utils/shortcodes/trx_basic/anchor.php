<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('bugspatrol_sc_anchor_theme_setup')) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_sc_anchor_theme_setup' );
	function bugspatrol_sc_anchor_theme_setup() {
		add_action('bugspatrol_action_shortcodes_list', 		'bugspatrol_sc_anchor_reg_shortcodes');
		if (function_exists('bugspatrol_exists_visual_composer') && bugspatrol_exists_visual_composer())
			add_action('bugspatrol_action_shortcodes_list_vc','bugspatrol_sc_anchor_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_anchor id="unique_id" description="Anchor description" title="Short Caption" icon="icon-class"]
*/

if (!function_exists('bugspatrol_sc_anchor')) {	
	function bugspatrol_sc_anchor($atts, $content = null) {
		if (bugspatrol_in_shortcode_blogger()) return '';
		extract(bugspatrol_html_decode(shortcode_atts(array(
			// Individual params
			"title" => "",
			"description" => '',
			"icon" => '',
			"url" => "",
			"separator" => "no",
			// Common params
			"id" => ""
		), $atts)));
		$output = $id 
			? '<a id="'.esc_attr($id).'"'
				. ' class="sc_anchor"' 
				. ' title="' . ($title ? esc_attr($title) : '') . '"'
				. ' data-description="' . ($description ? esc_attr(bugspatrol_strmacros($description)) : ''). '"'
				. ' data-icon="' . ($icon ? $icon : '') . '"' 
				. ' data-url="' . ($url ? esc_attr($url) : '') . '"' 
				. ' data-separator="' . (bugspatrol_param_is_on($separator) ? 'yes' : 'no') . '"'
				. '></a>'
			: '';
		return apply_filters('bugspatrol_shortcode_output', $output, 'trx_anchor', $atts, $content);
	}
	bugspatrol_require_shortcode("trx_anchor", "bugspatrol_sc_anchor");
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'bugspatrol_sc_anchor_reg_shortcodes' ) ) {
	//add_action('bugspatrol_action_shortcodes_list', 'bugspatrol_sc_anchor_reg_shortcodes');
	function bugspatrol_sc_anchor_reg_shortcodes() {
	
		bugspatrol_sc_map("trx_anchor", array(
			"title" => esc_html__("Anchor", 'trx_utils'),
			"desc" => wp_kses_data( __("Insert anchor for the TOC (table of content)", 'trx_utils') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"icon" => array(
					"title" => esc_html__("Anchor's icon",  'trx_utils'),
					"desc" => wp_kses_data( __('Select icon for the anchor from Fontello icons set',  'trx_utils') ),
					"value" => "",
					"type" => "icons",
					"options" => bugspatrol_get_sc_param('icons')
				),
				"title" => array(
					"title" => esc_html__("Short title", 'trx_utils'),
					"desc" => wp_kses_data( __("Short title of the anchor (for the table of content)", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"description" => array(
					"title" => esc_html__("Long description", 'trx_utils'),
					"desc" => wp_kses_data( __("Description for the popup (then hover on the icon). You can use:<br>'{{' and '}}' - to make the text italic,<br>'((' and '))' - to make the text bold,<br>'||' - to insert line break", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"url" => array(
					"title" => esc_html__("External URL", 'trx_utils'),
					"desc" => wp_kses_data( __("External URL for this TOC item", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"separator" => array(
					"title" => esc_html__("Add separator", 'trx_utils'),
					"desc" => wp_kses_data( __("Add separator under item in the TOC", 'trx_utils') ),
					"value" => "no",
					"type" => "switch",
					"options" => bugspatrol_get_sc_param('yes_no')
				),
				"id" => bugspatrol_get_sc_param('id')
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'bugspatrol_sc_anchor_reg_shortcodes_vc' ) ) {
	//add_action('bugspatrol_action_shortcodes_list_vc', 'bugspatrol_sc_anchor_reg_shortcodes_vc');
	function bugspatrol_sc_anchor_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_anchor",
			"name" => esc_html__("Anchor", 'trx_utils'),
			"description" => wp_kses_data( __("Insert anchor for the TOC (table of content)", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_anchor',
			"class" => "trx_sc_single trx_sc_anchor",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "icon",
					"heading" => esc_html__("Anchor's icon", 'trx_utils'),
					"description" => wp_kses_data( __("Select icon for the anchor from Fontello icons set", 'trx_utils') ),
					"class" => "",
					"value" => bugspatrol_get_sc_param('icons'),
					"type" => "dropdown"
				),
				array(
					"param_name" => "title",
					"heading" => esc_html__("Short title", 'trx_utils'),
					"description" => wp_kses_data( __("Short title of the anchor (for the table of content)", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "description",
					"heading" => esc_html__("Long description", 'trx_utils'),
					"description" => wp_kses_data( __("Description for the popup (then hover on the icon). You can use:<br>'{{' and '}}' - to make the text italic,<br>'((' and '))' - to make the text bold,<br>'||' - to insert line break", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "url",
					"heading" => esc_html__("External URL", 'trx_utils'),
					"description" => wp_kses_data( __("External URL for this TOC item", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "separator",
					"heading" => esc_html__("Add separator", 'trx_utils'),
					"description" => wp_kses_data( __("Add separator under item in the TOC", 'trx_utils') ),
					"class" => "",
					"value" => array("Add separator" => "yes" ),
					"type" => "checkbox"
				),
				bugspatrol_get_vc_param('id')
			),
		) );
		
		class WPBakeryShortCode_Trx_Anchor extends Bugspatrol_VC_ShortCodeSingle {}
	}
}
?>