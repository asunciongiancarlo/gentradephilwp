<?php
/**
 * BugsPatrol Framework: return lists
 *
 * @package bugspatrol
 * @since bugspatrol 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }



// Return styles list
if ( !function_exists( 'bugspatrol_get_list_styles' ) ) {
	function bugspatrol_get_list_styles($from=1, $to=2, $prepend_inherit=false) {
		$list = array();
		for ($i=$from; $i<=$to; $i++)
			$list[$i] = sprintf(esc_html__('Style %d', 'bugspatrol'), $i);
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list of the shortcodes margins
if ( !function_exists( 'bugspatrol_get_list_margins' ) ) {
	function bugspatrol_get_list_margins($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_margins'))=='') {
			$list = array(
				'null'		=> esc_html__('0 (No margin)',	'bugspatrol'),
				'tiny'		=> esc_html__('Tiny',		'bugspatrol'),
				'small'		=> esc_html__('Small',		'bugspatrol'),
				'medium'	=> esc_html__('Medium',		'bugspatrol'),
				'large'		=> esc_html__('Large',		'bugspatrol'),
				'huge'		=> esc_html__('Huge',		'bugspatrol'),
				'tiny-'		=> esc_html__('Tiny (negative)',	'bugspatrol'),
				'small-'	=> esc_html__('Small (negative)',	'bugspatrol'),
				'medium-'	=> esc_html__('Medium (negative)',	'bugspatrol'),
				'large-'	=> esc_html__('Large (negative)',	'bugspatrol'),
				'huge-'		=> esc_html__('Huge (negative)',	'bugspatrol')
				);
			$list = apply_filters('bugspatrol_filter_list_margins', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_margins', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list of the line styles
if ( !function_exists( 'bugspatrol_get_list_line_styles' ) ) {
	function bugspatrol_get_list_line_styles($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_line_styles'))=='') {
			$list = array(
				'solid'	=> esc_html__('Solid', 'bugspatrol'),
				'dashed'=> esc_html__('Dashed', 'bugspatrol'),
				'dotted'=> esc_html__('Dotted', 'bugspatrol'),
				'double'=> esc_html__('Double', 'bugspatrol'),
				'image'	=> esc_html__('Image', 'bugspatrol')
				);
			$list = apply_filters('bugspatrol_filter_list_line_styles', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_line_styles', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list of the animations
if ( !function_exists( 'bugspatrol_get_list_animations' ) ) {
	function bugspatrol_get_list_animations($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_animations'))=='') {
			$list = array(
				'none'			=> esc_html__('- None -',	'bugspatrol'),
				'bounce'		=> esc_html__('Bounce',		'bugspatrol'),
				'elastic'		=> esc_html__('Elastic',	'bugspatrol'),
				'flash'			=> esc_html__('Flash',		'bugspatrol'),
				'flip'			=> esc_html__('Flip',		'bugspatrol'),
				'pulse'			=> esc_html__('Pulse',		'bugspatrol'),
				'rubberBand'	=> esc_html__('Rubber Band','bugspatrol'),
				'shake'			=> esc_html__('Shake',		'bugspatrol'),
				'swing'			=> esc_html__('Swing',		'bugspatrol'),
				'tada'			=> esc_html__('Tada',		'bugspatrol'),
				'wobble'		=> esc_html__('Wobble',		'bugspatrol')
				);
			$list = apply_filters('bugspatrol_filter_list_animations', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_animations', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list of the enter animations
if ( !function_exists( 'bugspatrol_get_list_animations_in' ) ) {
	function bugspatrol_get_list_animations_in($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_animations_in'))=='') {
			$list = array(
				'none'				=> esc_html__('- None -',			'bugspatrol'),
				'bounceIn'			=> esc_html__('Bounce In',			'bugspatrol'),
				'bounceInUp'		=> esc_html__('Bounce In Up',		'bugspatrol'),
				'bounceInDown'		=> esc_html__('Bounce In Down',		'bugspatrol'),
				'bounceInLeft'		=> esc_html__('Bounce In Left',		'bugspatrol'),
				'bounceInRight'		=> esc_html__('Bounce In Right',	'bugspatrol'),
				'elastic'			=> esc_html__('Elastic In',			'bugspatrol'),
				'fadeIn'			=> esc_html__('Fade In',			'bugspatrol'),
				'fadeInUp'			=> esc_html__('Fade In Up',			'bugspatrol'),
				'fadeInUpSmall'		=> esc_html__('Fade In Up Small',	'bugspatrol'),
				'fadeInUpBig'		=> esc_html__('Fade In Up Big',		'bugspatrol'),
				'fadeInDown'		=> esc_html__('Fade In Down',		'bugspatrol'),
				'fadeInDownBig'		=> esc_html__('Fade In Down Big',	'bugspatrol'),
				'fadeInLeft'		=> esc_html__('Fade In Left',		'bugspatrol'),
				'fadeInLeftBig'		=> esc_html__('Fade In Left Big',	'bugspatrol'),
				'fadeInRight'		=> esc_html__('Fade In Right',		'bugspatrol'),
				'fadeInRightBig'	=> esc_html__('Fade In Right Big',	'bugspatrol'),
				'flipInX'			=> esc_html__('Flip In X',			'bugspatrol'),
				'flipInY'			=> esc_html__('Flip In Y',			'bugspatrol'),
				'lightSpeedIn'		=> esc_html__('Light Speed In',		'bugspatrol'),
				'rotateIn'			=> esc_html__('Rotate In',			'bugspatrol'),
				'rotateInUpLeft'	=> esc_html__('Rotate In Down Left','bugspatrol'),
				'rotateInUpRight'	=> esc_html__('Rotate In Up Right',	'bugspatrol'),
				'rotateInDownLeft'	=> esc_html__('Rotate In Up Left',	'bugspatrol'),
				'rotateInDownRight'	=> esc_html__('Rotate In Down Right','bugspatrol'),
				'rollIn'			=> esc_html__('Roll In',			'bugspatrol'),
				'slideInUp'			=> esc_html__('Slide In Up',		'bugspatrol'),
				'slideInDown'		=> esc_html__('Slide In Down',		'bugspatrol'),
				'slideInLeft'		=> esc_html__('Slide In Left',		'bugspatrol'),
				'slideInRight'		=> esc_html__('Slide In Right',		'bugspatrol'),
				'wipeInLeftTop'		=> esc_html__('Wipe In Left Top',	'bugspatrol'),
				'zoomIn'			=> esc_html__('Zoom In',			'bugspatrol'),
				'zoomInUp'			=> esc_html__('Zoom In Up',			'bugspatrol'),
				'zoomInDown'		=> esc_html__('Zoom In Down',		'bugspatrol'),
				'zoomInLeft'		=> esc_html__('Zoom In Left',		'bugspatrol'),
				'zoomInRight'		=> esc_html__('Zoom In Right',		'bugspatrol')
				);
			$list = apply_filters('bugspatrol_filter_list_animations_in', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_animations_in', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list of the out animations
if ( !function_exists( 'bugspatrol_get_list_animations_out' ) ) {
	function bugspatrol_get_list_animations_out($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_animations_out'))=='') {
			$list = array(
				'none'				=> esc_html__('- None -',			'bugspatrol'),
				'bounceOut'			=> esc_html__('Bounce Out',			'bugspatrol'),
				'bounceOutUp'		=> esc_html__('Bounce Out Up',		'bugspatrol'),
				'bounceOutDown'		=> esc_html__('Bounce Out Down',	'bugspatrol'),
				'bounceOutLeft'		=> esc_html__('Bounce Out Left',	'bugspatrol'),
				'bounceOutRight'	=> esc_html__('Bounce Out Right',	'bugspatrol'),
				'fadeOut'			=> esc_html__('Fade Out',			'bugspatrol'),
				'fadeOutUp'			=> esc_html__('Fade Out Up',		'bugspatrol'),
				'fadeOutUpBig'		=> esc_html__('Fade Out Up Big',	'bugspatrol'),
				'fadeOutDown'		=> esc_html__('Fade Out Down',		'bugspatrol'),
				'fadeOutDownSmall'	=> esc_html__('Fade Out Down Small','bugspatrol'),
				'fadeOutDownBig'	=> esc_html__('Fade Out Down Big',	'bugspatrol'),
				'fadeOutLeft'		=> esc_html__('Fade Out Left',		'bugspatrol'),
				'fadeOutLeftBig'	=> esc_html__('Fade Out Left Big',	'bugspatrol'),
				'fadeOutRight'		=> esc_html__('Fade Out Right',		'bugspatrol'),
				'fadeOutRightBig'	=> esc_html__('Fade Out Right Big',	'bugspatrol'),
				'flipOutX'			=> esc_html__('Flip Out X',			'bugspatrol'),
				'flipOutY'			=> esc_html__('Flip Out Y',			'bugspatrol'),
				'hinge'				=> esc_html__('Hinge Out',			'bugspatrol'),
				'lightSpeedOut'		=> esc_html__('Light Speed Out',	'bugspatrol'),
				'rotateOut'			=> esc_html__('Rotate Out',			'bugspatrol'),
				'rotateOutUpLeft'	=> esc_html__('Rotate Out Down Left','bugspatrol'),
				'rotateOutUpRight'	=> esc_html__('Rotate Out Up Right','bugspatrol'),
				'rotateOutDownLeft'	=> esc_html__('Rotate Out Up Left',	'bugspatrol'),
				'rotateOutDownRight'=> esc_html__('Rotate Out Down Right','bugspatrol'),
				'rollOut'			=> esc_html__('Roll Out',			'bugspatrol'),
				'slideOutUp'		=> esc_html__('Slide Out Up',		'bugspatrol'),
				'slideOutDown'		=> esc_html__('Slide Out Down',		'bugspatrol'),
				'slideOutLeft'		=> esc_html__('Slide Out Left',		'bugspatrol'),
				'slideOutRight'		=> esc_html__('Slide Out Right',	'bugspatrol'),
				'zoomOut'			=> esc_html__('Zoom Out',			'bugspatrol'),
				'zoomOutUp'			=> esc_html__('Zoom Out Up',		'bugspatrol'),
				'zoomOutDown'		=> esc_html__('Zoom Out Down',		'bugspatrol'),
				'zoomOutLeft'		=> esc_html__('Zoom Out Left',		'bugspatrol'),
				'zoomOutRight'		=> esc_html__('Zoom Out Right',		'bugspatrol')
				);
			$list = apply_filters('bugspatrol_filter_list_animations_out', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_animations_out', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return classes list for the specified animation
if (!function_exists('bugspatrol_get_animation_classes')) {
	function bugspatrol_get_animation_classes($animation, $speed='normal', $loop='none') {
		return bugspatrol_param_is_off($animation) ? '' : 'animated '.esc_attr($animation).' '.esc_attr($speed).(!bugspatrol_param_is_off($loop) ? ' '.esc_attr($loop) : '');
	}
}


// Return list of the main menu hover effects
if ( !function_exists( 'bugspatrol_get_list_menu_hovers' ) ) {
	function bugspatrol_get_list_menu_hovers($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_menu_hovers'))=='') {
			$list = array(
				'fade'			=> esc_html__('Fade',		'bugspatrol'),
				'slide_line'	=> esc_html__('Slide Line',	'bugspatrol'),
				'slide_box'		=> esc_html__('Slide Box',	'bugspatrol'),
				'zoom_line'		=> esc_html__('Zoom Line',	'bugspatrol'),
				'path_line'		=> esc_html__('Path Line',	'bugspatrol'),
				'roll_down'		=> esc_html__('Roll Down',	'bugspatrol'),
				'color_line'	=> esc_html__('Color Line',	'bugspatrol'),
				);
			$list = apply_filters('bugspatrol_filter_list_menu_hovers', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_menu_hovers', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list of the button's hover effects
if ( !function_exists( 'bugspatrol_get_list_button_hovers' ) ) {
	function bugspatrol_get_list_button_hovers($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_button_hovers'))=='') {
			$list = array(
				'default'		=> esc_html__('Default',			'bugspatrol'),
				'fade'			=> esc_html__('Fade',				'bugspatrol'),
				'slide_left'	=> esc_html__('Slide from Left',	'bugspatrol'),
				'slide_top'		=> esc_html__('Slide from Top',		'bugspatrol'),
				'arrow'			=> esc_html__('Arrow',				'bugspatrol'),
				);
			$list = apply_filters('bugspatrol_filter_list_button_hovers', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_button_hovers', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list of the input field's hover effects
if ( !function_exists( 'bugspatrol_get_list_input_hovers' ) ) {
	function bugspatrol_get_list_input_hovers($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_input_hovers'))=='') {
			$list = array(
				'default'	=> esc_html__('Default',	'bugspatrol'),
				'accent'	=> esc_html__('Accented',	'bugspatrol'),
				'path'		=> esc_html__('Path',		'bugspatrol'),
				'jump'		=> esc_html__('Jump',		'bugspatrol'),
				'underline'	=> esc_html__('Underline',	'bugspatrol'),
				'iconed'	=> esc_html__('Iconed',		'bugspatrol'),
				);
			$list = apply_filters('bugspatrol_filter_list_input_hovers', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_input_hovers', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list of the search field's styles
if ( !function_exists( 'bugspatrol_get_list_search_styles' ) ) {
	function bugspatrol_get_list_search_styles($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_search_styles'))=='') {
			$list = array(
				'default'	=> esc_html__('Default',	'bugspatrol'),
				'fullscreen'=> esc_html__('Fullscreen',	'bugspatrol'),
				'slide'		=> esc_html__('Slide',		'bugspatrol'),
				'expand'	=> esc_html__('Expand',		'bugspatrol'),
				);
			$list = apply_filters('bugspatrol_filter_list_search_styles', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_search_styles', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list of categories
if ( !function_exists( 'bugspatrol_get_list_categories' ) ) {
	function bugspatrol_get_list_categories($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_categories'))=='') {
			$list = array();
			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 0,
				'hierarchical'             => 1,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => 'category',
				'pad_counts'               => false );
			$taxonomies = get_categories( $args );
			if (is_array($taxonomies) && count($taxonomies) > 0) {
				foreach ($taxonomies as $cat) {
					$list[$cat->term_id] = $cat->name;
				}
			}
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_categories', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list of taxonomies
if ( !function_exists( 'bugspatrol_get_list_terms' ) ) {
	function bugspatrol_get_list_terms($prepend_inherit=false, $taxonomy='category') {
		if (($list = bugspatrol_storage_get('list_taxonomies_'.($taxonomy)))=='') {
			$list = array();
			if ( is_array($taxonomy) || taxonomy_exists($taxonomy) ) {
				$terms = get_terms( $taxonomy, array(
					'child_of'                 => 0,
					'parent'                   => '',
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 0,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => $taxonomy,
					'pad_counts'               => false
					)
				);
			} else {
				$terms = bugspatrol_get_terms_by_taxonomy_from_db($taxonomy);
			}
			if (!is_wp_error( $terms ) && is_array($terms) && count($terms) > 0) {
				foreach ($terms as $cat) {
					$list[$cat->term_id] = $cat->name;					}
			}
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_taxonomies_'.($taxonomy), $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return list of post's types
if ( !function_exists( 'bugspatrol_get_list_posts_types' ) ) {
	function bugspatrol_get_list_posts_types($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_posts_types'))=='') {
			// Return only theme inheritance supported post types
			$list = apply_filters('bugspatrol_filter_list_post_types', array());
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_posts_types', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list post items from any post type and taxonomy
if ( !function_exists( 'bugspatrol_get_list_posts' ) ) {
	function bugspatrol_get_list_posts($prepend_inherit=false, $opt=array()) {
		$opt = array_merge(array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'taxonomy'			=> 'category',
			'taxonomy_value'	=> '',
			'posts_per_page'	=> -1,
			'orderby'			=> 'post_date',
			'order'				=> 'desc',
			'return'			=> 'id'
			), is_array($opt) ? $opt : array('post_type'=>$opt));

		$hash = 'list_posts_'.($opt['post_type']).'_'.($opt['taxonomy']).'_'.($opt['taxonomy_value']).'_'.($opt['orderby']).'_'.($opt['order']).'_'.($opt['return']).'_'.($opt['posts_per_page']);
		if (($list = bugspatrol_storage_get($hash))=='') {
			$list = array();
			$list['none'] = esc_html__("- Not selected -", 'bugspatrol');
			$args = array(
				'post_type' => $opt['post_type'],
				'post_status' => $opt['post_status'],
				'posts_per_page' => $opt['posts_per_page'],
				'ignore_sticky_posts' => true,
				'orderby'	=> $opt['orderby'],
				'order'		=> $opt['order']
			);
			if (!empty($opt['taxonomy_value'])) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $opt['taxonomy'],
						'field' => (int) $opt['taxonomy_value'] > 0 ? 'id' : 'slug',
						'terms' => $opt['taxonomy_value']
					)
				);
			}
			$posts = get_posts( $args );
			if (is_array($posts) && count($posts) > 0) {
				foreach ($posts as $post) {
					$list[$opt['return']=='id' ? $post->ID : $post->post_title] = $post->post_title;
				}
			}
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set($hash, $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list pages
if ( !function_exists( 'bugspatrol_get_list_pages' ) ) {
	function bugspatrol_get_list_pages($prepend_inherit=false, $opt=array()) {
		$opt = array_merge(array(
			'post_type'			=> 'page',
			'post_status'		=> 'publish',
			'posts_per_page'	=> -1,
			'orderby'			=> 'title',
			'order'				=> 'asc',
			'return'			=> 'id'
			), is_array($opt) ? $opt : array('post_type'=>$opt));
		return bugspatrol_get_list_posts($prepend_inherit, $opt);
	}
}


// Return list of registered users
if ( !function_exists( 'bugspatrol_get_list_users' ) ) {
	function bugspatrol_get_list_users($prepend_inherit=false, $roles=array('administrator', 'editor', 'author', 'contributor', 'shop_manager')) {
		if (($list = bugspatrol_storage_get('list_users'))=='') {
			$list = array();
			$list['none'] = esc_html__("- Not selected -", 'bugspatrol');
			$args = array(
				'orderby'	=> 'display_name',
				'order'		=> 'ASC' );
			$users = get_users( $args );
			if (is_array($users) && count($users) > 0) {
				foreach ($users as $user) {
					$accept = true;
					if (is_array($user->roles)) {
						if (is_array($user->roles) && count($user->roles) > 0) {
							$accept = false;
							foreach ($user->roles as $role) {
								if (in_array($role, $roles)) {
									$accept = true;
									break;
								}
							}
						}
					}
					if ($accept) $list[$user->user_login] = $user->display_name;
				}
			}
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_users', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return slider engines list, prepended inherit (if need)
if ( !function_exists( 'bugspatrol_get_list_sliders' ) ) {
	function bugspatrol_get_list_sliders($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_sliders'))=='') {
			$list = array(
				'swiper' => esc_html__("Posts slider (Swiper)", 'bugspatrol')
			);
			$list = apply_filters('bugspatrol_filter_list_sliders', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_sliders', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return slider controls list, prepended inherit (if need)
if ( !function_exists( 'bugspatrol_get_list_slider_controls' ) ) {
	function bugspatrol_get_list_slider_controls($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_slider_controls'))=='') {
			$list = array(
				'no'		=> esc_html__('None', 'bugspatrol'),
				'side'		=> esc_html__('Side', 'bugspatrol'),
				'bottom'	=> esc_html__('Bottom', 'bugspatrol'),
				'pagination'=> esc_html__('Pagination', 'bugspatrol')
				);
			$list = apply_filters('bugspatrol_filter_list_slider_controls', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_slider_controls', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return slider controls classes
if ( !function_exists( 'bugspatrol_get_slider_controls_classes' ) ) {
	function bugspatrol_get_slider_controls_classes($controls) {
		if (bugspatrol_param_is_off($controls))	$classes = 'sc_slider_nopagination sc_slider_nocontrols';
		else if ($controls=='bottom')			$classes = 'sc_slider_nopagination sc_slider_controls sc_slider_controls_bottom';
		else if ($controls=='pagination')		$classes = 'sc_slider_pagination sc_slider_pagination_bottom sc_slider_nocontrols';
		else									$classes = 'sc_slider_nopagination sc_slider_controls sc_slider_controls_side';
		return $classes;
	}
}

// Return list with popup engines
if ( !function_exists( 'bugspatrol_get_list_popup_engines' ) ) {
	function bugspatrol_get_list_popup_engines($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_popup_engines'))=='') {
			$list = array(
				"pretty"	=> esc_html__("Pretty photo", 'bugspatrol'),
				"magnific"	=> esc_html__("Magnific popup", 'bugspatrol')
				);
			$list = apply_filters('bugspatrol_filter_list_popup_engines', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_popup_engines', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return menus list, prepended inherit
if ( !function_exists( 'bugspatrol_get_list_menus' ) ) {
	function bugspatrol_get_list_menus($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_menus'))=='') {
			$list = array();
			$list['default'] = esc_html__("Default", 'bugspatrol');
			$menus = wp_get_nav_menus();
			if (is_array($menus) && count($menus) > 0) {
				foreach ($menus as $menu) {
					$list[$menu->slug] = $menu->name;
				}
			}
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_menus', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return custom sidebars list, prepended inherit and main sidebars item (if need)
if ( !function_exists( 'bugspatrol_get_list_sidebars' ) ) {
	function bugspatrol_get_list_sidebars($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_sidebars'))=='') {
			if (($list = bugspatrol_storage_get('registered_sidebars'))=='') $list = array();
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_sidebars', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return sidebars positions
if ( !function_exists( 'bugspatrol_get_list_sidebars_positions' ) ) {
	function bugspatrol_get_list_sidebars_positions($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_sidebars_positions'))=='') {
			$list = array(
				'none'  => esc_html__('Hide',  'bugspatrol'),
				'left'  => esc_html__('Left',  'bugspatrol'),
				'right' => esc_html__('Right', 'bugspatrol')
				);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_sidebars_positions', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return sidebars class
if ( !function_exists( 'bugspatrol_get_sidebar_class' ) ) {
	function bugspatrol_get_sidebar_class() {
		$sb_main = bugspatrol_get_custom_option('show_sidebar_main');
		$sb_outer = bugspatrol_get_custom_option('show_sidebar_outer');
		return (bugspatrol_param_is_off($sb_main) ? 'sidebar_hide' : 'sidebar_show sidebar_'.($sb_main))
				. ' ' . (bugspatrol_param_is_off($sb_outer) ? 'sidebar_outer_hide' : 'sidebar_outer_show sidebar_outer_'.($sb_outer));
	}
}

// Return body styles list, prepended inherit
if ( !function_exists( 'bugspatrol_get_list_body_styles' ) ) {
	function bugspatrol_get_list_body_styles($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_body_styles'))=='') {
			$list = array(
				'boxed'	=> esc_html__('Boxed',		'bugspatrol'),
				'wide'	=> esc_html__('Wide',		'bugspatrol')
				);
			if (bugspatrol_get_theme_setting('allow_fullscreen')) {
				$list['fullwide']	= esc_html__('Fullwide',	'bugspatrol');
				$list['fullscreen']	= esc_html__('Fullscreen',	'bugspatrol');
			}
			$list = apply_filters('bugspatrol_filter_list_body_styles', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_body_styles', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return templates list, prepended inherit
if ( !function_exists( 'bugspatrol_get_list_templates' ) ) {
	function bugspatrol_get_list_templates($mode='') {
		if (($list = bugspatrol_storage_get('list_templates_'.($mode)))=='') {
			$list = array();
			$tpl = bugspatrol_storage_get('registered_templates');
			$tpl = bugspatrol_storage_get('registered_templates');
			if (is_array($tpl) && count($tpl) > 0) {
				foreach ($tpl as $k=>$v) {
					if ($mode=='' || in_array($mode, explode(',', $v['mode'])))
						$list[$k] = !empty($v['icon']) 
									? $v['icon'] 
									: (!empty($v['title']) 
										? $v['title'] 
										: bugspatrol_strtoproper($v['layout'])
										);
				}
			}
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_templates_'.($mode), $list);
		}
		return $list;
	}
}

// Return blog styles list, prepended inherit
if ( !function_exists( 'bugspatrol_get_list_templates_blog' ) ) {
	function bugspatrol_get_list_templates_blog($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_templates_blog'))=='') {
			$list = bugspatrol_get_list_templates('blog');
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_templates_blog', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return blogger styles list, prepended inherit
if ( !function_exists( 'bugspatrol_get_list_templates_blogger' ) ) {
	function bugspatrol_get_list_templates_blogger($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_templates_blogger'))=='') {
			$list = bugspatrol_array_merge(bugspatrol_get_list_templates('blogger'), bugspatrol_get_list_templates('blog'));
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_templates_blogger', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return single page styles list, prepended inherit
if ( !function_exists( 'bugspatrol_get_list_templates_single' ) ) {
	function bugspatrol_get_list_templates_single($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_templates_single'))=='') {
			$list = bugspatrol_get_list_templates('single');
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_templates_single', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return header styles list, prepended inherit
if ( !function_exists( 'bugspatrol_get_list_templates_header' ) ) {
	function bugspatrol_get_list_templates_header($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_templates_header'))=='') {
			$list = bugspatrol_get_list_templates('header');
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_templates_header', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return form styles list, prepended inherit
if ( !function_exists( 'bugspatrol_get_list_templates_forms' ) ) {
	function bugspatrol_get_list_templates_forms($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_templates_forms'))=='') {
			$list = bugspatrol_get_list_templates('forms');
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_templates_forms', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return article styles list, prepended inherit
if ( !function_exists( 'bugspatrol_get_list_article_styles' ) ) {
	function bugspatrol_get_list_article_styles($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_article_styles'))=='') {
			$list = array(
				"boxed"   => esc_html__('Boxed', 'bugspatrol'),
				"stretch" => esc_html__('Stretch', 'bugspatrol')
				);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_article_styles', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return post-formats filters list, prepended inherit
if ( !function_exists( 'bugspatrol_get_list_post_formats_filters' ) ) {
	function bugspatrol_get_list_post_formats_filters($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_post_formats_filters'))=='') {
			$list = array(
				"no"      => esc_html__('All posts', 'bugspatrol'),
				"thumbs"  => esc_html__('With thumbs', 'bugspatrol'),
				"reviews" => esc_html__('With reviews', 'bugspatrol'),
				"video"   => esc_html__('With videos', 'bugspatrol'),
				"audio"   => esc_html__('With audios', 'bugspatrol'),
				"gallery" => esc_html__('With galleries', 'bugspatrol')
				);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_post_formats_filters', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return portfolio filters list, prepended inherit
if ( !function_exists( 'bugspatrol_get_list_portfolio_filters' ) ) {
	function bugspatrol_get_list_portfolio_filters($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_portfolio_filters'))=='') {
			$list = array(
				"hide"		=> esc_html__('Hide', 'bugspatrol'),
				"tags"		=> esc_html__('Tags', 'bugspatrol'),
				"categories"=> esc_html__('Categories', 'bugspatrol')
				);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_portfolio_filters', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return hover styles list, prepended inherit
if ( !function_exists( 'bugspatrol_get_list_hovers' ) ) {
	function bugspatrol_get_list_hovers($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_hovers'))=='') {
			$list = array();
			$list['circle effect1']  = esc_html__('Circle Effect 1',  'bugspatrol');
			$list['circle effect2']  = esc_html__('Circle Effect 2',  'bugspatrol');
			$list['circle effect3']  = esc_html__('Circle Effect 3',  'bugspatrol');
			$list['circle effect4']  = esc_html__('Circle Effect 4',  'bugspatrol');
			$list['circle effect5']  = esc_html__('Circle Effect 5',  'bugspatrol');
			$list['circle effect6']  = esc_html__('Circle Effect 6',  'bugspatrol');
			$list['circle effect7']  = esc_html__('Circle Effect 7',  'bugspatrol');
			$list['circle effect8']  = esc_html__('Circle Effect 8',  'bugspatrol');
			$list['circle effect9']  = esc_html__('Circle Effect 9',  'bugspatrol');
			$list['circle effect10'] = esc_html__('Circle Effect 10',  'bugspatrol');
			$list['circle effect11'] = esc_html__('Circle Effect 11',  'bugspatrol');
			$list['circle effect12'] = esc_html__('Circle Effect 12',  'bugspatrol');
			$list['circle effect13'] = esc_html__('Circle Effect 13',  'bugspatrol');
			$list['circle effect14'] = esc_html__('Circle Effect 14',  'bugspatrol');
			$list['circle effect15'] = esc_html__('Circle Effect 15',  'bugspatrol');
			$list['circle effect16'] = esc_html__('Circle Effect 16',  'bugspatrol');
			$list['circle effect17'] = esc_html__('Circle Effect 17',  'bugspatrol');
			$list['circle effect18'] = esc_html__('Circle Effect 18',  'bugspatrol');
			$list['circle effect19'] = esc_html__('Circle Effect 19',  'bugspatrol');
			$list['circle effect20'] = esc_html__('Circle Effect 20',  'bugspatrol');
			$list['square effect1']  = esc_html__('Square Effect 1',  'bugspatrol');
			$list['square effect2']  = esc_html__('Square Effect 2',  'bugspatrol');
			$list['square effect3']  = esc_html__('Square Effect 3',  'bugspatrol');
			$list['square effect5']  = esc_html__('Square Effect 5',  'bugspatrol');
			$list['square effect6']  = esc_html__('Square Effect 6',  'bugspatrol');
			$list['square effect7']  = esc_html__('Square Effect 7',  'bugspatrol');
			$list['square effect8']  = esc_html__('Square Effect 8',  'bugspatrol');
			$list['square effect9']  = esc_html__('Square Effect 9',  'bugspatrol');
			$list['square effect10'] = esc_html__('Square Effect 10',  'bugspatrol');
			$list['square effect11'] = esc_html__('Square Effect 11',  'bugspatrol');
			$list['square effect12'] = esc_html__('Square Effect 12',  'bugspatrol');
			$list['square effect13'] = esc_html__('Square Effect 13',  'bugspatrol');
			$list['square effect14'] = esc_html__('Square Effect 14',  'bugspatrol');
			$list['square effect15'] = esc_html__('Square Effect 15',  'bugspatrol');
			$list['square effect_dir']   = esc_html__('Square Effect Dir',   'bugspatrol');
			$list['square effect_shift'] = esc_html__('Square Effect Shift', 'bugspatrol');
			$list['square effect_book']  = esc_html__('Square Effect Book',  'bugspatrol');
			$list['square effect_more']  = esc_html__('Square Effect More',  'bugspatrol');
			$list['square effect_fade']  = esc_html__('Square Effect Fade',  'bugspatrol');
			$list['square effect_pull']  = esc_html__('Square Effect Pull',  'bugspatrol');
			$list['square effect_slide'] = esc_html__('Square Effect Slide', 'bugspatrol');
			$list['square effect_border'] = esc_html__('Square Effect Border', 'bugspatrol');
			$list = apply_filters('bugspatrol_filter_portfolio_hovers', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_hovers', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list of the blog counters
if ( !function_exists( 'bugspatrol_get_list_blog_counters' ) ) {
	function bugspatrol_get_list_blog_counters($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_blog_counters'))=='') {
			$list = array(
				'views'		=> esc_html__('Views', 'bugspatrol'),
				'likes'		=> esc_html__('Likes', 'bugspatrol'),
				'rating'	=> esc_html__('Rating', 'bugspatrol'),
				'comments'	=> esc_html__('Comments', 'bugspatrol')
				);
			$list = apply_filters('bugspatrol_filter_list_blog_counters', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_blog_counters', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return list of the item sizes for the portfolio alter style, prepended inherit
if ( !function_exists( 'bugspatrol_get_list_alter_sizes' ) ) {
	function bugspatrol_get_list_alter_sizes($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_alter_sizes'))=='') {
			$list = array(
					'1_1' => esc_html__('1x1', 'bugspatrol'),
					'1_2' => esc_html__('1x2', 'bugspatrol'),
					'2_1' => esc_html__('2x1', 'bugspatrol'),
					'2_2' => esc_html__('2x2', 'bugspatrol'),
					'1_3' => esc_html__('1x3', 'bugspatrol'),
					'2_3' => esc_html__('2x3', 'bugspatrol'),
					'3_1' => esc_html__('3x1', 'bugspatrol'),
					'3_2' => esc_html__('3x2', 'bugspatrol'),
					'3_3' => esc_html__('3x3', 'bugspatrol')
					);
			$list = apply_filters('bugspatrol_filter_portfolio_alter_sizes', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_alter_sizes', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return extended hover directions list, prepended inherit
if ( !function_exists( 'bugspatrol_get_list_hovers_directions' ) ) {
	function bugspatrol_get_list_hovers_directions($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_hovers_directions'))=='') {
			$list = array(
				'left_to_right' => esc_html__('Left to Right',  'bugspatrol'),
				'right_to_left' => esc_html__('Right to Left',  'bugspatrol'),
				'top_to_bottom' => esc_html__('Top to Bottom',  'bugspatrol'),
				'bottom_to_top' => esc_html__('Bottom to Top',  'bugspatrol'),
				'scale_up'      => esc_html__('Scale Up',  'bugspatrol'),
				'scale_down'    => esc_html__('Scale Down',  'bugspatrol'),
				'scale_down_up' => esc_html__('Scale Down-Up',  'bugspatrol'),
				'from_left_and_right' => esc_html__('From Left and Right',  'bugspatrol'),
				'from_top_and_bottom' => esc_html__('From Top and Bottom',  'bugspatrol')
			);
			$list = apply_filters('bugspatrol_filter_portfolio_hovers_directions', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_hovers_directions', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list of the label positions in the custom forms
if ( !function_exists( 'bugspatrol_get_list_label_positions' ) ) {
	function bugspatrol_get_list_label_positions($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_label_positions'))=='') {
			$list = array(
				'top'		=> esc_html__('Top',		'bugspatrol'),
				'bottom'	=> esc_html__('Bottom',		'bugspatrol'),
				'left'		=> esc_html__('Left',		'bugspatrol'),
				'over'		=> esc_html__('Over',		'bugspatrol')
			);
			$list = apply_filters('bugspatrol_filter_label_positions', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_label_positions', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list of the bg image positions
if ( !function_exists( 'bugspatrol_get_list_bg_image_positions' ) ) {
	function bugspatrol_get_list_bg_image_positions($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_bg_image_positions'))=='') {
			$list = array(
				'left top'	   => esc_html__('Left Top', 'bugspatrol'),
				'center top'   => esc_html__("Center Top", 'bugspatrol'),
				'right top'    => esc_html__("Right Top", 'bugspatrol'),
				'left center'  => esc_html__("Left Center", 'bugspatrol'),
				'center center'=> esc_html__("Center Center", 'bugspatrol'),
				'right center' => esc_html__("Right Center", 'bugspatrol'),
				'left bottom'  => esc_html__("Left Bottom", 'bugspatrol'),
				'center bottom'=> esc_html__("Center Bottom", 'bugspatrol'),
				'right bottom' => esc_html__("Right Bottom", 'bugspatrol')
			);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_bg_image_positions', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list of the bg image repeat
if ( !function_exists( 'bugspatrol_get_list_bg_image_repeats' ) ) {
	function bugspatrol_get_list_bg_image_repeats($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_bg_image_repeats'))=='') {
			$list = array(
				'repeat'	=> esc_html__('Repeat', 'bugspatrol'),
				'repeat-x'	=> esc_html__('Repeat X', 'bugspatrol'),
				'repeat-y'	=> esc_html__('Repeat Y', 'bugspatrol'),
				'no-repeat'	=> esc_html__('No Repeat', 'bugspatrol')
			);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_bg_image_repeats', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list of the bg image attachment
if ( !function_exists( 'bugspatrol_get_list_bg_image_attachments' ) ) {
	function bugspatrol_get_list_bg_image_attachments($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_bg_image_attachments'))=='') {
			$list = array(
				'scroll'	=> esc_html__('Scroll', 'bugspatrol'),
				'fixed'		=> esc_html__('Fixed', 'bugspatrol'),
				'local'		=> esc_html__('Local', 'bugspatrol')
			);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_bg_image_attachments', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}


// Return list of the bg tints
if ( !function_exists( 'bugspatrol_get_list_bg_tints' ) ) {
	function bugspatrol_get_list_bg_tints($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_bg_tints'))=='') {
			$list = array(
				'white'	=> esc_html__('White', 'bugspatrol'),
				'light'	=> esc_html__('Light', 'bugspatrol'),
				'dark'	=> esc_html__('Dark', 'bugspatrol')
			);
			$list = apply_filters('bugspatrol_filter_bg_tints', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_bg_tints', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return custom fields types list, prepended inherit
if ( !function_exists( 'bugspatrol_get_list_field_types' ) ) {
	function bugspatrol_get_list_field_types($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_field_types'))=='') {
			$list = array(
				'text'     => esc_html__('Text',  'bugspatrol'),
				'textarea' => esc_html__('Text Area','bugspatrol'),
				'password' => esc_html__('Password',  'bugspatrol'),
				'radio'    => esc_html__('Radio',  'bugspatrol'),
				'checkbox' => esc_html__('Checkbox',  'bugspatrol'),
				'select'   => esc_html__('Select',  'bugspatrol'),
				'date'     => esc_html__('Date','bugspatrol'),
				'time'     => esc_html__('Time','bugspatrol'),
				'button'   => esc_html__('Button','bugspatrol')
			);
			$list = apply_filters('bugspatrol_filter_field_types', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_field_types', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return Google map styles
if ( !function_exists( 'bugspatrol_get_list_googlemap_styles' ) ) {
	function bugspatrol_get_list_googlemap_styles($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_googlemap_styles'))=='') {
			$list = array(
				'default' => esc_html__('Default', 'bugspatrol')
			);
			$list = apply_filters('bugspatrol_filter_googlemap_styles', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_googlemap_styles', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return iconed classes list
if ( !function_exists( 'bugspatrol_get_list_icons' ) ) {
	function bugspatrol_get_list_icons($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_icons'))=='') {
			$list = bugspatrol_parse_icons_classes(bugspatrol_get_file_dir("css/fontello/css/fontello-codes.css"));
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_icons', $list);
		}
		return $prepend_inherit ? array_merge(array('inherit'), $list) : $list;
	}
}

// Return socials list
if ( !function_exists( 'bugspatrol_get_list_socials' ) ) {
	function bugspatrol_get_list_socials($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_socials'))=='') {
			$list = bugspatrol_get_list_images("images/socials", "png");
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_socials', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}
// Return list with 'Yes' and 'No' items
if ( !function_exists( 'bugspatrol_get_list_yesno' ) ) {
	function bugspatrol_get_list_yesno($prepend_inherit=false) {
		$list = array(
			'yes' => esc_html__("Yes", 'bugspatrol'),
			'no'  => esc_html__("No", 'bugspatrol')
		);
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return list with 'On' and 'Of' items
if ( !function_exists( 'bugspatrol_get_list_onoff' ) ) {
	function bugspatrol_get_list_onoff($prepend_inherit=false) {
		$list = array(
			"on" => esc_html__("On", 'bugspatrol'),
			"off" => esc_html__("Off", 'bugspatrol')
		);
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return list with 'Show' and 'Hide' items
if ( !function_exists( 'bugspatrol_get_list_showhide' ) ) {
	function bugspatrol_get_list_showhide($prepend_inherit=false) {
		$list = array(
			"show" => esc_html__("Show", 'bugspatrol'),
			"hide" => esc_html__("Hide", 'bugspatrol')
		);
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return list with 'Ascending' and 'Descending' items
if ( !function_exists( 'bugspatrol_get_list_orderings' ) ) {
	function bugspatrol_get_list_orderings($prepend_inherit=false) {
		$list = array(
			"asc" => esc_html__("Ascending", 'bugspatrol'),
			"desc" => esc_html__("Descending", 'bugspatrol')
		);
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return list with 'Horizontal' and 'Vertical' items
if ( !function_exists( 'bugspatrol_get_list_directions' ) ) {
	function bugspatrol_get_list_directions($prepend_inherit=false) {
		$list = array(
			"horizontal" => esc_html__("Horizontal", 'bugspatrol'),
			"vertical" => esc_html__("Vertical", 'bugspatrol')
		);
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return list with item's shapes
if ( !function_exists( 'bugspatrol_get_list_shapes' ) ) {
	function bugspatrol_get_list_shapes($prepend_inherit=false) {
		$list = array(
			"round"  => esc_html__("Round", 'bugspatrol'),
			"square" => esc_html__("Square", 'bugspatrol')
		);
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return list with item's sizes
if ( !function_exists( 'bugspatrol_get_list_sizes' ) ) {
	function bugspatrol_get_list_sizes($prepend_inherit=false) {
		$list = array(
			"tiny"   => esc_html__("Tiny", 'bugspatrol'),
			"small"  => esc_html__("Small", 'bugspatrol'),
			"medium" => esc_html__("Medium", 'bugspatrol'),
			"large"  => esc_html__("Large", 'bugspatrol')
		);
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return list with slider (scroll) controls positions
if ( !function_exists( 'bugspatrol_get_list_controls' ) ) {
	function bugspatrol_get_list_controls($prepend_inherit=false) {
		$list = array(
			"hide" => esc_html__("Hide", 'bugspatrol'),
			"side" => esc_html__("Side", 'bugspatrol'),
			"bottom" => esc_html__("Bottom", 'bugspatrol')
		);
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return list with float items
if ( !function_exists( 'bugspatrol_get_list_floats' ) ) {
	function bugspatrol_get_list_floats($prepend_inherit=false) {
		$list = array(
			"none" => esc_html__("None", 'bugspatrol'),
			"left" => esc_html__("Float Left", 'bugspatrol'),
			"right" => esc_html__("Float Right", 'bugspatrol')
		);
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return list with alignment items
if ( !function_exists( 'bugspatrol_get_list_alignments' ) ) {
	function bugspatrol_get_list_alignments($justify=false, $prepend_inherit=false) {
		$list = array(
			"none" => esc_html__("None", 'bugspatrol'),
			"left" => esc_html__("Left", 'bugspatrol'),
			"center" => esc_html__("Center", 'bugspatrol'),
			"right" => esc_html__("Right", 'bugspatrol')
		);
		if ($justify) $list["justify"] = esc_html__("Justify", 'bugspatrol');
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return list with horizontal positions
if ( !function_exists( 'bugspatrol_get_list_hpos' ) ) {
	function bugspatrol_get_list_hpos($prepend_inherit=false, $center=false) {
		$list = array();
		$list['left'] = esc_html__("Left", 'bugspatrol');
		if ($center) $list['center'] = esc_html__("Center", 'bugspatrol');
		$list['right'] = esc_html__("Right", 'bugspatrol');
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return list with vertical positions
if ( !function_exists( 'bugspatrol_get_list_vpos' ) ) {
	function bugspatrol_get_list_vpos($prepend_inherit=false, $center=false) {
		$list = array();
		$list['top'] = esc_html__("Top", 'bugspatrol');
		if ($center) $list['center'] = esc_html__("Center", 'bugspatrol');
		$list['bottom'] = esc_html__("Bottom", 'bugspatrol');
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return sorting list items
if ( !function_exists( 'bugspatrol_get_list_sortings' ) ) {
	function bugspatrol_get_list_sortings($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_sortings'))=='') {
			$list = array(
				"date" => esc_html__("Date", 'bugspatrol'),
				"title" => esc_html__("Alphabetically", 'bugspatrol'),
				"views" => esc_html__("Popular (views count)", 'bugspatrol'),
				"comments" => esc_html__("Most commented (comments count)", 'bugspatrol'),
				"author_rating" => esc_html__("Author rating", 'bugspatrol'),
				"users_rating" => esc_html__("Visitors (users) rating", 'bugspatrol'),
				"random" => esc_html__("Random", 'bugspatrol')
			);
			$list = apply_filters('bugspatrol_filter_list_sortings', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_sortings', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return list with columns widths
if ( !function_exists( 'bugspatrol_get_list_columns' ) ) {
	function bugspatrol_get_list_columns($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_columns'))=='') {
			$list = array(
				"none" => esc_html__("None", 'bugspatrol'),
				"1_1" => esc_html__("100%", 'bugspatrol'),
				"1_2" => esc_html__("1/2", 'bugspatrol'),
				"1_3" => esc_html__("1/3", 'bugspatrol'),
				"2_3" => esc_html__("2/3", 'bugspatrol'),
				"1_4" => esc_html__("1/4", 'bugspatrol'),
				"3_4" => esc_html__("3/4", 'bugspatrol'),
				"1_5" => esc_html__("1/5", 'bugspatrol'),
				"2_5" => esc_html__("2/5", 'bugspatrol'),
				"3_5" => esc_html__("3/5", 'bugspatrol'),
				"4_5" => esc_html__("4/5", 'bugspatrol'),
				"1_6" => esc_html__("1/6", 'bugspatrol'),
				"5_6" => esc_html__("5/6", 'bugspatrol'),
				"1_7" => esc_html__("1/7", 'bugspatrol'),
				"2_7" => esc_html__("2/7", 'bugspatrol'),
				"3_7" => esc_html__("3/7", 'bugspatrol'),
				"4_7" => esc_html__("4/7", 'bugspatrol'),
				"5_7" => esc_html__("5/7", 'bugspatrol'),
				"6_7" => esc_html__("6/7", 'bugspatrol'),
				"1_8" => esc_html__("1/8", 'bugspatrol'),
				"3_8" => esc_html__("3/8", 'bugspatrol'),
				"5_8" => esc_html__("5/8", 'bugspatrol'),
				"7_8" => esc_html__("7/8", 'bugspatrol'),
				"1_9" => esc_html__("1/9", 'bugspatrol'),
				"2_9" => esc_html__("2/9", 'bugspatrol'),
				"4_9" => esc_html__("4/9", 'bugspatrol'),
				"5_9" => esc_html__("5/9", 'bugspatrol'),
				"7_9" => esc_html__("7/9", 'bugspatrol'),
				"8_9" => esc_html__("8/9", 'bugspatrol'),
				"1_10"=> esc_html__("1/10", 'bugspatrol'),
				"3_10"=> esc_html__("3/10", 'bugspatrol'),
				"7_10"=> esc_html__("7/10", 'bugspatrol'),
				"9_10"=> esc_html__("9/10", 'bugspatrol'),
				"1_11"=> esc_html__("1/11", 'bugspatrol'),
				"2_11"=> esc_html__("2/11", 'bugspatrol'),
				"3_11"=> esc_html__("3/11", 'bugspatrol'),
				"4_11"=> esc_html__("4/11", 'bugspatrol'),
				"5_11"=> esc_html__("5/11", 'bugspatrol'),
				"6_11"=> esc_html__("6/11", 'bugspatrol'),
				"7_11"=> esc_html__("7/11", 'bugspatrol'),
				"8_11"=> esc_html__("8/11", 'bugspatrol'),
				"9_11"=> esc_html__("9/11", 'bugspatrol'),
				"10_11"=> esc_html__("10/11", 'bugspatrol'),
				"1_12"=> esc_html__("1/12", 'bugspatrol'),
				"5_12"=> esc_html__("5/12", 'bugspatrol'),
				"7_12"=> esc_html__("7/12", 'bugspatrol'),
				"10_12"=> esc_html__("10/12", 'bugspatrol'),
				"11_12"=> esc_html__("11/12", 'bugspatrol')
			);
			$list = apply_filters('bugspatrol_filter_list_columns', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_columns', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return list of locations for the dedicated content
if ( !function_exists( 'bugspatrol_get_list_dedicated_locations' ) ) {
	function bugspatrol_get_list_dedicated_locations($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_dedicated_locations'))=='') {
			$list = array(
				"default" => esc_html__('As in the post defined', 'bugspatrol'),
				"center"  => esc_html__('Above the text of the post', 'bugspatrol'),
				"left"    => esc_html__('To the left the text of the post', 'bugspatrol'),
				"right"   => esc_html__('To the right the text of the post', 'bugspatrol'),
				"alter"   => esc_html__('Alternates for each post', 'bugspatrol')
			);
			$list = apply_filters('bugspatrol_filter_list_dedicated_locations', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_dedicated_locations', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return post-format name
if ( !function_exists( 'bugspatrol_get_post_format_name' ) ) {
	function bugspatrol_get_post_format_name($format, $single=true) {
		$name = '';
		if ($format=='gallery')		$name = $single ? esc_html__('gallery', 'bugspatrol') : esc_html__('galleries', 'bugspatrol');
		else if ($format=='video')	$name = $single ? esc_html__('video', 'bugspatrol') : esc_html__('videos', 'bugspatrol');
		else if ($format=='audio')	$name = $single ? esc_html__('audio', 'bugspatrol') : esc_html__('audios', 'bugspatrol');
		else if ($format=='image')	$name = $single ? esc_html__('image', 'bugspatrol') : esc_html__('images', 'bugspatrol');
		else if ($format=='quote')	$name = $single ? esc_html__('quote', 'bugspatrol') : esc_html__('quotes', 'bugspatrol');
		else if ($format=='link')	$name = $single ? esc_html__('link', 'bugspatrol') : esc_html__('links', 'bugspatrol');
		else if ($format=='status')	$name = $single ? esc_html__('status', 'bugspatrol') : esc_html__('statuses', 'bugspatrol');
		else if ($format=='aside')	$name = $single ? esc_html__('aside', 'bugspatrol') : esc_html__('asides', 'bugspatrol');
		else if ($format=='chat')	$name = $single ? esc_html__('chat', 'bugspatrol') : esc_html__('chats', 'bugspatrol');
		else						$name = $single ? esc_html__('standard', 'bugspatrol') : esc_html__('standards', 'bugspatrol');
		return apply_filters('bugspatrol_filter_list_post_format_name', $name, $format);
	}
}

// Return post-format icon name (from Fontello library)
if ( !function_exists( 'bugspatrol_get_post_format_icon' ) ) {
	function bugspatrol_get_post_format_icon($format) {
		$icon = 'icon-';
		if ($format=='gallery')		$icon .= 'pictures';
		else if ($format=='video')	$icon .= 'video';
		else if ($format=='audio')	$icon .= 'note';
		else if ($format=='image')	$icon .= 'picture';
		else if ($format=='quote')	$icon .= 'quote';
		else if ($format=='link')	$icon .= 'link';
		else if ($format=='status')	$icon .= 'comment';
		else if ($format=='aside')	$icon .= 'doc-text';
		else if ($format=='chat')	$icon .= 'chat';
		else						$icon .= 'book-open';
		return apply_filters('bugspatrol_filter_list_post_format_icon', $icon, $format);
	}
}

// Return fonts styles list, prepended inherit
if ( !function_exists( 'bugspatrol_get_list_fonts_styles' ) ) {
	function bugspatrol_get_list_fonts_styles($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_fonts_styles'))=='') {
			$list = array(
				'i' => esc_html__('I','bugspatrol'),
				'u' => esc_html__('U', 'bugspatrol')
			);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_fonts_styles', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return Google fonts list
if ( !function_exists( 'bugspatrol_get_list_fonts' ) ) {
	function bugspatrol_get_list_fonts($prepend_inherit=false) {
		if (($list = bugspatrol_storage_get('list_fonts'))=='') {
			$list = array();
			$list = bugspatrol_array_merge($list, bugspatrol_get_list_font_faces());
			// Google and custom fonts list:
																		$list = bugspatrol_array_merge($list, array(
				'Advent Pro' => array('family'=>'sans-serif'),
				'Alegreya Sans' => array('family'=>'sans-serif'),
				'Arimo' => array('family'=>'sans-serif'),
				'Asap' => array('family'=>'sans-serif'),
				'Averia Sans Libre' => array('family'=>'cursive'),
				'Averia Serif Libre' => array('family'=>'cursive'),
				'Bree Serif' => array('family'=>'serif',),
				'Cabin' => array('family'=>'sans-serif'),
				'Cabin Condensed' => array('family'=>'sans-serif'),
				'Caudex' => array('family'=>'serif'),
				'Comfortaa' => array('family'=>'cursive'),
				'Cousine' => array('family'=>'sans-serif'),
				'Crimson Text' => array('family'=>'serif'),
				'Cuprum' => array('family'=>'sans-serif'),
				'Dosis' => array('family'=>'sans-serif'),
				'Economica' => array('family'=>'sans-serif'),
				'Exo' => array('family'=>'sans-serif'),
				'Expletus Sans' => array('family'=>'cursive'),
				'Karla' => array('family'=>'sans-serif'),
				'Lato' => array('family'=>'sans-serif'),
				'Lekton' => array('family'=>'sans-serif'),
				'Lobster Two' => array('family'=>'cursive'),
				'Maven Pro' => array('family'=>'sans-serif'),
				'Merriweather' => array('family'=>'serif'),
				'Montserrat' => array('family'=>'sans-serif'),
				'Neuton' => array('family'=>'serif'),
				'Noticia Text' => array('family'=>'serif'),
				'Old Standard TT' => array('family'=>'serif'),
				'Open Sans' => array('family'=>'sans-serif'),
				'Orbitron' => array('family'=>'sans-serif'),
				'Oswald' => array('family'=>'sans-serif'),
				'Overlock' => array('family'=>'cursive'),
				'Oxygen' => array('family'=>'sans-serif'),
				'Philosopher' => array('family'=>'serif'),
				'PT Serif' => array('family'=>'serif'),
				'Puritan' => array('family'=>'sans-serif'),
				'Raleway' => array('family'=>'sans-serif'),
				'Roboto' => array('family'=>'sans-serif'),
				'Roboto Slab' => array('family'=>'sans-serif'),
				'Roboto Condensed' => array('family'=>'sans-serif'),
				'Rosario' => array('family'=>'sans-serif'),
				'Share' => array('family'=>'cursive'),
				'Signika' => array('family'=>'sans-serif'),
				'Signika Negative' => array('family'=>'sans-serif'),
				'Source Sans Pro' => array('family'=>'sans-serif'),
				'Tinos' => array('family'=>'serif'),
				'Ubuntu' => array('family'=>'sans-serif'),
				'Vollkorn' => array('family'=>'serif')
				)
			);
			$list = apply_filters('bugspatrol_filter_list_fonts', $list);
			if (bugspatrol_get_theme_setting('use_list_cache')) bugspatrol_storage_set('list_fonts', $list);
		}
		return $prepend_inherit ? bugspatrol_array_merge(array('inherit' => esc_html__("Inherit", 'bugspatrol')), $list) : $list;
	}
}

// Return Custom font-face list
if ( !function_exists( 'bugspatrol_get_list_font_faces' ) ) {
	function bugspatrol_get_list_font_faces($prepend_inherit=false) {
		static $list = false;
		if (is_array($list)) return $list;
        $fonts = bugspatrol_storage_get('required_custom_fonts');
		$list = array();
        if (is_array($fonts)) {
           	foreach ($fonts as $font) {
                if (($url = bugspatrol_get_file_url('css/font-face/'.trim($font).'/stylesheet.css'))!='') {
                   	$list[sprintf(esc_html__('%s (uploaded font)', 'bugspatrol'), $font)] = array('css' => $url);
				}
			}
		}
		return $list;
	}
}
?>