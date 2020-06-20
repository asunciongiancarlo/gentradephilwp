<?php
/* Woocommerce support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('bugspatrol_woocommerce_theme_setup')) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_woocommerce_theme_setup', 1 );
	function bugspatrol_woocommerce_theme_setup() {

		if (bugspatrol_exists_woocommerce()) {
			add_action('bugspatrol_action_add_styles', 				'bugspatrol_woocommerce_frontend_scripts' );

			// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
			add_filter('bugspatrol_filter_get_blog_type',				'bugspatrol_woocommerce_get_blog_type', 9, 2);
			add_filter('bugspatrol_filter_get_blog_title',			'bugspatrol_woocommerce_get_blog_title', 9, 2);
			add_filter('bugspatrol_filter_get_current_taxonomy',		'bugspatrol_woocommerce_get_current_taxonomy', 9, 2);
			add_filter('bugspatrol_filter_is_taxonomy',				'bugspatrol_woocommerce_is_taxonomy', 9, 2);
			add_filter('bugspatrol_filter_get_stream_page_title',		'bugspatrol_woocommerce_get_stream_page_title', 9, 2);
			add_filter('bugspatrol_filter_get_stream_page_link',		'bugspatrol_woocommerce_get_stream_page_link', 9, 2);
			add_filter('bugspatrol_filter_get_stream_page_id',		'bugspatrol_woocommerce_get_stream_page_id', 9, 2);
			add_filter('bugspatrol_filter_detect_inheritance_key',	'bugspatrol_woocommerce_detect_inheritance_key', 9, 1);
			add_filter('bugspatrol_filter_detect_template_page_id',	'bugspatrol_woocommerce_detect_template_page_id', 9, 2);
			add_filter('bugspatrol_filter_orderby_need',				'bugspatrol_woocommerce_orderby_need', 9, 2);

			add_filter('bugspatrol_filter_show_post_navi', 			'bugspatrol_woocommerce_show_post_navi');
			add_filter('bugspatrol_filter_list_post_types', 			'bugspatrol_woocommerce_list_post_types');

			add_action('bugspatrol_action_shortcodes_list', 			'bugspatrol_woocommerce_reg_shortcodes', 20);
			if (function_exists('bugspatrol_exists_visual_composer') && bugspatrol_exists_visual_composer())
				add_action('bugspatrol_action_shortcodes_list_vc',	'bugspatrol_woocommerce_reg_shortcodes_vc', 20);


		}

		if (is_admin()) {

			add_filter( 'bugspatrol_filter_required_plugins',					'bugspatrol_woocommerce_required_plugins' );
		}
	}
}

if ( !function_exists( 'bugspatrol_woocommerce_settings_theme_setup2' ) ) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_woocommerce_settings_theme_setup2', 3 );
	function bugspatrol_woocommerce_settings_theme_setup2() {
		if (bugspatrol_exists_woocommerce()) {
			// Add WooCommerce pages in the Theme inheritance system
			bugspatrol_add_theme_inheritance( array( 'woocommerce' => array(
				'stream_template' => 'blog-woocommerce',		// This params must be empty
				'single_template' => 'single-woocommerce',		// They are specified to enable separate settings for blog and single wooc
				'taxonomy' => array('product_cat'),
				'taxonomy_tags' => array('product_tag'),
				'post_type' => array('product'),
				'override' => 'page'
				) )
			);

			// Add WooCommerce specific options in the Theme Options

			bugspatrol_storage_set_array_before('options', 'partition_service', array(
				
				"partition_woocommerce" => array(
					"title" => esc_html__('WooCommerce', 'bugspatrol'),
					"icon" => "iconadmin-basket",
					"type" => "partition"),

				"info_wooc_1" => array(
					"title" => esc_html__('WooCommerce products list parameters', 'bugspatrol'),
					"desc" => esc_html__("Select WooCommerce products list's style and crop parameters", 'bugspatrol'),
					"type" => "info"),
		
				"shop_mode" => array(
					"title" => esc_html__('Shop list style',  'bugspatrol'),
					"desc" => esc_html__("WooCommerce products list's style: thumbs or list with description", 'bugspatrol'),
					"std" => "thumbs",
					"divider" => false,
					"options" => array(
						'thumbs' => esc_html__('Thumbs', 'bugspatrol'),
						'list' => esc_html__('List', 'bugspatrol')
					),
					"type" => "checklist"),
		
				"show_mode_buttons" => array(
					"title" => esc_html__('Show style buttons',  'bugspatrol'),
					"desc" => esc_html__("Show buttons to allow visitors change list style", 'bugspatrol'),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),

				"shop_loop_columns" => array(
					"title" => esc_html__('Shop columns',  'bugspatrol'),
					"desc" => esc_html__("How many columns used to show products on shop page", 'bugspatrol'),
					"std" => "3",
					"step" => 1,
					"min" => 1,
					"max" => 6,
					"type" => "spinner"),

				"show_currency" => array(
					"title" => esc_html__('Show currency selector', 'bugspatrol'),
					"desc" => esc_html__('Show currency selector in the user menu', 'bugspatrol'),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
				"show_cart" => array(
					"title" => esc_html__('Show cart button', 'bugspatrol'),
					"desc" => esc_html__('Show cart button in the user menu', 'bugspatrol'),
					"std" => "shop",
					"options" => array(
						'hide'   => esc_html__('Hide', 'bugspatrol'),
						'always' => esc_html__('Always', 'bugspatrol'),
						'shop'   => esc_html__('Only on shop pages', 'bugspatrol')
					),
					"type" => "checklist"),

				"crop_product_thumb" => array(
					"title" => esc_html__("Crop product's thumbnail",  'bugspatrol'),
					"desc" => esc_html__("Crop product's thumbnails on search results page or scale it", 'bugspatrol'),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch")
				
				)
			);

		}
	}
}

// WooCommerce hooks
if (!function_exists('bugspatrol_woocommerce_theme_setup3')) {
	add_action( 'bugspatrol_action_after_init_theme', 'bugspatrol_woocommerce_theme_setup3' );
	function bugspatrol_woocommerce_theme_setup3() {

		if (bugspatrol_exists_woocommerce()) {

			add_action(    'woocommerce_before_subcategory_title',		'bugspatrol_woocommerce_open_thumb_wrapper', 9 );
			add_action(    'woocommerce_before_shop_loop_item_title',	'bugspatrol_woocommerce_open_thumb_wrapper', 9 );

			add_action(    'woocommerce_before_subcategory_title',		'bugspatrol_woocommerce_open_item_wrapper', 20 );
			add_action(    'woocommerce_before_shop_loop_item_title',	'bugspatrol_woocommerce_open_item_wrapper', 20 );

			add_action(    'woocommerce_after_subcategory',				'bugspatrol_woocommerce_close_item_wrapper', 20 );
			add_action(    'woocommerce_after_shop_loop_item',			'bugspatrol_woocommerce_close_item_wrapper', 20 );

			add_action(    'woocommerce_after_shop_loop_item_title',	'bugspatrol_woocommerce_after_shop_loop_item_title', 7);

			add_action(    'woocommerce_after_subcategory_title',		'bugspatrol_woocommerce_after_subcategory_title', 10 );

			// Remove link around product item
			remove_action('woocommerce_before_shop_loop_item',			'woocommerce_template_loop_product_link_open', 10);
			remove_action('woocommerce_after_shop_loop_item',			'woocommerce_template_loop_product_link_close', 5);
			// Remove link around product category
			remove_action('woocommerce_before_subcategory',				'woocommerce_template_loop_category_link_open', 10);
			remove_action('woocommerce_after_subcategory',				'woocommerce_template_loop_category_link_close', 10);

		}

		if (bugspatrol_is_woocommerce_page()) {
			
			remove_action( 'woocommerce_sidebar', 						'woocommerce_get_sidebar', 10 );					// Remove WOOC sidebar
			
			remove_action( 'woocommerce_before_main_content',			'woocommerce_output_content_wrapper', 10);
			add_action(    'woocommerce_before_main_content',			'bugspatrol_woocommerce_wrapper_start', 10);
			
			remove_action( 'woocommerce_after_main_content',			'woocommerce_output_content_wrapper_end', 10);		
			add_action(    'woocommerce_after_main_content',			'bugspatrol_woocommerce_wrapper_end', 10);

			add_action(    'woocommerce_show_page_title',				'bugspatrol_woocommerce_show_page_title', 10);

			remove_action( 'woocommerce_single_product_summary',		'woocommerce_template_single_title', 5);		
			add_action(    'woocommerce_single_product_summary',		'bugspatrol_woocommerce_show_product_title', 5 );

			add_action(    'woocommerce_before_shop_loop', 				'bugspatrol_woocommerce_before_shop_loop', 10 );

			remove_action( 'woocommerce_after_shop_loop',				'woocommerce_pagination', 10 );
			add_action(    'woocommerce_after_shop_loop',				'bugspatrol_woocommerce_pagination', 10 );

			add_action(    'woocommerce_product_meta_end',				'bugspatrol_woocommerce_show_product_id', 10);

			add_filter(    'woocommerce_output_related_products_args',	'bugspatrol_woocommerce_output_related_products_args' );
			
			add_filter(    'woocommerce_product_thumbnails_columns',	'bugspatrol_woocommerce_product_thumbnails_columns' );



			add_filter(    'get_product_search_form',					'bugspatrol_woocommerce_get_product_search_form' );

			add_filter(    'post_class',								'bugspatrol_woocommerce_loop_shop_columns_class' );
			add_action(    'the_title',									'bugspatrol_woocommerce_the_title');
			
			bugspatrol_enqueue_popup();
		}
	}
}



// Check if WooCommerce installed and activated
if ( !function_exists( 'bugspatrol_exists_woocommerce' ) ) {
	function bugspatrol_exists_woocommerce() {
		return class_exists('Woocommerce');
	}
}

// Return true, if current page is any woocommerce page
if ( !function_exists( 'bugspatrol_is_woocommerce_page' ) ) {
	function bugspatrol_is_woocommerce_page() {
		$rez = false;
		if (bugspatrol_exists_woocommerce()) {
			if (!bugspatrol_storage_empty('pre_query')) {
				$id = bugspatrol_storage_get_obj_property('pre_query', 'queried_object_id', 0);
				$rez = bugspatrol_storage_call_obj_method('pre_query', 'get', 'post_type')=='product' 
						|| $id==wc_get_page_id('shop')
						|| $id==wc_get_page_id('cart')
						|| $id==wc_get_page_id('checkout')
						|| $id==wc_get_page_id('myaccount')
						|| bugspatrol_storage_call_obj_method('pre_query', 'is_tax', 'product_cat')
						|| bugspatrol_storage_call_obj_method('pre_query', 'is_tax', 'product_tag')
						|| bugspatrol_storage_call_obj_method('pre_query', 'is_tax', get_object_taxonomies('product'));
						
			} else
				$rez = is_shop() || is_product() || is_product_category() || is_product_tag() || is_product_taxonomy() || is_cart() || is_checkout() || is_account_page();
		}
		return $rez;
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'bugspatrol_woocommerce_detect_inheritance_key' ) ) {
		function bugspatrol_woocommerce_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return bugspatrol_is_woocommerce_page() ? 'woocommerce' : '';
	}
}

// Filter to detect current template page id
if ( !function_exists( 'bugspatrol_woocommerce_detect_template_page_id' ) ) {
		function bugspatrol_woocommerce_detect_template_page_id($id, $key) {
		if (!empty($id)) return $id;
		if ($key == 'woocommerce_cart')				$id = get_option('woocommerce_cart_page_id');
		else if ($key == 'woocommerce_checkout')	$id = get_option('woocommerce_checkout_page_id');
		else if ($key == 'woocommerce_account')		$id = get_option('woocommerce_account_page_id');
		else if ($key == 'woocommerce')				$id = get_option('woocommerce_shop_page_id');
		return $id;
	}
}

// Filter to detect current page type (slug)
if ( !function_exists( 'bugspatrol_woocommerce_get_blog_type' ) ) {
		function bugspatrol_woocommerce_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;
		
		if (is_shop()) 					$page = 'woocommerce_shop';
		else if ($query && $query->get('post_type')=='product' || is_product())		$page = 'woocommerce_product';
		else if ($query && $query->get('product_tag')!='' || is_product_tag())		$page = 'woocommerce_tag';
		else if ($query && $query->get('product_cat')!='' || is_product_category())	$page = 'woocommerce_category';
		else if (is_cart())				$page = 'woocommerce_cart';
		else if (is_checkout())			$page = 'woocommerce_checkout';
		else if (is_account_page())		$page = 'woocommerce_account';
		else if (is_woocommerce())		$page = 'woocommerce';
		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'bugspatrol_woocommerce_get_blog_title' ) ) {
		function bugspatrol_woocommerce_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		
		if ( bugspatrol_strpos($page, 'woocommerce')!==false ) {
			if ( $page == 'woocommerce_category' ) {
				$term = get_term_by( 'slug', get_query_var( 'product_cat' ), 'product_cat', OBJECT);
				$title = $term->name;
			} else if ( $page == 'woocommerce_tag' ) {
				$term = get_term_by( 'slug', get_query_var( 'product_tag' ), 'product_tag', OBJECT);
				$title = esc_html__('Tag:', 'bugspatrol') . ' ' . esc_html($term->name);
			} else if ( $page == 'woocommerce_cart' ) {
				$title = esc_html__( 'Your cart', 'bugspatrol' );
			} else if ( $page == 'woocommerce_checkout' ) {
				$title = esc_html__( 'Checkout', 'bugspatrol' );
			} else if ( $page == 'woocommerce_account' ) {
				$title = esc_html__( 'Account', 'bugspatrol' );
			} else if ( $page == 'woocommerce_product' ) {
				$title = bugspatrol_get_post_title();
			} else if (($page_id=get_option('woocommerce_shop_page_id')) > 0) {
				$title = bugspatrol_get_post_title($page_id);
			} else {
				$title = esc_html__( 'Shop', 'bugspatrol' );
			}
		}
		
		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'bugspatrol_woocommerce_get_stream_page_title' ) ) {
		function bugspatrol_woocommerce_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if (bugspatrol_strpos($page, 'woocommerce')!==false) {
			if (($page_id = bugspatrol_woocommerce_get_stream_page_id(0, $page)) > 0)
				$title = bugspatrol_get_post_title($page_id);
			else
				$title = esc_html__('Shop', 'bugspatrol');				
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'bugspatrol_woocommerce_get_stream_page_id' ) ) {
		function bugspatrol_woocommerce_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if (bugspatrol_strpos($page, 'woocommerce')!==false) {
			$id = get_option('woocommerce_shop_page_id');
		}
		return $id;
	}
}

// Filter to detect stream page link
if ( !function_exists( 'bugspatrol_woocommerce_get_stream_page_link' ) ) {
		function bugspatrol_woocommerce_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if (bugspatrol_strpos($page, 'woocommerce')!==false) {
			$id = bugspatrol_woocommerce_get_stream_page_id(0, $page);
			if ($id) $url = get_permalink($id);
		}
		return $url;
	}
}

// Filter to detect current taxonomy
if ( !function_exists( 'bugspatrol_woocommerce_get_current_taxonomy' ) ) {
		function bugspatrol_woocommerce_get_current_taxonomy($tax, $page) {
		if (!empty($tax)) return $tax;
		if ( bugspatrol_strpos($page, 'woocommerce')!==false ) {
			$tax = 'product_cat';
		}
		return $tax;
	}
}

// Return taxonomy name (slug) if current page is this taxonomy page
if ( !function_exists( 'bugspatrol_woocommerce_is_taxonomy' ) ) {
		function bugspatrol_woocommerce_is_taxonomy($tax, $query=null) {
		if (!empty($tax))
			return $tax;
		else 
			return $query!==null && $query->get('product_cat')!='' || is_product_category() ? 'product_cat' : '';
	}
}

// Return false if current plugin not need theme orderby setting
if ( !function_exists( 'bugspatrol_woocommerce_orderby_need' ) ) {
		function bugspatrol_woocommerce_orderby_need($need) {
		if ($need == false || bugspatrol_storage_empty('pre_query'))
			return $need;
		else {
			return bugspatrol_storage_call_obj_method('pre_query', 'get', 'post_type')!='product' 
					&& bugspatrol_storage_call_obj_method('pre_query', 'get', 'product_cat')==''
					&& bugspatrol_storage_call_obj_method('pre_query', 'get', 'product_tag')=='';
		}
	}
}

// Add custom post type into list
if ( !function_exists( 'bugspatrol_woocommerce_list_post_types' ) ) {
		function bugspatrol_woocommerce_list_post_types($list) {
		$list['product'] = esc_html__('Products', 'bugspatrol');
		return $list;
	}
}


	
// Enqueue WooCommerce custom styles
if ( !function_exists( 'bugspatrol_woocommerce_frontend_scripts' ) ) {
		function bugspatrol_woocommerce_frontend_scripts() {
		if (bugspatrol_is_woocommerce_page() || bugspatrol_get_custom_option('show_cart')=='always')
			if (file_exists(bugspatrol_get_file_dir('css/plugin.woocommerce.css')))
				wp_enqueue_style( 'bugspatrol-plugin-woocommerce-style',  bugspatrol_get_file_url('css/plugin.woocommerce.css'), array(), null );
	}
}

// Before main content
if ( !function_exists( 'bugspatrol_woocommerce_wrapper_start' ) ) {
			function bugspatrol_woocommerce_wrapper_start() {
		if (is_product() || is_cart() || is_checkout() || is_account_page()) {
			?>
			<article class="post_item post_item_single post_item_product">
			<?php
		} else {
			?>
			<div class="list_products shop_mode_<?php echo !bugspatrol_storage_empty('shop_mode') ? bugspatrol_storage_get('shop_mode') : 'thumbs'; ?>">
			<?php
		}
	}
}

// After main content
if ( !function_exists( 'bugspatrol_woocommerce_wrapper_end' ) ) {
			function bugspatrol_woocommerce_wrapper_end() {
		if (is_product() || is_cart() || is_checkout() || is_account_page()) {
			?>
			</article>	<!-- .post_item -->
			<?php
		} else {
			?>
			</div>	<!-- .list_products -->
			<?php
		}
	}
}

// Check to show page title
if ( !function_exists( 'bugspatrol_woocommerce_show_page_title' ) ) {
		function bugspatrol_woocommerce_show_page_title($defa=true) {
		return bugspatrol_get_custom_option('show_page_title')=='no';
	}
}

// Check to show product title
if ( !function_exists( 'bugspatrol_woocommerce_show_product_title' ) ) {
			function bugspatrol_woocommerce_show_product_title() {
		if (bugspatrol_get_custom_option('show_post_title')=='yes' || bugspatrol_get_custom_option('show_page_title')=='no') {
			wc_get_template( 'single-product/title.php' );
		}
	}
}

// Add list mode buttons
if ( !function_exists( 'bugspatrol_woocommerce_before_shop_loop' ) ) {
		function bugspatrol_woocommerce_before_shop_loop() {
		if (bugspatrol_get_custom_option('show_mode_buttons')=='yes') {
			echo '<div class="mode_buttons"><form action="' . esc_url(bugspatrol_get_current_url()) . '" method="post">'
				. '<input type="hidden" name="bugspatrol_shop_mode" value="'.esc_attr(bugspatrol_storage_get('shop_mode')).'" />'
				. '<a href="#" class="woocommerce_thumbs icon-th" title="'.esc_attr__('Show products as thumbs', 'bugspatrol').'"></a>'
				. '<a href="#" class="woocommerce_list icon-th-list" title="'.esc_attr__('Show products as list', 'bugspatrol').'"></a>'
				. '</form></div>';
		}
	}
}


// Open thumbs wrapper for categories and products
if ( !function_exists( 'bugspatrol_woocommerce_open_thumb_wrapper' ) ) {
			function bugspatrol_woocommerce_open_thumb_wrapper($cat='') {
		bugspatrol_storage_set('in_product_item', true);
		?>
		<div class="post_item_wrap">
			<div class="post_featured">
				<div class="post_thumb">
					<a class="hover_icon hover_icon_link" href="<?php echo esc_url(is_object($cat) ? get_term_link($cat->slug, 'product_cat') : get_permalink()); ?>">
		<?php
	}
}

// Open item wrapper for categories and products
if ( !function_exists( 'bugspatrol_woocommerce_open_item_wrapper' ) ) {
			function bugspatrol_woocommerce_open_item_wrapper($cat='') {
		?>
				</a>
			</div>
		</div>
		<div class="post_content">
		<?php
	}
}

// Close item wrapper for categories and products
if ( !function_exists( 'bugspatrol_woocommerce_close_item_wrapper' ) ) {
			function bugspatrol_woocommerce_close_item_wrapper($cat='') {
		?>
			</div>
		</div>
		<?php
		bugspatrol_storage_set('in_product_item', false);
	}
}

// Add excerpt in output for the product in the list mode
if ( !function_exists( 'bugspatrol_woocommerce_after_shop_loop_item_title' ) ) {
		function bugspatrol_woocommerce_after_shop_loop_item_title() {
		if (bugspatrol_storage_get('shop_mode') == 'list') {
		    $excerpt = apply_filters('the_excerpt', get_the_excerpt());
			echo '<div class="description">'.trim($excerpt).'</div>';
		}
	}
}

// Add excerpt in output for the product in the list mode
if ( !function_exists( 'bugspatrol_woocommerce_after_subcategory_title' ) ) {
		function bugspatrol_woocommerce_after_subcategory_title($category) {
		if (bugspatrol_storage_get('shop_mode') == 'list')
			echo '<div class="description">' . trim($category->description) . '</div>';
	}
}

// Add Product ID for single product
if ( !function_exists( 'bugspatrol_woocommerce_show_product_id' ) ) {
		function bugspatrol_woocommerce_show_product_id() {
		global $post, $product;
		echo '<span class="product_id">'.esc_html__('Product ID: ', 'bugspatrol') . '<span>' . ($post->ID) . '</span></span>';
	}
}

// Redefine number of related products
if ( !function_exists( 'bugspatrol_woocommerce_output_related_products_args' ) ) {
		function bugspatrol_woocommerce_output_related_products_args($args) {
		$ppp = $ccc = 0;
		if (bugspatrol_param_is_on(bugspatrol_get_custom_option('show_post_related'))) {
			$ccc_add = in_array(bugspatrol_get_custom_option('body_style'), array('fullwide', 'fullscreen')) ? 1 : 0;
			$ccc =  bugspatrol_get_custom_option('post_related_columns');
			$ccc = $ccc > 0 ? $ccc : (bugspatrol_param_is_off(bugspatrol_get_custom_option('show_sidebar_main')) ? 3+$ccc_add : 2+$ccc_add);
			$ppp = bugspatrol_get_custom_option('post_related_count');
			$ppp = $ppp > 0 ? $ppp : $ccc;
		}
		$args['posts_per_page'] = $ppp;
		$args['columns'] = $ccc;
		return $args;
	}
}

// Number columns for product thumbnails
if ( !function_exists( 'bugspatrol_woocommerce_product_thumbnails_columns' ) ) {
		function bugspatrol_woocommerce_product_thumbnails_columns($cols) {
		return 4;
	}
}

// Add column class into product item in shop streampage
if ( !function_exists( 'bugspatrol_woocommerce_loop_shop_columns_class' ) ) {
	    function bugspatrol_woocommerce_loop_shop_columns_class($class, $class2='', $cat='') {
        if (!is_product() && !is_cart() && !is_checkout() && !is_account_page()) {
            $cols = function_exists('wc_get_default_products_per_row') ? wc_get_default_products_per_row() : 2;
            $class[] = ' column-1_' . $cols;
        }
        return $class;
    }
}



// Search form
if ( !function_exists( 'bugspatrol_woocommerce_get_product_search_form' ) ) {
		function bugspatrol_woocommerce_get_product_search_form($form) {
		return '
		<form role="search" method="get" class="search_form" action="' . esc_url(home_url('/')) . '">
			<input type="text" class="search_field" placeholder="' . esc_attr__('Search for products &hellip;', 'bugspatrol') . '" value="' . get_search_query() . '" name="s" title="' . esc_attr__('Search for products:', 'bugspatrol') . '" /><button class="search_button icon-search" type="submit"></button>
			<input type="hidden" name="post_type" value="product" />
		</form>
		';
	}
}

// Wrap product title into link
if ( !function_exists( 'bugspatrol_woocommerce_the_title' ) ) {
		function bugspatrol_woocommerce_the_title($title) {
		if (bugspatrol_storage_get('in_product_item') && get_post_type()=='product') {
			$title = '<a href="'.get_permalink().'">'.($title).'</a>';
		}
		return $title;
	}
}

// Show pagination links
if ( !function_exists( 'bugspatrol_woocommerce_pagination' ) ) {
		function bugspatrol_woocommerce_pagination() {
		$style = bugspatrol_get_custom_option('blog_pagination');
		bugspatrol_show_pagination(array(
			'class' => 'pagination_wrap pagination_' . esc_attr($style),
			'style' => $style,
			'button_class' => '',
			'first_text'=> '',
			'last_text' => '',
			'prev_text' => '',
			'next_text' => '',
			'pages_in_group' => $style=='pages' ? 10 : 20
			)
		);
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'bugspatrol_woocommerce_required_plugins' ) ) {
		function bugspatrol_woocommerce_required_plugins($list=array()) {
		if (in_array('woocommerce', bugspatrol_storage_get('required_plugins')))
			$list[] = array(
					'name' 		=> 'WooCommerce',
					'slug' 		=> 'woocommerce',
					'required' 	=> false
				);

		return $list;
	}
}

// Show products navigation
if ( !function_exists( 'bugspatrol_woocommerce_show_post_navi' ) ) {
		function bugspatrol_woocommerce_show_post_navi($show=false) {
		return $show || (bugspatrol_get_custom_option('show_page_title')=='yes' && is_single() && bugspatrol_is_woocommerce_page());
	}
}



// Register shortcodes to the internal builder
//------------------------------------------------------------------------
if ( !function_exists( 'bugspatrol_woocommerce_reg_shortcodes' ) ) {
		function bugspatrol_woocommerce_reg_shortcodes() {

		// WooCommerce - Cart
		bugspatrol_sc_map("woocommerce_cart", array(
			"title" => esc_html__("Woocommerce: Cart", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show Cart page", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array()
			)
		);
		
		// WooCommerce - Checkout
		bugspatrol_sc_map("woocommerce_checkout", array(
			"title" => esc_html__("Woocommerce: Checkout", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show Checkout page", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array()
			)
		);
		
		// WooCommerce - My Account
		bugspatrol_sc_map("woocommerce_my_account", array(
			"title" => esc_html__("Woocommerce: My Account", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show My Account page", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array()
			)
		);
		
		// WooCommerce - Order Tracking
		bugspatrol_sc_map("woocommerce_order_tracking", array(
			"title" => esc_html__("Woocommerce: Order Tracking", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show Order Tracking page", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array()
			)
		);
		
		// WooCommerce - Shop Messages
		bugspatrol_sc_map("shop_messages", array(
			"title" => esc_html__("Woocommerce: Shop Messages", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show shop messages", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array()
			)
		);
		
		// WooCommerce - Product Page
		bugspatrol_sc_map("product_page", array(
			"title" => esc_html__("Woocommerce: Product Page", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: display single product page", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"sku" => array(
					"title" => esc_html__("SKU", 'bugspatrol'),
					"desc" => wp_kses_data( __("SKU code of displayed product", 'bugspatrol') ),
					"value" => "",
					"type" => "text"
				),
				"id" => array(
					"title" => esc_html__("ID", 'bugspatrol'),
					"desc" => wp_kses_data( __("ID of displayed product", 'bugspatrol') ),
					"value" => "",
					"type" => "text"
				),
				"posts_per_page" => array(
					"title" => esc_html__("Number", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
					"value" => "1",
					"min" => 1,
					"type" => "spinner"
				),
				"post_type" => array(
					"title" => esc_html__("Post type", 'bugspatrol'),
					"desc" => wp_kses_data( __("Post type for the WP query (leave 'product')", 'bugspatrol') ),
					"value" => "product",
					"type" => "text"
				),
				"post_status" => array(
					"title" => esc_html__("Post status", 'bugspatrol'),
					"desc" => wp_kses_data( __("Display posts only with this status", 'bugspatrol') ),
					"value" => "publish",
					"type" => "select",
					"options" => array(
						"publish" => esc_html__('Publish', 'bugspatrol'),
						"protected" => esc_html__('Protected', 'bugspatrol'),
						"private" => esc_html__('Private', 'bugspatrol'),
						"pending" => esc_html__('Pending', 'bugspatrol'),
						"draft" => esc_html__('Draft', 'bugspatrol')
						)
					)
				)
			)
		);
		
		// WooCommerce - Product
		bugspatrol_sc_map("product", array(
			"title" => esc_html__("Woocommerce: Product", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: display one product", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"sku" => array(
					"title" => esc_html__("SKU", 'bugspatrol'),
					"desc" => wp_kses_data( __("SKU code of displayed product", 'bugspatrol') ),
					"value" => "",
					"type" => "text"
				),
				"id" => array(
					"title" => esc_html__("ID", 'bugspatrol'),
					"desc" => wp_kses_data( __("ID of displayed product", 'bugspatrol') ),
					"value" => "",
					"type" => "text"
					)
				)
			)
		);
		
		// WooCommerce - Best Selling Products
		bugspatrol_sc_map("best_selling_products", array(
			"title" => esc_html__("Woocommerce: Best Selling Products", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show best selling products", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"per_page" => array(
					"title" => esc_html__("Number", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
					)
				)
			)
		);
		
		// WooCommerce - Recent Products
		bugspatrol_sc_map("recent_products", array(
			"title" => esc_html__("Woocommerce: Recent Products", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show recent products", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"per_page" => array(
					"title" => esc_html__("Number", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'bugspatrol'),
						"title" => esc_html__('Title', 'bugspatrol')
					)
				),
				"order" => array(
					"title" => esc_html__("Order", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "desc",
					"type" => "switch",
					"size" => "big",
					"options" => bugspatrol_get_sc_param('ordering')
					)
				)
			)
		);
		
		// WooCommerce - Related Products
		bugspatrol_sc_map("related_products", array(
			"title" => esc_html__("Woocommerce: Related Products", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show related products", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"posts_per_page" => array(
					"title" => esc_html__("Number", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'bugspatrol'),
						"title" => esc_html__('Title', 'bugspatrol')
						)
					)
				)
			)
		);
		
		// WooCommerce - Featured Products
		bugspatrol_sc_map("featured_products", array(
			"title" => esc_html__("Woocommerce: Featured Products", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show featured products", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"per_page" => array(
					"title" => esc_html__("Number", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'bugspatrol'),
						"title" => esc_html__('Title', 'bugspatrol')
					)
				),
				"order" => array(
					"title" => esc_html__("Order", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "desc",
					"type" => "switch",
					"size" => "big",
					"options" => bugspatrol_get_sc_param('ordering')
					)
				)
			)
		);
		
		// WooCommerce - Top Rated Products
		bugspatrol_sc_map("featured_products", array(
			"title" => esc_html__("Woocommerce: Top Rated Products", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show top rated products", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"per_page" => array(
					"title" => esc_html__("Number", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'bugspatrol'),
						"title" => esc_html__('Title', 'bugspatrol')
					)
				),
				"order" => array(
					"title" => esc_html__("Order", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "desc",
					"type" => "switch",
					"size" => "big",
					"options" => bugspatrol_get_sc_param('ordering')
					)
				)
			)
		);
		
		// WooCommerce - Sale Products
		bugspatrol_sc_map("featured_products", array(
			"title" => esc_html__("Woocommerce: Sale Products", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: list products on sale", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"per_page" => array(
					"title" => esc_html__("Number", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'bugspatrol'),
						"title" => esc_html__('Title', 'bugspatrol')
					)
				),
				"order" => array(
					"title" => esc_html__("Order", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "desc",
					"type" => "switch",
					"size" => "big",
					"options" => bugspatrol_get_sc_param('ordering')
					)
				)
			)
		);
		
		// WooCommerce - Product Category
		bugspatrol_sc_map("product_category", array(
			"title" => esc_html__("Woocommerce: Products from category", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: list products in specified category(-ies)", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"per_page" => array(
					"title" => esc_html__("Number", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'bugspatrol'),
						"title" => esc_html__('Title', 'bugspatrol')
					)
				),
				"order" => array(
					"title" => esc_html__("Order", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "desc",
					"type" => "switch",
					"size" => "big",
					"options" => bugspatrol_get_sc_param('ordering')
				),
				"category" => array(
					"title" => esc_html__("Categories", 'bugspatrol'),
					"desc" => wp_kses_data( __("Comma separated category slugs", 'bugspatrol') ),
					"value" => '',
					"type" => "text"
				),
				"operator" => array(
					"title" => esc_html__("Operator", 'bugspatrol'),
					"desc" => wp_kses_data( __("Categories operator", 'bugspatrol') ),
					"value" => "IN",
					"type" => "checklist",
					"size" => "medium",
					"options" => array(
						"IN" => esc_html__('IN', 'bugspatrol'),
						"NOT IN" => esc_html__('NOT IN', 'bugspatrol'),
						"AND" => esc_html__('AND', 'bugspatrol')
						)
					)
				)
			)
		);
		
		// WooCommerce - Products
		bugspatrol_sc_map("products", array(
			"title" => esc_html__("Woocommerce: Products", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: list all products", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"skus" => array(
					"title" => esc_html__("SKUs", 'bugspatrol'),
					"desc" => wp_kses_data( __("Comma separated SKU codes of products", 'bugspatrol') ),
					"value" => "",
					"type" => "text"
				),
				"ids" => array(
					"title" => esc_html__("IDs", 'bugspatrol'),
					"desc" => wp_kses_data( __("Comma separated ID of products", 'bugspatrol') ),
					"value" => "",
					"type" => "text"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'bugspatrol'),
						"title" => esc_html__('Title', 'bugspatrol')
					)
				),
				"order" => array(
					"title" => esc_html__("Order", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "desc",
					"type" => "switch",
					"size" => "big",
					"options" => bugspatrol_get_sc_param('ordering')
					)
				)
			)
		);
		
		// WooCommerce - Product attribute
		bugspatrol_sc_map("product_attribute", array(
			"title" => esc_html__("Woocommerce: Products by Attribute", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show products with specified attribute", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"per_page" => array(
					"title" => esc_html__("Number", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'bugspatrol'),
						"title" => esc_html__('Title', 'bugspatrol')
					)
				),
				"order" => array(
					"title" => esc_html__("Order", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "desc",
					"type" => "switch",
					"size" => "big",
					"options" => bugspatrol_get_sc_param('ordering')
				),
				"attribute" => array(
					"title" => esc_html__("Attribute", 'bugspatrol'),
					"desc" => wp_kses_data( __("Attribute name", 'bugspatrol') ),
					"value" => "",
					"type" => "text"
				),
				"filter" => array(
					"title" => esc_html__("Filter", 'bugspatrol'),
					"desc" => wp_kses_data( __("Attribute value", 'bugspatrol') ),
					"value" => "",
					"type" => "text"
					)
				)
			)
		);
		
		// WooCommerce - Products Categories
		bugspatrol_sc_map("product_categories", array(
			"title" => esc_html__("Woocommerce: Product Categories", 'bugspatrol'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show categories with products", 'bugspatrol') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"number" => array(
					"title" => esc_html__("Number", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many categories showed", 'bugspatrol') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many columns per row use for categories output", 'bugspatrol') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'bugspatrol'),
						"title" => esc_html__('Title', 'bugspatrol')
					)
				),
				"order" => array(
					"title" => esc_html__("Order", 'bugspatrol'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
					"value" => "desc",
					"type" => "switch",
					"size" => "big",
					"options" => bugspatrol_get_sc_param('ordering')
				),
				"parent" => array(
					"title" => esc_html__("Parent", 'bugspatrol'),
					"desc" => wp_kses_data( __("Parent category slug", 'bugspatrol') ),
					"value" => "",
					"type" => "text"
				),
				"ids" => array(
					"title" => esc_html__("IDs", 'bugspatrol'),
					"desc" => wp_kses_data( __("Comma separated ID of products", 'bugspatrol') ),
					"value" => "",
					"type" => "text"
				),
				"hide_empty" => array(
					"title" => esc_html__("Hide empty", 'bugspatrol'),
					"desc" => wp_kses_data( __("Hide empty categories", 'bugspatrol') ),
					"value" => "yes",
					"type" => "switch",
					"options" => bugspatrol_get_sc_param('yes_no')
					)
				)
			)
		);
	}
}



// Register shortcodes to the VC builder
//------------------------------------------------------------------------
if ( !function_exists( 'bugspatrol_woocommerce_reg_shortcodes_vc' ) ) {
		function bugspatrol_woocommerce_reg_shortcodes_vc() {
	
		if (false && function_exists('bugspatrol_exists_woocommerce') && bugspatrol_exists_woocommerce()) {
		
			// WooCommerce - Cart
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "woocommerce_cart",
				"name" => esc_html__("Cart", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show cart page", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_wooc_cart',
				"class" => "trx_sc_alone trx_sc_woocommerce_cart",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => false,
				"params" => array(
					array(
						"param_name" => "dummy",
						"heading" => esc_html__("Dummy data", 'bugspatrol'),
						"description" => wp_kses_data( __("Dummy data - not used in shortcodes", 'bugspatrol') ),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					)
				)
			) );
			
			class WPBakeryShortCode_Woocommerce_Cart extends Bugspatrol_VC_ShortCodeAlone {}
		
		
			// WooCommerce - Checkout
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "woocommerce_checkout",
				"name" => esc_html__("Checkout", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show checkout page", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_wooc_checkout',
				"class" => "trx_sc_alone trx_sc_woocommerce_checkout",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => false,
				"params" => array(
					array(
						"param_name" => "dummy",
						"heading" => esc_html__("Dummy data", 'bugspatrol'),
						"description" => wp_kses_data( __("Dummy data - not used in shortcodes", 'bugspatrol') ),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					)
				)
			) );
			
			class WPBakeryShortCode_Woocommerce_Checkout extends Bugspatrol_VC_ShortCodeAlone {}
		
		
			// WooCommerce - My Account
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "woocommerce_my_account",
				"name" => esc_html__("My Account", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show my account page", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_wooc_my_account',
				"class" => "trx_sc_alone trx_sc_woocommerce_my_account",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => false,
				"params" => array(
					array(
						"param_name" => "dummy",
						"heading" => esc_html__("Dummy data", 'bugspatrol'),
						"description" => wp_kses_data( __("Dummy data - not used in shortcodes", 'bugspatrol') ),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					)
				)
			) );
			
			class WPBakeryShortCode_Woocommerce_My_Account extends Bugspatrol_VC_ShortCodeAlone {}
		
		
			// WooCommerce - Order Tracking
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "woocommerce_order_tracking",
				"name" => esc_html__("Order Tracking", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show order tracking page", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_wooc_order_tracking',
				"class" => "trx_sc_alone trx_sc_woocommerce_order_tracking",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => false,
				"params" => array(
					array(
						"param_name" => "dummy",
						"heading" => esc_html__("Dummy data", 'bugspatrol'),
						"description" => wp_kses_data( __("Dummy data - not used in shortcodes", 'bugspatrol') ),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					)
				)
			) );
			
			class WPBakeryShortCode_Woocommerce_Order_Tracking extends Bugspatrol_VC_ShortCodeAlone {}
		
		
			// WooCommerce - Shop Messages
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "shop_messages",
				"name" => esc_html__("Shop Messages", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show shop messages", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_wooc_shop_messages',
				"class" => "trx_sc_alone trx_sc_shop_messages",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => false,
				"params" => array(
					array(
						"param_name" => "dummy",
						"heading" => esc_html__("Dummy data", 'bugspatrol'),
						"description" => wp_kses_data( __("Dummy data - not used in shortcodes", 'bugspatrol') ),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					)
				)
			) );
			
			class WPBakeryShortCode_Shop_Messages extends Bugspatrol_VC_ShortCodeAlone {}
		
		
			// WooCommerce - Product Page
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "product_page",
				"name" => esc_html__("Product Page", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: display single product page", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_product_page',
				"class" => "trx_sc_single trx_sc_product_page",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "sku",
						"heading" => esc_html__("SKU", 'bugspatrol'),
						"description" => wp_kses_data( __("SKU code of displayed product", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "id",
						"heading" => esc_html__("ID", 'bugspatrol'),
						"description" => wp_kses_data( __("ID of displayed product", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "posts_per_page",
						"heading" => esc_html__("Number", 'bugspatrol'),
						"description" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "post_type",
						"heading" => esc_html__("Post type", 'bugspatrol'),
						"description" => wp_kses_data( __("Post type for the WP query (leave 'product')", 'bugspatrol') ),
						"class" => "",
						"value" => "product",
						"type" => "textfield"
					),
					array(
						"param_name" => "post_status",
						"heading" => esc_html__("Post status", 'bugspatrol'),
						"description" => wp_kses_data( __("Display posts only with this status", 'bugspatrol') ),
						"class" => "",
						"value" => array(
							esc_html__('Publish', 'bugspatrol') => 'publish',
							esc_html__('Protected', 'bugspatrol') => 'protected',
							esc_html__('Private', 'bugspatrol') => 'private',
							esc_html__('Pending', 'bugspatrol') => 'pending',
							esc_html__('Draft', 'bugspatrol') => 'draft'
						),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Product_Page extends Bugspatrol_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Product
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "product",
				"name" => esc_html__("Product", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: display one product", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_product',
				"class" => "trx_sc_single trx_sc_product",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "sku",
						"heading" => esc_html__("SKU", 'bugspatrol'),
						"description" => wp_kses_data( __("Product's SKU code", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "id",
						"heading" => esc_html__("ID", 'bugspatrol'),
						"description" => wp_kses_data( __("Product's ID", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					)
				)
			) );
			
			class WPBakeryShortCode_Product extends Bugspatrol_VC_ShortCodeSingle {}
		
		
			// WooCommerce - Best Selling Products
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "best_selling_products",
				"name" => esc_html__("Best Selling Products", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show best selling products", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_best_selling_products',
				"class" => "trx_sc_single trx_sc_best_selling_products",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "per_page",
						"heading" => esc_html__("Number", 'bugspatrol'),
						"description" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'bugspatrol'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					)
				)
			) );
			
			class WPBakeryShortCode_Best_Selling_Products extends Bugspatrol_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Recent Products
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "recent_products",
				"name" => esc_html__("Recent Products", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show recent products", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_recent_products',
				"class" => "trx_sc_single trx_sc_recent_products",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "per_page",
						"heading" => esc_html__("Number", 'bugspatrol'),
						"description" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"

					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'bugspatrol'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'bugspatrol') => 'date',
							esc_html__('Title', 'bugspatrol') => 'title'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip(bugspatrol_get_sc_param('ordering')),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Recent_Products extends Bugspatrol_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Related Products
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "related_products",
				"name" => esc_html__("Related Products", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show related products", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_related_products',
				"class" => "trx_sc_single trx_sc_related_products",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "posts_per_page",
						"heading" => esc_html__("Number", 'bugspatrol'),
						"description" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'bugspatrol'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'bugspatrol') => 'date',
							esc_html__('Title', 'bugspatrol') => 'title'
						),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Related_Products extends Bugspatrol_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Featured Products
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "featured_products",
				"name" => esc_html__("Featured Products", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show featured products", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_featured_products',
				"class" => "trx_sc_single trx_sc_featured_products",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "per_page",
						"heading" => esc_html__("Number", 'bugspatrol'),
						"description" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'bugspatrol'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'bugspatrol') => 'date',
							esc_html__('Title', 'bugspatrol') => 'title'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip(bugspatrol_get_sc_param('ordering')),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Featured_Products extends Bugspatrol_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Top Rated Products
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "top_rated_products",
				"name" => esc_html__("Top Rated Products", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show top rated products", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_top_rated_products',
				"class" => "trx_sc_single trx_sc_top_rated_products",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "per_page",
						"heading" => esc_html__("Number", 'bugspatrol'),
						"description" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'bugspatrol'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'bugspatrol') => 'date',
							esc_html__('Title', 'bugspatrol') => 'title'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip(bugspatrol_get_sc_param('ordering')),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Top_Rated_Products extends Bugspatrol_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Sale Products
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "sale_products",
				"name" => esc_html__("Sale Products", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: list products on sale", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_sale_products',
				"class" => "trx_sc_single trx_sc_sale_products",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "per_page",
						"heading" => esc_html__("Number", 'bugspatrol'),
						"description" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'bugspatrol'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'bugspatrol') => 'date',
							esc_html__('Title', 'bugspatrol') => 'title'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip(bugspatrol_get_sc_param('ordering')),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Sale_Products extends Bugspatrol_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Product Category
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "product_category",
				"name" => esc_html__("Products from category", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: list products in specified category(-ies)", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_product_category',
				"class" => "trx_sc_single trx_sc_product_category",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "per_page",
						"heading" => esc_html__("Number", 'bugspatrol'),
						"description" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'bugspatrol'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'bugspatrol') => 'date',
							esc_html__('Title', 'bugspatrol') => 'title'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip(bugspatrol_get_sc_param('ordering')),
						"type" => "dropdown"
					),
					array(
						"param_name" => "category",
						"heading" => esc_html__("Categories", 'bugspatrol'),
						"description" => wp_kses_data( __("Comma separated category slugs", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "operator",
						"heading" => esc_html__("Operator", 'bugspatrol'),
						"description" => wp_kses_data( __("Categories operator", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('IN', 'bugspatrol') => 'IN',
							esc_html__('NOT IN', 'bugspatrol') => 'NOT IN',
							esc_html__('AND', 'bugspatrol') => 'AND'
						),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Product_Category extends Bugspatrol_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Products
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "products",
				"name" => esc_html__("Products", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: list all products", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_products',
				"class" => "trx_sc_single trx_sc_products",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "skus",
						"heading" => esc_html__("SKUs", 'bugspatrol'),
						"description" => wp_kses_data( __("Comma separated SKU codes of products", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "ids",
						"heading" => esc_html__("IDs", 'bugspatrol'),
						"description" => wp_kses_data( __("Comma separated ID of products", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'bugspatrol'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'bugspatrol') => 'date',
							esc_html__('Title', 'bugspatrol') => 'title'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip(bugspatrol_get_sc_param('ordering')),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Products extends Bugspatrol_VC_ShortCodeSingle {}
		
		
		
		
			// WooCommerce - Product Attribute
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "product_attribute",
				"name" => esc_html__("Products by Attribute", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show products with specified attribute", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_product_attribute',
				"class" => "trx_sc_single trx_sc_product_attribute",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "per_page",
						"heading" => esc_html__("Number", 'bugspatrol'),
						"description" => wp_kses_data( __("How many products showed", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'bugspatrol'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'bugspatrol') => 'date',
							esc_html__('Title', 'bugspatrol') => 'title'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip(bugspatrol_get_sc_param('ordering')),
						"type" => "dropdown"
					),
					array(
						"param_name" => "attribute",
						"heading" => esc_html__("Attribute", 'bugspatrol'),
						"description" => wp_kses_data( __("Attribute name", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "filter",
						"heading" => esc_html__("Filter", 'bugspatrol'),
						"description" => wp_kses_data( __("Attribute value", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					)
				)
			) );
			
			class WPBakeryShortCode_Product_Attribute extends Bugspatrol_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Products Categories
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "product_categories",
				"name" => esc_html__("Product Categories", 'bugspatrol'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show categories with products", 'bugspatrol') ),
				"category" => esc_html__('WooCommerce', 'bugspatrol'),
				'icon' => 'icon_trx_product_categories',
				"class" => "trx_sc_single trx_sc_product_categories",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "number",
						"heading" => esc_html__("Number", 'bugspatrol'),
						"description" => wp_kses_data( __("How many categories showed", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'bugspatrol'),
						"description" => wp_kses_data( __("How many columns per row use for categories output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'bugspatrol') => 'date',
							esc_html__('Title', 'bugspatrol') => 'title'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'bugspatrol'),
						"description" => wp_kses_data( __("Sorting order for products output", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip(bugspatrol_get_sc_param('ordering')),
						"type" => "dropdown"
					),
					array(
						"param_name" => "parent",
						"heading" => esc_html__("Parent", 'bugspatrol'),
						"description" => wp_kses_data( __("Parent category slug", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "date",
						"type" => "textfield"
					),
					array(
						"param_name" => "ids",
						"heading" => esc_html__("IDs", 'bugspatrol'),
						"description" => wp_kses_data( __("Comma separated ID of products", 'bugspatrol') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "hide_empty",
						"heading" => esc_html__("Hide empty", 'bugspatrol'),
						"description" => wp_kses_data( __("Hide empty categories", 'bugspatrol') ),
						"class" => "",
						"value" => array("Hide empty" => "1" ),
						"type" => "checkbox"
					)
				)
			) );
			
			class WPBakeryShortCode_Products_Categories extends Bugspatrol_VC_ShortCodeSingle {}
		
		}
	}
}
?>