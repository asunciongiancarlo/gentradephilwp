<?php
// Get template args
extract(bugspatrol_template_get_args('counters'));

$show_all_counters = !isset($post_options['counters']);
$counters_tag = is_single() ? 'span' : 'a';

// Views
if ($show_all_counters || bugspatrol_strpos($post_options['counters'], 'views')!==false) {
	?>
	<<?php bugspatrol_show_layout($counters_tag); ?> class="post_counters_item post_counters_views icon-eye" title="<?php echo esc_attr( sprintf(__('Views - %s', 'bugspatrol'), $post_data['post_views']) ); ?>" href="<?php echo esc_url($post_data['post_link']); ?>"><span class="post_counters_number"><?php bugspatrol_show_layout($post_data['post_views']); ?></span><?php if (bugspatrol_strpos($post_options['counters'], 'captions')!==false) echo ' '.esc_html__('Views', 'bugspatrol'); ?></<?php bugspatrol_show_layout($counters_tag); ?>>
	<?php
}

// Comments
if ($show_all_counters || bugspatrol_strpos($post_options['counters'], 'comments')!==false) {
	?>
	<a class="post_counters_item post_counters_comments icon-comment-1" title="<?php echo esc_attr( sprintf(__('Comments - %s', 'bugspatrol'), $post_data['post_comments']) ); ?>" href="<?php echo esc_url($post_data['post_comments_link']); ?>"><span class="post_counters_number"><?php bugspatrol_show_layout($post_data['post_comments']); ?></span><?php if (bugspatrol_strpos($post_options['counters'], 'captions')!==false) echo ' '.esc_html__('Comments', 'bugspatrol'); ?></a>
	<?php 
}
 
// Rating
$rating = $post_data['post_reviews_'.(bugspatrol_get_theme_option('reviews_first')=='author' ? 'author' : 'users')];
if ($rating > 0 && ($show_all_counters || bugspatrol_strpos($post_options['counters'], 'rating')!==false)) { 
	?>
	<<?php bugspatrol_show_layout($counters_tag); ?> class="post_counters_item post_counters_rating icon-star" title="<?php echo esc_attr( sprintf(__('Rating - %s', 'bugspatrol'), $rating) ); ?>" href="<?php echo esc_url($post_data['post_link']); ?>"><span class="post_counters_number"><?php bugspatrol_show_layout($rating); ?></span></<?php bugspatrol_show_layout($counters_tag); ?>>
	<?php
}

// Likes
if ($show_all_counters || bugspatrol_strpos($post_options['counters'], 'likes')!==false) {
	// Load core messages
	bugspatrol_enqueue_messages();
	$likes = isset($_COOKIE['bugspatrol_likes']) ? $_COOKIE['bugspatrol_likes'] : '';
	$allow = bugspatrol_strpos($likes, ','.($post_data['post_id']).',')===false;
	?>
	<a class="post_counters_item post_counters_likes icon-heart <?php echo !empty($allow) ? 'enabled' : 'disabled'; ?>" title="<?php echo !empty($allow) ? esc_attr__('Like', 'bugspatrol') : esc_attr__('Dislike', 'bugspatrol'); ?>" href="#"
		data-postid="<?php echo esc_attr($post_data['post_id']); ?>"
		data-likes="<?php echo esc_attr($post_data['post_likes']); ?>"
		data-title-like="<?php esc_attr_e('Like', 'bugspatrol'); ?>"
		data-title-dislike="<?php esc_attr_e('Dislike', 'bugspatrol'); ?>"><span class="post_counters_number"><?php bugspatrol_show_layout($post_data['post_likes']); ?></span><?php if (bugspatrol_strpos($post_options['counters'], 'captions')!==false) echo ' '.esc_html__('Likes', 'bugspatrol'); ?></a>
	<?php
}

// Edit page link
if (bugspatrol_strpos($post_options['counters'], 'edit')!==false) {
	edit_post_link( esc_html__( 'Edit', 'bugspatrol' ), '<span class="post_edit edit-link">', '</span>' );
}

// Markup for search engines
if (is_single() && bugspatrol_strpos($post_options['counters'], 'markup')!==false) {
	?>
	<meta itemprop="interactionCount" content="User<?php echo esc_attr(bugspatrol_strpos($post_options['counters'],'comments')!==false ? 'Comments' : 'PageVisits'); ?>:<?php echo esc_attr(bugspatrol_strpos($post_options['counters'], 'comments')!==false ? $post_data['post_comments'] : $post_data['post_views']); ?>" />
	<?php
}
?>