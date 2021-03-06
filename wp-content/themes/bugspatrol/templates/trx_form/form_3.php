<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'bugspatrol_template_form_3_theme_setup' ) ) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_template_form_3_theme_setup', 1 );
	function bugspatrol_template_form_3_theme_setup() {
		bugspatrol_add_template(array(
			'layout' => 'form_3',
			'mode'   => 'forms',
			'title'  => esc_html__('Contact Form 3', 'bugspatrol')
			));
	}
}

// Template output
if ( !function_exists( 'bugspatrol_template_form_3_output' ) ) {
	function bugspatrol_template_form_3_output($post_options, $post_data) {
		$form_style = bugspatrol_get_theme_option('input_hover');
		?>
		<form <?php echo !empty($post_options['id']) ? ' id="'.esc_attr($post_options['id']).'_form"' : ''; ?>
			class="sc_input_hover_<?php echo esc_attr($form_style); ?>"
			data-formtype="<?php echo esc_attr($post_options['layout']); ?>"
			method="post"
			action="<?php echo esc_url($post_options['action'] ? $post_options['action'] : admin_url('admin-ajax.php')); ?>">
			<?php bugspatrol_sc_form_show_fields($post_options['fields']); ?>
			<div class="sc_form_info">
				<div class="sc_form_item sc_form_select_container label_over">
                    <?php
                    $options = explode('|', bugspatrol_storage_get('select_options'));
                    if (!empty($options)) {
                        ?><select name="service"><?php
                        $coun = 0;
                        foreach ($options as $v) {
                            $coun++;
                            $parts = explode('=', $v);
                            if (count($parts)==1) $parts[1] = $parts[0];
                            echo '<option'
                                . ' value="' . esc_attr(trim(chop($parts[0]))) . '"'
                                . ( $coun == 1 ? ' selected="selected"' : '')
                                . '>'
                                . trim(chop($parts[1]))
                                . '</option>';
                        }
                        echo '</select>';
                    }
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
				?></div><div class="sc_form_item sc_form_field label_over"><input id="sc_form_username" type="text" name="username"<?php if ($form_style=='default') echo ' placeholder="'.esc_attr__('Name *', 'bugspatrol').'"'; ?> aria-required="true"><?php
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
                    ?></div><div class="sc_form_item sc_form_field label_over"><input id="sc_form_zip" type="text" name="zip"<?php if ($form_style=='default') echo ' placeholder="'.esc_attr__('Zip-Code', 'bugspatrol').'"'; ?> aria-required="true"><?php
					if ($form_style!='default') { 
						?><label class="required" for="sc_form_zip"><?php
							if ($form_style == 'path') {
								?><svg class="sc_form_graphic" preserveAspectRatio="none" viewBox="0 0 404 77" height="100%" width="100%"><path d="m0,0l404,0l0,77l-404,0l0,-77z"></svg><?php
							} else if ($form_style == 'iconed') {
								?><i class="sc_form_label_icon icon-menu"></i><?php
							}
							?><span class="sc_form_label_content" data-content="<?php esc_html_e('Zip-Code', 'bugspatrol'); ?>"><?php esc_html_e('Zip-Code', 'bugspatrol'); ?></span><?php
						?></label><?php
					}
				?></div>

                <?php
                $privacy = trx_utils_get_privacy_text();
                if (!empty($privacy)) {
                    ?><div class="sc_form_item sc_form_field_checkbox"><?php
                    ?><input type="checkbox" id="i_agree_privacy_policy_sc_form_3" name="i_agree_privacy_policy" class="sc_form_privacy_checkbox" value="1">
                    <label for="i_agree_privacy_policy_sc_form_3"><?php trx_utils_show_layout($privacy); ?></label>
                    </div><?php
                }
                ?><div class="sc_form_item sc_form_button"><?php
                    ?><button class="sc_button sc_button_square sc_button_style_filled sc_button_size_large sc_button_iconed icon-right" <?php
                    if (!empty($privacy)) echo ' disabled="disabled"'
                    ?> ><?php
                        if (!empty($args['button_caption']))
                            echo esc_html($args['button_caption']);
                        else
                            esc_html_e('Submit', 'bugspatrol');
                        ?></button>
                </div>
			</div>
			<div class="result sc_infobox"></div>
		</form>
		<?php
	}
}
?>