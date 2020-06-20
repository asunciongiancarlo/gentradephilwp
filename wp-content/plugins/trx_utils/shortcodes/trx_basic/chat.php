<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('bugspatrol_sc_chat_theme_setup')) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_sc_chat_theme_setup' );
	function bugspatrol_sc_chat_theme_setup() {
		add_action('bugspatrol_action_shortcodes_list', 		'bugspatrol_sc_chat_reg_shortcodes');
		if (function_exists('bugspatrol_exists_visual_composer') && bugspatrol_exists_visual_composer())
			add_action('bugspatrol_action_shortcodes_list_vc','bugspatrol_sc_chat_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_chat id="unique_id" link="url" title=""]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/trx_chat]
[trx_chat id="unique_id" link="url" title=""]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/trx_chat]
...
*/

if (!function_exists('bugspatrol_sc_chat')) {	
	function bugspatrol_sc_chat($atts, $content=null){	
		if (bugspatrol_in_shortcode_blogger()) return '';
		extract(bugspatrol_html_decode(shortcode_atts(array(
			// Individual params
			"photo" => "",
			"title" => "",
			"link" => "",
			// Common params
			"id" => "",
			"class" => "",
			"css" => "",
			"animation" => "",
			"width" => "",
			"height" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . bugspatrol_get_css_position_as_classes($top, $right, $bottom, $left);
		$css .= bugspatrol_get_css_dimensions_from_values($width, $height);
		$title = $title=='' ? $link : $title;
		if (!empty($photo)) {
			if ($photo > 0) {
				$attach = wp_get_attachment_image_src( $photo, 'full' );
				if (isset($attach[0]) && $attach[0]!='')
					$photo = $attach[0];
			}
			$photo = bugspatrol_get_resized_image_tag($photo, 75, 75);
		}
		$content = do_shortcode($content);
		if (bugspatrol_substr($content, 0, 2)!='<p') $content = '<p>' . ($content) . '</p>';
		$output = '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
				. ' class="sc_chat' . (!empty($class) ? ' '.esc_attr($class) : '') . '"' 
				. (!bugspatrol_param_is_off($animation) ? ' data-animation="'.esc_attr(bugspatrol_get_animation_classes($animation)).'"' : '')
				. ($css ? ' style="'.esc_attr($css).'"' : '') 
				. '>'
					. '<div class="sc_chat_inner">'
						. ($photo ? '<div class="sc_chat_avatar">'.($photo).'</div>' : '')
						. ($title == '' ? '' : ('<div class="sc_chat_title">' . ($link!='' ? '<a href="'.esc_url($link).'">' : '') . ($title) . ($link!='' ? '</a>' : '') . '</div>'))
						. '<div class="sc_chat_content">'.($content).'</div>'
					. '</div>'
				. '</div>';
		return apply_filters('bugspatrol_shortcode_output', $output, 'trx_chat', $atts, $content);
	}
	bugspatrol_require_shortcode('trx_chat', 'bugspatrol_sc_chat');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'bugspatrol_sc_chat_reg_shortcodes' ) ) {
	//add_action('bugspatrol_action_shortcodes_list', 'bugspatrol_sc_chat_reg_shortcodes');
	function bugspatrol_sc_chat_reg_shortcodes() {
	
		bugspatrol_sc_map("trx_chat", array(
			"title" => esc_html__("Chat", 'trx_utils'),
			"desc" => wp_kses_data( __("Chat message", 'trx_utils') ),
			"decorate" => true,
			"container" => true,
			"params" => array(
				"title" => array(
					"title" => esc_html__("Item title", 'trx_utils'),
					"desc" => wp_kses_data( __("Chat item title", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"photo" => array(
					"title" => esc_html__("Item photo", 'trx_utils'),
					"desc" => wp_kses_data( __("Select or upload image or write URL from other site for the item photo (avatar)", 'trx_utils') ),
					"readonly" => false,
					"value" => "",
					"type" => "media"
				),
				"link" => array(
					"title" => esc_html__("Item link", 'trx_utils'),
					"desc" => wp_kses_data( __("Chat item link", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"_content_" => array(
					"title" => esc_html__("Chat item content", 'trx_utils'),
					"desc" => wp_kses_data( __("Current chat item content", 'trx_utils') ),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				"width" => bugspatrol_shortcodes_width(),
				"height" => bugspatrol_shortcodes_height(),
				"top" => bugspatrol_get_sc_param('top'),
				"bottom" => bugspatrol_get_sc_param('bottom'),
				"left" => bugspatrol_get_sc_param('left'),
				"right" => bugspatrol_get_sc_param('right'),
				"id" => bugspatrol_get_sc_param('id'),
				"class" => bugspatrol_get_sc_param('class'),
				"animation" => bugspatrol_get_sc_param('animation'),
				"css" => bugspatrol_get_sc_param('css')
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'bugspatrol_sc_chat_reg_shortcodes_vc' ) ) {
	//add_action('bugspatrol_action_shortcodes_list_vc', 'bugspatrol_sc_chat_reg_shortcodes_vc');
	function bugspatrol_sc_chat_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_chat",
			"name" => esc_html__("Chat", 'trx_utils'),
			"description" => wp_kses_data( __("Chat message", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_chat',
			"class" => "trx_sc_container trx_sc_chat",
			"content_element" => true,
			"is_container" => true,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "title",
					"heading" => esc_html__("Item title", 'trx_utils'),
					"description" => wp_kses_data( __("Title for current chat item", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "photo",
					"heading" => esc_html__("Item photo", 'trx_utils'),
					"description" => wp_kses_data( __("Select or upload image or write URL from other site for the item photo (avatar)", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "attach_image"
				),
				array(
					"param_name" => "link",
					"heading" => esc_html__("Link URL", 'trx_utils'),
					"description" => wp_kses_data( __("URL for the link on chat title click", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				bugspatrol_get_vc_param('id'),
				bugspatrol_get_vc_param('class'),
				bugspatrol_get_vc_param('animation'),
				bugspatrol_get_vc_param('css'),
				bugspatrol_vc_width(),
				bugspatrol_vc_height(),
				bugspatrol_get_vc_param('margin_top'),
				bugspatrol_get_vc_param('margin_bottom'),
				bugspatrol_get_vc_param('margin_left'),
				bugspatrol_get_vc_param('margin_right')
			),
			'js_view' => 'VcTrxTextContainerView'
		
		) );
		
		class WPBakeryShortCode_Trx_Chat extends Bugspatrol_VC_ShortCodeContainer {}
	}
}
?>