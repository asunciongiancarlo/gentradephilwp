<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('bugspatrol_mailchimp_theme_setup')) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_mailchimp_theme_setup', 1 );
	function bugspatrol_mailchimp_theme_setup() {
		if (is_admin()) {
			add_filter( 'bugspatrol_filter_required_plugins',					'bugspatrol_mailchimp_required_plugins' );
		}
	}
}

// Check if Instagram Feed installed and activated
if ( !function_exists( 'bugspatrol_exists_mailchimp' ) ) {
	function bugspatrol_exists_mailchimp() {
		return function_exists('mc4wp_load_plugin');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'bugspatrol_mailchimp_required_plugins' ) ) {
		function bugspatrol_mailchimp_required_plugins($list=array()) {
		if (in_array('mailchimp', bugspatrol_storage_get('required_plugins')))
			$list[] = array(
				'name' 		=> esc_html__('MailChimp for WP', 'bugspatrol'),
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		return $list;
	}
}
?>