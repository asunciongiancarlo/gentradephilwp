<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'bugspatrol_template_header_1_theme_setup' ) ) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_template_header_1_theme_setup', 1 );
	function bugspatrol_template_header_1_theme_setup() {
		bugspatrol_add_template(array(
			'layout' => 'header_1',
			'mode'   => 'header',
			'title'  => esc_html__('Header 1', 'bugspatrol'),
			'icon'   => bugspatrol_get_file_url('templates/headers/images/1.jpg')
			));
	}
}

// Template output
if ( !function_exists( 'bugspatrol_template_header_1_output' ) ) {
	function bugspatrol_template_header_1_output($post_options, $post_data) {

		// WP custom header
		$header_css = '';
		if ($post_options['position'] != 'over') {
			$header_image = get_header_image();
			$header_css = $header_image!='' 
				? ' style="background-image: url('.esc_url($header_image).')"' 
				: '';
		}
		?>
		
		<div class="top_panel_fixed_wrap"></div>

		<header class="top_panel_wrap top_panel_style_1 scheme_<?php echo esc_attr($post_options['scheme']); ?>">
			<div class="top_panel_wrap_inner top_panel_inner_style_1 top_panel_position_<?php echo esc_attr(bugspatrol_get_custom_option('top_panel_position')); ?>">
			<div class="top_panel_middle" <?php bugspatrol_show_layout($header_css); ?>>
				<div class="content_wrap">
					<div class="columns_wrap columns_fluid">
						<div class="column-2_5 contact_logo">
							<?php bugspatrol_show_logo(); ?>
						</div><?php
						// Address
						$contact_address_1=trim(bugspatrol_get_custom_option('contact_address_1'));
						$contact_address_2=trim(bugspatrol_get_custom_option('contact_address_2'));
						if (!empty($contact_address_1) || !empty($contact_address_2)) {
							?><div class="column-1_5 contact_field contact_address">
								<span class="contact_icon icon-home-1"></span>
								<span class="contact_label contact_address_1"><?php echo wp_kses_data(trim($contact_address_1)); ?></span>
								<span class="contact_address_2"><?php echo wp_kses_data(trim($contact_address_2)); ?></span>
							</div><?php
						}
						
						// Phone and email
						$contact_phone=trim(bugspatrol_get_custom_option('contact_phone'));
						$contact_email=trim(bugspatrol_get_custom_option('contact_email'));
						if (!empty($contact_phone) || !empty($contact_email)) {
							?><div class="column-1_5 contact_field contact_phone">
								<span class="contact_icon icon-phone-1"></span>
								<span class="contact_label contact_phone"><?php
                                    echo wp_kses_data(bugspatrol_get_custom_option('contact_phone_text'));
                                    echo '<br>';
                                    echo trim('<a href="tel:'.$contact_phone.'">'.$contact_phone.'</a>'); ?></span>
							</div><?php
						}


                        // Woocommerce Cart
                        if (bugspatrol_get_custom_option('show_header_button')=='yes' && bugspatrol_get_custom_option('header_button_text') != '' && bugspatrol_get_custom_option('header_button_link') != '') {

                            ?><a class="sc_button sc_button_style_filled sc_button_size_small" href="<?php echo wp_kses_data(trim(trim(bugspatrol_get_custom_option('header_button_link'))));?>"><?php echo wp_kses_data(trim(trim(bugspatrol_get_custom_option('header_button_text'))));?></a><?php
                        }
                        ?></div>
				</div>
			</div>

			<div class="top_panel_bottom">
				<div class="content_wrap clearfix">
					<nav class="menu_main_nav_area menu_hover_<?php echo esc_attr(bugspatrol_get_theme_option('menu_hover')); ?>">
						<?php
						$menu_main = bugspatrol_get_nav_menu('menu_main');
						if (empty($menu_main)) $menu_main = bugspatrol_get_nav_menu();
						bugspatrol_show_layout($menu_main);
						?>
					</nav>
					<?php
                    if (function_exists('bugspatrol_exists_woocommerce') && bugspatrol_exists_woocommerce() && (bugspatrol_is_woocommerce_page() && bugspatrol_get_custom_option('show_cart')=='shop' || bugspatrol_get_custom_option('show_cart')=='always') && !(is_checkout() || is_cart() || defined('WOOCOMMERCE_CHECKOUT') || defined('WOOCOMMERCE_CART'))) {
                        ?>
                        <div class="menu_main_cart top_panel_icon">
                            <?php get_template_part(bugspatrol_get_file_slug('templates/headers/_parts/contact-info-cart.php')); ?>
                        </div>
                    <?php
                    }
                    ?>
				</div>
			</div>

			</div>
		</header>

		<?php
		bugspatrol_storage_set('header_mobile', array(
			 'open_hours' => false,
			 'login' => false,
			 'socials' => false,
			 'bookmarks' => false,
			 'contact_address' => false,
			 'contact_phone_email' => false,
			 'woo_cart' => false,
			 'search' => false
			)
		);
	}
}
?>