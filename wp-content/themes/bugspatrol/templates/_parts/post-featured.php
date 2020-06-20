<?php
// Get template args
extract(bugspatrol_template_get_args('post-featured'));

if (!empty($post_data['post_video'])) {
	bugspatrol_show_layout(bugspatrol_get_video_frame($post_data['post_video'], $post_data['post_video_image'] ? $post_data['post_video_image'] : $post_data['post_thumb']));

} else if (!empty($post_data['post_audio'])) {
	if (bugspatrol_get_custom_option('substitute_audio')=='no' || !bugspatrol_in_shortcode_blogger(true))
		bugspatrol_show_layout(bugspatrol_get_audio_frame($post_data['post_audio'], $post_data['post_audio_image'] ? $post_data['post_audio_image'] : $post_data['post_thumb_url']));
	else
		bugspatrol_show_layout($post_data['post_audio']);

} else if (!empty($post_data['post_thumb']) && ($post_data['post_format']!='gallery' || empty($post_data['post_gallery']) || bugspatrol_get_custom_option('gallery_instead_image')=='no')) {
	?>
	<div class="post_thumb" data-image="<?php echo esc_url($post_data['post_attachment']); ?>" data-title="<?php echo esc_attr($post_data['post_title']); ?>">
	<?php
	if ($post_data['post_format']=='link' && $post_data['post_url']!='')
		echo '<a class="hover_icon hover_icon_link" href="'.esc_url($post_data['post_url']).'"'.($post_data['post_url_target'] ? ' target="'.esc_attr($post_data['post_url_target']).'"' : '').'>'.($post_data['post_thumb']).'</a>';
	else if ($post_data['post_link']!='')
		echo '<a class="hover_icon hover_icon_link" href="'.esc_url($post_data['post_link']).'">'.($post_data['post_thumb']).'</a>';
	else
		bugspatrol_show_layout($post_data['post_thumb']);
	?>
	</div>
	<?php

} else if (!empty($post_data['post_gallery'])) {
	bugspatrol_enqueue_slider();
	bugspatrol_show_layout($post_data['post_gallery']);
}
?>