<?php
if (!function_exists('bugspatrol_theme_shortcodes_setup')) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_theme_shortcodes_setup', 1 );
	function bugspatrol_theme_shortcodes_setup() {
		add_filter('bugspatrol_filter_googlemap_styles', 'bugspatrol_theme_shortcodes_googlemap_styles');
	}
}


// Add theme-specific Google map styles
if ( !function_exists( 'bugspatrol_theme_shortcodes_googlemap_styles' ) ) {
	function bugspatrol_theme_shortcodes_googlemap_styles($list) {
		$list['simple']		= esc_html__('Simple', 'bugspatrol');
		$list['greyscale']	= esc_html__('Greyscale', 'bugspatrol');
		$list['inverse']	= esc_html__('Inverse', 'bugspatrol');
		$list['apple']		= esc_html__('Apple', 'bugspatrol');
		return $list;
	}
}
?>