<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'bugspatrol_template_form_2_theme_setup' ) ) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_template_form_2_theme_setup', 1 );
	function bugspatrol_template_form_2_theme_setup() {
		bugspatrol_add_template(array(
			'layout' => 'form_2',
			'mode'   => 'forms',
			'title'  => esc_html__('Contact Form 2', 'bugspatrol')
			));
	}
}

// Template output
if ( !function_exists( 'bugspatrol_template_form_2_output' ) ) {
	function bugspatrol_template_form_2_output($post_options, $post_data) {

		$form_style = bugspatrol_get_theme_option('input_hover');
		$address_1 = bugspatrol_get_theme_option('contact_address_1');
		$address_2 = bugspatrol_get_theme_option('contact_address_2');
		$phone = bugspatrol_get_theme_option('contact_phone');
		$fax = bugspatrol_get_theme_option('contact_fax');
		$email = bugspatrol_get_theme_option('contact_email');
		$open_hours = bugspatrol_get_theme_option('contact_open_hours');
		
		?><div class="sc_columns columns_wrap"><?php

			// Form info
			?><div class="sc_form_address column-1_3">
				<div class="sc_form_address_field">
					<span class="sc_form_address_label"><?php esc_html_e('Address', 'bugspatrol'); ?></span>
					<span class="sc_form_address_data"><?php bugspatrol_show_layout($address_1) . (!empty($address_1) && !empty($address_2) ? ', ' : '') . $address_2; ?></span>
				</div>
				<div class="sc_form_address_field">
					<span class="sc_form_address_label"><?php esc_html_e('We are open', 'bugspatrol'); ?></span>
					<span class="sc_form_address_data"><?php bugspatrol_show_layout($open_hours); ?></span>
				</div>
				<div class="sc_form_address_field">
					<span class="sc_form_address_label"><?php esc_html_e('Phone', 'bugspatrol'); ?></span>
					<span class="sc_form_address_data"><?php bugspatrol_show_layout( '<a href="tel:'.($phone).'">'.($phone).'</a>') . (!empty($phone) && !empty($fax) ? ', ' : '') . $fax; ?></span>
				</div>
				<div class="sc_form_address_field">
					<span class="sc_form_address_label"><?php esc_html_e('E-mail', 'bugspatrol'); ?></span>
					<span class="sc_form_address_data"><?php bugspatrol_show_layout('<a href="mailto:'.$email.'">'.$email.'</a>'); ?></span>
				</div>
				<?php echo do_shortcode('[trx_socials size="tiny" shape="round"][/trx_socials]'); ?>
			</div><?php

			// Form fields
			?><div class="sc_form_fields column-2_3">
				<form <?php echo !empty($post_options['id']) ? ' id="'.esc_attr($post_options['id']).'_form"' : ''; ?> 
					class="sc_input_hover_<?php echo esc_attr($form_style); ?>"
					data-formtype="<?php echo esc_attr($post_options['layout']); ?>" 
					method="post" 
					action="<?php echo esc_url($post_options['action'] ? $post_options['action'] : admin_url('admin-ajax.php')); ?>">
					<?php bugspatrol_sc_form_show_fields($post_options['fields']); ?>
					<div class="sc_form_info">
						<div class="sc_form_item sc_form_field label_over"><input id="sc_form_username" type="text" name="username"<?php if ($form_style=='default') echo ' placeholder="'.esc_attr__('Name *', 'bugspatrol').'"'; ?> aria-required="true"><?php
							if ($form_style!='default') { 
								?><label class="required" for="sc_form_username"><?php
									if ($form_style == 'path') {
										?><svg class="sc_form_graphic" preserveAspectRatio="none" viewBox="0 0 404 77" height="100%" width="100%"><path d="m0,0l404,0l0,77l-404,0l0,-77z"></svg><?php
									} else if ($form_style == 'iconed') {
										?><i class="sc_form_label_icon icon-user"></i><?php
									}
									?><span class="sc_form_label_content" data-content="<?php esc_html_e('Name', 'bugspatrol'); ?>"><?php esc_html_e('Name', 'bugspatrol'); ?></span><?php
								?></label><?php
							}
						?></div>
						<div class="sc_form_item sc_form_field label_over"><input id="sc_form_email" type="text" name="email"<?php if ($form_style=='default') echo ' placeholder="'.esc_attr__('E-mail *', 'bugspatrol').'"'; ?> aria-required="true"><?php
							if ($form_style!='default') { 
								?><label class="required" for="sc_form_email"><?php
									if ($form_style == 'path') {
										?><svg class="sc_form_graphic" preserveAspectRatio="none" viewBox="0 0 404 77" height="100%" width="100%"><path d="m0,0l404,0l0,77l-404,0l0,-77z"></svg><?php
									} else if ($form_style == 'iconed') {
										?><i class="sc_form_label_icon icon-mail-empty"></i><?php
									}
									?><span class="sc_form_label_content" data-content="<?php esc_html_e('E-mail', 'bugspatrol'); ?>"><?php esc_html_e('E-mail', 'bugspatrol'); ?></span><?php
								?></label><?php
							}
						?></div>
						<div class="sc_form_item sc_form_field label_over"><input id="sc_form_subj" type="text" name="subject"<?php if ($form_style=='default') echo ' placeholder="'.esc_attr__('Subject', 'bugspatrol').'"'; ?> aria-required="true"><?php
							if ($form_style!='default') { 
								?><label class="required" for="sc_form_subj"><?php
									if ($form_style == 'path') {
										?><svg class="sc_form_graphic" preserveAspectRatio="none" viewBox="0 0 404 77" height="100%" width="100%"><path d="m0,0l404,0l0,77l-404,0l0,-77z"></svg><?php
									} else if ($form_style == 'iconed') {
										?><i class="sc_form_label_icon icon-menu"></i><?php
									}
									?><span class="sc_form_label_content" data-content="<?php esc_html_e('Subject', 'bugspatrol'); ?>"><?php esc_html_e('Subject', 'bugspatrol'); ?></span><?php
								?></label><?php
							}
						?></div>
					</div>
					<div class="sc_form_item sc_form_message"><textarea id="sc_form_message" name="message"<?php if ($form_style=='default') echo ' placeholder="'.esc_attr__('Message', 'bugspatrol').'"'; ?> aria-required="true"></textarea><?php
						if ($form_style!='default') { 
							?><label class="required" for="sc_form_message"><?php 
								if ($form_style == 'path') {
									?><svg class="sc_form_graphic" preserveAspectRatio="none" viewBox="0 0 404 77" height="100%" width="100%"><path d="m0,0l404,0l0,77l-404,0l0,-77z"></svg><?php
								} else if ($form_style == 'iconed') {
									?><i class="sc_form_label_icon icon-feather"></i><?php
								}
								?><span class="sc_form_label_content" data-content="<?php esc_html_e('Message', 'bugspatrol'); ?>"><?php esc_html_e('Message', 'bugspatrol'); ?></span><?php
							?></label><?php
						}
					?></div>

                    <?php
                    $privacy = trx_utils_get_privacy_text();
                    if (!empty($privacy)) {
                        ?><div class="sc_form_item sc_form_field_checkbox"><?php
                        ?><input type="checkbox" id="i_agree_privacy_policy_sc_form_2" name="i_agree_privacy_policy" class="sc_form_privacy_checkbox" value="1">
                        <label for="i_agree_privacy_policy_sc_form_2"><?php trx_utils_show_layout($privacy); ?></label>
                        </div><?php
                    }
                    ?><div class="sc_form_item sc_form_button"><?php
                        ?><button <?php
                        if (!empty($privacy)) echo ' disabled="disabled"'
                        ?> ><?php
                            if (!empty($args['button_caption']))
                                echo esc_html($args['button_caption']);
                            else
                                esc_html_e('Send Message', 'bugspatrol');
                            ?></button>
                    </div>
                    <div class="result sc_infobox"></div>
				</form>
			</div>
		</div>
		<?php
	}
}
?>