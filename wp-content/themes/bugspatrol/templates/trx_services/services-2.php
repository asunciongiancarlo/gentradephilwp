<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'bugspatrol_template_services_2_theme_setup' ) ) {
    add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_template_services_2_theme_setup', 1 );
    function bugspatrol_template_services_2_theme_setup() {
        bugspatrol_add_template(array(
            'layout' => 'services-2',
            'template' => 'services-2',
            'mode'   => 'services',
            'title'  => esc_html__('Services /Style 2/', 'bugspatrol'),
            'thumb_title'  => esc_html__('Medium image (square crop)', 'bugspatrol'),
            'w'		 => 370,
            'h'		 => 350
        ));
    }
}

// Template output
if ( !function_exists( 'bugspatrol_template_services_2_output' ) ) {
    function bugspatrol_template_services_2_output($post_options, $post_data) {
        $show_title = !empty($post_data['post_title']);
        $parts = explode('_', $post_options['layout']);
        $style = $parts[0];
        $columns = max(1, min(12, empty($parts[1]) ? (!empty($post_options['columns_count']) ? $post_options['columns_count'] : 1) : (int) $parts[1]));
        if (bugspatrol_param_is_on($post_options['slider'])) {
            ?><div class="swiper-slide" data-style="<?php echo esc_attr($post_options['tag_css_wh']); ?>" style="<?php echo esc_attr($post_options['tag_css_wh']); ?>"><div class="sc_services_item_wrap"><?php
        } else if ($columns > 1) {
            ?><div class="column-1_<?php echo esc_attr($columns); ?> column_padding_bottom"><?php
        }
        ?>
        <div<?php echo !empty($post_options['tag_id']) ? ' id="'.esc_attr($post_options['tag_id']).'"' : ''; ?>
            class="sc_services_item sc_services_item_<?php echo esc_attr($post_options['number']) . ($post_options['number'] % 2 == 1 ? ' odd' : ' even') . ($post_options['number'] == 1 ? ' first' : '') . (!empty($post_options['tag_class']) ? ' '.esc_attr($post_options['tag_class']) : ''); ?>"
            <?php echo (!empty($post_options['tag_css']) ? ' style="'.esc_attr($post_options['tag_css']).'"' : '')
                . (!bugspatrol_param_is_off($post_options['tag_animation']) ? ' data-animation="'.esc_attr(bugspatrol_get_animation_classes($post_options['tag_animation'])).'"' : ''); ?>>
            <?php
            if ($post_data['post_icon'] && $post_options['tag_type']=='icons') {
                $html = bugspatrol_do_shortcode('[trx_icon icon="'.esc_attr($post_data['post_icon']).'" shape="round"]');
                if ((!isset($post_options['links']) || $post_options['links']) && !empty($post_data['post_link'])) {
                    ?><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php bugspatrol_show_layout($html); ?></a><?php
                } else
                    bugspatrol_show_layout($html);
            } else {
                ?>
                <div class="sc_services_item_featured post_featured">
                    <?php
                    bugspatrol_template_set_args('post-featured', array(
                        'post_options' => $post_options,
                        'post_data' => $post_data
                    ));
                    get_template_part(bugspatrol_get_file_slug('templates/_parts/post-featured.php'));
                    ?>
                    <?php
                    if ($show_title) {
                        if ((!isset($post_options['links']) || $post_options['links']) && !empty($post_data['post_link'])) {
                            ?><h4 class="sc_services_item_title"><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php bugspatrol_show_layout($post_data['post_title']); ?></a></h4><?php
                        } else {
                            ?><h4 class="sc_services_item_title"><?php bugspatrol_show_layout($post_data['post_title']); ?></h4><?php
                        }
                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <div class="sc_services_item_content">
                <?php

                if ($post_data['post_icon']) {
                    $html = bugspatrol_do_shortcode('[trx_icon icon="'.esc_attr($post_data['post_icon']).'" shape="round"]');
                    if ((!isset($post_options['links']) || $post_options['links']) && !empty($post_data['post_link'])) {
                        ?><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php bugspatrol_show_layout($html); ?></a><?php
                    } else
                        bugspatrol_show_layout($html);
                }

                if ($show_title) {
                    if ((!isset($post_options['links']) || $post_options['links']) && !empty($post_data['post_link'])) {
                        ?><h4 class="sc_services_item_title"><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php bugspatrol_show_layout($post_data['post_title']); ?></a></h4><?php
                    } else {
                        ?><h4 class="sc_services_item_title"><?php bugspatrol_show_layout($post_data['post_title']); ?></h4><?php
                    }
                }
                ?>

                <div class="sc_services_item_description">
                    <?php
                    if ($post_data['post_protected']) {
                        bugspatrol_show_layout($post_data['post_excerpt']);
                    } else {
                        if ($post_data['post_excerpt']) {
                            echo in_array($post_data['post_format'], array('quote', 'link', 'chat', 'aside', 'status')) ? $post_data['post_excerpt'] : '<p>'.trim(bugspatrol_strshort($post_data['post_excerpt'], isset($post_options['descr']) ? $post_options['descr'] : bugspatrol_get_custom_option('post_excerpt_maxlength_masonry'))).'</p>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        if (bugspatrol_param_is_on($post_options['slider'])) {
            ?></div></div><?php
        } else if ($columns > 1) {
            ?></div><?php
        }
    }
}
?>