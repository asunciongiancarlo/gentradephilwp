<?php
/**
 * Theme custom styles
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if (!function_exists('bugspatrol_action_theme_styles_theme_setup')) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_action_theme_styles_theme_setup', 1 );
	function bugspatrol_action_theme_styles_theme_setup() {
	
		// Add theme fonts in the used fonts list
		add_filter('bugspatrol_filter_used_fonts',			'bugspatrol_filter_theme_styles_used_fonts');
		// Add theme fonts (from Google fonts) in the main fonts list (if not present).
		add_filter('bugspatrol_filter_list_fonts',			'bugspatrol_filter_theme_styles_list_fonts');

		// Add theme stylesheets
		add_action('bugspatrol_action_add_styles',			'bugspatrol_action_theme_styles_add_styles');
		// Add theme inline styles
		add_filter('bugspatrol_filter_add_styles_inline',		'bugspatrol_filter_theme_styles_add_styles_inline');

		// Add theme scripts
		add_action('bugspatrol_action_add_scripts',			'bugspatrol_action_theme_styles_add_scripts');
		// Add theme scripts inline
		add_filter('bugspatrol_filter_localize_script',		'bugspatrol_filter_theme_styles_localize_script');

		// Add theme less files into list for compilation
		add_filter('bugspatrol_filter_compile_less',			'bugspatrol_filter_theme_styles_compile_less');


		// Add color schemes
		bugspatrol_add_color_scheme('original', array(

			'title'					=> esc_html__('Original', 'bugspatrol'),
			
			// Whole block border and background
			'bd_color'				=> '#eae9e8',       //
			'bg_color'				=> '#ffffff',       //
			
			// Headers, text and links colors
			'text'					=> '#8f8f8f',       //
			'text_light'			=> '#b1b1b1',       //
			'text_dark'				=> '#3a3a3a',       //
			'text_link'				=> '#e2bb4c',       //
			'text_hover'			=> '#d1ab3f',       //

			// Inverse colors
			'inverse_text'			=> '#ffffff',       //
			'inverse_light'			=> '#f7f6f5',       //
			'inverse_dark'			=> '#ffffff',
			'inverse_link'			=> '#64ab68',       //
			'inverse_hover'			=> '#f5f5f5',       //
		
			// Input fields
			'input_text'			=> '#8a8a8a',
			'input_light'			=> '#acb4b6',
			'input_dark'			=> '#232a34',
			'input_bd_color'		=> '#dddddd',
			'input_bd_hover'		=> '#bbbbbb',
			'input_bg_color'		=> '#f7f7f7',
			'input_bg_hover'		=> '#f0f0f0',
		
			// Alternative blocks (submenu items, etc.)
			'alter_text'			=> '#ebebeb',       //
			'alter_light'			=> '#acb4b6',
			'alter_dark'			=> '#232a34',
			'alter_link'			=> '#20c7ca',
			'alter_hover'			=> '#189799',
			'alter_bd_color'		=> '#2f2f2f',       //
			'alter_bd_hover'		=> '#eeeeee',       //
			'alter_bg_color'		=> '#f7f7f7',
			'alter_bg_hover'		=> '#f0f0f0',
			)
		);


        // Add color schemes
        bugspatrol_add_color_scheme('sea', array(

                'title'					=> esc_html__('Sea', 'bugspatrol'),

                // Whole block border and background
                'bd_color'				=> '#eae9e8',       //
                'bg_color'				=> '#ffffff',       //

                // Headers, text and links colors
                'text'					=> '#8f8f8f',       //
                'text_light'			=> '#b1b1b1',       //
                'text_dark'				=> '#3a3a3a',       //
                'text_link'				=> '#ff864c',       //
                'text_hover'			=> '#ff7240',       //

                // Inverse colors
                'inverse_text'			=> '#ffffff',       //
                'inverse_light'			=> '#f7f6f5',       //
                'inverse_dark'			=> '#ffffff',
                'inverse_link'			=> '#11b0a3',       //
                'inverse_hover'			=> '#f5f5f5',       //

                // Input fields
                'input_text'			=> '#8a8a8a',
                'input_light'			=> '#acb4b6',
                'input_dark'			=> '#232a34',
                'input_bd_color'		=> '#dddddd',
                'input_bd_hover'		=> '#bbbbbb',
                'input_bg_color'		=> '#f7f7f7',
                'input_bg_hover'		=> '#f0f0f0',

                // Alternative blocks (submenu items, etc.)
                'alter_text'			=> '#ebebeb',       //
                'alter_light'			=> '#acb4b6',
                'alter_dark'			=> '#232a34',
                'alter_link'			=> '#20c7ca',
                'alter_hover'			=> '#189799',
                'alter_bd_color'		=> '#2f2f2f',       //
                'alter_bd_hover'		=> '#eeeeee',       //
                'alter_bg_color'		=> '#f7f7f7',
                'alter_bg_hover'		=> '#f0f0f0',
            )
        );

        // Add color schemes
        bugspatrol_add_color_scheme('marsalo', array(

                'title'					=> esc_html__('Marsalo', 'bugspatrol'),

                // Whole block border and background
                'bd_color'				=> '#eae9e8',       //
                'bg_color'				=> '#ffffff',       //

                // Headers, text and links colors
                'text'					=> '#8f8f8f',       //
                'text_light'			=> '#b1b1b1',       //
                'text_dark'				=> '#3a3a3a',       //
                'text_link'				=> '#da373b',       //
                'text_hover'			=> '#cf282c',       //

                // Inverse colors
                'inverse_text'			=> '#ffffff',       //
                'inverse_light'			=> '#f7f6f5',       //
                'inverse_dark'			=> '#ffffff',
                'inverse_link'			=> '#1d628c',       //
                'inverse_hover'			=> '#f5f5f5',       //

                // Input fields
                'input_text'			=> '#8a8a8a',
                'input_light'			=> '#acb4b6',
                'input_dark'			=> '#232a34',
                'input_bd_color'		=> '#dddddd',
                'input_bd_hover'		=> '#bbbbbb',
                'input_bg_color'		=> '#f7f7f7',
                'input_bg_hover'		=> '#f0f0f0',

                // Alternative blocks (submenu items, etc.)
                'alter_text'			=> '#ebebeb',       //
                'alter_light'			=> '#acb4b6',
                'alter_dark'			=> '#232a34',
                'alter_link'			=> '#20c7ca',
                'alter_hover'			=> '#189799',
                'alter_bd_color'		=> '#2f2f2f',       //
                'alter_bd_hover'		=> '#eeeeee',       //
                'alter_bg_color'		=> '#f7f7f7',
                'alter_bg_hover'		=> '#f0f0f0',
            )
        );


        // Add color schemes
        bugspatrol_add_color_scheme('blue', array(

                'title'					=> esc_html__('Blue', 'bugspatrol'),

                // Whole block border and background
                'bd_color'				=> '#eae9e8',       //
                'bg_color'				=> '#ffffff',       //

                // Headers, text and links colors
                'text'					=> '#8f8f8f',       //
                'text_light'			=> '#b1b1b1',       //
                'text_dark'				=> '#3a3a3a',       //
                'text_link'				=> '#4586c4',       //
                'text_hover'			=> '#3972bb',       //

                // Inverse colors
                'inverse_text'			=> '#ffffff',       //
                'inverse_light'			=> '#f7f6f5',       //
                'inverse_dark'			=> '#ffffff',
                'inverse_link'			=> '#00764e',       //
                'inverse_hover'			=> '#f5f5f5',       //

                // Input fields
                'input_text'			=> '#8a8a8a',
                'input_light'			=> '#acb4b6',
                'input_dark'			=> '#232a34',
                'input_bd_color'		=> '#dddddd',
                'input_bd_hover'		=> '#bbbbbb',
                'input_bg_color'		=> '#f7f7f7',
                'input_bg_hover'		=> '#f0f0f0',

                // Alternative blocks (submenu items, etc.)
                'alter_text'			=> '#ebebeb',       //
                'alter_light'			=> '#acb4b6',
                'alter_dark'			=> '#232a34',
                'alter_link'			=> '#20c7ca',
                'alter_hover'			=> '#189799',
                'alter_bd_color'		=> '#2f2f2f',       //
                'alter_bd_hover'		=> '#eeeeee',       //
                'alter_bg_color'		=> '#f7f7f7',
                'alter_bg_hover'		=> '#f0f0f0',
            )
        );

		/* Font slugs:
		h1 ... h6	- headers
		p			- plain text
		link		- links
		info		- info blocks (Posted 15 May, 2015 by John Doe)
		menu		- main menu
		submenu		- dropdown menus
		logo		- logo text
		button		- button's caption
		input		- input fields
		*/

		// Add Custom fonts
		bugspatrol_add_custom_font('h1', array(
			'title'			=> esc_html__('Heading 1', 'bugspatrol'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '3.5714em',
			'font-weight'	=> '400',
			'font-style'	=> '',
			'line-height'	=> '1.11em',
			'margin-top'	=> '2.26em',
			'margin-bottom'	=> '0.32em'
			)
		);
		bugspatrol_add_custom_font('h2', array(
			'title'			=> esc_html__('Heading 2', 'bugspatrol'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '2.5714em',
			'font-weight'	=> '400',
			'font-style'	=> '',
			'line-height'	=> '1.4em',
			'margin-top'	=> '3.2em',
			'margin-bottom'	=> '1.05em'
			)
		);
		bugspatrol_add_custom_font('h3', array(
			'title'			=> esc_html__('Heading 3', 'bugspatrol'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '1.715em',
			'font-weight'	=> '400',
			'font-style'	=> '',
			'line-height'	=> '1.33333em',
			'margin-top'	=> '4.95em',
			'margin-bottom'	=> '1.15em'
			)
		);
		bugspatrol_add_custom_font('h4', array(
			'title'			=> esc_html__('Heading 4', 'bugspatrol'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '1.42857em',
			'font-weight'	=> '400',
			'font-style'	=> '',
			'line-height'	=> '1.5em',
			'margin-top'	=> '6em',
			'margin-bottom'	=> '1.8em'
			)
		);
		bugspatrol_add_custom_font('h5', array(
			'title'			=> esc_html__('Heading 5', 'bugspatrol'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '1.42857em',
			'font-weight'	=> '400',
			'font-style'	=> '',
			'line-height'	=> '1.5em',
			'margin-top'	=> '6em',
			'margin-bottom'	=> '1.8em'
			)
		);
		bugspatrol_add_custom_font('h6', array(
			'title'			=> esc_html__('Heading 6', 'bugspatrol'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '1.07em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '1.34em',
			'margin-top'	=> '8.15em',
			'margin-bottom'	=> '0.8em'
			)
		);
		bugspatrol_add_custom_font('p', array(
			'title'			=> esc_html__('Text', 'bugspatrol'),
			'description'	=> '',
			'font-family'	=> 'Lato',
			'font-size' 	=> '14px',
			'font-weight'	=> '400',
			'font-style'	=> '',
			'line-height'	=> '1.5715em',
			'margin-top'	=> '',
			'margin-bottom'	=> '1em'
			)
		);
		bugspatrol_add_custom_font('link', array(
			'title'			=> esc_html__('Links', 'bugspatrol'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '',
			'font-weight'	=> '',
			'font-style'	=> ''
			)
		);
		bugspatrol_add_custom_font('info', array(
			'title'			=> esc_html__('Post info', 'bugspatrol'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '12px',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '1.2857em',
			'margin-top'	=> '',
			'margin-bottom'	=> '3em'
			)
		);
		bugspatrol_add_custom_font('menu', array(
			'title'			=> esc_html__('Main menu items', 'bugspatrol'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '1.071em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '1.2857em',
			'margin-top'	=> '0.65em',
			'margin-bottom'	=> '0.65em'
			)
		);
		bugspatrol_add_custom_font('submenu', array(
			'title'			=> esc_html__('Dropdown menu items', 'bugspatrol'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '1.071em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '1.2857em',
			'margin-top'	=> '0.7em',
			'margin-bottom'	=> '0.7em'
			)
		);
		bugspatrol_add_custom_font('logo', array(
			'title'			=> esc_html__('Logo', 'bugspatrol'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '1.6428em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '0.75em',
			'margin-top'	=> '1.9em',
			'margin-bottom'	=> '1.8em'
			)
		);
		bugspatrol_add_custom_font('button', array(
			'title'			=> esc_html__('Buttons', 'bugspatrol'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '1.07em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '1.2857em'
			)
		);
		bugspatrol_add_custom_font('input', array(
			'title'			=> esc_html__('Input fields', 'bugspatrol'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '1.07em',
			'font-weight'	=> '',
			'font-style'	=> '',
			'line-height'	=> '1.2857em'
			)
		);

	}
}





//------------------------------------------------------------------------------
// Theme fonts
//------------------------------------------------------------------------------

// Add theme fonts in the used fonts list
if (!function_exists('bugspatrol_filter_theme_styles_used_fonts')) {
		function bugspatrol_filter_theme_styles_used_fonts($theme_fonts) {
		$theme_fonts['Lato'] = 1;
		return $theme_fonts;
	}
}

// Add theme fonts (from Google fonts) in the main fonts list (if not present).
// To use custom font-face you not need add it into list in this function
if (!function_exists('bugspatrol_filter_theme_styles_list_fonts')) {
		function bugspatrol_filter_theme_styles_list_fonts($list) {
		// Example:
																if (!isset($list['Lato']))	$list['Lato'] = array('family'=>'sans-serif');
		return $list;
	}
}



//------------------------------------------------------------------------------
// Theme stylesheets
//------------------------------------------------------------------------------

// Add theme.less into list files for compilation
if (!function_exists('bugspatrol_filter_theme_styles_compile_less')) {
		function bugspatrol_filter_theme_styles_compile_less($files) {
		if (file_exists(bugspatrol_get_file_dir('css/theme.less'))) {
		 	$files[] = bugspatrol_get_file_dir('css/theme.less');
		}
		return $files;	
	}
}

// Add theme stylesheets
if (!function_exists('bugspatrol_action_theme_styles_add_styles')) {
		function bugspatrol_action_theme_styles_add_styles() {
		// Add stylesheet files only if LESS supported
		if ( bugspatrol_get_theme_setting('less_compiler') != 'no' ) {
			wp_enqueue_style( 'bugspatrol-theme-style', bugspatrol_get_file_url('css/theme.css'), array(), null );
			wp_add_inline_style( 'bugspatrol-theme-style', bugspatrol_get_inline_css() );
		}
	}
}

// Add theme inline styles
if (!function_exists('bugspatrol_filter_theme_styles_add_styles_inline')) {
		function bugspatrol_filter_theme_styles_add_styles_inline($custom_style) {
		// Todo: add theme specific styles in the $custom_style to override
		
		// Submenu width
		$menu_width = bugspatrol_get_theme_option('menu_width');
		if (!empty($menu_width)) {
			$custom_style .= "
				/* Submenu width */
				.menu_side_nav > li ul,
				.menu_main_nav > li ul {
					width: ".intval($menu_width)."px;
				}
				.menu_side_nav > li > ul ul,
				.menu_main_nav > li > ul ul {
					left:".intval($menu_width+4)."px;
				}
				.menu_side_nav > li > ul ul.submenu_left,
				.menu_main_nav > li > ul ul.submenu_left {
					left:-".intval($menu_width+1)."px;
				}
			";
		}
	
		// Logo height
		$logo_height = bugspatrol_get_custom_option('logo_height');
		if (!empty($logo_height)) {
			$custom_style .= "
				/* Logo header height */
				.sidebar_outer_logo .logo_main,
				.top_panel_wrap .logo_main,
				.top_panel_wrap .logo_fixed {
					height:".intval($logo_height)."px;
				}
			";
		}
	
		// Logo top offset
		$logo_offset = bugspatrol_get_custom_option('logo_offset');
		if (!empty($logo_offset)) {
			$custom_style .= "
				/* Logo header top offset */
				.top_panel_wrap .logo {
					margin-top:".intval($logo_offset)."px;
				}
			";
		}

		// Logo footer height
		$logo_height = bugspatrol_get_theme_option('logo_footer_height');
		if (!empty($logo_height)) {
			$custom_style .= "
				/* Logo footer height */
				.contacts_wrap .logo img {
					height:".intval($logo_height)."px;
				}
			";
		}

		// Custom css from theme options
		$custom_style .= bugspatrol_get_custom_option('custom_css');

		return $custom_style;	
	}
}


//------------------------------------------------------------------------------
// Theme scripts
//------------------------------------------------------------------------------

// Add theme scripts
if (!function_exists('bugspatrol_action_theme_styles_add_scripts')) {
		function bugspatrol_action_theme_styles_add_scripts() {
		if (bugspatrol_get_theme_option('show_theme_customizer') == 'yes' && file_exists(bugspatrol_get_file_dir('js/theme.customizer.js')))
			wp_enqueue_script( 'bugspatrol-theme-styles-customizer-script', bugspatrol_get_file_url('js/theme.customizer.js'), array(), null, true );
	}
}

// Add theme scripts inline
if (!function_exists('bugspatrol_filter_theme_styles_localize_script')) {
		function bugspatrol_filter_theme_styles_localize_script($vars) {
		if (empty($vars['theme_font']))
			$vars['theme_font'] = bugspatrol_get_custom_font_settings('p', 'font-family');
		$vars['theme_color'] = bugspatrol_get_scheme_color('text_dark');
		$vars['theme_bg_color'] = bugspatrol_get_scheme_color('bg_color');
		return $vars;
	}
}
?>