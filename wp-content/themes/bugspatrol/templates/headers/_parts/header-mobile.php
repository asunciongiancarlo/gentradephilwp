<?php
$header_options = bugspatrol_storage_get('header_mobile');
$contact_address_1 = trim(bugspatrol_get_custom_option('contact_address_1'));
$contact_address_2 = trim(bugspatrol_get_custom_option('contact_address_2'));
$contact_phone = trim(bugspatrol_get_custom_option('contact_phone'));
$contact_email = trim(bugspatrol_get_custom_option('contact_email'));
?>
	<div class="header_mobile">
		<div class="content_wrap">
			<div class="menu_button icon-menu"></div>
			<?php 
			bugspatrol_show_logo(); 
			if ($header_options['woo_cart']){
				if (function_exists('bugspatrol_exists_woocommerce') && bugspatrol_exists_woocommerce() && (bugspatrol_is_woocommerce_page() && bugspatrol_get_custom_option('show_cart')=='shop' || bugspatrol_get_custom_option('show_cart')=='always') && !(is_checkout() || is_cart() || defined('WOOCOMMERCE_CHECKOUT') || defined('WOOCOMMERCE_CART'))) { 
					?>
					<div class="menu_main_cart top_panel_icon">
						<?php get_template_part(bugspatrol_get_file_slug('templates/headers/_parts/contact-info-cart.php')); ?>
					</div>
					<?php
				}
			}
			?>
		</div>
		<div class="side_wrap">
			<div class="close"><?php esc_html_e('Close', 'bugspatrol'); ?></div>
			<div class="panel_top">
				<nav class="menu_main_nav_area">
					<?php
						$menu_main = bugspatrol_get_nav_menu('menu_main');
						if (empty($menu_main)) $menu_main = bugspatrol_get_nav_menu();
						$menu_main = bugspatrol_set_tag_attrib($menu_main, '<ul>', 'id', 'menu_mobile');
						bugspatrol_show_layout($menu_main);
					?>
				</nav>
			</div>
			
			<?php if ($header_options['contact_address'] || $header_options['contact_phone_email'] || $header_options['open_hours']) { ?>
			<div class="panel_middle">
				<?php
				if ($header_options['contact_address'] && (!empty($contact_address_1) || !empty($contact_address_2))) {
					?><div class="contact_field contact_address">
								<span class="contact_icon icon-home"></span>
								<span class="contact_label contact_address_1"><?php echo wp_kses_data(trim($contact_address_1)); ?></span>
								<span class="contact_address_2"><?php echo wp_kses_data(trim($contact_address_2)); ?></span>
							</div><?php
				}
						
				if ($header_options['contact_phone_email'] && (!empty($contact_phone) || !empty($contact_email))) {
					?><div class="contact_field contact_phone">
						<span class="contact_icon icon-phone"></span>
						<span class="contact_label contact_phone"><?php echo wp_kses_data(trim($contact_phone)); ?></span>
						<span class="contact_email"><?php echo wp_kses_data(trim($contact_email)); ?></span>
					</div><?php
				}
				
				bugspatrol_template_set_args('top-panel-top', array(
					'menu_user_id' => 'menu_user_mobile',
					'top_panel_top_components' => array(
						($header_options['open_hours'] ? 'open_hours' : '')
					)
				));
				get_template_part(bugspatrol_get_file_slug('templates/headers/_parts/top-panel-top.php'));
				?>
			</div>
			<?php } ?>

			<div class="panel_bottom">
				<?php if ($header_options['socials'] && bugspatrol_get_custom_option('show_socials')=='yes') { ?>
					<div class="contact_socials">
						<?php bugspatrol_show_layout(bugspatrol_sc_socials(array('size'=>'small'))); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="mask"></div>
	</div>