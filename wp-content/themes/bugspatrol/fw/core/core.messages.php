<?php
/**
 * BugsPatrol Framework: messages subsystem
 *
 * @package	bugspatrol
 * @since	bugspatrol 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('bugspatrol_messages_theme_setup')) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_messages_theme_setup' );
	function bugspatrol_messages_theme_setup() {
		// Core messages strings
		add_filter('bugspatrol_filter_localize_script', 'bugspatrol_messages_localize_script');
	}
}


/* Session messages
------------------------------------------------------------------------------------- */

if (!function_exists('bugspatrol_get_error_msg')) {
	function bugspatrol_get_error_msg() {
		return bugspatrol_storage_get('error_msg');
	}
}

if (!function_exists('bugspatrol_set_error_msg')) {
	function bugspatrol_set_error_msg($msg) {
		$msg2 = bugspatrol_get_error_msg();
		bugspatrol_storage_set('error_msg', trim($msg2) . ($msg2=='' ? '' : '<br />') . trim($msg));
	}
}

if (!function_exists('bugspatrol_get_success_msg')) {
	function bugspatrol_get_success_msg() {
		return bugspatrol_storage_get('success_msg');
	}
}

if (!function_exists('bugspatrol_set_success_msg')) {
	function bugspatrol_set_success_msg($msg) {
		$msg2 = bugspatrol_get_success_msg();
		bugspatrol_storage_set('success_msg', trim($msg2) . ($msg2=='' ? '' : '<br />') . trim($msg));
	}
}

if (!function_exists('bugspatrol_get_notice_msg')) {
	function bugspatrol_get_notice_msg() {
		return bugspatrol_storage_get('notice_msg');
	}
}

if (!function_exists('bugspatrol_set_notice_msg')) {
	function bugspatrol_set_notice_msg($msg) {
		$msg2 = bugspatrol_get_notice_msg();
		bugspatrol_storage_set('notice_msg', trim($msg2) . ($msg2=='' ? '' : '<br />') . trim($msg));
	}
}


/* System messages (save when page reload)
------------------------------------------------------------------------------------- */
if (!function_exists('bugspatrol_set_system_message')) {
	function bugspatrol_set_system_message($msg, $status='info', $hdr='') {
		update_option(bugspatrol_storage_get('options_prefix') . '_message', array('message' => $msg, 'status' => $status, 'header' => $hdr));
	}
}

if (!function_exists('bugspatrol_get_system_message')) {
	function bugspatrol_get_system_message($del=false) {
		$msg = get_option(bugspatrol_storage_get('options_prefix') . '_message', false);
		if (!$msg)
			$msg = array('message' => '', 'status' => '', 'header' => '');
		else if ($del)
			bugspatrol_del_system_message();
		return $msg;
	}
}

if (!function_exists('bugspatrol_del_system_message')) {
	function bugspatrol_del_system_message() {
		delete_option(bugspatrol_storage_get('options_prefix') . '_message');
	}
}


/* Messages strings
------------------------------------------------------------------------------------- */

if (!function_exists('bugspatrol_messages_localize_script')) {
		function bugspatrol_messages_localize_script($vars) {
		$vars['strings'] = array(
			'ajax_error'		=> esc_html__('Invalid server answer', 'bugspatrol'),
			'bookmark_add'		=> esc_html__('Add the bookmark', 'bugspatrol'),
            'bookmark_added'	=> esc_html__('Current page has been successfully added to the bookmarks. You can see it in the right panel on the tab \'Bookmarks\'', 'bugspatrol'),
            'bookmark_del'		=> esc_html__('Delete this bookmark', 'bugspatrol'),
            'bookmark_title'	=> esc_html__('Enter bookmark title', 'bugspatrol'),
            'bookmark_exists'	=> esc_html__('Current page already exists in the bookmarks list', 'bugspatrol'),
			'search_error'		=> esc_html__('Error occurs in AJAX search! Please, type your query and press search icon for the traditional search way.', 'bugspatrol'),
			'email_confirm'		=> esc_html__('On the e-mail address "%s" we sent a confirmation email. Please, open it and click on the link.', 'bugspatrol'),
			'reviews_vote'		=> esc_html__('Thanks for your vote! New average rating is:', 'bugspatrol'),
			'reviews_error'		=> esc_html__('Error saving your vote! Please, try again later.', 'bugspatrol'),
			'error_like'		=> esc_html__('Error saving your like! Please, try again later.', 'bugspatrol'),
			'error_global'		=> esc_html__('Global error text', 'bugspatrol'),
			'name_empty'		=> esc_html__('The name can\'t be empty', 'bugspatrol'),
			'name_long'			=> esc_html__('Too long name', 'bugspatrol'),
			'email_empty'		=> esc_html__('Too short (or empty) email address', 'bugspatrol'),
			'email_long'		=> esc_html__('Too long email address', 'bugspatrol'),
			'email_not_valid'	=> esc_html__('Invalid email address', 'bugspatrol'),
			'subject_empty'		=> esc_html__('The subject can\'t be empty', 'bugspatrol'),
			'subject_long'		=> esc_html__('Too long subject', 'bugspatrol'),
			'text_empty'		=> esc_html__('The message text can\'t be empty', 'bugspatrol'),
			'text_long'			=> esc_html__('Too long message text', 'bugspatrol'),
			'send_complete'		=> esc_html__("Send message complete!", 'bugspatrol'),
			'send_error'		=> esc_html__('Transmit failed!', 'bugspatrol'),
			'geocode_error'			=> esc_html__('Geocode was not successful for the following reason:', 'bugspatrol'),
			'googlemap_not_avail'	=> esc_html__('Google map API not available!', 'bugspatrol'),
			'editor_save_success'	=> esc_html__("Post content saved!", 'bugspatrol'),
			'editor_save_error'		=> esc_html__("Error saving post data!", 'bugspatrol'),
			'editor_delete_post'	=> esc_html__("You really want to delete the current post?", 'bugspatrol'),
			'editor_delete_post_header'	=> esc_html__("Delete post", 'bugspatrol'),
			'editor_delete_success'	=> esc_html__("Post deleted!", 'bugspatrol'),
			'editor_delete_error'	=> esc_html__("Error deleting post!", 'bugspatrol'),
			'editor_caption_cancel'	=> esc_html__('Cancel', 'bugspatrol'),
			'editor_caption_close'	=> esc_html__('Close', 'bugspatrol')
			);
		return $vars;
	}
}
?>