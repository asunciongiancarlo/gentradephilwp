<?php
/**
 * Theme sprecific functions and definitions
 */

/* Theme setup section
------------------------------------------------------------------- */

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) $content_width = 1170; /* pixels */


if ( !function_exists( 'bugspatrol_theme_setup' ) ) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_theme_setup', 1 );
	function bugspatrol_theme_setup() {

        // Add default posts and comments RSS feed links to head
        add_theme_support( 'automatic-feed-links' );

        // Enable support for Post Thumbnails
        add_theme_support( 'post-thumbnails' );

        // Custom header setup
        add_theme_support( 'custom-header', array('header-text'=>false));

        // Custom backgrounds setup
        add_theme_support( 'custom-background');

        // Supported posts formats
        add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat') );

        // Autogenerate title tag
        add_theme_support('title-tag');

        // Add user menu
        add_theme_support('nav-menus');

        // WooCommerce Support
        add_theme_support( 'woocommerce' );

        // Add wide and full blocks support
        add_theme_support( 'align-wide' );

		// Register theme menus
		add_filter( 'bugspatrol_filter_add_theme_menus',		'bugspatrol_add_theme_menus' );

		// Register theme sidebars
		add_filter( 'bugspatrol_filter_add_theme_sidebars',	'bugspatrol_add_theme_sidebars' );

		// Set options for importer
		add_filter( 'bugspatrol_filter_importer_options',		'bugspatrol_set_importer_options' );

		// Add theme required plugins
		add_filter( 'bugspatrol_filter_required_plugins',		'bugspatrol_add_required_plugins' );
		
		// Add preloader styles
		add_filter('bugspatrol_filter_add_styles_inline',		'bugspatrol_head_add_page_preloader_styles');

		// Init theme after WP is created
		add_action( 'wp',									'bugspatrol_core_init_theme' );

		// Add theme specified classes into the body
		add_filter( 'body_class', 							'bugspatrol_body_classes' );

		// Add data to the head and to the beginning of the body
		add_action('wp_head',								'bugspatrol_head_add_page_meta', 1);
		add_action('before',								'bugspatrol_body_add_gtm');
		add_action('before',								'bugspatrol_body_add_toc');
		add_action('before',								'bugspatrol_body_add_page_preloader');

		// Add data to the footer (priority 1, because priority 2 used for localize scripts)
		add_action('wp_footer',								'bugspatrol_footer_add_views_counter', 1);
		add_action('wp_footer',								'bugspatrol_footer_add_theme_customizer', 1);
		add_action('wp_footer',								'bugspatrol_footer_add_scroll_to_top', 1);
		add_action('wp_footer',								'bugspatrol_footer_add_custom_html', 1);
		add_action('wp_footer',								'bugspatrol_footer_add_gtm2', 1);

		// Set list of the theme required plugins
		bugspatrol_storage_set('required_plugins', array(
			'booked',
			'essgrids',
			'revslider',
            'mailchimp',
			'trx_utils',
			'visual_composer',
			'woocommerce',
            'wp_gdpr_compliance',
            'elegro-payment',
            'trx_updater',
            'contact_form_7'
			)
		);

        // Set list of the theme required custom fonts from folder /css/font-faces
        // Attention! Font's folder must have name equal to the font's name
        bugspatrol_storage_set('required_custom_fonts', array(
            	'Amadeus'
            )
        );

		
	}
}


// Add/Remove theme nav menus
if ( !function_exists( 'bugspatrol_add_theme_menus' ) ) {
	function bugspatrol_add_theme_menus($menus) {
		return $menus;
	}
}


// Add theme specific widgetized areas
if ( !function_exists( 'bugspatrol_add_theme_sidebars' ) ) {
	function bugspatrol_add_theme_sidebars($sidebars=array()) {
		if (is_array($sidebars)) {
			$theme_sidebars = array(
				'sidebar_main'		=> esc_html__( 'Main Sidebar', 'bugspatrol' ),
				'sidebar_footer'	=> esc_html__( 'Footer Sidebar', 'bugspatrol' )
			);
			if (function_exists('bugspatrol_exists_woocommerce') && bugspatrol_exists_woocommerce()) {
				$theme_sidebars['sidebar_cart']  = esc_html__( 'WooCommerce Cart Sidebar', 'bugspatrol' );
			}
			$sidebars = array_merge($theme_sidebars, $sidebars);
		}
		return $sidebars;
	}
}


// Add theme required plugins
if ( !function_exists( 'bugspatrol_add_required_plugins' ) ) {
	function bugspatrol_add_required_plugins($plugins) {
		$plugins[] = array(
			'name' 		=> esc_html__( 'BugsPatrol Utilities', 'bugspatrol' ),
			'version'	=> '3.2',					// Minimal required version
			'slug' 		=> 'trx_utils',
			'source'	=> bugspatrol_get_file_dir('plugins/install/trx_utils.zip'),
			'required' 	=> true
		);
		return $plugins;
	}
}


//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( ! function_exists( 'bugspatrol_importer_set_options' ) ) {
    add_filter( 'trx_utils_filter_importer_options', 'bugspatrol_importer_set_options', 9 );
    function bugspatrol_importer_set_options( $options=array() ) {
        if ( is_array( $options ) ) {
            // Save or not installer's messages to the log-file
            $options['debug'] = false;
            // Prepare demo data
            if ( is_dir( BUGSPATROL_THEME_PATH . 'demo/' ) ) {
                $options['demo_url'] = BUGSPATROL_THEME_PATH . 'demo/';
            } else {
                $options['demo_url'] = esc_url( bugspatrol_get_protocol().'://demofiles.ancorathemes.com/bugspatrol/' ); // Demo-site domain
            }

            // Required plugins
            $options['required_plugins'] =  array(
                'booked',
                'essential-grid',
                'revslider',
                'mailchimp',
                'trx_utils',
                'js_composer',
                'woocommerce',
                'contact-form-7'
            );

            $options['theme_slug'] = 'bugspatrol';

            // Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
            // Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
            $options['regenerate_thumbnails'] = 3;
            // Default demo
            $options['files']['default']['title'] = esc_html__( 'Education Demo', 'bugspatrol' );
            $options['files']['default']['domain_dev'] = esc_url(bugspatrol_get_protocol().'://bugspatrol.dv.ancorathemes.com'); // Developers domain
            $options['files']['default']['domain_demo']= esc_url(bugspatrol_get_protocol().'://bugspatrol.ancorathemes.com'); // Demo-site domain

        }
        return $options;
    }
}


// Add data to the head and to the beginning of the body
//------------------------------------------------------------------------

// Add theme specified classes to the body tag
if ( !function_exists('bugspatrol_body_classes') ) {
	function bugspatrol_body_classes( $classes ) {

		$classes[] = 'bugspatrol_body';
		$classes[] = 'body_style_' . trim(bugspatrol_get_custom_option('body_style'));
		$classes[] = 'body_' . (bugspatrol_get_custom_option('body_filled')=='yes' ? 'filled' : 'transparent');
		$classes[] = 'article_style_' . trim(bugspatrol_get_custom_option('article_style'));
		
		$blog_style = bugspatrol_get_custom_option(is_singular() && !bugspatrol_storage_get('blog_streampage') ? 'single_style' : 'blog_style');
		$classes[] = 'layout_' . trim($blog_style);
		$classes[] = 'template_' . trim(bugspatrol_get_template_name($blog_style));
		
		$body_scheme = bugspatrol_get_custom_option('body_scheme');
		if (empty($body_scheme)  || bugspatrol_is_inherit_option($body_scheme)) $body_scheme = 'original';
		$classes[] = 'scheme_' . $body_scheme;

		$top_panel_position = bugspatrol_get_custom_option('top_panel_position');
		if (!bugspatrol_param_is_off($top_panel_position)) {
			$classes[] = 'top_panel_show';
			$classes[] = 'top_panel_' . trim($top_panel_position);
		} else 
			$classes[] = 'top_panel_hide';
		$classes[] = bugspatrol_get_sidebar_class();

		if (bugspatrol_get_custom_option('show_video_bg')=='yes' && (bugspatrol_get_custom_option('video_bg_youtube_code')!='' || bugspatrol_get_custom_option('video_bg_url')!=''))
			$classes[] = 'video_bg_show';

		if (!bugspatrol_param_is_off(bugspatrol_get_theme_option('page_preloader')))
			$classes[] = 'preloader';

		return $classes;
	}
}


// Add page meta to the head
if (!function_exists('bugspatrol_head_add_page_meta')) {
	function bugspatrol_head_add_page_meta() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1<?php if (bugspatrol_get_theme_option('responsive_layouts')=='yes') echo ', maximum-scale=1'; ?>">
		<meta name="format-detection" content="telephone=no">
	
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php
	}
}

// Add page preloader styles to the head
if (!function_exists('bugspatrol_head_add_page_preloader_styles')) {
	function bugspatrol_head_add_page_preloader_styles($css) {
		if (($preloader=bugspatrol_get_theme_option('page_preloader'))!='none') {
			$image = bugspatrol_get_theme_option('page_preloader_image');
			$bg_clr = bugspatrol_get_scheme_color('bg_color');
			$link_clr = bugspatrol_get_scheme_color('text_link');
			$css .= '
				#page_preloader {
					background-color: '. esc_attr($bg_clr) . ';'
					. ($preloader=='custom' && $image
						? 'background-image:url('.esc_url($image).');'
						: ''
						)
				    . '
				}
				.preloader_wrap > div {
					background-color: '.esc_attr($link_clr).';
				}';
		}
		return $css;
	}
}

// Add gtm code to the beginning of the body 
if (!function_exists('bugspatrol_body_add_gtm')) {
	function bugspatrol_body_add_gtm() {
		echo wp_kses_data(trim(bugspatrol_get_custom_option('gtm_code')));
	}
}

// Add TOC anchors to the beginning of the body 
if (!function_exists('bugspatrol_body_add_toc')) {
	function bugspatrol_body_add_toc() {
		// Add TOC items 'Home' and "To top"
		if (bugspatrol_get_custom_option('menu_toc_home')=='yes' && function_exists('bugspatrol_sc_anchor'))
			bugspatrol_show_layout(bugspatrol_sc_anchor(array(
				'id' => "toc_home",
				'title' => esc_html__('Home', 'bugspatrol'),
				'description' => esc_html__('{{Return to Home}} - ||navigate to home page of the site', 'bugspatrol'),
				'icon' => "icon-home",
				'separator' => "yes",
				'url' => esc_url(home_url('/'))
				)
			)); 
		if (bugspatrol_get_custom_option('menu_toc_top')=='yes' && function_exists('bugspatrol_sc_anchor'))
			bugspatrol_show_layout(bugspatrol_sc_anchor(array(
				'id' => "toc_top",
				'title' => esc_html__('To Top', 'bugspatrol'),
				'description' => esc_html__('{{Back to top}} - ||scroll to top of the page', 'bugspatrol'),
				'icon' => "icon-double-up",
				'separator' => "yes")
				)); 
	}
}

// Add page preloader to the beginning of the body
if (!function_exists('bugspatrol_body_add_page_preloader')) {
	function bugspatrol_body_add_page_preloader() {
		if ( ($preloader=bugspatrol_get_theme_option('page_preloader')) != 'none' && ( $preloader != 'custom' || ($image=bugspatrol_get_theme_option('page_preloader_image')) != '')) {
			?><div id="page_preloader"><?php
				if ($preloader == 'circle') {
					?><div class="preloader_wrap preloader_<?php echo esc_attr($preloader); ?>"><div class="preloader_circ1"></div><div class="preloader_circ2"></div><div class="preloader_circ3"></div><div class="preloader_circ4"></div></div><?php
				} else if ($preloader == 'square') {
					?><div class="preloader_wrap preloader_<?php echo esc_attr($preloader); ?>"><div class="preloader_square1"></div><div class="preloader_square2"></div></div><?php
				}
			?></div><?php
		}
	}
}


// Add data to the footer
//------------------------------------------------------------------------

// Add post/page views counter
if (!function_exists('bugspatrol_footer_add_views_counter')) {
	function bugspatrol_footer_add_views_counter() {
		// Post/Page views counter
		get_template_part(bugspatrol_get_file_slug('templates/_parts/views-counter.php'));
	}
}

// Add theme customizer
if (!function_exists('bugspatrol_footer_add_theme_customizer')) {
	function bugspatrol_footer_add_theme_customizer() {
		// Front customizer
		if (bugspatrol_get_custom_option('show_theme_customizer')=='yes') {
            require_once BUGSPATROL_FW_PATH . 'core/core.customizer/front.customizer.php';
		}
	}
}

// Add scroll to top button
if (!function_exists('bugspatrol_footer_add_scroll_to_top')) {
	function bugspatrol_footer_add_scroll_to_top() {
		?><a href="#" class="scroll_to_top icon-up" title="<?php esc_attr_e('Scroll to top', 'bugspatrol'); ?>"></a><?php
	}
}

// Add custom html
if (!function_exists('bugspatrol_footer_add_custom_html')) {
	function bugspatrol_footer_add_custom_html() {
		?><div class="custom_html_section"><?php
			echo wp_kses_data(trim(bugspatrol_get_custom_option('custom_code')));
		?></div><?php
	}
}

// Add gtm code
if (!function_exists('bugspatrol_footer_add_gtm2')) {
	function bugspatrol_footer_add_gtm2() {
		echo wp_kses_data(trim(bugspatrol_get_custom_option('gtm_code2')));
	}
}


function bugspatrol_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter( 'comment_form_fields', 'bugspatrol_move_comment_field_to_bottom' );

// Add theme required plugins
if ( !function_exists( 'bugspatrol_add_trx_utils' ) ) {
    add_filter( 'trx_utils_active', 'bugspatrol_add_trx_utils' );
    function bugspatrol_add_trx_utils($enable=true) {
        return true;
    }
}

// Include framework core files
//-------------------------------------------------------------------
require_once trailingslashit( get_template_directory() ) . 'fw/loader.php';
?>