<?php
/**
 * BugsPatrol Framework: Services support
 *
 * @package	bugspatrol
 * @since	bugspatrol 1.0
 */

// Theme init
if (!function_exists('bugspatrol_services_theme_setup')) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_services_theme_setup',1 );
	function bugspatrol_services_theme_setup() {
		
		// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
		add_filter('bugspatrol_filter_get_blog_type',			'bugspatrol_services_get_blog_type', 9, 2);
		add_filter('bugspatrol_filter_get_blog_title',		'bugspatrol_services_get_blog_title', 9, 2);
		add_filter('bugspatrol_filter_get_current_taxonomy',	'bugspatrol_services_get_current_taxonomy', 9, 2);
		add_filter('bugspatrol_filter_is_taxonomy',			'bugspatrol_services_is_taxonomy', 9, 2);
		add_filter('bugspatrol_filter_get_stream_page_title',	'bugspatrol_services_get_stream_page_title', 9, 2);
		add_filter('bugspatrol_filter_get_stream_page_link',	'bugspatrol_services_get_stream_page_link', 9, 2);
		add_filter('bugspatrol_filter_get_stream_page_id',	'bugspatrol_services_get_stream_page_id', 9, 2);
		add_filter('bugspatrol_filter_query_add_filters',		'bugspatrol_services_query_add_filters', 9, 2);
		add_filter('bugspatrol_filter_detect_inheritance_key','bugspatrol_services_detect_inheritance_key', 9, 1);

		// Extra column for services lists
		if (bugspatrol_get_theme_option('show_overriden_posts')=='yes') {
			add_filter('manage_edit-services_columns',			'bugspatrol_post_add_options_column', 9);
			add_filter('manage_services_posts_custom_column',	'bugspatrol_post_fill_options_column', 9, 2);
		}

		// Add supported data types
		bugspatrol_theme_support_pt('services');
		bugspatrol_theme_support_tx('services_group');
	}
}

if ( !function_exists( 'bugspatrol_services_settings_theme_setup2' ) ) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_services_settings_theme_setup2', 3 );
	function bugspatrol_services_settings_theme_setup2() {
		// Add post type 'services' and taxonomy 'services_group' into theme inheritance list
		bugspatrol_add_theme_inheritance( array('services' => array(
			'stream_template' => 'blog-services',
			'single_template' => 'single-service',
			'taxonomy' => array('services_group'),
			'taxonomy_tags' => array(),
			'post_type' => array('services'),
			'override' => 'custom'
			) )
		);
	}
}



// Return true, if current page is services page
if ( !function_exists( 'bugspatrol_is_services_page' ) ) {
	function bugspatrol_is_services_page() {
		$is = in_array(bugspatrol_storage_get('page_template'), array('blog-services', 'single-service'));
		if (!$is) {
			if (!bugspatrol_storage_empty('pre_query'))
				$is = bugspatrol_storage_call_obj_method('pre_query', 'get', 'post_type')=='services' 
						|| bugspatrol_storage_call_obj_method('pre_query', 'is_tax', 'services_group') 
						|| (bugspatrol_storage_call_obj_method('pre_query', 'is_page') 
								&& ($id=bugspatrol_get_template_page_id('blog-services')) > 0 
								&& $id==bugspatrol_storage_get_obj_property('pre_query', 'queried_object_id', 0) 
							);
			else
				$is = get_query_var('post_type')=='services' 
						|| is_tax('services_group') 
						|| (is_page() && ($id=bugspatrol_get_template_page_id('blog-services')) > 0 && $id==get_the_ID());
		}
		return $is;
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'bugspatrol_services_detect_inheritance_key' ) ) {
		function bugspatrol_services_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return bugspatrol_is_services_page() ? 'services' : '';
	}
}

// Filter to detect current page slug
if ( !function_exists( 'bugspatrol_services_get_blog_type' ) ) {
		function bugspatrol_services_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;
		if ($query && $query->is_tax('services_group') || is_tax('services_group'))
			$page = 'services_category';
		else if ($query && $query->get('post_type')=='services' || get_query_var('post_type')=='services')
			$page = $query && $query->is_single() || is_single() ? 'services_item' : 'services';
		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'bugspatrol_services_get_blog_title' ) ) {
		function bugspatrol_services_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		if ( bugspatrol_strpos($page, 'services')!==false ) {
			if ( $page == 'services_category' ) {
				$term = get_term_by( 'slug', get_query_var( 'services_group' ), 'services_group', OBJECT);
				$title = $term->name;
			} else if ( $page == 'services_item' ) {
				$title = bugspatrol_get_post_title();
			} else {
				$title = esc_html__('All services', 'bugspatrol');
			}
		}
		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'bugspatrol_services_get_stream_page_title' ) ) {
		function bugspatrol_services_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if (bugspatrol_strpos($page, 'services')!==false) {
			if (($page_id = bugspatrol_services_get_stream_page_id(0, $page=='services' ? 'blog-services' : $page)) > 0)
				$title = bugspatrol_get_post_title($page_id);
			else
				$title = esc_html__('All services', 'bugspatrol');				
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'bugspatrol_services_get_stream_page_id' ) ) {
		function bugspatrol_services_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if (bugspatrol_strpos($page, 'services')!==false) $id = bugspatrol_get_template_page_id('blog-services');
		return $id;
	}
}

// Filter to detect stream page URL
if ( !function_exists( 'bugspatrol_services_get_stream_page_link' ) ) {
		function bugspatrol_services_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if (bugspatrol_strpos($page, 'services')!==false) {
			$id = bugspatrol_get_template_page_id('blog-services');
			if ($id) $url = get_permalink($id);
		}
		return $url;
	}
}

// Filter to detect current taxonomy
if ( !function_exists( 'bugspatrol_services_get_current_taxonomy' ) ) {
		function bugspatrol_services_get_current_taxonomy($tax, $page) {
		if (!empty($tax)) return $tax;
		if ( bugspatrol_strpos($page, 'services')!==false ) {
			$tax = 'services_group';
		}
		return $tax;
	}
}

// Return taxonomy name (slug) if current page is this taxonomy page
if ( !function_exists( 'bugspatrol_services_is_taxonomy' ) ) {
		function bugspatrol_services_is_taxonomy($tax, $query=null) {
		if (!empty($tax))
			return $tax;
		else 
			return $query && $query->get('services_group')!='' || is_tax('services_group') ? 'services_group' : '';
	}
}

// Add custom post type and/or taxonomies arguments to the query
if ( !function_exists( 'bugspatrol_services_query_add_filters' ) ) {
		function bugspatrol_services_query_add_filters($args, $filter) {
		if ($filter == 'services') {
			$args['post_type'] = 'services';
		}
		return $args;
	}
}





?>