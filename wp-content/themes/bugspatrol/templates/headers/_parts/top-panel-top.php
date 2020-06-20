<?php 
// Get template args
extract(bugspatrol_template_get_args('top-panel-top'));

if (in_array('contact_info', $top_panel_top_components) && ($contact_info=trim(bugspatrol_get_custom_option('contact_info')))!='') {
	?>
	<div class="top_panel_top_contact_area">
		<?php echo wp_kses_data(trim($contact_info)); ?>
	</div>
	<?php
}
?>

<?php
if (in_array('phone', $top_panel_top_components) && ($phone=trim(bugspatrol_get_custom_option('contact_phone')))!='') {
	?>
	<div class="top_panel_top_phone_area"><?php
        echo wp_kses_data(trim(trim(bugspatrol_get_custom_option('contact_phone_text'))));
        echo ' ';
        echo trim('<a href="tel:'.$phone.'">'.$phone.'</a>'); ?></div>
	<?php
}
?>

<div class="top_panel_top_user_area">
	<?php
	if (in_array('socials', $top_panel_top_components) && bugspatrol_get_custom_option('show_socials')=='yes') {
		?>
		<div class="top_panel_top_socials">
			<?php bugspatrol_show_layout(bugspatrol_sc_socials(array('size'=>'tiny'))); ?>
		</div>
		<?php
	}

	if (in_array('search', $top_panel_top_components) && bugspatrol_get_custom_option('show_search')=='yes') {
		?>
		<div class="top_panel_top_search"><?php bugspatrol_show_layout(bugspatrol_sc_search(array('state' => bugspatrol_get_theme_option('search_style')=='default' ? 'fixed' : 'closed'))); ?></div>
		<?php
	}

	$menu_user = bugspatrol_get_nav_menu('menu_user');
	if (empty($menu_user)) {
		?>
		<ul id="<?php echo (!empty($menu_user_id) ? esc_attr($menu_user_id) : 'menu_user'); ?>" class="menu_user_nav">
		<?php
	} else {
		$menu = bugspatrol_substr($menu_user, 0, bugspatrol_strlen($menu_user)-5);
		$pos = bugspatrol_strpos($menu, '<ul');
		if ($pos!==false && bugspatrol_strpos($menu, 'menu_user_nav')===false)
			$menu = bugspatrol_substr($menu, 0, $pos+3) . ' class="menu_user_nav"' . bugspatrol_substr($menu, $pos+3);
		if (!empty($menu_user_id))
			$menu = bugspatrol_set_tag_attrib($menu, '<ul>', 'id', $menu_user_id);
		echo str_replace('class=""', '', $menu);
	}
	

	if (in_array('currency', $top_panel_top_components) && function_exists('bugspatrol_is_woocommerce_page') && bugspatrol_is_woocommerce_page() && bugspatrol_get_custom_option('show_currency')=='yes') {
		?>
		<li class="menu_user_currency">
			<a href="#">$</a>
			<ul>
				<li><a href="#"><b>&#36;</b> <?php esc_html_e('Dollar', 'bugspatrol'); ?></a></li>
				<li><a href="#"><b>&euro;</b> <?php esc_html_e('Euro', 'bugspatrol'); ?></a></li>
				<li><a href="#"><b>&pound;</b> <?php esc_html_e('Pounds', 'bugspatrol'); ?></a></li>
			</ul>
		</li>
		<?php
	}

	if (in_array('language', $top_panel_top_components) && bugspatrol_get_custom_option('show_languages')=='yes' && function_exists('icl_get_languages')) {
		$languages = icl_get_languages('skip_missing=1');
		if (!empty($languages) && is_array($languages)) {
			$lang_list = '';
			$lang_active = '';
			foreach ($languages as $lang) {
				$lang_title = esc_attr($lang['translated_name']);					if ($lang['active']) {
					$lang_active = $lang_title;
				}
				$lang_list .= "\n"
					.'<li><a rel="alternate" hreflang="' . esc_attr($lang['language_code']) . '" href="' . esc_url(apply_filters('WPML_filter_link', $lang['url'], $lang)) . '">'
						.'<img src="' . esc_url($lang['country_flag_url']) . '" alt="' . esc_attr($lang_title) . '" title="' . esc_attr($lang_title) . '" />'
						. ($lang_title)
					.'</a></li>';
			}
			?>
			<li class="menu_user_language">
				<a href="#"><span><?php bugspatrol_show_layout($lang_active); ?></span></a>
				<ul><?php bugspatrol_show_layout($lang_list); ?></ul>
			</li>
			<?php
		}
	}

	if (in_array('bookmarks', $top_panel_top_components) && bugspatrol_get_custom_option('show_bookmarks')=='yes') {
		// Load core messages
		bugspatrol_enqueue_messages();
		?>
		<li class="menu_user_bookmarks"><a href="#" class="bookmarks_show icon-star" title="<?php esc_attr_e('Show bookmarks', 'bugspatrol'); ?>"><?php esc_html_e('Bookmarks', 'bugspatrol'); ?></a>
		<?php 
			$list = bugspatrol_get_value_gpc('bugspatrol_bookmarks', '');
			if (!empty($list)) $list = json_decode($list, true);
			?>
			<ul class="bookmarks_list">
				<li><a href="#" class="bookmarks_add icon-star-empty" title="<?php esc_attr_e('Add the current page into bookmarks', 'bugspatrol'); ?>"><?php esc_html_e('Add bookmark', 'bugspatrol'); ?></a></li>
				<?php 
				if (!empty($list) && is_array($list)) {
					foreach ($list as $bm) {
						echo '<li><a href="'.esc_url($bm['url']).'" class="bookmarks_item">'.($bm['title']).'<span class="bookmarks_delete icon-cancel" title="'.esc_attr__('Delete this bookmark', 'bugspatrol').'"></span></a></li>';
					}
				}
				?>
			</ul>
		</li>
		<?php 
	}

	if (in_array('login', $top_panel_top_components) && bugspatrol_get_custom_option('show_login')=='yes') {
        if ( !is_user_logged_in() ) {
            // Load core messages
            bugspatrol_enqueue_messages();
            // Load Popup engine
            bugspatrol_enqueue_popup();
            // Anyone can register ?
            if ( (int) get_option('users_can_register') > 0) {
                ?><li class="menu_user_register"><?php do_action('trx_utils_action_register'); ?></li><?php
            }
            ?><li class="menu_user_login"><?php do_action('trx_utils_action_login'); ?></li><?php
        } else {
			$current_user = wp_get_current_user();
			?>
			<li class="menu_user_controls">
				<a href="#"><?php
					$user_avatar = '';
					$mult = bugspatrol_get_retina_multiplier();
					if ($current_user->user_email) $user_avatar = get_avatar($current_user->user_email, 16*$mult);
					if ($user_avatar) {
						?><span class="user_avatar"><?php bugspatrol_show_layout($user_avatar); ?></span><?php
					}?><span class="user_name"><?php bugspatrol_show_layout($current_user->display_name); ?></span></a>
				<ul>
					<?php if (current_user_can('publish_posts')) { ?>
					<li><a href="<?php echo esc_url(home_url('/')); ?>/wp-admin/post-new.php?post_type=post" class="icon icon-doc"><?php esc_html_e('New post', 'bugspatrol'); ?></a></li>
					<?php } ?>
					<li><a href="<?php echo get_edit_user_link(); ?>" class="icon icon-cog"><?php esc_html_e('Settings', 'bugspatrol'); ?></a></li>
				</ul>
			</li>
			<li class="menu_user_logout"><a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>" class="icon icon-logout"><?php esc_html_e('Logout', 'bugspatrol'); ?></a></li>
			<?php 
		}
	}

	if (in_array('cart', $top_panel_top_components) && function_exists('bugspatrol_exists_woocommerce') && bugspatrol_exists_woocommerce() && (bugspatrol_is_woocommerce_page() && bugspatrol_get_custom_option('show_cart')=='shop' || bugspatrol_get_custom_option('show_cart')=='always') && !(is_checkout() || is_cart() || defined('WOOCOMMERCE_CHECKOUT') || defined('WOOCOMMERCE_CART'))) { 
		?>
		<li class="menu_user_cart">
			<?php get_template_part(bugspatrol_get_file_slug('templates/headers/_parts/contact-info-cart.php')); ?>
		</li>
		<?php
	}
	?>

	</ul>

</div>