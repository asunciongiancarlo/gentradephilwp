<?php

/* Theme setup section
-------------------------------------------------------------------- */

// ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
// Framework settings

bugspatrol_storage_set('settings', array(
	
	'less_compiler'		=> 'lessc',								// no|lessc|less|external - Compiler for the .less
																// lessc	- fast & low memory required, but .less-map, shadows & gradients not supprted
																// less		- slow, but support all features
																// external	- used if you have external .less compiler (like WinLess or Koala)
																// no		- don't use .less, all styles stored in the theme.styles.php
	'less_nested'		=> false,								// Use nested selectors when compiling less - increase .css size, but allow using nested color schemes
	'less_prefix'		=> '',									// any string - Use prefix before each selector when compile less. For example: 'html '
	'less_split'		=> false,								// If true - load each file into memory, split it (see below) and compile separate.
																// Else - compile each file without loading to memory
	'less_separator'	=> '/*---LESS_SEPARATOR---*/',			// string - separator inside .less file to split it when compiling to reduce memory usage
																// (compilation speed gets a bit slow)
	'less_map'			=> 'no',								// no|internal|external - Generate map for .less files. 
																// Warning! You need more then 128Mb for PHP scripts on your server! Supported only if less_compiler=less (see above)
	
	'customizer_demo'	=> true,								// Show color customizer demo (if many color settings) or not (if only accent colors used)

	'allow_fullscreen'	=> false,								// Allow fullscreen and fullwide body styles

	'socials_type'		=> 'icons',								// images|icons - Use this kind of pictograms for all socials: share, social profiles, team members socials, etc.
	'slides_type'		=> 'bg',								// images|bg - Use image as slide's content or as slide's background

	'add_image_size'	=> false,								// Add theme's thumb sizes into WP list sizes. 
																// If false - new image thumb will be generated on demand,
																// otherwise - all thumb sizes will be generated when image is loaded

	'use_list_cache'	=> true,								// Use cache for any lists (increase theme speed, but get 15-20K memory)
	'use_post_cache'	=> true,								// Use cache for post_data (increase theme speed, decrease queries number, but get more memory - up to 300K)

	'admin_dummy_style' => 2									// 1 | 2 - Progress bar style when import dummy data
	)
);



// Default Theme Options
if ( !function_exists( 'bugspatrol_options_settings_theme_setup' ) ) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_options_settings_theme_setup', 2 );	// Priority 1 for add bugspatrol_filter handlers
	function bugspatrol_options_settings_theme_setup() {
		
		// Clear all saved Theme Options on first theme run
		add_action('after_switch_theme', 'bugspatrol_options_reset');

		// Settings 
		$socials_type = bugspatrol_get_theme_setting('socials_type');
				
		// Prepare arrays 
		bugspatrol_storage_set('options_params', apply_filters('bugspatrol_filter_theme_options_params', array(
			'list_fonts'				=> array('$bugspatrol_get_list_fonts' => ''),
			'list_fonts_styles'			=> array('$bugspatrol_get_list_fonts_styles' => ''),
			'list_socials' 				=> array('$bugspatrol_get_list_socials' => ''),
			'list_icons' 				=> array('$bugspatrol_get_list_icons(true)' => ''),
			'list_posts_types' 			=> array('$bugspatrol_get_list_posts_types' => ''),
			'list_categories' 			=> array('$bugspatrol_get_list_categories' => ''),
			'list_menus'				=> array('$bugspatrol_get_list_menus(true)' => ''),
			'list_sidebars'				=> array('$bugspatrol_get_list_sidebars' => ''),
			'list_positions' 			=> array('$bugspatrol_get_list_sidebars_positions' => ''),
			'list_color_schemes'		=> array('$bugspatrol_get_list_color_schemes' => ''),
			'list_bg_tints'				=> array('$bugspatrol_get_list_bg_tints' => ''),
			'list_body_styles'			=> array('$bugspatrol_get_list_body_styles' => ''),
			'list_header_styles'		=> array('$bugspatrol_get_list_templates_header' => ''),
			'list_blog_styles'			=> array('$bugspatrol_get_list_templates_blog' => ''),
			'list_single_styles'		=> array('$bugspatrol_get_list_templates_single' => ''),
			'list_article_styles'		=> array('$bugspatrol_get_list_article_styles' => ''),
			'list_blog_counters' 		=> array('$bugspatrol_get_list_blog_counters' => ''),
			'list_menu_hovers' 			=> array('$bugspatrol_get_list_menu_hovers' => ''),
			'list_button_hovers'		=> array('$bugspatrol_get_list_button_hovers' => ''),
			'list_input_hovers'			=> array('$bugspatrol_get_list_input_hovers' => ''),
			'list_search_styles'		=> array('$bugspatrol_get_list_search_styles' => ''),
			'list_animations_in' 		=> array('$bugspatrol_get_list_animations_in' => ''),
			'list_animations_out'		=> array('$bugspatrol_get_list_animations_out' => ''),
			'list_filters'				=> array('$bugspatrol_get_list_portfolio_filters' => ''),
			'list_hovers'				=> array('$bugspatrol_get_list_hovers' => ''),
			'list_hovers_dir'			=> array('$bugspatrol_get_list_hovers_directions' => ''),
			'list_alter_sizes'			=> array('$bugspatrol_get_list_alter_sizes' => ''),
			'list_sliders' 				=> array('$bugspatrol_get_list_sliders' => ''),
			'list_bg_image_positions'	=> array('$bugspatrol_get_list_bg_image_positions' => ''),
			'list_popups' 				=> array('$bugspatrol_get_list_popup_engines' => ''),
			'list_gmap_styles'		 	=> array('$bugspatrol_get_list_googlemap_styles' => ''),
			'list_yes_no' 				=> array('$bugspatrol_get_list_yesno' => ''),
			'list_on_off' 				=> array('$bugspatrol_get_list_onoff' => ''),
			'list_show_hide' 			=> array('$bugspatrol_get_list_showhide' => ''),
			'list_sorting' 				=> array('$bugspatrol_get_list_sortings' => ''),
			'list_ordering' 			=> array('$bugspatrol_get_list_orderings' => ''),
			'list_locations' 			=> array('$bugspatrol_get_list_dedicated_locations' => '')
			)
		));


		// Theme options array
		bugspatrol_storage_set('options', array(

		
		//###############################
		//#### Customization         #### 
		//###############################
		'partition_customization' => array(
					"title" => esc_html__('Customization', 'bugspatrol'),
					"start" => "partitions",
					"override" => "category,services_group,post,page,custom",
					"icon" => "iconadmin-cog-alt",
					"type" => "partition"
					),
		
		
		// Customization -> Body Style
		//-------------------------------------------------
		
		'customization_body' => array(
					"title" => esc_html__('Body style', 'bugspatrol'),
					"override" => "category,services_group,post,page,custom",
					"icon" => 'iconadmin-picture',
					"start" => "customization_tabs",
					"type" => "tab"
					),
		
		'info_body_1' => array(
					"title" => esc_html__('Body parameters', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select body style and color scheme for entire site. You can override this parameters on any page, post or category', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"
					),

		'body_style' => array(
					"title" => esc_html__('Body style', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select body style:', 'bugspatrol') )
								. ' <br>' 
								. wp_kses_data( __('<b>boxed</b> - if you want use background color and/or image', 'bugspatrol') )
								. ',<br>'
								. wp_kses_data( __('<b>wide</b> - page fill whole window with centered content', 'bugspatrol') )
								. (bugspatrol_get_theme_setting('allow_fullscreen') 
									? ',<br>' . wp_kses_data( __('<b>fullwide</b> - page content stretched on the full width of the window (with few left and right paddings)', 'bugspatrol') )
									: '')
								. (bugspatrol_get_theme_setting('allow_fullscreen') 
									? ',<br>' . wp_kses_data( __('<b>fullscreen</b> - page content fill whole window without any paddings', 'bugspatrol') )
									: ''),
					"info" => true,
					"override" => "category,services_group,post,page,custom",
					"std" => "wide",
					"options" => bugspatrol_get_options_param('list_body_styles'),
					"dir" => "horizontal",
					"type" => "radio"
					),
		
		'body_paddings' => array(
					"title" => esc_html__('Page paddings', 'bugspatrol'),
					"desc" => wp_kses_data( __('Add paddings above and below the page content', 'bugspatrol') ),
					"override" => "post,page,custom",
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"
					),

		"body_scheme" => array(
					"title" => esc_html__('Color scheme', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select predefined color scheme for the entire page', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "original",
					"dir" => "horizontal",
					"options" => bugspatrol_get_options_param('list_color_schemes'),
					"type" => "checklist"),
		
		'body_filled' => array(
					"title" => esc_html__('Fill body', 'bugspatrol'),
					"desc" => wp_kses_data( __('Fill the page background with the solid color or leave it transparend to show background image (or video background)', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"
					),

		'info_body_2' => array(
					"title" => esc_html__('Background color and image', 'bugspatrol'),
					"desc" => wp_kses_data( __('Color and image for the site background', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"
					),

		'bg_custom' => array(
					"title" => esc_html__('Use custom background',  'bugspatrol'),
					"desc" => wp_kses_data( __("Use custom color and/or image as the site background", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"
					),
		
		'bg_color' => array(
					"title" => esc_html__('Background color',  'bugspatrol'),
					"desc" => wp_kses_data( __('Body background color',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'bg_custom' => array('yes')
					),
					"std" => "#ffffff",
					"type" => "color"
					),

		'bg_pattern' => array(
					"title" => esc_html__('Background predefined pattern',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select theme background pattern (first case - without pattern)',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'bg_custom' => array('yes')
					),
					"std" => "",
					"options" => array(
						0 => bugspatrol_get_file_url('images/spacer.png'),
						1 => bugspatrol_get_file_url('images/bg/pattern_1.jpg'),
						2 => bugspatrol_get_file_url('images/bg/pattern_2.jpg'),
						3 => bugspatrol_get_file_url('images/bg/pattern_3.jpg'),
						4 => bugspatrol_get_file_url('images/bg/pattern_4.jpg'),
						5 => bugspatrol_get_file_url('images/bg/pattern_5.jpg')
					),
					"style" => "list",
					"type" => "images"
					),
		
		'bg_pattern_custom' => array(
					"title" => esc_html__('Background custom pattern',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select or upload background custom pattern. If selected - use it instead the theme predefined pattern (selected in the field above)',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'bg_custom' => array('yes')
					),
					"std" => "",
					"type" => "media"
					),
		
		'bg_image' => array(
					"title" => esc_html__('Background predefined image',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select theme background image (first case - without image)',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "",
					"dependency" => array(
						'bg_custom' => array('yes')
					),
					"options" => array(
						0 => bugspatrol_get_file_url('images/spacer.png'),
						1 => bugspatrol_get_file_url('images/bg/image_1_thumb.jpg'),
						2 => bugspatrol_get_file_url('images/bg/image_2_thumb.jpg'),
						3 => bugspatrol_get_file_url('images/bg/image_3_thumb.jpg')
					),
					"style" => "list",
					"type" => "images"
					),
		
		'bg_image_custom' => array(
					"title" => esc_html__('Background custom image',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select or upload background custom image. If selected - use it instead the theme predefined image (selected in the field above)',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'bg_custom' => array('yes')
					),
					"std" => "",
					"type" => "media"
					),
		
		'bg_image_custom_position' => array( 
					"title" => esc_html__('Background custom image position',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select custom image position',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "left_top",
					"dependency" => array(
						'bg_custom' => array('yes')
					),
					"options" => array(
						'left_top' => "Left Top",
						'center_top' => "Center Top",
						'right_top' => "Right Top",
						'left_center' => "Left Center",
						'center_center' => "Center Center",
						'right_center' => "Right Center",
						'left_bottom' => "Left Bottom",
						'center_bottom' => "Center Bottom",
						'right_bottom' => "Right Bottom",
					),
					"type" => "select"
					),
		
		'bg_image_load' => array(
					"title" => esc_html__('Load background image', 'bugspatrol'),
					"desc" => wp_kses_data( __('Always load background images or only for boxed body style', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "boxed",
					"size" => "medium",
					"dependency" => array(
						'bg_custom' => array('yes')
					),
					"options" => array(
						'boxed' => esc_html__('Boxed', 'bugspatrol'),
						'always' => esc_html__('Always', 'bugspatrol')
					),
					"type" => "switch"
					),

		
		'info_body_3' => array(
					"title" => esc_html__('Video background', 'bugspatrol'),
					"desc" => wp_kses_data( __('Parameters of the video, used as site background', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"
					),

		'show_video_bg' => array(
					"title" => esc_html__('Show video background',  'bugspatrol'),
					"desc" => wp_kses_data( __("Show video as the site background", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"
					),

		'video_bg_youtube_code' => array(
					"title" => esc_html__('Youtube code for video bg',  'bugspatrol'),
					"desc" => wp_kses_data( __("Youtube code of video", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_video_bg' => array('yes')
					),
					"std" => "",
					"type" => "text"
					),

		'video_bg_url' => array(
					"title" => esc_html__('Local video for video bg',  'bugspatrol'),
					"desc" => wp_kses_data( __("URL to video-file (uploaded on your site)", 'bugspatrol') ),
					"readonly" =>false,
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_video_bg' => array('yes')
					),
					"before" => array(	'title' => esc_html__('Choose video', 'bugspatrol'),
										'action' => 'media_upload',
										'multiple' => false,
										'linked_field' => '',
										'type' => 'video',
										'captions' => array('choose' => esc_html__( 'Choose Video', 'bugspatrol'),
															'update' => esc_html__( 'Select Video', 'bugspatrol')
														)
								),
					"std" => "",
					"type" => "media"
					),

		'video_bg_overlay' => array(
					"title" => esc_html__('Use overlay for video bg', 'bugspatrol'),
					"desc" => wp_kses_data( __('Use overlay texture for the video background', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_video_bg' => array('yes')
					),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"
					),
		
		
		
		
		
		// Customization -> Header
		//-------------------------------------------------
		
		'customization_header' => array(
					"title" => esc_html__("Header", 'bugspatrol'),
					"override" => "category,services_group,post,page,custom",
					"icon" => 'iconadmin-window',
					"type" => "tab"),
		
		"info_header_1" => array(
					"title" => esc_html__('Top panel', 'bugspatrol'),
					"desc" => wp_kses_data( __('Top panel settings. It include user menu area (with contact info, cart button, language selector, login/logout menu and user menu) and main menu area (with logo and main menu).', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
		
		"top_panel_style" => array(
					"title" => esc_html__('Top panel style', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select desired style of the page header', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "header_3",
					"options" => bugspatrol_get_options_param('list_header_styles'),
					"style" => "list",
					"type" => "images"),


            "show_header_button" => array(
                "title" => esc_html__('Show button in header', 'bugspatrol'),
                "desc" => wp_kses_data( __('Show button in header', 'bugspatrol') ),
                "override" => "category,services_group,post,page,custom",
                "dependency" => array(
                    'top_panel_style' => array('header_1')
                ),
                "std" => "no",
                "options" => bugspatrol_get_options_param('list_yes_no'),
                "type" => "switch"),

            'header_button_text' => array(
                "title" => esc_html__('Header button text', 'bugspatrol'),
                "desc" => wp_kses_data( __('Header button text', 'bugspatrol') ),
                "override" => "category,services_group,post,page,custom",
                "dependency" => array(
                    'show_header_button' => 'yes',
                    'top_panel_style' => array('header_1')
                ),
                "std" => '',
                "type" => "text"
            ),
            'header_button_link' => array(
                "title" => esc_html__('Header button link', 'bugspatrol'),
                "desc" => wp_kses_data( __('Header button link', 'bugspatrol') ),
                "override" => "category,services_group,post,page,custom",
                "dependency" => array(
                    'show_header_button' => 'yes',
                    'top_panel_style' => array('header_1')
                ),
                "std" => '',
                "type" => "text"
            ),


		"top_panel_image" => array(
					"title" => esc_html__('Top panel image', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select default background image of the page header (if not single post or featured image for current post is not specified)', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'top_panel_style' => array('header_7')
					),
					"std" => "",
					"type" => "media"),
		
		"top_panel_position" => array( 
					"title" => esc_html__('Top panel position', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select position for the top panel with logo and main menu', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "above",
					"options" => array(
						'hide'  => esc_html__('Hide', 'bugspatrol'),
						'above' => esc_html__('Above slider', 'bugspatrol'),
						'below' => esc_html__('Below slider', 'bugspatrol'),
						'over'  => esc_html__('Over slider', 'bugspatrol')
					),
					"type" => "checklist"),

		"top_panel_scheme" => array(
					"title" => esc_html__('Top panel color scheme', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select predefined color scheme for the top panel', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "original",
					"dir" => "horizontal",
					"options" => bugspatrol_get_options_param('list_color_schemes'),
					"type" => "checklist"),

		"pushy_panel_scheme" => array(
					"title" => esc_html__('Push panel color scheme', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select predefined color scheme for the push panel (with logo, menu and socials)', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'top_panel_style' => array('header_8')
					),
					"std" => "dark",
					"dir" => "horizontal",
					"options" => bugspatrol_get_options_param('list_color_schemes'),
					"type" => "checklist"),

		"show_page_title" => array(
					"title" => esc_html__('Show Page title', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show post/page/category title', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),

            "contact_phone_text" => array(
                "title" => esc_html__('Text before phone', 'bugspatrol'),
                "desc" => wp_kses_data( __('Text before phone', 'bugspatrol') ),
                "override" => "category,services_group,post,page,custom",
                "std" => "",
                "allow_html" => true,
                "type" => "text"),

		"show_breadcrumbs" => array(
					"title" => esc_html__('Show Breadcrumbs', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show path to current category (post, page)', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"breadcrumbs_max_level" => array(
					"title" => esc_html__('Breadcrumbs max nesting', 'bugspatrol'),
					"desc" => wp_kses_data( __("Max number of the nested categories in the breadcrumbs (0 - unlimited)", 'bugspatrol') ),
					"dependency" => array(
						'show_breadcrumbs' => array('yes')
					),
					"std" => "0",
					"min" => 0,
					"max" => 100,
					"step" => 1,
					"type" => "spinner"),


        
            "show_title_bg" => array(
                "title" => esc_html__('Use custom background for title and breadcrumbs', 'bugspatrol'),
                "desc" => wp_kses_data( __('Use custom background for title and breadcrumbs', 'bugspatrol') ),
                "override" => "category,services_group,post,page,custom",
                "std" => "no",
                "options" => bugspatrol_get_options_param('list_yes_no'),
                "type" => "switch"),

            "title_bg" => array(
                "title" => esc_html__('Custom background for title and breadcrumbs', 'bugspatrol'),
                "desc" => wp_kses_data( __('Select custom background for title and breadcrumbs', 'bugspatrol') ),
                "override" => "category,services_group,post,page,custom",
                "dependency" => array(
                    'show_title_bg' => 'yes'
                ),
                "std" => "",
                "type" => "media"),
		
		
		
		"info_header_2" => array( 
					"title" => esc_html__('Main menu style and position', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select the Main menu style and position', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
		
		"menu_main" => array( 
					"title" => esc_html__('Select main menu',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select main menu for the current page',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "default",
					"options" => bugspatrol_get_options_param('list_menus'),
					"type" => "select"),
		
		"menu_attachment" => array( 
					"title" => esc_html__('Main menu attachment', 'bugspatrol'),
					"desc" => wp_kses_data( __('Attach main menu to top of window then page scroll down', 'bugspatrol') ),
					"std" => "fixed",
					"options" => array(
						"fixed"=>esc_html__("Fix menu position", 'bugspatrol'), 
						"none"=>esc_html__("Don't fix menu position", 'bugspatrol')
					),
					"dir" => "vertical",
					"type" => "radio"),

		"menu_hover" => array( 
					"title" => esc_html__('Main menu hover effect', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select hover effect for the main menu items', 'bugspatrol') ),
					"std" => "fade",
					"type" => "select",
					"options" => bugspatrol_get_options_param('list_menu_hovers')),

		"menu_animation_in" => array( 
					"title" => esc_html__('Submenu show animation', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select animation to show submenu ', 'bugspatrol') ),
					"std" => "fadeInUp",
					"type" => "select",
					"options" => bugspatrol_get_options_param('list_animations_in')),

		"menu_animation_out" => array( 
					"title" => esc_html__('Submenu hide animation', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select animation to hide submenu ', 'bugspatrol') ),
					"std" => "fadeOutDown",
					"type" => "select",
					"options" => bugspatrol_get_options_param('list_animations_out')),
		
		"menu_mobile" => array( 
					"title" => esc_html__('Main menu responsive', 'bugspatrol'),
					"desc" => wp_kses_data( __('Allow responsive version for the main menu if window width less then this value', 'bugspatrol') ),
					"std" => 1024,
					"min" => 320,
					"max" => 1024,
					"type" => "spinner"),
		
		"menu_width" => array( 
					"title" => esc_html__('Submenu width', 'bugspatrol'),
					"desc" => wp_kses_data( __('Width for dropdown menus in main menu', 'bugspatrol') ),
					"step" => 5,
					"std" => "",
					"min" => 180,
					"max" => 300,
					"mask" => "?999",
					"type" => "spinner"),
		
		
		
		"info_header_3" => array(
					"title" => esc_html__("Top area components", 'bugspatrol'),
					"desc" => wp_kses_data( __("Select parts for the user's menu area", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
		
		"show_top_panel_top" => array(
					"title" => esc_html__('Show top area', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show user menu area on top of page', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"menu_user" => array(
					"title" => esc_html__('Select user menu',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select user menu for the current page',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_top_panel_top' => array('yes')
					),
					"std" => "default",
					"options" => bugspatrol_get_options_param('list_menus'),
					"type" => "hidden"),
		
		"show_languages" => array(
					"title" => esc_html__('Show language selector', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show language selector in the user menu (if WPML plugin installed and current page/post has multilanguage version)', 'bugspatrol') ),
					"dependency" => array(
						'show_top_panel_top' => array('yes')
					),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"show_login" => array( 
					"title" => esc_html__('Show Login/Logout buttons', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show Login and Logout buttons in the user menu area', 'bugspatrol') ),
					"dependency" => array(
						'show_top_panel_top' => array('yes')
					),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "hidden"),
		
		"show_bookmarks" => array(
					"title" => esc_html__('Show bookmarks', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show bookmarks selector in the user menu', 'bugspatrol') ),
					"dependency" => array(
						'show_top_panel_top' => array('yes')
					),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "hidden"),
		
		"show_socials" => array( 
					"title" => esc_html__('Show Social icons', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show Social icons in the user menu area', 'bugspatrol') ),
					"dependency" => array(
						'show_top_panel_top' => array('yes')
					),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "hidden"),
		
		

		
		"info_header_4" => array( 
					"title" => esc_html__("Table of Contents (TOC)", 'bugspatrol'),
					"desc" => wp_kses_data( __("Table of Contents for the current page. Automatically created if the page contains objects with id starting with 'toc_'", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
		
		"menu_toc" => array( 
					"title" => esc_html__('TOC position', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show TOC for the current page', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "float",
					"options" => array(
						'hide'  => esc_html__('Hide', 'bugspatrol'),
						'fixed' => esc_html__('Fixed', 'bugspatrol'),
						'float' => esc_html__('Float', 'bugspatrol')
					),
					"type" => "checklist"),
		
		"menu_toc_home" => array(
					"title" => esc_html__('Add "Home" into TOC', 'bugspatrol'),
					"desc" => wp_kses_data( __('Automatically add "Home" item into table of contents - return to home page of the site', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'menu_toc' => array('fixed','float')
					),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"menu_toc_top" => array( 
					"title" => esc_html__('Add "To Top" into TOC', 'bugspatrol'),
					"desc" => wp_kses_data( __('Automatically add "To Top" item into table of contents - scroll to top of the page', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'menu_toc' => array('fixed','float')
					),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),

		
		
		
		'info_header_5' => array(
					"title" => esc_html__('Main logo', 'bugspatrol'),
					"desc" => wp_kses_data( __("Select or upload logos for the site's header and select it position", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"
					),

		'logo' => array(
					"title" => esc_html__('Logo image', 'bugspatrol'),
					"desc" => wp_kses_data( __('Main logo image', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "",
					"type" => "media"
					),

		'logo_retina' => array(
					"title" => esc_html__('Logo image for Retina', 'bugspatrol'),
					"desc" => wp_kses_data( __('Main logo image used on Retina display', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "",
					"type" => "media"
					),

		'logo_fixed' => array(
					"title" => esc_html__('Logo image (fixed header)', 'bugspatrol'),
					"desc" => wp_kses_data( __('Logo image for the header (if menu is fixed after the page is scrolled)', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"divider" => false,
					"std" => "",
					"type" => "media"
					),

		'logo_text' => array(
					"title" => esc_html__('Logo text', 'bugspatrol'),
					"desc" => wp_kses_data( __('Logo text - display it after logo image', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => '',
					"type" => "text"
					),

		'logo_height' => array(
					"title" => esc_html__('Logo height', 'bugspatrol'),
					"desc" => wp_kses_data( __('Height for the logo in the header area', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"step" => 1,
					"std" => '',
					"min" => 10,
					"max" => 300,
					"mask" => "?999",
					"type" => "spinner"
					),

		'logo_offset' => array(
					"title" => esc_html__('Logo top offset', 'bugspatrol'),
					"desc" => wp_kses_data( __('Top offset for the logo in the header area', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"step" => 1,
					"std" => '',
					"min" => 0,
					"max" => 99,
					"mask" => "?99",
					"type" => "spinner"
					),
		
		
		
		
		
		
		
		// Customization -> Slider
		//-------------------------------------------------
		
		"customization_slider" => array( 
					"title" => esc_html__('Slider', 'bugspatrol'),
					"icon" => "iconadmin-picture",
					"override" => "category,services_group,page,custom",
					"type" => "tab"),
		
		"info_slider_1" => array(
					"title" => esc_html__('Main slider parameters', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select parameters for main slider (you can override it in each category and page)', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"type" => "info"),
					
		"show_slider" => array(
					"title" => esc_html__('Show Slider', 'bugspatrol'),
					"desc" => wp_kses_data( __('Do you want to show slider on each page (post)', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
					
		"slider_display" => array(
					"title" => esc_html__('Slider display', 'bugspatrol'),
					"desc" => wp_kses_data( __('How display slider: boxed (fixed width and height), fullwide (fixed height) or fullscreen', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes')
					),
					"std" => "fullwide",
					"options" => array(
						"boxed"=>esc_html__("Boxed", 'bugspatrol'),
						"fullwide"=>esc_html__("Fullwide", 'bugspatrol'),
						"fullscreen"=>esc_html__("Fullscreen", 'bugspatrol')
					),
					"type" => "checklist"),
		
		"slider_height" => array(
					"title" => esc_html__("Height (in pixels)", 'bugspatrol'),
					"desc" => wp_kses_data( __("Slider height (in pixels) - only if slider display with fixed height.", 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes')
					),
					"std" => '',
					"min" => 100,
					"step" => 10,
					"type" => "spinner"),
		
		"slider_engine" => array(
					"title" => esc_html__('Slider engine', 'bugspatrol'),
					"desc" => wp_kses_data( __('What engine use to show slider?', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes')
					),
					"std" => "swiper",
					"options" => bugspatrol_get_options_param('list_sliders'),
					"type" => "radio"),

		"slider_over_content" => array(
					"title" => esc_html__('Put content over slider',  'bugspatrol'),
					"desc" => wp_kses_data( __('Put content below on fixed layer over this slider',  'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes')
					),
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"allow_html" => true,
					"allow_js" => true,
					"type" => "editor"),

		"slider_over_scheme" => array(
					"title" => esc_html__('Color scheme for content above', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select predefined color scheme for the content over the slider', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"std" => "dark",
					"dir" => "horizontal",
					"options" => bugspatrol_get_options_param('list_color_schemes'),
					"type" => "checklist"),
		
		"slider_category" => array(
					"title" => esc_html__('Posts Slider: Category to show', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select category to show in Flexslider (ignored for Revolution and Royal sliders)', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "",
					"options" => bugspatrol_array_merge(array(0 => esc_html__('- Select category -', 'bugspatrol')), bugspatrol_get_options_param('list_categories')),
					"type" => "select",
					"multiple" => true,
					"style" => "list"),
		
		"slider_posts" => array(
					"title" => esc_html__('Posts Slider: Number posts or comma separated posts list',  'bugspatrol'),
					"desc" => wp_kses_data( __("How many recent posts display in slider or comma separated list of posts ID (in this case selected category ignored)", 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "5",
					"type" => "text"),
		
		"slider_orderby" => array(
					"title" => esc_html__("Posts Slider: Posts order by",  'bugspatrol'),
					"desc" => wp_kses_data( __("Posts in slider ordered by date (default), comments, views, author rating, users rating, random or alphabetically", 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "date",
					"options" => bugspatrol_get_options_param('list_sorting'),
					"type" => "select"),
		
		"slider_order" => array(
					"title" => esc_html__("Posts Slider: Posts order", 'bugspatrol'),
					"desc" => wp_kses_data( __('Select the desired ordering method for posts', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "desc",
					"options" => bugspatrol_get_options_param('list_ordering'),
					"size" => "big",
					"type" => "switch"),
					
		"slider_interval" => array(
					"title" => esc_html__("Posts Slider: Slide change interval", 'bugspatrol'),
					"desc" => wp_kses_data( __("Interval (in ms) for slides change in slider", 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => 7000,
					"min" => 100,
					"step" => 100,
					"type" => "spinner"),
		
		"slider_pagination" => array(
					"title" => esc_html__("Posts Slider: Pagination", 'bugspatrol'),
					"desc" => wp_kses_data( __("Choose pagination style for the slider", 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "no",
					"options" => array(
						'no'   => esc_html__('None', 'bugspatrol'),
						'yes'  => esc_html__('Dots', 'bugspatrol'), 
						'over' => esc_html__('Titles', 'bugspatrol')
					),
					"type" => "checklist"),
		
		"slider_infobox" => array(
					"title" => esc_html__("Posts Slider: Show infobox", 'bugspatrol'),
					"desc" => wp_kses_data( __("Do you want to show post's title, reviews rating and description on slides in slider", 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "slide",
					"options" => array(
						'no'    => esc_html__('None',  'bugspatrol'),
						'slide' => esc_html__('Slide', 'bugspatrol'), 
						'fixed' => esc_html__('Fixed', 'bugspatrol')
					),
					"type" => "checklist"),
					
		"slider_info_category" => array(
					"title" => esc_html__("Posts Slider: Show post's category", 'bugspatrol'),
					"desc" => wp_kses_data( __("Do you want to show post's category on slides in slider", 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
					
		"slider_info_reviews" => array(
					"title" => esc_html__("Posts Slider: Show post's reviews rating", 'bugspatrol'),
					"desc" => wp_kses_data( __("Do you want to show post's reviews rating on slides in slider", 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
					
		"slider_info_descriptions" => array(
					"title" => esc_html__("Posts Slider: Show post's descriptions", 'bugspatrol'),
					"desc" => wp_kses_data( __("How many characters show in the post's description in slider. 0 - no descriptions", 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => 0,
					"min" => 0,
					"step" => 10,
					"type" => "spinner"),
		
		
		
		
		
		// Customization -> Sidebars
		//-------------------------------------------------
		
		"customization_sidebars" => array( 
					"title" => esc_html__('Sidebars', 'bugspatrol'),
					"icon" => "iconadmin-indent-right",
					"override" => "category,services_group,post,page,custom",
					"type" => "tab"),
		
		"info_sidebars_1" => array( 
					"title" => esc_html__('Custom sidebars', 'bugspatrol'),
					"desc" => wp_kses_data( __('In this section you can create unlimited sidebars. You can fill them with widgets in the menu Appearance - Widgets', 'bugspatrol') ),
					"type" => "info"),
		
		"custom_sidebars" => array(
					"title" => esc_html__('Custom sidebars',  'bugspatrol'),
					"desc" => wp_kses_data( __('Manage custom sidebars. You can use it with each category (page, post) independently',  'bugspatrol') ),
					"std" => "",
					"cloneable" => true,
					"type" => "text"),
		
		"info_sidebars_2" => array(
					"title" => esc_html__('Main sidebar', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show / Hide and select main sidebar', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
		
		'show_sidebar_main' => array( 
					"title" => esc_html__('Show main sidebar',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select position for the main sidebar or hide it',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "right",
					"options" => bugspatrol_get_options_param('list_positions'),
					"dir" => "horizontal",
					"type" => "checklist"),

		"sidebar_main_scheme" => array(
					"title" => esc_html__("Color scheme", 'bugspatrol'),
					"desc" => wp_kses_data( __('Select predefined color scheme for the main sidebar', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_sidebar_main' => array('left', 'right')
					),
					"std" => "original",
					"dir" => "horizontal",
					"options" => bugspatrol_get_options_param('list_color_schemes'),
					"type" => "checklist"),
		
		"sidebar_main" => array( 
					"title" => esc_html__('Select main sidebar',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select main sidebar content',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_sidebar_main' => array('left', 'right')
					),
					"std" => "sidebar_main",
					"options" => bugspatrol_get_options_param('list_sidebars'),
					"type" => "select"),
		
		"info_sidebars_3" => array(
					"title" => esc_html__('Outer sidebar', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show / Hide and select outer sidebar (sidemenu, logo, etc.', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "hidden"),
		
		'show_sidebar_outer' => array( 
					"title" => esc_html__('Show outer sidebar',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select position for the outer sidebar or hide it',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "hide",
					"options" => bugspatrol_get_options_param('list_positions'),
					"dir" => "horizontal",
					"type" => "hidden"),

		"sidebar_outer_scheme" => array(
					"title" => esc_html__("Color scheme", 'bugspatrol'),
					"desc" => wp_kses_data( __('Select predefined color scheme for the outer sidebar', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_sidebar_outer' => array('left', 'right')
					),
					"std" => "original",
					"dir" => "horizontal",
					"options" => bugspatrol_get_options_param('list_color_schemes'),
					"type" => "checklist"),
		
		"sidebar_outer_show_logo" => array( 
					"title" => esc_html__('Show Logo', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show Logo in the outer sidebar', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_sidebar_outer' => array('left', 'right')
					),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"sidebar_outer_show_socials" => array( 
					"title" => esc_html__('Show Social icons', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show Social icons in the outer sidebar', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_sidebar_outer' => array('left', 'right')
					),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"sidebar_outer_show_menu" => array( 
					"title" => esc_html__('Show Menu', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show Menu in the outer sidebar', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_sidebar_outer' => array('left', 'right')
					),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"menu_side" => array(
					"title" => esc_html__('Select menu',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select menu for the outer sidebar',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_sidebar_outer' => array('left', 'right'),
						'sidebar_outer_show_menu' => array('yes')
					),
					"std" => "default",
					"options" => bugspatrol_get_options_param('list_menus'),
					"type" => "select"),
		
		"sidebar_outer_show_widgets" => array( 
					"title" => esc_html__('Show Widgets', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show Widgets in the outer sidebar', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_sidebar_outer' => array('left', 'right')
					),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),

		"sidebar_outer" => array( 
					"title" => esc_html__('Select outer sidebar',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select outer sidebar content',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'sidebar_outer_show_widgets' => array('yes'),
						'show_sidebar_outer' => array('left', 'right')
					),
					"std" => "sidebar_outer",
					"options" => bugspatrol_get_options_param('list_sidebars'),
					"type" => "select"),
		
		
		
		
		// Customization -> Footer
		//-------------------------------------------------
		
		'customization_footer' => array(
					"title" => esc_html__("Footer", 'bugspatrol'),
					"override" => "category,services_group,post,page,custom",
					"icon" => 'iconadmin-window',
					"type" => "tab"),
		
		
		"info_footer_1" => array(
					"title" => esc_html__("Footer components", 'bugspatrol'),
					"desc" => wp_kses_data( __("Select components of the footer, set style and put the content for the user's footer area", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
		
		"show_sidebar_footer" => array(
					"title" => esc_html__('Show footer sidebar', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select style for the footer sidebar or hide it', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),

		"sidebar_footer_scheme" => array(
					"title" => esc_html__("Color scheme", 'bugspatrol'),
					"desc" => wp_kses_data( __('Select predefined color scheme for the footer', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_sidebar_footer' => array('yes')
					),
					"std" => "original",
					"dir" => "horizontal",
					"options" => bugspatrol_get_options_param('list_color_schemes'),
					"type" => "checklist"),
		
		"sidebar_footer" => array( 
					"title" => esc_html__('Select footer sidebar',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select footer sidebar for the blog page',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_sidebar_footer' => array('yes')
					),
					"std" => "sidebar_footer",
					"options" => bugspatrol_get_options_param('list_sidebars'),
					"type" => "select"),
		
		"sidebar_footer_columns" => array( 
					"title" => esc_html__('Footer sidebar columns',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select columns number for the footer sidebar',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_sidebar_footer' => array('yes')
					),
					"std" => 4,
					"min" => 1,
					"max" => 6,
					"type" => "spinner"),
		
		
		"info_footer_2" => array(
					"title" => esc_html__('Testimonials in Footer', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select parameters for Testimonials in the Footer', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),

		"show_testimonials_in_footer" => array(
					"title" => esc_html__('Show Testimonials in footer', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show Testimonials slider in footer. For correct operation of the slider (and shortcode testimonials) you must fill out Testimonials posts on the menu "Testimonials"', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),

		"testimonials_scheme" => array(
					"title" => esc_html__("Color scheme", 'bugspatrol'),
					"desc" => wp_kses_data( __('Select predefined color scheme for the testimonials area', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_testimonials_in_footer' => array('yes')
					),
					"std" => "original",
					"dir" => "horizontal",
					"options" => bugspatrol_get_options_param('list_color_schemes'),
					"type" => "checklist"),

		"testimonials_count" => array( 
					"title" => esc_html__('Testimonials count', 'bugspatrol'),
					"desc" => wp_kses_data( __('Number testimonials to show', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_testimonials_in_footer' => array('yes')
					),
					"std" => 3,
					"step" => 1,
					"min" => 1,
					"max" => 10,
					"type" => "spinner"),
		
		
		"info_footer_3" => array(
					"title" => esc_html__('Twitter in Footer', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select parameters for Twitter stream in the Footer (you can override it in each category and page)', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),

		"show_twitter_in_footer" => array(
					"title" => esc_html__('Show Twitter in footer', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show Twitter slider in footer. For correct operation of the slider (and shortcode twitter) you must fill out the Twitter API keys on the menu "Appearance - Theme Options - Socials"', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),

		"twitter_scheme" => array(
					"title" => esc_html__("Color scheme", 'bugspatrol'),
					"desc" => wp_kses_data( __('Select predefined color scheme for the twitter area', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_twitter_in_footer' => array('yes')
					),
					"std" => "original",
					"dir" => "horizontal",
					"options" => bugspatrol_get_options_param('list_color_schemes'),
					"type" => "checklist"),

		"twitter_count" => array( 
					"title" => esc_html__('Twitter count', 'bugspatrol'),
					"desc" => wp_kses_data( __('Number twitter to show', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_twitter_in_footer' => array('yes')
					),
					"std" => 3,
					"step" => 1,
					"min" => 1,
					"max" => 10,
					"type" => "spinner"),


		"info_footer_4" => array(
					"title" => esc_html__('Google map parameters', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select parameters for Google map (you can override it in each category and page)', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
					
		"show_googlemap" => array(
					"title" => esc_html__('Show Google Map', 'bugspatrol'),
					"desc" => wp_kses_data( __('Do you want to show Google map on each page (post)', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"googlemap_height" => array(
					"title" => esc_html__("Map height", 'bugspatrol'),
					"desc" => wp_kses_data( __("Map height (default - in pixels, allows any CSS units of measure)", 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => 400,
					"min" => 100,
					"step" => 10,
					"type" => "spinner"),
		
		"googlemap_address" => array(
					"title" => esc_html__('Address to show on map',  'bugspatrol'),
					"desc" => wp_kses_data( __("Enter address to show on map center", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => "",
					"type" => "text"),
		
		"googlemap_latlng" => array(
					"title" => esc_html__('Latitude and Longitude to show on map',  'bugspatrol'),
					"desc" => wp_kses_data( __("Enter coordinates (separated by comma) to show on map center (instead of address)", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => "",
					"type" => "text"),
		
		"googlemap_title" => array(
					"title" => esc_html__('Title to show on map',  'bugspatrol'),
					"desc" => wp_kses_data( __("Enter title to show on map center", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => "",
					"type" => "text"),
		
		"googlemap_description" => array(
					"title" => esc_html__('Description to show on map',  'bugspatrol'),
					"desc" => wp_kses_data( __("Enter description to show on map center", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => "",
					"type" => "text"),
		
		"googlemap_zoom" => array(
					"title" => esc_html__('Google map initial zoom',  'bugspatrol'),
					"desc" => wp_kses_data( __("Enter desired initial zoom for Google map", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => 16,
					"min" => 1,
					"max" => 20,
					"step" => 1,
					"type" => "spinner"),
		
		"googlemap_style" => array(
					"title" => esc_html__('Google map style',  'bugspatrol'),
					"desc" => wp_kses_data( __("Select style to show Google map", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => 'style1',
					"options" => bugspatrol_get_options_param('list_gmap_styles'),
					"type" => "select"),
		
		"googlemap_marker" => array(
					"title" => esc_html__('Google map marker',  'bugspatrol'),
					"desc" => wp_kses_data( __("Select or upload png-image with Google map marker", 'bugspatrol') ),
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => '',
					"type" => "media"),
		
		
		
		"info_footer_5" => array(
					"title" => esc_html__("Contacts area", 'bugspatrol'),
					"desc" => wp_kses_data( __("Show/Hide contacts area in the footer", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
		
		"show_contacts_in_footer" => array(
					"title" => esc_html__('Show Contacts in footer', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show contact information area in footer: site logo, contact info and large social icons', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),

		"contacts_scheme" => array(
					"title" => esc_html__("Color scheme", 'bugspatrol'),
					"desc" => wp_kses_data( __('Select predefined color scheme for the contacts area', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_contacts_in_footer' => array('yes')
					),
					"std" => "original",
					"dir" => "horizontal",
					"options" => bugspatrol_get_options_param('list_color_schemes'),
					"type" => "checklist"),

		'logo_footer' => array(
					"title" => esc_html__('Logo image for footer', 'bugspatrol'),
					"desc" => wp_kses_data( __('Logo image in the footer (in the contacts area)', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_contacts_in_footer' => array('yes')
					),
					"std" => "",
					"type" => "media"
					),

		'logo_footer_retina' => array(
					"title" => esc_html__('Logo image for footer for Retina', 'bugspatrol'),
					"desc" => wp_kses_data( __('Logo image in the footer (in the contacts area) used on Retina display', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_contacts_in_footer' => array('yes')
					),
					"std" => "",
					"type" => "media"
					),
		
		'logo_footer_height' => array(
					"title" => esc_html__('Logo height', 'bugspatrol'),
					"desc" => wp_kses_data( __('Height for the logo in the footer area (in the contacts area)', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_contacts_in_footer' => array('yes')
					),
					"step" => 1,
					"std" => 30,
					"min" => 10,
					"max" => 300,
					"mask" => "?999",
					"type" => "spinner"
					),
		
		
		
		"info_footer_6" => array(
					"title" => esc_html__("Copyright and footer menu", 'bugspatrol'),
					"desc" => wp_kses_data( __("Show/Hide copyright area in the footer", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),

		"show_copyright_in_footer" => array(
					"title" => esc_html__('Show Copyright area in footer', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show area with copyright information, footer menu and small social icons in footer', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "plain",
					"options" => array(
						'none' => esc_html__('Hide', 'bugspatrol'),
						'text' => esc_html__('Text', 'bugspatrol'),
						'menu' => esc_html__('Text and menu', 'bugspatrol'),
						'socials' => esc_html__('Text and Social icons', 'bugspatrol')
					),
					"type" => "checklist"),

		"copyright_scheme" => array(
					"title" => esc_html__("Color scheme", 'bugspatrol'),
					"desc" => wp_kses_data( __('Select predefined color scheme for the copyright area', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_copyright_in_footer' => array('text', 'menu', 'socials')
					),
					"std" => "original",
					"dir" => "horizontal",
					"options" => bugspatrol_get_options_param('list_color_schemes'),
					"type" => "checklist"),
		
		"menu_footer" => array( 
					"title" => esc_html__('Select footer menu',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select footer menu for the current page',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "default",
					"dependency" => array(
						'show_copyright_in_footer' => array('menu')
					),
					"options" => bugspatrol_get_options_param('list_menus'),
					"type" => "select"),

		"footer_copyright" => array(
					"title" => esc_html__('Footer copyright text',  'bugspatrol'),
					"desc" => wp_kses_data( __("Copyright text to show in footer area (bottom of site)", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_copyright_in_footer' => array('text', 'menu', 'socials')
					),
					"allow_html" => true,
					"std" => "AncoraThemes &copy; {Y}. All rights reserved. ",
					"rows" => "10",
					"type" => "editor"),




		// Customization -> Other
		//-------------------------------------------------
		
		'customization_other' => array(
					"title" => esc_html__('Other', 'bugspatrol'),
					"override" => "category,services_group,post,page,custom",
					"icon" => 'iconadmin-cog',
					"type" => "tab"
					),

		'info_other_1' => array(
					"title" => esc_html__('Theme customization other parameters', 'bugspatrol'),
					"desc" => wp_kses_data( __('Animation parameters and responsive layouts for the small screens', 'bugspatrol') ),
					"type" => "info"
					),

		'show_theme_customizer' => array(
					"title" => esc_html__('Show Theme customizer', 'bugspatrol'),
					"desc" => wp_kses_data( __('Do you want to show theme customizer in the right panel? Your website visitors will be able to customise it yourself.', 'bugspatrol') ),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"
					),

		"customizer_demo" => array(
					"title" => esc_html__('Theme customizer panel demo time', 'bugspatrol'),
					"desc" => wp_kses_data( __('Timer for demo mode for the customizer panel (in milliseconds: 1000ms = 1s). If 0 - no demo.', 'bugspatrol') ),
					"dependency" => array(
						'show_theme_customizer' => array('yes')
					),
					"std" => "0",
					"min" => 0,
					"max" => 10000,
					"step" => 500,
					"type" => "spinner"),
		
		'css_animation' => array(
					"title" => esc_html__('Extended CSS animations', 'bugspatrol'),
					"desc" => wp_kses_data( __('Do you want use extended animations effects on your site?', 'bugspatrol') ),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"
					),
		
		'animation_on_mobile' => array(
					"title" => esc_html__('Allow CSS animations on mobile', 'bugspatrol'),
					"desc" => wp_kses_data( __('Do you allow extended animations effects on mobile devices?', 'bugspatrol') ),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"
					),

		"button_hover" => array( 
					"title" => esc_html__("Buttons hover", 'bugspatrol'),
					"desc" => wp_kses_data( __("Select hover effect for all theme's buttons (and buttons from the thirdparty plugins if possible)", 'bugspatrol') ),
					"std" => "fade",
					"type" => "select",
					"options" => bugspatrol_get_options_param('list_button_hovers')),

		"input_hover" => array( 
					"title" => esc_html__("Input fileds style", 'bugspatrol'),
					"desc" => wp_kses_data( __("Select style for all theme's input fields (and fields from the thirdparty plugins if possible)", 'bugspatrol') ),
					"std" => "default",
					"type" => "select",
					"options" => bugspatrol_get_options_param('list_input_hovers')),

		'remember_visitors_settings' => array(
					"title" => esc_html__("Remember visitor's settings", 'bugspatrol'),
					"desc" => wp_kses_data( __('To remember the settings that were made by the visitor, when navigating to other pages or to limit their effect only within the current page', 'bugspatrol') ),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"
					),
					
		'responsive_layouts' => array(
					"title" => esc_html__('Responsive Layouts', 'bugspatrol'),
					"desc" => wp_kses_data( __('Do you want use responsive layouts on small screen or still use main layout?', 'bugspatrol') ),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"
					),

		"page_preloader" => array( 
					"title" => esc_html__("Show page preloader", 'bugspatrol'),
					"desc" => wp_kses_data( __("Select one of predefined styles for the page preloader or upload preloader image", 'bugspatrol') ),
					"std" => "none",
					"type" => "select",
					"options" => array(
						'none'   => esc_html__('Hide preloader', 'bugspatrol'),
						'circle' => esc_html__('Circle', 'bugspatrol'),
						'square' => esc_html__('Square', 'bugspatrol'),
						'custom' => esc_html__('Custom', 'bugspatrol'),
					)),
        'privacy_text' => array(
                    "title" => esc_html__("Text with Privacy Policy link", 'bugspatrol'),
                    "desc"  => wp_kses_data( esc_html__("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'bugspatrol') ),
                    "std"   => wp_kses_post( esc_html__( 'I agree that my submitted data is being collected and stored.', 'bugspatrol') ),
                    "type"  => "text"
                    ),


            'page_preloader_image' => array(
					"title" => esc_html__('Upload preloader image',  'bugspatrol'),
					"desc" => wp_kses_data( __('Upload animated GIF to use it as page preloader',  'bugspatrol') ),
					"dependency" => array(
						'page_preloader' => array('custom')
					),
					"std" => "",
					"type" => "media"
					),


		'info_other_2' => array(
					"title" => esc_html__('Google fonts parameters', 'bugspatrol'),
					"desc" => wp_kses_data( __('Specify additional parameters, used to load Google fonts', 'bugspatrol') ),
					"type" => "info"
					),
		
		"fonts_subset" => array(
					"title" => esc_html__('Characters subset', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select subset, included into used Google fonts', 'bugspatrol') ),
					"std" => "latin,latin-ext",
					"options" => array(
						'latin' => esc_html__('Latin', 'bugspatrol'),
						'latin-ext' => esc_html__('Latin Extended', 'bugspatrol'),
						'greek' => esc_html__('Greek', 'bugspatrol'),
						'greek-ext' => esc_html__('Greek Extended', 'bugspatrol'),
						'cyrillic' => esc_html__('Cyrillic', 'bugspatrol'),
						'cyrillic-ext' => esc_html__('Cyrillic Extended', 'bugspatrol'),
						'vietnamese' => esc_html__('Vietnamese', 'bugspatrol')
					),
					"size" => "medium",
					"dir" => "vertical",
					"multiple" => true,
					"type" => "checklist"),


		'info_other_3' => array(
					"title" => esc_html__('Additional CSS and HTML/JS code', 'bugspatrol'),
					"desc" => wp_kses_data( __('Put here your custom CSS and JS code', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"
					),
					
		'custom_css_html' => array(
					"title" => esc_html__('Use custom CSS/HTML/JS', 'bugspatrol'),
					"desc" => wp_kses_data( __('Do you want use custom HTML/CSS/JS code in your site? For example: custom styles, Google Analitics code, etc.', 'bugspatrol') ),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"
					),
		
		"gtm_code" => array(
					"title" => esc_html__('Google tags manager or Google analitics code',  'bugspatrol'),
					"desc" => wp_kses_data( __('Put here Google Tags Manager (GTM) code from your account: Google analitics, remarketing, etc. This code will be placed after open body tag.',  'bugspatrol') ),
					"dependency" => array(
						'custom_css_html' => array('yes')
					),
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"allow_html" => true,
					"allow_js" => true,
					"type" => "textarea"),
		
		"gtm_code2" => array(
					"title" => esc_html__('Google remarketing code',  'bugspatrol'),
					"desc" => wp_kses_data( __('Put here Google Remarketing code from your account. This code will be placed before close body tag.',  'bugspatrol') ),
					"dependency" => array(
						'custom_css_html' => array('yes')
					),
					"divider" => false,
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"allow_html" => true,
					"allow_js" => true,
					"type" => "textarea"),
		
		'custom_code' => array(
					"title" => esc_html__('Your custom HTML/JS code',  'bugspatrol'),
					"desc" => wp_kses_data( __('Put here your invisible html/js code: Google analitics, counters, etc',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'custom_css_html' => array('yes')
					),
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"allow_html" => true,
					"allow_js" => true,
					"type" => "textarea"
					),
		
		'custom_css' => array(
					"title" => esc_html__('Your custom CSS code',  'bugspatrol'),
					"desc" => wp_kses_data( __('Put here your css code to correct main theme styles',  'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'custom_css_html' => array('yes')
					),
					"divider" => false,
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"type" => "textarea"
					),
		
		
		
		
		
		
		
		
		
		//###############################
		//#### Blog and Single pages #### 
		//###############################
		"partition_blog" => array(
					"title" => esc_html__('Blog &amp; Single', 'bugspatrol'),
					"icon" => "iconadmin-docs",
					"override" => "category,services_group,post,page,custom",
					"type" => "partition"),
		
		
		
		// Blog -> Stream page
		//-------------------------------------------------
		
		'blog_tab_stream' => array(
					"title" => esc_html__('Stream page', 'bugspatrol'),
					"start" => 'blog_tabs',
					"icon" => "iconadmin-docs",
					"override" => "category,services_group,post,page,custom",
					"type" => "tab"),
		
		"info_blog_1" => array(
					"title" => esc_html__('Blog streampage parameters', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select desired blog streampage parameters (you can override it in each category)', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
		
		"blog_style" => array(
					"title" => esc_html__('Blog style', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select desired blog style', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"std" => "excerpt",
					"options" => bugspatrol_get_options_param('list_blog_styles'),
					"type" => "select"),
		
		"hover_style" => array(
					"title" => esc_html__('Hover style', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select desired hover style (only for Blog style = Portfolio)', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'blog_style' => array('portfolio','grid','square','colored')
					),
					"std" => "square effect_shift",
					"options" => bugspatrol_get_options_param('list_hovers'),
					"type" => "select"),
		
		"hover_dir" => array(
					"title" => esc_html__('Hover dir', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select hover direction (only for Blog style = Portfolio and Hover style = Circle or Square)', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'blog_style' => array('portfolio','grid','square','colored'),
						'hover_style' => array('square','circle')
					),
					"std" => "left_to_right",
					"options" => bugspatrol_get_options_param('list_hovers_dir'),
					"type" => "select"),
		
		"article_style" => array(
					"title" => esc_html__('Article style', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select article display method: boxed or stretch', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"std" => "stretch",
					"options" => bugspatrol_get_options_param('list_article_styles'),
					"size" => "medium",
					"type" => "switch"),
		
		"dedicated_location" => array(
					"title" => esc_html__('Dedicated location', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select location for the dedicated content or featured image in the "excerpt" blog style', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'blog_style' => array('excerpt')
					),
					"std" => "default",
					"options" => bugspatrol_get_options_param('list_locations'),
					"type" => "select"),
		
		"show_filters" => array(
					"title" => esc_html__('Show filters', 'bugspatrol'),
					"desc" => wp_kses_data( __('What taxonomy use for filter buttons', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'blog_style' => array('portfolio','grid','square','colored')
					),
					"std" => "hide",
					"options" => bugspatrol_get_options_param('list_filters'),
					"type" => "checklist"),
		
		"blog_sort" => array(
					"title" => esc_html__('Blog posts sorted by', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select the desired sorting method for posts', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"std" => "date",
					"options" => bugspatrol_get_options_param('list_sorting'),
					"dir" => "vertical",
					"type" => "radio"),
		
		"blog_order" => array(
					"title" => esc_html__('Blog posts order', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select the desired ordering method for posts', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"std" => "desc",
					"options" => bugspatrol_get_options_param('list_ordering'),
					"size" => "big",
					"type" => "switch"),
		
		"posts_per_page" => array(
					"title" => esc_html__('Blog posts per page',  'bugspatrol'),
					"desc" => wp_kses_data( __('How many posts display on blog pages for selected style. If empty or 0 - inherit system wordpress settings',  'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"std" => "12",
					"mask" => "?99",
					"type" => "text"),
		
		"post_excerpt_maxlength" => array(
					"title" => esc_html__('Excerpt maxlength for streampage',  'bugspatrol'),
					"desc" => wp_kses_data( __('How many characters from post excerpt are display in blog streampage (only for Blog style = Excerpt). 0 - do not trim excerpt.',  'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'blog_style' => array('excerpt', 'portfolio', 'grid', 'square', 'related')
					),
					"std" => "250",
					"mask" => "?9999",
					"type" => "text"),
		
		"post_excerpt_maxlength_masonry" => array(
					"title" => esc_html__('Excerpt maxlength for classic and masonry',  'bugspatrol'),
					"desc" => wp_kses_data( __('How many characters from post excerpt are display in blog streampage (only for Blog style = Classic or Masonry). 0 - do not trim excerpt.',  'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'blog_style' => array('masonry', 'classic')
					),
					"std" => "150",
					"mask" => "?9999",
					"type" => "text"),
		
		
		
		
		// Blog -> Single page
		//-------------------------------------------------
		
		'blog_tab_single' => array(
					"title" => esc_html__('Single page', 'bugspatrol'),
					"icon" => "iconadmin-doc",
					"override" => "category,services_group,post,page,custom",
					"type" => "tab"),
		
		
		"info_single_1" => array(
					"title" => esc_html__('Single (detail) pages parameters', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select desired parameters for single (detail) pages (you can override it in each category and single post (page))', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
		
		"single_style" => array(
					"title" => esc_html__('Single page style', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select desired style for single page', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "single-standard",
					"options" => bugspatrol_get_options_param('list_single_styles'),
					"dir" => "horizontal",
					"type" => "radio"),

		"icon" => array(
					"title" => esc_html__('Select post icon', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select icon for output before post/category name in some layouts', 'bugspatrol') ),
					"override" => "services_group,post,page,custom",
					"std" => "",
					"options" => bugspatrol_get_options_param('list_icons'),
					"style" => "select",
					"type" => "icons"
					),

		"alter_thumb_size" => array(
					"title" => esc_html__('Alter thumb size (WxH)',  'bugspatrol'),
					"override" => "page,post",
					"desc" => wp_kses_data( __("Select thumb size for the alternative portfolio layout (number items horizontally x number items vertically)", 'bugspatrol') ),
					"class" => "",
					"std" => "1_1",
					"type" => "radio",
					"options" => bugspatrol_get_options_param('list_alter_sizes')
					),
		
		"show_featured_image" => array(
					"title" => esc_html__('Show featured image before post',  'bugspatrol'),
					"desc" => wp_kses_data( __("Show featured image (if selected) before post content on single pages", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"show_post_title" => array(
					"title" => esc_html__('Show post title', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show area with post title on single pages', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"show_post_title_on_quotes" => array(
					"title" => esc_html__('Show post title on links, chat, quote, status', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show area with post title on single and blog pages in specific post formats: links, chat, quote, status', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"show_post_info" => array(
					"title" => esc_html__('Show post info', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show area with post info on single pages', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"show_text_before_readmore" => array(
					"title" => esc_html__('Show text before "Read more" tag', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show text before "Read more" tag on single pages', 'bugspatrol') ),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
					
		"show_post_author" => array(
					"title" => esc_html__('Show post author details',  'bugspatrol'),
					"desc" => wp_kses_data( __("Show post author information block on single post page", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"show_post_tags" => array(
					"title" => esc_html__('Show post tags',  'bugspatrol'),
					"desc" => wp_kses_data( __("Show tags block on single post page", 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"show_post_related" => array(
					"title" => esc_html__('Show related posts',  'bugspatrol'),
					"desc" => wp_kses_data( __("Show related posts block on single post page", 'bugspatrol') ),
					"override" => "category,services_group,post,custom",
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),

		"post_related_count" => array(
					"title" => esc_html__('Related posts number',  'bugspatrol'),
					"desc" => wp_kses_data( __("How many related posts showed on single post page", 'bugspatrol') ),
					"dependency" => array(
						'show_post_related' => array('yes')
					),
					"override" => "category,services_group,post,custom",
					"std" => "2",
					"step" => 1,
					"min" => 2,
					"max" => 8,
					"type" => "spinner"),

		"post_related_columns" => array(
					"title" => esc_html__('Related posts columns',  'bugspatrol'),
					"desc" => wp_kses_data( __("How many columns used to show related posts on single post page. 1 - use scrolling to show all related posts", 'bugspatrol') ),
					"override" => "category,services_group,post,custom",
					"dependency" => array(
						'show_post_related' => array('yes')
					),
					"std" => "2",
					"step" => 1,
					"min" => 1,
					"max" => 4,
					"type" => "spinner"),
		
		"post_related_sort" => array(
					"title" => esc_html__('Related posts sorted by', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select the desired sorting method for related posts', 'bugspatrol') ),
					"dependency" => array(
						'show_post_related' => array('yes')
					),
					"std" => "date",
					"options" => bugspatrol_get_options_param('list_sorting'),
					"type" => "select"),
		
		"post_related_order" => array(
					"title" => esc_html__('Related posts order', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select the desired ordering method for related posts', 'bugspatrol') ),
					"dependency" => array(
						'show_post_related' => array('yes')
					),
					"std" => "desc",
					"options" => bugspatrol_get_options_param('list_ordering'),
					"size" => "big",
					"type" => "switch"),
		
		
		
		// Blog -> Other parameters
		//-------------------------------------------------
		
		'blog_tab_other' => array(
					"title" => esc_html__('Other parameters', 'bugspatrol'),
					"icon" => "iconadmin-newspaper",
					"override" => "category,services_group,page,custom",
					"type" => "tab"),
		
		"info_blog_other_1" => array(
					"title" => esc_html__('Other Blog parameters', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select excluded categories, substitute parameters, etc.', 'bugspatrol') ),
					"type" => "info"),
		
		"exclude_cats" => array(
					"title" => esc_html__('Exclude categories', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select categories, which posts are exclude from blog page', 'bugspatrol') ),
					"std" => "",
					"options" => bugspatrol_get_options_param('list_categories'),
					"multiple" => true,
					"style" => "list",
					"type" => "select"),
		
		"blog_pagination" => array(
					"title" => esc_html__('Blog pagination', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select type of the pagination on blog streampages', 'bugspatrol') ),
					"std" => "pages",
					"override" => "category,services_group,page,custom",
					"options" => array(
						'pages'    => esc_html__('Standard page numbers', 'bugspatrol'),
						'slider'   => esc_html__('Slider with page numbers', 'bugspatrol'),
						'viewmore' => esc_html__('"View more" button', 'bugspatrol'),
						'infinite' => esc_html__('Infinite scroll', 'bugspatrol')
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"blog_counters" => array(
					"title" => esc_html__('Blog counters', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select counters, displayed near the post title', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"std" => "comments",
					"options" => bugspatrol_get_options_param('list_blog_counters'),
					"dir" => "vertical",
					"multiple" => true,
					"type" => "checklist"),
		
		"close_category" => array(
					"title" => esc_html__("Post's category announce", 'bugspatrol'),
					"desc" => wp_kses_data( __('What category display in announce block (over posts thumb) - original or nearest parental', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"std" => "parental",
					"options" => array(
						'parental' => esc_html__('Nearest parental category', 'bugspatrol'),
						'original' => esc_html__("Original post's category", 'bugspatrol')
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"show_date_after" => array(
					"title" => esc_html__('Show post date after', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show post date after N days (before - show post age)', 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"std" => "30",
					"mask" => "?99",
					"type" => "text"),
		
		
		
		
		
		//###############################
		//#### Reviews               #### 
		//###############################
		"partition_reviews" => array(
					"title" => esc_html__('Reviews', 'bugspatrol'),
					"icon" => "iconadmin-newspaper",
					"override" => "category,services_group,services_group",
					"type" => "partition"),
		
		"info_reviews_1" => array(
					"title" => esc_html__('Reviews criterias', 'bugspatrol'),
					"desc" => wp_kses_data( __('Set up list of reviews criterias. You can override it in any category.', 'bugspatrol') ),
					"override" => "category,services_group,services_group",
					"type" => "info"),
		
		"show_reviews" => array(
					"title" => esc_html__('Show reviews block',  'bugspatrol'),
					"desc" => wp_kses_data( __("Show reviews block on single post page and average reviews rating after post's title in stream pages", 'bugspatrol') ),
					"override" => "category,services_group,services_group",
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"reviews_max_level" => array(
					"title" => esc_html__('Max reviews level',  'bugspatrol'),
					"desc" => wp_kses_data( __("Maximum level for reviews marks", 'bugspatrol') ),
					"std" => "5",
					"options" => array(
						'5'=>esc_html__('5 stars', 'bugspatrol'), 
						'10'=>esc_html__('10 stars', 'bugspatrol'), 
						'100'=>esc_html__('100%', 'bugspatrol')
					),
					"type" => "radio",
					),
		
		"reviews_style" => array(
					"title" => esc_html__('Show rating as',  'bugspatrol'),
					"desc" => wp_kses_data( __("Show rating marks as text or as stars/progress bars.", 'bugspatrol') ),
					"std" => "stars",
					"options" => array(
						'text' => esc_html__('As text (for example: 7.5 / 10)', 'bugspatrol'), 
						'stars' => esc_html__('As stars or bars', 'bugspatrol')
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"reviews_criterias_levels" => array(
					"title" => esc_html__('Reviews Criterias Levels', 'bugspatrol'),
					"desc" => wp_kses_data( __('Words to mark criterials levels. Just write the word and press "Enter". Also you can arrange words.', 'bugspatrol') ),
					"std" => esc_html__("bad,poor,normal,good,great", 'bugspatrol'),
					"type" => "tags"),
		
		"reviews_first" => array(
					"title" => esc_html__('Show first reviews',  'bugspatrol'),
					"desc" => wp_kses_data( __("What reviews will be displayed first: by author or by visitors. Also this type of reviews will display under post's title.", 'bugspatrol') ),
					"std" => "author",
					"options" => array(
						'author' => esc_html__('By author', 'bugspatrol'),
						'users' => esc_html__('By visitors', 'bugspatrol')
						),
					"dir" => "horizontal",
					"type" => "radio"),
		
		"reviews_second" => array(
					"title" => esc_html__('Hide second reviews',  'bugspatrol'),
					"desc" => wp_kses_data( __("Do you want hide second reviews tab in widgets and single posts?", 'bugspatrol') ),
					"std" => "show",
					"options" => bugspatrol_get_options_param('list_show_hide'),
					"size" => "medium",
					"type" => "switch"),
		
		"reviews_can_vote" => array(
					"title" => esc_html__('What visitors can vote',  'bugspatrol'),
					"desc" => wp_kses_data( __("What visitors can vote: all or only registered", 'bugspatrol') ),
					"std" => "all",
					"options" => array(
						'all'=>esc_html__('All visitors', 'bugspatrol'), 
						'registered'=>esc_html__('Only registered', 'bugspatrol')
					),
					"dir" => "horizontal",
					"type" => "radio"),
		
		"reviews_criterias" => array(
					"title" => esc_html__('Reviews criterias',  'bugspatrol'),
					"desc" => wp_kses_data( __('Add default reviews criterias.',  'bugspatrol') ),
					"override" => "category,services_group,services_group",
					"std" => "",
					"cloneable" => true,
					"type" => "text"),

		// Don't remove this parameter - it used in admin for store marks
		"reviews_marks" => array(
					"std" => "",
					"type" => "hidden"),
		





		//###############################
		//#### Media                #### 
		//###############################
		"partition_media" => array(
					"title" => esc_html__('Media', 'bugspatrol'),
					"icon" => "iconadmin-picture",
					"override" => "category,services_group,post,page,custom",
					"type" => "partition"),
		
		"info_media_1" => array(
					"title" => esc_html__('Media settings', 'bugspatrol'),
					"desc" => wp_kses_data( __('Set up parameters to show images, galleries, audio and video posts', 'bugspatrol') ),
					"override" => "category,services_group,services_group",
					"type" => "info"),
					
		"retina_ready" => array(
					"title" => esc_html__('Image dimensions', 'bugspatrol'),
					"desc" => wp_kses_data( __('What dimensions use for uploaded image: Original or "Retina ready" (twice enlarged)', 'bugspatrol') ),
					"std" => "1",
					"size" => "medium",
					"options" => array(
						"1" => esc_html__("Original", 'bugspatrol'), 
						"2" => esc_html__("Retina", 'bugspatrol')
					),
					"type" => "switch"),
		
		"images_quality" => array(
					"title" => esc_html__('Quality for cropped images', 'bugspatrol'),
					"desc" => wp_kses_data( __('Quality (1-100) to save cropped images', 'bugspatrol') ),
					"std" => "70",
					"min" => 1,
					"max" => 100,
					"type" => "spinner"),
		
		"substitute_gallery" => array(
					"title" => esc_html__('Substitute standard Wordpress gallery', 'bugspatrol'),
					"desc" => wp_kses_data( __('Substitute standard Wordpress gallery with our slider on the single pages', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"gallery_instead_image" => array(
					"title" => esc_html__('Show gallery instead featured image', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show slider with gallery instead featured image on blog streampage and in the related posts section for the gallery posts', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"gallery_max_slides" => array(
					"title" => esc_html__('Max images number in the slider', 'bugspatrol'),
					"desc" => wp_kses_data( __('Maximum images number from gallery into slider', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'gallery_instead_image' => array('yes')
					),
					"std" => "5",
					"min" => 2,
					"max" => 10,
					"type" => "spinner"),
		
		"popup_engine" => array(
					"title" => esc_html__('Popup engine to zoom images', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select engine to show popup windows with images and galleries', 'bugspatrol') ),
					"std" => "pretty",
					"options" => bugspatrol_get_options_param('list_popups'),
					"type" => "select"),
		
		"substitute_audio" => array(
					"title" => esc_html__('Substitute audio tags', 'bugspatrol'),
					"desc" => wp_kses_data( __('Substitute audio tag with source from soundcloud to embed player', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"substitute_video" => array(
					"title" => esc_html__('Substitute video tags', 'bugspatrol'),
					"desc" => wp_kses_data( __('Substitute video tags with embed players or leave video tags unchanged (if you use third party plugins for the video tags)', 'bugspatrol') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"use_mediaelement" => array(
					"title" => esc_html__('Use Media Element script for audio and video tags', 'bugspatrol'),
					"desc" => wp_kses_data( __('Do you want use the Media Element script for all audio and video tags on your site or leave standard HTML5 behaviour?', 'bugspatrol') ),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		
		
		
		//###############################
		//#### Socials               #### 
		//###############################
		"partition_socials" => array(
					"title" => esc_html__('Socials', 'bugspatrol'),
					"icon" => "iconadmin-users",
					"override" => "category,services_group,page,custom",
					"type" => "partition"),
		
		"info_socials_1" => array(
					"title" => esc_html__('Social networks', 'bugspatrol'),
					"desc" => wp_kses_data( __("Social networks list for site footer and Social widget", 'bugspatrol') ),
					"type" => "info"),
		
		"social_icons" => array(
					"title" => esc_html__('Social networks',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select icon and write URL to your profile in desired social networks.',  'bugspatrol') ),
					"std" => array(array('url'=>'', 'icon'=>'')),
					"cloneable" => true,
					"size" => "small",
					"style" => $socials_type,
					"options" => $socials_type=='images' ? bugspatrol_get_options_param('list_socials') : bugspatrol_get_options_param('list_icons'),
					"type" => "socials"),
		
		"info_socials_2" => array(
					"title" => esc_html__('Share buttons', 'bugspatrol'),
					"desc" => wp_kses_data( __("Add button's code for each social share network.<br>
					In share url you can use next macro:<br>
					<b>{url}</b> - share post (page) URL,<br>
					<b>{title}</b> - post title,<br>
					<b>{image}</b> - post image,<br>
					<b>{descr}</b> - post description (if supported)<br>
					For example:<br>
					<b>Facebook</b> share string: <em>http://www.facebook.com/sharer.php?u={link}&amp;t={title}</em><br>
					<b>Delicious</b> share string: <em>http://delicious.com/save?url={link}&amp;title={title}&amp;note={descr}</em>", 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"type" => "info"),
		
		"show_share" => array(
					"title" => esc_html__('Show social share buttons',  'bugspatrol'),
					"desc" => wp_kses_data( __("Show social share buttons block", 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"std" => "horizontal",
					"options" => array(
						'hide'		=> esc_html__('Hide', 'bugspatrol'),
						'vertical'	=> esc_html__('Vertical', 'bugspatrol'),
						'horizontal'=> esc_html__('Horizontal', 'bugspatrol')
					),
					"type" => "checklist"),

		"show_share_counters" => array(
					"title" => esc_html__('Show share counters',  'bugspatrol'),
					"desc" => wp_kses_data( __("Show share counters after social buttons", 'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_share' => array('vertical', 'horizontal')
					),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),

		"share_caption" => array(
					"title" => esc_html__('Share block caption',  'bugspatrol'),
					"desc" => wp_kses_data( __('Caption for the block with social share buttons',  'bugspatrol') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_share' => array('vertical', 'horizontal')
					),
					"std" => esc_html__('Share:', 'bugspatrol'),
					"type" => "text"),
		
		"share_buttons" => array(
					"title" => esc_html__('Share buttons',  'bugspatrol'),
					"desc" => wp_kses_data( __('Select icon and write share URL for desired social networks.<br><b>Important!</b> If you leave text field empty - internal theme link will be used (if present).',  'bugspatrol') ),
					"dependency" => array(
						'show_share' => array('vertical', 'horizontal')
					),
					"std" => array(array('url'=>'', 'icon'=>'')),
					"cloneable" => true,
					"size" => "small",
					"style" => $socials_type,
					"options" => $socials_type=='images' ? bugspatrol_get_options_param('list_socials') : bugspatrol_get_options_param('list_icons'),
					"type" => "socials"),
		
		
		"info_socials_3" => array(
					"title" => esc_html__('Twitter API keys', 'bugspatrol'),
					"desc" => wp_kses_data( __("Put to this section Twitter API 1.1 keys.<br>You can take them after registration your application in <strong>https://apps.twitter.com/</strong>", 'bugspatrol') ),
					"type" => "info"),
		
		"twitter_username" => array(
					"title" => esc_html__('Twitter username',  'bugspatrol'),
					"desc" => wp_kses_data( __('Your login (username) in Twitter',  'bugspatrol') ),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		"twitter_consumer_key" => array(
					"title" => esc_html__('Consumer Key',  'bugspatrol'),
					"desc" => wp_kses_data( __('Twitter API Consumer key',  'bugspatrol') ),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		"twitter_consumer_secret" => array(
					"title" => esc_html__('Consumer Secret',  'bugspatrol'),
					"desc" => wp_kses_data( __('Twitter API Consumer secret',  'bugspatrol') ),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		"twitter_token_key" => array(
					"title" => esc_html__('Token Key',  'bugspatrol'),
					"desc" => wp_kses_data( __('Twitter API Token key',  'bugspatrol') ),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		"twitter_token_secret" => array(
					"title" => esc_html__('Token Secret',  'bugspatrol'),
					"desc" => wp_kses_data( __('Twitter API Token secret',  'bugspatrol') ),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		
		
		
		
		//###############################
		//#### Contact info          #### 
		//###############################
		"partition_contacts" => array(
					"title" => esc_html__('Contact info', 'bugspatrol'),
					"icon" => "iconadmin-mail",
					"type" => "partition"),
		
		"info_contact_1" => array(
					"title" => esc_html__('Contact information', 'bugspatrol'),
					"desc" => wp_kses_data( __('Company address, phones and e-mail', 'bugspatrol') ),
					"type" => "info"),
		
		"contact_info" => array(
					"title" => esc_html__('Contacts in the header', 'bugspatrol'),
					"desc" => wp_kses_data( __('String with contact info in the left side of the site header', 'bugspatrol') ),
					"std" => "",
					"before" => array('icon'=>'iconadmin-home'),
					"allow_html" => true,
					"type" => "text"),
		
		"contact_open_hours" => array(
					"title" => esc_html__('Open hours in the header', 'bugspatrol'),
					"desc" => wp_kses_data( __('String with open hours in the site header', 'bugspatrol') ),
					"std" => "",
					"before" => array('icon'=>'iconadmin-clock'),
					"allow_html" => true,
					"type" => "text"),
		
		"contact_email" => array(
					"title" => esc_html__('Contact form email', 'bugspatrol'),
					"desc" => wp_kses_data( __('E-mail for send contact form and user registration data', 'bugspatrol') ),
					"std" => "",
					"before" => array('icon'=>'iconadmin-mail'),
					"type" => "text"),
		
		"contact_address_1" => array(
					"title" => esc_html__('Company address (part 1)', 'bugspatrol'),
					"desc" => wp_kses_data( __('Company country, post code and city', 'bugspatrol') ),
					"std" => "",
					"before" => array('icon'=>'iconadmin-home'),
					"type" => "text"),
		
		"contact_address_2" => array(
					"title" => esc_html__('Company address (part 2)', 'bugspatrol'),
					"desc" => wp_kses_data( __('Street and house number', 'bugspatrol') ),
					"std" => "",
					"before" => array('icon'=>'iconadmin-home'),
					"type" => "text"),
		
		"contact_phone" => array(
					"title" => esc_html__('Phone', 'bugspatrol'),
					"desc" => wp_kses_data( __('Phone number', 'bugspatrol') ),
					"std" => "",
					"before" => array('icon'=>'iconadmin-phone'),
					"allow_html" => true,
					"type" => "text"),


		
		"contact_fax" => array(
					"title" => esc_html__('Fax', 'bugspatrol'),
					"desc" => wp_kses_data( __('Fax number', 'bugspatrol') ),
					"std" => "",
					"before" => array('icon'=>'iconadmin-phone'),
					"allow_html" => true,
					"type" => "text"),
		
		"info_contact_2" => array(
					"title" => esc_html__('Contact and Comments form', 'bugspatrol'),
					"desc" => wp_kses_data( __('Maximum length of the messages in the contact form shortcode and in the comments form', 'bugspatrol') ),
					"type" => "info"),
		
		"message_maxlength_contacts" => array(
					"title" => esc_html__('Contact form message', 'bugspatrol'),
					"desc" => wp_kses_data( __("Message's maxlength in the contact form shortcode", 'bugspatrol') ),
					"std" => "1000",
					"min" => 0,
					"max" => 10000,
					"step" => 100,
					"type" => "spinner"),
		
		"message_maxlength_comments" => array(
					"title" => esc_html__('Comments form message', 'bugspatrol'),
					"desc" => wp_kses_data( __("Message's maxlength in the comments form", 'bugspatrol') ),
					"std" => "1000",
					"min" => 0,
					"max" => 10000,
					"step" => 100,
					"type" => "spinner"),
		
		"info_contact_3" => array(
					"title" => esc_html__('Default mail function', 'bugspatrol'),
					"desc" => wp_kses_data( __('What function use to send mail: the built-in Wordpress wp_mail or standard PHP mail function? Attention! Some plugins may not work with one of them and you always have the ability to switch to alternative.', 'bugspatrol') ),
					"type" => "info"),
		
		"mail_function" => array(
					"title" => esc_html__("Mail function", 'bugspatrol'),
					"desc" => wp_kses_data( __("What function use to send mail? Attention! Only wp_mail support attachment in the mail!", 'bugspatrol') ),
					"std" => "wp_mail",
					"size" => "medium",
					"options" => array(
						'wp_mail' => esc_html__('WP mail', 'bugspatrol'),
						'mail' => esc_html__('PHP mail', 'bugspatrol')
					),
					"type" => "switch"),
		
		
		
		
		
		
		
		//###############################
		//#### Search parameters     #### 
		//###############################
		"partition_search" => array(
					"title" => esc_html__('Search', 'bugspatrol'),
					"icon" => "iconadmin-search",
					"type" => "hidden"),
		
		"info_search_1" => array(
					"title" => esc_html__('Search parameters', 'bugspatrol'),
					"desc" => wp_kses_data( __('Enable/disable AJAX search and output settings for it', 'bugspatrol') ),
					"type" => "hidden"),
		
		"show_search" => array(
					"title" => esc_html__('Show search field', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show search field in the top area and side menus', 'bugspatrol') ),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "hidden"),

		"search_style" => array( 
					"title" => esc_html__('Select search style', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select style for the search field', 'bugspatrol') ),
					"std" => "default",
					"type" => "hidden",
					"options" => bugspatrol_get_options_param('list_search_styles')),
		
		"use_ajax_search" => array(
					"title" => esc_html__('Enable AJAX search', 'bugspatrol'),
					"desc" => wp_kses_data( __('Use incremental AJAX search for the search field in top of page', 'bugspatrol') ),
					"dependency" => array(
						'show_search' => array('yes'),
						'search_style' => array('default', 'slide', 'expand')
					),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"ajax_search_min_length" => array(
					"title" => esc_html__('Min search string length',  'bugspatrol'),
					"desc" => wp_kses_data( __('The minimum length of the search string',  'bugspatrol') ),
					"dependency" => array(
						'show_search' => array('yes'),
						'search_style' => array('default', 'slide', 'expand'),
						'use_ajax_search' => array('yes')
					),
					"std" => 4,
					"min" => 3,
					"type" => "spinner"),
		
		"ajax_search_delay" => array(
					"title" => esc_html__('Delay before search (in ms)',  'bugspatrol'),
					"desc" => wp_kses_data( __('How much time (in milliseconds, 1000 ms = 1 second) must pass after the last character before the start search',  'bugspatrol') ),
					"dependency" => array(
						'show_search' => array('yes'),
						'search_style' => array('default', 'slide', 'expand'),
						'use_ajax_search' => array('yes')
					),
					"std" => 500,
					"min" => 300,
					"max" => 1000,
					"step" => 100,
					"type" => "spinner"),
		
		"ajax_search_types" => array(
					"title" => esc_html__('Search area', 'bugspatrol'),
					"desc" => wp_kses_data( __('Select post types, what will be include in search results. If not selected - use all types.', 'bugspatrol') ),
					"dependency" => array(
						'show_search' => array('yes'),
						'search_style' => array('default', 'slide', 'expand'),
						'use_ajax_search' => array('yes')
					),
					"std" => "",
					"options" => bugspatrol_get_options_param('list_posts_types'),
					"multiple" => true,
					"style" => "list",
					"type" => "select"),
		
		"ajax_search_posts_count" => array(
					"title" => esc_html__('Posts number in output',  'bugspatrol'),
					"dependency" => array(
						'show_search' => array('yes'),
						'search_style' => array('default', 'slide', 'expand'),
						'use_ajax_search' => array('yes')
					),
					"desc" => wp_kses_data( __('Number of the posts to show in search results',  'bugspatrol') ),
					"std" => 5,
					"min" => 1,
					"max" => 10,
					"type" => "spinner"),
		
		"ajax_search_posts_image" => array(
					"title" => esc_html__("Show post's image", 'bugspatrol'),
					"dependency" => array(
						'show_search' => array('yes'),
						'search_style' => array('default', 'slide', 'expand'),
						'use_ajax_search' => array('yes')
					),
					"desc" => wp_kses_data( __("Show post's thumbnail in the search results", 'bugspatrol') ),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"ajax_search_posts_date" => array(
					"title" => esc_html__("Show post's date", 'bugspatrol'),
					"dependency" => array(
						'show_search' => array('yes'),
						'search_style' => array('default', 'slide', 'expand'),
						'use_ajax_search' => array('yes')
					),
					"desc" => wp_kses_data( __("Show post's publish date in the search results", 'bugspatrol') ),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"ajax_search_posts_author" => array(
					"title" => esc_html__("Show post's author", 'bugspatrol'),
					"dependency" => array(
						'show_search' => array('yes'),
						'search_style' => array('default', 'slide', 'expand'),
						'use_ajax_search' => array('yes')
					),
					"desc" => wp_kses_data( __("Show post's author in the search results", 'bugspatrol') ),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"ajax_search_posts_counters" => array(
					"title" => esc_html__("Show post's counters", 'bugspatrol'),
					"dependency" => array(
						'show_search' => array('yes'),
						'search_style' => array('default', 'slide', 'expand'),
						'use_ajax_search' => array('yes')
					),
					"desc" => wp_kses_data( __("Show post's counters (views, comments, likes) in the search results", 'bugspatrol') ),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		
		
		
		
		//###############################
		//#### Service               #### 
		//###############################
		
		"partition_service" => array(
					"title" => esc_html__('Service', 'bugspatrol'),
					"icon" => "iconadmin-wrench",
					"type" => "partition"),
		
		"info_service_1" => array(
					"title" => esc_html__('Theme functionality', 'bugspatrol'),
					"desc" => wp_kses_data( __('Basic theme functionality settings', 'bugspatrol') ),
					"type" => "info"),
		
		"use_ajax_views_counter" => array(
					"title" => esc_html__('Use AJAX post views counter', 'bugspatrol'),
					"desc" => wp_kses_data( __('Use javascript for post views count (if site work under the caching plugin) or increment views count in single page template', 'bugspatrol') ),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"allow_editor" => array(
					"title" => esc_html__('Frontend editor',  'bugspatrol'),
					"desc" => wp_kses_data( __("Allow authors to edit their posts in frontend area", 'bugspatrol') ),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),

		"admin_add_filters" => array(
					"title" => esc_html__('Additional filters in the admin panel', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show additional filters (on post formats, tags and categories) in admin panel page "Posts". <br>Attention! If you have more than 2.000-3.000 posts, enabling this option may cause slow load of the "Posts" page! If you encounter such slow down, simply open Appearance - Theme Options - Service and set "No" for this option.', 'bugspatrol') ),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),

		"show_overriden_taxonomies" => array(
					"title" => esc_html__('Show overriden options for taxonomies', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show extra column in categories list, where changed (overriden) theme options are displayed.', 'bugspatrol') ),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),

		"show_overriden_posts" => array(
					"title" => esc_html__('Show overriden options for posts and pages', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show extra column in posts and pages list, where changed (overriden) theme options are displayed.', 'bugspatrol') ),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"admin_dummy_data" => array(
					"title" => esc_html__('Enable Dummy Data Installer', 'bugspatrol'),
					"desc" => wp_kses_data( __('Show "Install Dummy Data" in the menu "Appearance". <b>Attention!</b> When you install dummy data all content of your site will be replaced!', 'bugspatrol') ),
					"std" => "yes",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),

		"admin_dummy_timeout" => array(
					"title" => esc_html__('Dummy Data Installer Timeout',  'bugspatrol'),
					"desc" => wp_kses_data( __('Web-servers set the time limit for the execution of php-scripts. By default, this is 30 sec. Therefore, the import process will be split into parts. Upon completion of each part - the import will resume automatically! The import process will try to increase this limit to the time, specified in this field.',  'bugspatrol') ),
					"std" => 120,
					"min" => 30,
					"max" => 1800,
					"type" => "spinner"),
		
		"admin_emailer" => array(
					"title" => esc_html__('Enable Emailer in the admin panel', 'bugspatrol'),
					"desc" => wp_kses_data( __('Allow to use BugsPatrol Emailer for mass-volume e-mail distribution and management of mailing lists in "Appearance - Emailer"', 'bugspatrol') ),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "hidden"),

		"admin_po_composer" => array(
					"title" => esc_html__('Enable PO Composer in the admin panel', 'bugspatrol'),
					"desc" => wp_kses_data( __('Allow to use "PO Composer" for edit language files in this theme (in the "Appearance - PO Composer")', 'bugspatrol') ),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "hidden"),
		
		"debug_mode" => array(
					"title" => esc_html__('Debug mode', 'bugspatrol'),
					"desc" => wp_kses_data( __('In debug mode we are using unpacked scripts and styles, else - using minified scripts and styles (if present). <b>Attention!</b> If you have modified the source code in the js or css files, regardless of this option will be used latest (modified) version stylesheets and scripts. You can re-create minified versions of files using on-line services or utilities', 'bugspatrol') ),
					"std" => "no",
					"options" => bugspatrol_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		
		"info_service_2" => array(
					"title" => esc_html__('API Keys', 'bugspatrol'),
					"desc" => wp_kses_data( __('API Keys for some Web services', 'bugspatrol') ),
					"type" => "info"),
		'api_google' => array(
					"title" => esc_html__('Google API Key', 'bugspatrol'),
					"desc" => wp_kses_data( __("Insert Google API Key for browsers into the field above to generate Google Maps", 'bugspatrol') ),
					"std" => "",
					"type" => "text")
		));

	}
}


// Update all temporary vars (start with $bugspatrol_) in the Theme Options with actual lists
if ( !function_exists( 'bugspatrol_options_settings_theme_setup2' ) ) {
	add_action( 'bugspatrol_action_after_init_theme', 'bugspatrol_options_settings_theme_setup2', 1 );
	function bugspatrol_options_settings_theme_setup2() {
		if (bugspatrol_options_is_used()) {
			// Replace arrays with actual parameters
			$lists = array();
			$tmp = bugspatrol_storage_get('options');
			if (is_array($tmp) && count($tmp) > 0) {
				$prefix = '$bugspatrol_';
				$prefix_len = bugspatrol_strlen($prefix);
				foreach ($tmp as $k=>$v) {
					if (isset($v['options']) && is_array($v['options']) && count($v['options']) > 0) {
						foreach ($v['options'] as $k1=>$v1) {
							if (bugspatrol_substr($k1, 0, $prefix_len) == $prefix || bugspatrol_substr($v1, 0, $prefix_len) == $prefix) {
								$list_func = bugspatrol_substr(bugspatrol_substr($k1, 0, $prefix_len) == $prefix ? $k1 : $v1, 1);
								$inherit = strpos($list_func, '(true)')!==false;
								$list_func = str_replace('(true)', '', $list_func);
								unset($tmp[$k]['options'][$k1]);
								if (isset($lists[$list_func]))
									$tmp[$k]['options'] = bugspatrol_array_merge($tmp[$k]['options'], $lists[$list_func]);
								else {
									if (function_exists($list_func)) {
										$tmp[$k]['options'] = $lists[$list_func] = bugspatrol_array_merge($tmp[$k]['options'], $list_func($inherit));
								   	} else
                                        bugspatrol_dfl(sprintf(esc_html__('Wrong function name %s in the theme options array', 'bugspatrol'), $list_func));
								}
							}
						}
					}
				}
				bugspatrol_storage_set('options', $tmp);
			}
		}
	}
}



// Reset old Theme Options while theme first run
if ( !function_exists( 'bugspatrol_options_reset' ) ) {
		function bugspatrol_options_reset($clear=true) {
		$theme_slug = str_replace(' ', '_', trim(bugspatrol_strtolower(get_stylesheet())));
		$option_name = bugspatrol_storage_get('options_prefix') . '_' . trim($theme_slug) . '_options_reset';
		if ( get_option($option_name, false) === false ) {				if ($clear) {
				// Remove Theme Options from WP Options
				global $wpdb;
				$wpdb->query( $wpdb->prepare(
										"DELETE FROM {$wpdb->options} WHERE option_name LIKE %s",
										bugspatrol_storage_get('options_prefix').'_%'
										)
							);
				// Add Templates Options
                $txt = bugspatrol_fgc(bugspatrol_storage_get('demo_data_url') . 'default/templates_options.txt');
				if (!empty($txt)) {
					$data = bugspatrol_unserialize($txt);
					// Replace upload url in options
					if (is_array($data) && count($data) > 0) {
						foreach ($data as $k=>$v) {
							if (is_array($v) && count($v) > 0) {
								foreach ($v as $k1=>$v1) {
									$v[$k1] = bugspatrol_replace_uploads_url(bugspatrol_replace_uploads_url($v1, 'uploads'), 'imports');
								}
							}
							add_option( $k, $v, '', 'yes' );
						}
					}
				}
			}
			add_option($option_name, 1, '', 'yes');
		}
	}
}
?>