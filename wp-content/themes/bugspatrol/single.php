<?php
/**
 * Single post
 */
get_header(); 

$single_style = bugspatrol_storage_get('single_style');
if (empty($single_style)) $single_style = bugspatrol_get_custom_option('single_style');

while ( have_posts() ) { the_post();
	bugspatrol_show_post_layout(
		array(
			'layout' => $single_style,
			'sidebar' => !bugspatrol_param_is_off(bugspatrol_get_custom_option('show_sidebar_main')),
			'content' => bugspatrol_get_template_property($single_style, 'need_content'),
			'terms_list' => bugspatrol_get_template_property($single_style, 'need_terms')
		)
	);
}

get_footer();
?>