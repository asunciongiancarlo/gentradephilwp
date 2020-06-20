<?php
/**
 * Attachment page
 */
get_header(); 

while ( have_posts() ) { the_post();

	// Move bugspatrol_set_post_views to the javascript - counter will work under cache system
	if (bugspatrol_get_custom_option('use_ajax_views_counter')=='no') {
		bugspatrol_set_post_views(get_the_ID());
	}

	bugspatrol_show_post_layout(
		array(
			'layout' => 'attachment',
			'sidebar' => !bugspatrol_param_is_off(bugspatrol_get_custom_option('show_sidebar_main'))
		)
	);

}

get_footer();
?>