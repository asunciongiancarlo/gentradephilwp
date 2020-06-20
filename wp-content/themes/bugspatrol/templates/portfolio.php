<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'bugspatrol_template_portfolio_theme_setup' ) ) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_template_portfolio_theme_setup', 1 );
	function bugspatrol_template_portfolio_theme_setup() {
		bugspatrol_add_template(array(
			'layout' => 'portfolio_2',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => esc_html__('Portfolio tile (with hovers, different height) /2 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium image', 'bugspatrol'),
			'w'		 => 370,
			'h_crop' => 209,
			'h'		 => null
		));
		bugspatrol_add_template(array(
			'layout' => 'portfolio_3',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => esc_html__('Portfolio tile /3 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium image', 'bugspatrol'),
			'w'		 => 370,
			'h_crop' => 209,
			'h'		 => null
		));
		bugspatrol_add_template(array(
			'layout' => 'portfolio_4',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => esc_html__('Portfolio tile /4 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium image', 'bugspatrol'),
			'w'		 => 370,
			'h_crop' => 209,
			'h'		 => null
		));
		bugspatrol_add_template(array(
			'layout' => 'grid_2',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'container_classes' => 'no_margins',
			'title'  => esc_html__('Grid tile (with hovers, equal height) /2 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h' 	 => 209
		));
		bugspatrol_add_template(array(
			'layout' => 'grid_3',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'container_classes' => 'no_margins',
			'title'  => esc_html__('Grid tile /3 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h'		 => 209
		));
		bugspatrol_add_template(array(
			'layout' => 'grid_4',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'container_classes' => 'no_margins',
			'title'  => esc_html__('Grid tile /4 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h'		 => 209
		));
		bugspatrol_add_template(array(
			'layout' => 'square_2',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'container_classes' => 'no_margins',
			'title'  => esc_html__('Square tile (with hovers, width=height) /2 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium square image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h' 	 => 370
		));
		bugspatrol_add_template(array(
			'layout' => 'square_3',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'container_classes' => 'no_margins',
			'title'  => esc_html__('Square tile /3 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium square image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h'		 => 370
		));
		bugspatrol_add_template(array(
			'layout' => 'square_4',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'container_classes' => 'no_margins',
			'title'  => esc_html__('Square tile /4 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium square image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h'		 => 370
		));
		bugspatrol_add_template(array(
			'layout' => 'colored_1',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'need_terms' => true,
			'title'  => esc_html__('Colored excerpt', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium square image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h'		 => 370
		));
		bugspatrol_add_template(array(
			'layout' => 'colored_2',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'need_terms' => true,
			'title'  => esc_html__('Colored tile (with hovers, width=height) /2 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium square image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h' 	 => 370
		));
		bugspatrol_add_template(array(
			'layout' => 'colored_3',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'need_terms' => true,
			'title'  => esc_html__('Colored tile /3 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium square image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h'		 => 370
		));
		bugspatrol_add_template(array(
			'layout' => 'colored_4',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'need_terms' => true,
			'title'  => esc_html__('Colored tile /4 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium square image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h'		 => 370
		));
		bugspatrol_add_template(array(
			'layout' => 'short_2',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'need_terms' => true,
			'container_classes' => 'no_margins',
			'title'  => esc_html__('Short info /2 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium square image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h' 	 => 370
		));
		bugspatrol_add_template(array(
			'layout' => 'short_3',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'need_terms' => true,
			'container_classes' => 'no_margins',
			'title'  => esc_html__('Short info /3 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium square image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h'		 => 370
		));
		bugspatrol_add_template(array(
			'layout' => 'short_4',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'need_terms' => true,
			'container_classes' => 'no_margins',
			'title'  => esc_html__('Short info /4 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium square image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h'		 => 370
		));
		bugspatrol_add_template(array(
			'layout' => 'alter_2',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'container_classes' => 'small_margins',
			'title'  => esc_html__('Alternative grid (with hovers) /2 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium square image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h' 	 => 370
		));
		bugspatrol_add_template(array(
			'layout' => 'alter_3',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'container_classes' => 'small_margins',
			'title'  => esc_html__('Alternative grid /3 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium square image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h'		 => 370
		));
		bugspatrol_add_template(array(
			'layout' => 'alter_4',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'container_classes' => 'small_margins',
			'title'  => esc_html__('Alternative grid /4 columns/', 'bugspatrol'),
			'thumb_title'  => esc_html__('Medium square image (crop)', 'bugspatrol'),
			'w'		 => 370,
			'h'		 => 370
		));
		// Add template specific scripts
		add_action('bugspatrol_action_blog_scripts', 'bugspatrol_template_portfolio_add_scripts');
	}
}

// Add template specific scripts
if (!function_exists('bugspatrol_template_portfolio_add_scripts')) {
		function bugspatrol_template_portfolio_add_scripts($style) {
		if (bugspatrol_substr($style, 0, 10) == 'portfolio_' 
			|| bugspatrol_substr($style, 0, 5) == 'grid_' 
			|| bugspatrol_substr($style, 0, 7) == 'square_' 
			|| bugspatrol_substr($style, 0, 6) == 'short_'
			|| bugspatrol_substr($style, 0, 6) == 'alter_' 
			|| bugspatrol_substr($style, 0, 8) == 'colored_') {
			wp_enqueue_script( 'isotope', bugspatrol_get_file_url('js/jquery.isotope.min.js'), array(), null, true );
			if ($style != 'colored_1')  {
				wp_enqueue_script( 'hoverdir', bugspatrol_get_file_url('js/hover/jquery.hoverdir.js'), array(), null, true );
				wp_enqueue_style( 'bugspatrol-portfolio-style', bugspatrol_get_file_url('css/core.portfolio.css'), array(), null );
			}
		}
	}
}

// Template output
if ( !function_exists( 'bugspatrol_template_portfolio_output' ) ) {
	function bugspatrol_template_portfolio_output($post_options, $post_data) {
		$show_title = !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote'));
		$parts = explode('_', $post_options['layout']);
		$style = $parts[0];
		$columns = max(1, min(12, empty($post_options['columns_count']) 
									? (empty($parts[1]) ? 1 : (int) $parts[1])
									: $post_options['columns_count']
									));
		$tag = bugspatrol_in_shortcode_blogger(true) ? 'div' : 'article';
		if ($post_options['hover']=='square effect4') $post_options['hover']='square effect5';
		$link_start = !isset($post_options['links']) || $post_options['links'] ? '<a href="'.esc_url($post_data['post_link']).'">' : '';
		$link_end = !isset($post_options['links']) || $post_options['links'] ? '</a>' : '';
		if (in_array($post_data['post_type'], array('matches', 'players')))
			$post_meta = get_post_meta($post_data['post_id'], bugspatrol_storage_get('options_prefix').'_post_options', true);

		if ($style == 'colored' && $columns==1) {				// colored excerpt style (1 column)
			?>
			<div class="isotope_item isotope_item_colored isotope_item_colored_1 isotope_column_1
						<?php
						if ($post_options['filters'] != '') {
							if ($post_options['filters']=='categories' && !empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms_ids))
								echo ' flt_' . join(' flt_', $post_data['post_terms'][$post_data['post_taxonomy']]->terms_ids);
							else if ($post_options['filters']=='tags' && !empty($post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_ids))
								echo ' flt_' . join(' flt_', $post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_ids);
						}
						?>">
				<<?php bugspatrol_show_layout($tag); ?> class="post_item post_item_colored post_item_colored_1
					<?php echo 'post_format_'.esc_attr($post_data['post_format']) 
						. ($post_options['number']%2==0 ? ' even' : ' odd') 
						. ($post_options['number']==0 ? ' first' : '') 
						. ($post_options['number']==$post_options['posts_on_page'] ? ' last' : '')
						. ($post_data['post_type'] == 'matches' ? ' type_match' : '');
					?>">
	
					<div class="post_content isotope_item_content">
						<div class="post_featured img">
							<?php 
							
							bugspatrol_show_layout($post_data['post_thumb'], $link_start, $link_end);
							
							bugspatrol_template_set_args('reviews-summary', array(
								'post_options' => $post_options,
								'post_data' => $post_data
							));
							get_template_part(bugspatrol_get_file_slug('templates/_parts/reviews-summary.php'));
							$reviews_summary = bugspatrol_storage_get('reviews_summary');

							$new = bugspatrol_get_custom_option('mark_as_new', '', $post_data['post_id'], $post_data['post_type']);					// !!!!!! Get option from specified post
							if ($new && $new > date('Y-m-d')) {
								?><div class="post_mark_new"><?php esc_html_e('NEW', 'bugspatrol'); ?></div><?php
							}
							?>
						</div>
		
						<div class="post_description clearfix">
							<?php
							if ($post_data['post_type'] == 'matches'){
								// Date of the match
								echo '<div class="match_date">'
										. (!empty($post_meta['match_date']) && !bugspatrol_param_is_inherit($post_meta['match_date']) ?  date("d M", strtotime($post_meta['match_date'])) : '')
										. (!empty($post_meta['match_time']) && !bugspatrol_param_is_inherit($post_meta['match_time']) ?  ' ' . trim($post_meta['match_time']) : '')
									.'</div>';
								?>
								<div class="post_category">
									<?php
									if (!empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms_links))
										echo join(', ', $post_data['post_terms'][$post_data['post_taxonomy']]->terms_links);
									?>
								</div>
							<?php
							}							
							?>
							<h5 class="post_title"><?php bugspatrol_show_layout($post_data['post_title'] . ($post_data['post_type'] == 'matches' ? ': ' . trim($post_meta['match_player_1']) . ' - ' . trim($post_meta['match_player_2']) : ''), $link_start, $link_end); ?></h5>
							<?php
							if ($post_data['post_type'] == 'players'){
								// Player information
								echo '<div class="player_info">'
										. (!empty($post_meta['player_country']) && !bugspatrol_param_is_inherit($post_meta['player_country']) ? '<span class="player_country">'. esc_html__( 'Country: ', 'bugspatrol' ) .''. bugspatrol_get_list_countries(false,$post_meta['player_country']) . '</span>' : '')
										. (!empty($post_meta['player_club']) && !bugspatrol_param_is_inherit($post_meta['player_club']) ? '<span class="player_club">'. esc_html__( 'Club: ', 'bugspatrol' ) .''. trim($post_meta['player_club']) .'</span>' : '')
										. (!empty($post_meta['player_age']) && !bugspatrol_param_is_inherit($post_meta['player_age']) && $post_meta['player_type'] == 'player' ? '<span class="player_age">'. esc_html__( 'Age: ', 'bugspatrol' ) .''. trim($post_meta['player_age']) .'</span>' : '')
									.'</div>';
							}
							else if($post_data['post_type'] != 'matches'){					
							?>
							<div class="post_category">
								<?php
								if (!empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms_links))
									echo join(', ', $post_data['post_terms'][$post_data['post_taxonomy']]->terms_links);
								?>
							</div>
							<?php
							}
							
							bugspatrol_show_layout($reviews_summary); ?>
							<div class="post_descr">
								<?php bugspatrol_show_layout($post_data['post_excerpt']); ?>
							</div>
							<?php if ($post_data['post_link'] != '') { ?>
								<div class="post_buttons">
									<?php bugspatrol_show_layout(bugspatrol_sc_button(array(
																		'size'=>'small',
																		'link'=>$post_data['post_link']
																		),
																		esc_html__('LEARN MORE', 'bugspatrol'))); ?>
								</div>
							<?php } ?>
						</div>
					</div>				<!-- /.post_content -->
				</<?php bugspatrol_show_layout($tag); ?>>	<!-- /.post_item -->
			</div>						<!-- /.isotope_item -->
			<?php

		} else {										// All rest portfolio styles (portfolio, grid, square, colored) with 2 and more columns

			// Detect new image size for alter portfolio
			if ($style=='alter') {
				$thumb_sizes = bugspatrol_get_thumb_sizes(array(
					'layout' => $post_options['layout']
				));

				$alter_size = explode('_', bugspatrol_get_custom_option('alter_thumb_size', '1_1', $post_data['post_id'], $post_data['post_type']));	// !!!!!! Get option from specified post
				$alter_size[0] = max(1, $alter_size[0]);
				$alter_size[1] = max(1, empty($alter_size[1]) ? 1 : $alter_size[1]);
				$post_data['post_thumb'] = bugspatrol_get_resized_image_tag($post_data['post_attachment'], 
					$alter_size[0]*$thumb_sizes['w'] + ($alter_size[0]-1)*10,
					$alter_size[1]*$thumb_sizes['h'] + ($alter_size[1]-1)*10
				);
				$post_data['post_thumb'] = str_replace('<img', '<img'
					. ' data-alter-items-w="'.esc_attr($alter_size[0]).'"'
					. ' data-alter-items-h="'.esc_attr($alter_size[1]).'"'
					. ' data-alter-item-space="10"',
					$post_data['post_thumb']);
			}

			?>
			<div class="isotope_item isotope_item_<?php echo esc_attr($style); ?> isotope_item_<?php echo esc_attr($post_options['layout']); ?> isotope_column_<?php echo esc_attr($columns); ?>
						<?php
						if ($style=='alter') {
							echo ' isotope_item_size-'.esc_attr(join('_', $alter_size));
						}
						if ($post_options['filters'] != '') {
							if ($post_options['filters']=='categories' && !empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms_ids))
								echo ' flt_' . esc_attr(join(' flt_', $post_data['post_terms'][$post_data['post_taxonomy']]->terms_ids));
							else if ($post_options['filters']=='tags' && !empty($post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_ids))
								echo ' flt_' . esc_attr(join(' flt_', $post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_ids));
						}
						?>">
				<<?php bugspatrol_show_layout($tag); ?> class="post_item post_item_<?php echo esc_attr($style); ?> post_item_<?php echo esc_attr($post_options['layout']); ?>
					<?php echo 'post_format_'.esc_attr($post_data['post_format']) 
						. ($post_options['number']%2==0 ? ' even' : ' odd') 
						. ($post_options['number']==0 ? ' first' : '') 
						. ($post_options['number']==$post_options['posts_on_page'] ? ' last' : '')
						. ($post_data['post_type'] == 'players' ? ' type_player' : '');
					?>">
	
					<div class="post_content isotope_item_content<?php
						if ($style!='colored') {
							echo ' ih-item colored'
								. (!empty($post_options['hover']) ? ' '.esc_attr($post_options['hover']) : '')
								. (!empty($post_options['hover_dir']) ? ' '.esc_attr($post_options['hover_dir']) : '');
						}
					 ?>">
						<?php
						if ($style!='colored') {
							if ($post_options['hover'] == 'circle effect1') {
								?><div class="spinner"></div><?php
							}
							if ($post_options['hover'] == 'square effect4') {
								?><div class="mask1"></div><div class="mask2"></div><?php
							}
							if ($post_options['hover'] == 'circle effect8') {
								?><div class="img-container"><?php
							}
						}
						?>
						<div class="post_featured img <?php bugspatrol_show_layout($post_data['post_type'] == 'matches' ? 'matches_hover' : '');?>">
							<?php 

							bugspatrol_show_layout($post_data['post_thumb'], $link_start, $link_end);
							
							if ($style=='colored') {
								bugspatrol_template_set_args('reviews-summary', array(
									'post_options' => $post_options,
									'post_data' => $post_data
								));
								get_template_part(bugspatrol_get_file_slug('templates/_parts/reviews-summary.php'));
								$reviews_summary = bugspatrol_storage_get('reviews_summary');
								$new = bugspatrol_get_custom_option('mark_as_new', '', $post_data['post_id'], $post_data['post_type']);			// !!!!!! Get option from specified post
								if ($new && $new > date('Y-m-d')) {
									?><div class="post_mark_new"><?php esc_html_e('NEW', 'bugspatrol'); ?></div><?php
								}
								?>
								<h5 class="post_title"><?php bugspatrol_show_layout($post_data['post_title'] . ($post_data['post_type'] == 'matches' ? ': ' . trim($post_meta['match_player_1']) . ' - ' . trim($post_meta['match_player_2']) : ''), $link_start, $link_end); ?></h5>
								<div class="post_descr">
									<?php
									$category = !empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms) 
												? ($post_data['post_terms'][$post_data['post_taxonomy']]->terms[0]->link ? '<a href="'.esc_url($post_data['post_terms'][$post_data['post_taxonomy']]->terms[0]->link).'">' : '')
													. ($post_data['post_terms'][$post_data['post_taxonomy']]->terms[0]->name)
													. ($post_data['post_terms'][$post_data['post_taxonomy']]->terms[0]->link ? '</a>' : '')
												: '';
												
									if ($post_data['post_type'] == 'players') {
										// Player information
										echo '<div class="player_info">'
												.(!empty($post_meta['player_country']) && !bugspatrol_param_is_inherit($post_meta['player_country']) ? '<span class="player_country">'. esc_html__( 'Country: ', 'bugspatrol' ) .''. bugspatrol_get_list_countries(false,$post_meta['player_country']) .'</span>' : '')
												.(!empty($post_meta['player_club']) && !bugspatrol_param_is_inherit($post_meta['player_club']) ? '<span class="player_club">'. esc_html__( 'Club: ', 'bugspatrol' ) .''. trim($post_meta['player_club']) .'</span>' : '')
												.(!empty($post_meta['player_age']) && !bugspatrol_param_is_inherit($post_meta['player_age']) && $post_meta['player_type'] == 'player' ? '<span class="player_age">'. esc_html__( 'Age: ', 'bugspatrol' ) .''. trim($post_meta['player_age']) .'</span>' : '')
											.'</div>';
									} else if ($post_data['post_type'] == 'matches') {
										// Date of the match
										echo '<div class="match_date">'
												.(!empty($post_meta['match_date']) && !bugspatrol_param_is_inherit($post_meta['match_date']) ?  date("d M", strtotime($post_meta['match_date'])) : '')
												.(!empty($post_meta['match_time']) && !bugspatrol_param_is_inherit($post_meta['match_time']) ?  ' ' . trim($post_meta['match_time']) : '')
											.'</div>';
										?><div class="post_category"><?php bugspatrol_show_layout($category); ?></div><?php
									} else { 
										?><div class="post_category"><?php bugspatrol_show_layout($category); ?></div><?php 
									}
									bugspatrol_show_layout($reviews_summary); ?>
								</div>
								<?php
							}
							?>
						</div>
						<?php
						if ($style!='colored') {
							if ($post_options['hover'] == 'circle effect8') {
								?>
								</div>	<!-- .img-container -->
								<div class="info-container">
								<?php
							}
							?>
		
							<div class="post_info_wrap info"><div class="info-back">
		
								<?php
								if ($show_title) {
									?><h4 class="post_title"><?php bugspatrol_show_layout($post_data['post_title'], $link_start, $link_end); ?></h4><?php
								}
								?>
		
								<div class="post_descr">
								<?php
									if ($post_data['post_protected']) {
										bugspatrol_show_layout($post_data['post_excerpt'], $link_start, $link_end);
									} else {
										if (!$post_data['post_protected'] && $post_options['info']) {
											$post_options['info_parts'] = array('counters'=>true, 'terms'=>false, 'author' => false, 'tag' => 'p');
											bugspatrol_template_set_args('post-info', array(
												'post_options' => $post_options,
												'post_data' => $post_data
											));
											get_template_part(bugspatrol_get_file_slug('templates/_parts/post-info.php')); 
										}
										if ($post_data['post_excerpt']) {
											echo in_array($post_data['post_format'], array('quote', 'link', 'chat', 'aside', 'status')) 
												? ( ($link_start) . ($post_data['post_excerpt']) . ($link_end) )
												: '<p>' . ($link_start) 
													. (bugspatrol_strpos($post_options['hover'], 'square')!==false
														? strip_tags($post_data['post_excerpt'])
														: trim(bugspatrol_strshort($post_data['post_excerpt'], isset($post_options['descr']) ? $post_options['descr'] : bugspatrol_get_custom_option('post_excerpt_maxlength_masonry'))) 
														)
													. ($link_end) . '</p>';
										}
										if ($post_data['post_link'] != '') {
											?><p class="post_buttons"><?php
											if (!bugspatrol_param_is_off($post_options['readmore']) && !in_array($post_data['post_format'], array('quote', 'link', 'chat', 'aside', 'status'))) {
												?><a href="<?php echo esc_url($post_data['post_link']); ?>" class="post_readmore"><span class="post_readmore_label"><?php bugspatrol_show_layout($post_options['readmore']); ?></span></a><?php
											}
											?></p><?php
										}
									}
								?>
								</div>
							</div></div>	<!-- /.info-back /.info -->
							<?php if ($post_options['hover'] == 'circle effect8') { ?>
							</div>			<!-- /.info-container -->
							<?php } ?>
						<?php }	?>
					</div>				<!-- /.post_content -->
				</<?php bugspatrol_show_layout($tag); ?>>	<!-- /.post_item -->
			</div>						<!-- /.isotope_item -->
			<?php
		}		}
}
?>