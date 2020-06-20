<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'bugspatrol_template_polaroid_theme_setup' ) ) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_template_polaroid_theme_setup', 1 );
	function bugspatrol_template_polaroid_theme_setup() {
		bugspatrol_add_template(array(
			'layout' => 'polaroid',
			'template' => 'polaroid',
			'mode'   => 'blogger',
			'container2' => '<div class="sc_blogger_elements"><div class="photostack" %css><div>%s</div></div></div>',
			'title'  => esc_html__('Blogger layout: Polaroid', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium square image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h'		 => 370
		));
		// Add template specific scripts
		add_action('bugspatrol_action_blog_scripts', 'bugspatrol_template_polaroid_add_scripts');
	}
}

// Add template specific scripts
if (!function_exists('bugspatrol_template_polaroid_add_scripts')) {
		function bugspatrol_template_polaroid_add_scripts($style) {
		if (bugspatrol_substr($style, 0, 8) == 'polaroid')
			bugspatrol_enqueue_polaroid();
	}
}

// Template output
if ( !function_exists( 'bugspatrol_template_polaroid_output' ) ) {
	function bugspatrol_template_polaroid_output($post_options, $post_data) {
		$show_title = true;
		$style = $post_options['layout'];
		?>
		<figure class="post_item sc_blogger_item sc_polaroid_item<?php if ($post_options['number'] == $post_options['posts_on_page'] && !bugspatrol_param_is_on($post_options['loadmore'])) echo ' sc_blogger_item_last'; ?>">
			<a href="<?php echo esc_url($post_data['post_link']); ?>" class="photostack-img"><?php bugspatrol_show_layout($post_data['post_thumb']); ?></a>
			<figcaption class="photostack_info">
				<h6 class="post_title sc_title sc_blogger_title sc_polaroid_title photostack-title"><?php bugspatrol_show_layout($post_data['post_title']); ?></h6>
				<?php
				if ($post_data['post_excerpt']) {
					echo '<div class="photostack-back">' 
						. (in_array($post_data['post_format'], array('quote', 'link', 'chat', 'aside', 'status')) 
							? $post_data['post_excerpt']
							: '<p>'.trim(bugspatrol_strshort($post_data['post_excerpt'], isset($post_options['descr']) 
									? $post_options['descr'] 
									: bugspatrol_get_custom_option('post_excerpt_maxlength_masonry')
									)
							).'</p>')
						. '</div>';
				}
				?>
			</figcaption>
		</figure>
		<?php
	}
}
?>