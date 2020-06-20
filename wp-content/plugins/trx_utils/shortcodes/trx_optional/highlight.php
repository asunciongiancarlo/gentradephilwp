<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('bugspatrol_sc_highlight_theme_setup')) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_sc_highlight_theme_setup' );
	function bugspatrol_sc_highlight_theme_setup() {
		add_action('bugspatrol_action_shortcodes_list', 		'bugspatrol_sc_highlight_reg_shortcodes');
		if (function_exists('bugspatrol_exists_visual_composer') && bugspatrol_exists_visual_composer())
			add_action('bugspatrol_action_shortcodes_list_vc','bugspatrol_sc_highlight_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_highlight id="unique_id" color="fore_color's_name_or_#rrggbb" backcolor="back_color's_name_or_#rrggbb" style="custom_style"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/trx_highlight]
*/

if (!function_exists('bugspatrol_sc_highlight')) {	
	function bugspatrol_sc_highlight($atts, $content=null){	
		if (bugspatrol_in_shortcode_blogger()) return '';
		extract(bugspatrol_html_decode(shortcode_atts(array(
			// Individual params
			"color" => "",
			"bg_color" => "",
			"font_size" => "",
			"type" => "1",
			// Common params
			"id" => "",
			"class" => "",
			"css" => ""
		), $atts)));
		$css .= ($color != '' ? 'color:' . esc_attr($color) . ';' : '')
			.($bg_color != '' ? 'background-color:' . esc_attr($bg_color) . ';' : '')
			.($font_size != '' ? 'font-size:' . esc_attr(bugspatrol_prepare_css_value($font_size)) . '; line-height: 1em;' : '');
		$output = '<span' . ($id ? ' id="'.esc_attr($id).'"' : '') 
				. ' class="sc_highlight'.($type>0 ? ' sc_highlight_style_'.esc_attr($type) : ''). (!empty($class) ? ' '.esc_attr($class) : '').'"'
				. ($css!='' ? ' style="'.esc_attr($css).'"' : '')
				. '>' 
				. do_shortcode($content) 
				. '</span>';
		return apply_filters('bugspatrol_shortcode_output', $output, 'trx_highlight', $atts, $content);
	}
	bugspatrol_require_shortcode('trx_highlight', 'bugspatrol_sc_highlight');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'bugspatrol_sc_highlight_reg_shortcodes' ) ) {
	//add_action('bugspatrol_action_shortcodes_list', 'bugspatrol_sc_highlight_reg_shortcodes');
	function bugspatrol_sc_highlight_reg_shortcodes() {
	
		bugspatrol_sc_map("trx_highlight", array(
			"title" => esc_html__("Highlight text", 'trx_utils'),
			"desc" => wp_kses_data( __("Highlight text with selected color, background color and other styles", 'trx_utils') ),
			"decorate" => false,
			"container" => true,
			"params" => array(
				"type" => array(
					"title" => esc_html__("Type", 'trx_utils'),
					"desc" => wp_kses_data( __("Highlight type", 'trx_utils') ),
					"value" => "1",
					"type" => "checklist",
					"options" => array(
						0 => esc_html__('Custom', 'trx_utils'),
						1 => esc_html__('Type 1', 'trx_utils'),
						2 => esc_html__('Type 2', 'trx_utils'),
						3 => esc_html__('Type 3', 'trx_utils')
					)
				),
				"color" => array(
					"title" => esc_html__("Color", 'trx_utils'),
					"desc" => wp_kses_data( __("Color for the highlighted text", 'trx_utils') ),
					"divider" => true,
					"value" => "",
					"type" => "color"
				),
				"bg_color" => array(
					"title" => esc_html__("Background color", 'trx_utils'),
					"desc" => wp_kses_data( __("Background color for the highlighted text", 'trx_utils') ),
					"value" => "",
					"type" => "color"
				),
				"font_size" => array(
					"title" => esc_html__("Font size", 'trx_utils'),
					"desc" => wp_kses_data( __("Font size of the highlighted text (default - in pixels, allows any CSS units of measure)", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"_content_" => array(
					"title" => esc_html__("Highlighting content", 'trx_utils'),
					"desc" => wp_kses_data( __("Content for highlight", 'trx_utils') ),
					"divider" => true,
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				"id" => bugspatrol_get_sc_param('id'),
				"class" => bugspatrol_get_sc_param('class'),
				"css" => bugspatrol_get_sc_param('css')
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'bugspatrol_sc_highlight_reg_shortcodes_vc' ) ) {
	//add_action('bugspatrol_action_shortcodes_list_vc', 'bugspatrol_sc_highlight_reg_shortcodes_vc');
	function bugspatrol_sc_highlight_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_highlight",
			"name" => esc_html__("Highlight text", 'trx_utils'),
			"description" => wp_kses_data( __("Highlight text with selected color, background color and other styles", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_highlight',
			"class" => "trx_sc_single trx_sc_highlight",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "type",
					"heading" => esc_html__("Type", 'trx_utils'),
					"description" => wp_kses_data( __("Highlight type", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => array(
							esc_html__('Custom', 'trx_utils') => 0,
							esc_html__('Type 1', 'trx_utils') => 1,
							esc_html__('Type 2', 'trx_utils') => 2,
							esc_html__('Type 3', 'trx_utils') => 3
						),
					"type" => "dropdown"
				),
				array(
					"param_name" => "color",
					"heading" => esc_html__("Text color", 'trx_utils'),
					"description" => wp_kses_data( __("Color for the highlighted text", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "colorpicker"
				),
				array(
					"param_name" => "bg_color",
					"heading" => esc_html__("Background color", 'trx_utils'),
					"description" => wp_kses_data( __("Background color for the highlighted text", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "colorpicker"
				),
				array(
					"param_name" => "font_size",
					"heading" => esc_html__("Font size", 'trx_utils'),
					"description" => wp_kses_data( __("Font size for the highlighted text (default - in pixels, allows any CSS units of measure)", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "content",
					"heading" => esc_html__("Highlight text", 'trx_utils'),
					"description" => wp_kses_data( __("Content for highlight", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "textarea_html"
				),
				bugspatrol_get_vc_param('id'),
				bugspatrol_get_vc_param('class'),
				bugspatrol_get_vc_param('css')
			),
			'js_view' => 'VcTrxTextView'
		) );
		
		class WPBakeryShortCode_Trx_Highlight extends Bugspatrol_VC_ShortCodeSingle {}
	}
}
?>