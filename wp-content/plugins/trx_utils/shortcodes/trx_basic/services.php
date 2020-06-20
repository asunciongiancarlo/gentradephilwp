<?php

// Register shortcodes [trx_services] and [trx_services_item]

if (function_exists('bugspatrol_exists_visual_composer') && bugspatrol_exists_visual_composer())
    add_action('bugspatrol_action_shortcodes_list',		'bugspatrol_services_reg_shortcodes');
    add_action('bugspatrol_action_shortcodes_list_vc','bugspatrol_services_reg_shortcodes_vc');



// ---------------------------------- [trx_services] ---------------------------------------

/*
[trx_services id="unique_id" columns="4" count="4" style="services-1|services-2|..." title="Block title" subtitle="xxx" description="xxxxxx"]
	[trx_services_item icon="url" title="Item title" description="Item description" link="url" link_caption="Link text"]
	[trx_services_item icon="url" title="Item title" description="Item description" link="url" link_caption="Link text"]
[/trx_services]
*/
if ( !function_exists( 'bugspatrol_sc_services' ) ) {
    function bugspatrol_sc_services($atts, $content=null){
        if (bugspatrol_in_shortcode_blogger()) return '';
        extract(bugspatrol_html_decode(shortcode_atts(array(
            // Individual params
            "style" => "services-1",
            "columns" => 4,
            "slider" => "no",
            "slides_space" => 0,
            "controls" => "no",
            "interval" => "",
            "descr_show" => "",
            "style_color" => "",
            "autoheight" => "no",
            "equalheight" => "no",
            "align" => "",
            "custom" => "no",
            "type" => "images",	// icons | images
            "ids" => "",
            "cat" => "",
            "count" => 4,
            "offset" => "",
            "orderby" => "date",
            "order" => "desc",
            "readmore" => esc_html__('Learn more', 'bugspatrol'),
            "title" => "",
            "subtitle" => "",
            "description" => "",
            "link_caption" => esc_html__('Learn more', 'bugspatrol'),
            "link" => '',
            "scheme" => '',
            "image" => '',
            "image_align" => '',
            // Common params
            "id" => "",
            "class" => "",
            "animation" => "",
            "css" => "",
            "width" => "",
            "height" => "",
            "top" => "",
            "bottom" => "",
            "left" => "",
            "right" => ""
        ), $atts)));

        if (bugspatrol_param_is_off($slider) && $columns > 1 && $style == 'services-5' && !empty($image)) $columns = 2;
        if (!empty($image)) {
            if ($image > 0) {
                $attach = wp_get_attachment_image_src( $image, 'full' );
                if (isset($attach[0]) && $attach[0]!='')
                    $image = $attach[0];
            }
        }

        if (empty($id)) $id = "sc_services_".str_replace('.', '', mt_rand());
        if (empty($width)) $width = "100%";
        if (!empty($height) && bugspatrol_param_is_on($autoheight)) $autoheight = "no";
        if (empty($interval)) $interval = mt_rand(5000, 10000);

        $class .= ($class ? ' ' : '') . bugspatrol_get_css_position_as_classes($top, $right, $bottom, $left);

        $ws = bugspatrol_get_css_dimensions_from_values($width);
        $hs = bugspatrol_get_css_dimensions_from_values('', $height);
        $css .= ($hs) . ($ws);

        $columns = max(1, min(12, (int) $columns));
        $count = max(1, (int) $count);
        if (bugspatrol_param_is_off($custom) && $count < $columns) $columns = $count;

        if (bugspatrol_param_is_on($slider)) bugspatrol_enqueue_slider('swiper');

        bugspatrol_storage_set('sc_services_data', array(
                'id' => $id,
                'style' => $style,
                'type' => $type,
                'columns' => $columns,
                'counter' => 0,
                'slider' => $slider,
                'css_wh' => $ws . $hs,
                'readmore' => $readmore
            )
        );
        $alt = basename($image);
        $alt = substr($alt,0,strlen($alt) - 4);

        $output = '<div' . ($id ? ' id="'.esc_attr($id).'_wrap"' : '')
            . ' class="sc_services_wrap'
            . ($scheme && !bugspatrol_param_is_off($scheme) && !bugspatrol_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '')
            .'">'
            . '<div' . ($id ? ' id="'.esc_attr($id).'"' : '')
            . ' class="sc_services'
            . ' sc_services_style_'.esc_attr($style)
            . ' sc_services_type_'.esc_attr($type)
            . ' ' . esc_attr(bugspatrol_get_template_property($style, 'container_classes'))
            . (!empty($class) ? ' '.esc_attr($class) : '')
            . (!empty($descr_show) ? ' '.esc_attr($descr_show) : '')
            . (!empty($style_color) ? ' '.esc_attr($style_color) : '')
            . ($align!='' && $align!='none' ? ' align'.esc_attr($align) : '')
            . '"'
            . ($css!='' ? ' style="'.esc_attr($css).'"' : '')
            . (!bugspatrol_param_is_off($equalheight) ? ' data-equal-height=".sc_services_item"' : '')
            . (!bugspatrol_param_is_off($animation) ? ' data-animation="'.esc_attr(bugspatrol_get_animation_classes($animation)).'"' : '')
            . '>'
            . (!empty($subtitle) ? '<h6 class="sc_services_subtitle sc_item_subtitle">' . trim(bugspatrol_strmacros($subtitle)) . '</h6>' : '')
            . (!empty($title) ? '<h2 class="sc_services_title sc_item_title">' . trim(bugspatrol_strmacros($title)) . '</h2>' : '')
            . (!empty($description) ? '<div class="sc_services_descr sc_item_descr">' . trim(bugspatrol_strmacros($description)) . '</div>' : '')
            . (bugspatrol_param_is_on($slider)
                ? ('<div class="sc_slider_swiper swiper-slider-container'
                    . ' ' . esc_attr(bugspatrol_get_slider_controls_classes($controls))
                    . (bugspatrol_param_is_on($autoheight) ? ' sc_slider_height_auto' : '')
                    . ($hs ? ' sc_slider_height_fixed' : '')
                    . '"'
                    . (!empty($width) && bugspatrol_strpos($width, '%')===false ? ' data-old-width="' . esc_attr($width) . '"' : '')
                    . (!empty($height) && bugspatrol_strpos($height, '%')===false ? ' data-old-height="' . esc_attr($height) . '"' : '')
                    . ((int) $interval > 0 ? ' data-interval="'.esc_attr($interval).'"' : '')
                    . ($columns > 1 ? ' data-slides-per-view="' . esc_attr($columns) . '"' : '')
                    . ($slides_space > 0 ? ' data-slides-space="' . esc_attr($slides_space) . '"' : '')
                    . ' data-slides-min-width="250"'
                    . '>'
                    . '<div class="slides swiper-wrapper">')
                : ($columns > 1
                    ? ($style == 'services-5' && !empty($image)
                        ? '<div class="sc_service_container sc_align_'.esc_attr($image_align).'">'
                        . '<div class="sc_services_image"><img src="'.esc_url($image).'" alt="'.esc_html($alt).'"></div>'
                        : '')
                    . '<div class="sc_columns columns_wrap">'
                    : '')
            );

        if (bugspatrol_param_is_on($custom) && $content) {
            $output .= do_shortcode($content);
        } else {
            global $post;

            if (!empty($ids)) {
                $posts = explode(',', $ids);
                $count = count($posts);
            }

            $args = array(
                'post_type' => 'services',
                'post_status' => 'publish',
                'posts_per_page' => $count,
                'ignore_sticky_posts' => true,
                'order' => $order=='asc' ? 'asc' : 'desc',
                'readmore' => $readmore
            );

            if ($offset > 0 && empty($ids)) {
                $args['offset'] = $offset;
            }

            $args = bugspatrol_query_add_sort_order($args, $orderby, $order);
            $args = bugspatrol_query_add_posts_and_cats($args, $ids, 'services', $cat, 'services_group');

            $query = new WP_Query( $args );

            $post_number = 0;

            while ( $query->have_posts() ) {
                $query->the_post();
                $post_number++;
                $args = array(
                    'layout' => $style,
                    'show' => false,
                    'number' => $post_number,
                    'posts_on_page' => ($count > 0 ? $count : $query->found_posts),
                    "descr" => bugspatrol_get_custom_option('post_excerpt_maxlength'.($columns > 1 ? '_masonry' : '')),
                    "orderby" => $orderby,
                    'content' => false,
                    'terms_list' => false,
                    'readmore' => $readmore,
                    'tag_type' => $type,
                    'columns_count' => $columns,
                    'slider' => $slider,
                    'tag_id' => $id ? $id . '_' . $post_number : '',
                    'tag_class' => '',
                    'tag_animation' => '',
                    'tag_css' => '',
                    'tag_css_wh' => $ws . $hs
                );
                $output .= bugspatrol_show_post_layout($args);
            }
            wp_reset_postdata();
        }

        if (bugspatrol_param_is_on($slider)) {
            $output .= '</div>'
                . '<div class="sc_slider_controls_wrap"><a class="sc_slider_prev" href="#"></a><a class="sc_slider_next" href="#"></a></div>'
                . '<div class="sc_slider_pagination_wrap"></div>'
                . '</div>';
        } else if ($columns > 1) {
            $output .= '</div>';
            if ($style == 'services-5' && !empty($image))
                $output .= '</div>';
        }

        $output .=  (!empty($link) ? '<div class="sc_services_button sc_item_button">'.bugspatrol_do_shortcode('[trx_button link="'.esc_url($link).'" icon="icon-right"]'.esc_html($link_caption).'[/trx_button]').'</div>' : '')
            . '</div><!-- /.sc_services -->'
            . '</div><!-- /.sc_services_wrap -->';

        // Add template specific scripts and styles
        do_action('bugspatrol_action_blog_scripts', $style);

        return apply_filters('bugspatrol_shortcode_output', $output, 'trx_services', $atts, $content);
    }
    bugspatrol_require_shortcode('trx_services', 'bugspatrol_sc_services');
}


if ( !function_exists( 'bugspatrol_sc_services_item' ) ) {
    function bugspatrol_sc_services_item($atts, $content=null) {
        if (bugspatrol_in_shortcode_blogger()) return '';
        extract(bugspatrol_html_decode(shortcode_atts( array(
            // Individual params
            "icon" => "",
            "image" => "",
            "title" => "",
            "link" => "",
            "readmore" => "(none)",
            // Common params
            "id" => "",
            "class" => "",
            "animation" => "",
            "css" => ""
        ), $atts)));

        bugspatrol_storage_inc_array('sc_services_data', 'counter');

        $id = $id ? $id : (bugspatrol_storage_get_array('sc_services_data', 'id') ? bugspatrol_storage_get_array('sc_services_data', 'id') . '_' . bugspatrol_storage_get_array('sc_services_data', 'counter') : '');

        $descr = trim(chop(do_shortcode($content)));
        $readmore = $readmore=='(none)' ? bugspatrol_storage_get_array('sc_services_data', 'readmore') : $readmore;

        $type = bugspatrol_storage_get_array('sc_services_data', 'type');
        if (!empty($icon)) {
            $type = 'icons';
        } else if (!empty($image)) {
            $type = 'images';
            if ($image > 0) {
                $attach = wp_get_attachment_image_src( $image, 'full' );
                if (isset($attach[0]) && $attach[0]!='')
                    $image = $attach[0];
            }
            $thumb_sizes = bugspatrol_get_thumb_sizes(array('layout' => bugspatrol_storage_get_array('sc_services_data', 'style')));
            $image = bugspatrol_get_resized_image_tag($image, $thumb_sizes['w'], $thumb_sizes['h']);
        }

        $post_data = array(
            'post_title' => $title,
            'post_excerpt' => $descr,
            'post_thumb' => $image,
            'post_icon' => $icon,
            'post_link' => $link,
            'post_protected' => false,
            'post_format' => 'standard'
        );
        $args = array(
            'layout' => bugspatrol_storage_get_array('sc_services_data', 'style'),
            'number' => bugspatrol_storage_get_array('sc_services_data', 'counter'),
            'columns_count' => bugspatrol_storage_get_array('sc_services_data', 'columns'),
            'slider' => bugspatrol_storage_get_array('sc_services_data', 'slider'),
            'show' => false,
            'descr'  => -1,		// -1 - don't strip tags, 0 - strip_tags, >0 - strip_tags and truncate string
            'readmore' => $readmore,
            'tag_type' => $type,
            'tag_id' => $id,
            'tag_class' => $class,
            'tag_animation' => $animation,
            'tag_css' => $css,
            'tag_css_wh' => bugspatrol_storage_get_array('sc_services_data', 'css_wh')
        );
        $output = bugspatrol_show_post_layout($args, $post_data);
        return apply_filters('bugspatrol_shortcode_output', $output, 'trx_services_item', $atts, $content);
    }
    bugspatrol_require_shortcode('trx_services_item', 'bugspatrol_sc_services_item');
}
// ---------------------------------- [/trx_services] ---------------------------------------



// Add [trx_services] and [trx_services_item] in the shortcodes list
if (!function_exists('bugspatrol_services_reg_shortcodes')) {
    function bugspatrol_services_reg_shortcodes() {
        if (bugspatrol_storage_isset('shortcodes')) {

            $services_groups = bugspatrol_get_list_terms(false, 'services_group');
            $services_styles = bugspatrol_get_list_templates('services');
            $controls 		 = bugspatrol_get_list_slider_controls();

            bugspatrol_sc_map_after('trx_section', array(

                // Services
                "trx_services" => array(
                    "title" => esc_html__("Services", 'bugspatrol'),
                    "desc" => wp_kses_data( __("Insert services list in your page (post)", 'bugspatrol') ),
                    "decorate" => true,
                    "container" => false,
                    "params" => array(
                        "title" => array(
                            "title" => esc_html__("Title", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Title for the block", 'bugspatrol') ),
                            "value" => "",
                            "type" => "text"
                        ),
                        "subtitle" => array(
                            "title" => esc_html__("Subtitle", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Subtitle for the block", 'bugspatrol') ),
                            "value" => "",
                            "type" => "text"
                        ),
                        "description" => array(
                            "title" => esc_html__("Description", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Short description for the block", 'bugspatrol') ),
                            "value" => "",
                            "type" => "textarea"
                        ),
                        "style" => array(
                            "title" => esc_html__("Services style", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Select style to display services list", 'bugspatrol') ),
                            "value" => "services-1",
                            "type" => "select",
                            "options" => $services_styles
                        ),
                        "image" => array(
                            "title" => esc_html__("Item's image", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Item's image", 'bugspatrol') ),
                            "dependency" => array(
                                'style' => 'services-5'
                            ),
                            "value" => "",
                            "readonly" => false,
                            "type" => "media"
                        ),
                        "image_align" => array(
                            "title" => esc_html__("Image alignment", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Alignment of the image", 'bugspatrol') ),
                            "divider" => true,
                            "value" => "",
                            "type" => "checklist",
                            "dir" => "horizontal",
                            "options" => bugspatrol_get_sc_param('align')
                        ),
                        "type" => array(
                            "title" => esc_html__("Icon's type", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Select type of icons: font icon or image", 'bugspatrol') ),
                            "value" => "icons",
                            "type" => "checklist",
                            "dir" => "horizontal",
                            "options" => array(
                                'icons'  => esc_html__('Icons', 'bugspatrol'),
                                'images' => esc_html__('Images', 'bugspatrol')
                            )
                        ),
                        "columns" => array(
                            "title" => esc_html__("Columns", 'bugspatrol'),
                            "desc" => wp_kses_data( __("How many columns use to show services list", 'bugspatrol') ),
                            "value" => 4,
                            "min" => 2,
                            "max" => 6,
                            "step" => 1,
                            "type" => "spinner"
                        ),
                        "scheme" => array(
                            "title" => esc_html__("Color scheme", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Select color scheme for this block", 'bugspatrol') ),
                            "value" => "",
                            "type" => "checklist",
                            "options" => bugspatrol_get_sc_param('schemes')
                        ),
                        "slider" => array(
                            "title" => esc_html__("Slider", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Use slider to show services", 'bugspatrol') ),
                            "value" => "no",
                            "type" => "switch",
                            "options" => bugspatrol_get_sc_param('yes_no')
                        ),
                        "controls" => array(
                            "title" => esc_html__("Controls", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Slider controls style and position", 'bugspatrol') ),
                            "dependency" => array(
                                'slider' => array('yes')
                            ),
                            "divider" => true,
                            "value" => "",
                            "type" => "checklist",
                            "dir" => "horizontal",
                            "options" => $controls
                        ),
                        "slides_space" => array(
                            "title" => esc_html__("Space between slides", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Size of space (in px) between slides", 'bugspatrol') ),
                            "dependency" => array(
                                'slider' => array('yes')
                            ),
                            "value" => 0,
                            "min" => 0,
                            "max" => 100,
                            "step" => 10,
                            "type" => "spinner"
                        ),
                        "interval" => array(
                            "title" => esc_html__("Slides change interval", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Slides change interval (in milliseconds: 1000ms = 1s)", 'bugspatrol') ),
                            "dependency" => array(
                                'slider' => array('yes')
                            ),
                            "value" => 7000,
                            "step" => 500,
                            "min" => 0,
                            "type" => "spinner"
                        ),
                        "autoheight" => array(
                            "title" => esc_html__("Autoheight", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Change whole slider's height (make it equal current slide's height)", 'bugspatrol') ),
                            "dependency" => array(
                                'slider' => array('yes')
                            ),
                            "value" => "yes",
                            "type" => "switch",
                            "options" => bugspatrol_get_sc_param('yes_no')
                        ),
                        "align" => array(
                            "title" => esc_html__("Alignment", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Alignment of the services block", 'bugspatrol') ),
                            "divider" => true,
                            "value" => "",
                            "type" => "checklist",
                            "dir" => "horizontal",
                            "options" => bugspatrol_get_sc_param('align')
                        ),
                        "custom" => array(
                            "title" => esc_html__("Custom", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Allow get services items from inner shortcodes (custom) or get it from specified group (cat)", 'bugspatrol') ),
                            "divider" => true,
                            "value" => "no",
                            "type" => "switch",
                            "options" => bugspatrol_get_sc_param('yes_no')
                        ),
                        "cat" => array(
                            "title" => esc_html__("Categories", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Select categories (groups) to show services list. If empty - select services from any category (group) or from IDs list", 'bugspatrol') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "divider" => true,
                            "value" => "",
                            "type" => "select",
                            "style" => "list",
                            "multiple" => true,
                            "options" => bugspatrol_array_merge(array(0 => esc_html__('- Select category -', 'bugspatrol')), $services_groups)
                        ),
                        "count" => array(
                            "title" => esc_html__("Number of posts", 'bugspatrol'),
                            "desc" => wp_kses_data( __("How many posts will be displayed? If used IDs - this parameter ignored.", 'bugspatrol') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "value" => 4,
                            "min" => 1,
                            "max" => 100,
                            "type" => "spinner"
                        ),
                        "offset" => array(
                            "title" => esc_html__("Offset before select posts", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Skip posts before select next part.", 'bugspatrol') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "value" => 0,
                            "min" => 0,
                            "type" => "spinner"
                        ),
                        "orderby" => array(
                            "title" => esc_html__("Post order by", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Select desired posts sorting method", 'bugspatrol') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "value" => "date",
                            "type" => "select",
                            "options" => bugspatrol_get_sc_param('sorting')
                        ),
                        "order" => array(
                            "title" => esc_html__("Post order", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Select desired posts order", 'bugspatrol') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "value" => "desc",
                            "type" => "switch",
                            "size" => "big",
                            "options" => bugspatrol_get_sc_param('ordering')
                        ),
                        "ids" => array(
                            "title" => esc_html__("Post IDs list", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Comma separated list of posts ID. If set - parameters above are ignored!", 'bugspatrol') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "value" => "",
                            "type" => "text"
                        ),
                        "readmore" => array(
                            "title" => esc_html__("Read more", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Caption for the Read more link (if empty - link not showed)", 'bugspatrol') ),
                            "value" => "",
                            "type" => "text"
                        ),
                        "link" => array(
                            "title" => esc_html__("Button URL", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Link URL for the button at the bottom of the block", 'bugspatrol') ),
                            "value" => "",
                            "type" => "text"
                        ),
                        "link_caption" => array(
                            "title" => esc_html__("Button caption", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Caption for the button at the bottom of the block", 'bugspatrol') ),
                            "value" => "",
                            "type" => "text"
                        ),
                        "width" => bugspatrol_shortcodes_width(),
                        "height" => bugspatrol_shortcodes_height(),
                        "top" => bugspatrol_get_sc_param('top'),
                        "bottom" => bugspatrol_get_sc_param('bottom'),
                        "left" => bugspatrol_get_sc_param('left'),
                        "right" => bugspatrol_get_sc_param('right'),
                        "id" => bugspatrol_get_sc_param('id'),
                        "class" => bugspatrol_get_sc_param('class'),
                        "animation" => bugspatrol_get_sc_param('animation'),
                        "css" => bugspatrol_get_sc_param('css')
                    ),
                    "children" => array(
                        "name" => "trx_services_item",
                        "title" => esc_html__("Service item", 'bugspatrol'),
                        "desc" => wp_kses_data( __("Service item", 'bugspatrol') ),
                        "container" => true,
                        "params" => array(
                            "title" => array(
                                "title" => esc_html__("Title", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Item's title", 'bugspatrol') ),
                                "divider" => true,
                                "value" => "",
                                "type" => "text"
                            ),
                            "icon" => array(
                                "title" => esc_html__("Item's icon",  'bugspatrol'),
                                "desc" => wp_kses_data( __('Select icon for the item from Fontello icons set',  'bugspatrol') ),
                                "value" => "",
                                "type" => "icons",
                                "options" => bugspatrol_get_sc_param('icons')
                            ),
                            "image" => array(
                                "title" => esc_html__("Item's image", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Item's image (if icon not selected)", 'bugspatrol') ),
                                "dependency" => array(
                                    'icon' => array('is_empty', 'none')
                                ),
                                "value" => "",
                                "readonly" => false,
                                "type" => "media"
                            ),
                            "link" => array(
                                "title" => esc_html__("Link", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Link on service's item page", 'bugspatrol') ),
                                "divider" => true,
                                "value" => "",
                                "type" => "text"
                            ),
                            "readmore" => array(
                                "title" => esc_html__("Read more", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Caption for the Read more link (if empty - link not showed)", 'bugspatrol') ),
                                "value" => "",
                                "type" => "text"
                            ),
                            "_content_" => array(
                                "title" => esc_html__("Description", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Item's short description", 'bugspatrol') ),
                                "divider" => true,
                                "rows" => 4,
                                "value" => "",
                                "type" => "textarea"
                            ),
                            "id" => bugspatrol_get_sc_param('id'),
                            "class" => bugspatrol_get_sc_param('class'),
                            "animation" => bugspatrol_get_sc_param('animation'),
                            "css" => bugspatrol_get_sc_param('css')
                        )
                    )
                )

            ));
        }
    }
}


// Add [trx_services] and [trx_services_item] in the VC shortcodes list
if (!function_exists('bugspatrol_services_reg_shortcodes_vc')) {
    function bugspatrol_services_reg_shortcodes_vc() {

        $services_groups = bugspatrol_get_list_terms(false, 'services_group');
        $services_styles = bugspatrol_get_list_templates('services');
        $controls		 = bugspatrol_get_list_slider_controls();

        // Services
        vc_map( array(
            "base" => "trx_services",
            "name" => esc_html__("Services", 'bugspatrol'),
            "description" => wp_kses_data( __("Insert services list", 'bugspatrol') ),
            "category" => esc_html__('Content', 'bugspatrol'),
            "icon" => 'icon_trx_services',
            "class" => "trx_sc_columns trx_sc_services",
            "content_element" => true,
            "is_container" => true,
            "show_settings_on_create" => true,
            "as_parent" => array('only' => 'trx_services_item'),
            "params" => array(
                array(
                    "param_name" => "style",
                    "heading" => esc_html__("Services style", 'bugspatrol'),
                    "description" => wp_kses_data( __("Select style to display services list", 'bugspatrol') ),
                    "class" => "",
                    "admin_label" => true,
                    "value" => array_flip($services_styles),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "type",
                    "heading" => esc_html__("Icon's type", 'bugspatrol'),
                    "description" => wp_kses_data( __("Select type of icons: font icon or image", 'bugspatrol') ),
                    "class" => "",
                    "admin_label" => true,
                    "value" => array(
                        esc_html__('Images', 'bugspatrol') => 'images',
                        esc_html__('Icons', 'bugspatrol') => 'icons'
                    ),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "descr_show",
                    "heading" => esc_html__("Show description", 'bugspatrol'),
                    "description" => wp_kses_data( __("Select show description or not", 'bugspatrol') ),
                    "class" => "",
                    "admin_label" => true,
                    "value" => array(
                        esc_html__('Show', 'bugspatrol') => 'show_desrc',
                        esc_html__('No', 'bugspatrol') => 'not_show_descr'
                    ),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "style_color",
                    "heading" => esc_html__("Select style color", 'bugspatrol'),
                    "description" => wp_kses_data( __("Select style color", 'bugspatrol') ),
                    "class" => "",
                    "admin_label" => true,
                    "value" => array(
                        esc_html__('Original', 'bugspatrol') => 'original_style_color',
                        esc_html__('White text', 'bugspatrol') => 'white_text_style_color'
                    ),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "equalheight",
                    "heading" => esc_html__("Equal height", 'bugspatrol'),
                    "description" => wp_kses_data( __("Make equal height for all items in the row", 'bugspatrol') ),
                    "value" => array("Equal height" => "yes" ),
                    "type" => "checkbox"
                ),
                array(
                    "param_name" => "scheme",
                    "heading" => esc_html__("Color scheme", 'bugspatrol'),
                    "description" => wp_kses_data( __("Select color scheme for this block", 'bugspatrol') ),
                    "class" => "",
                    "value" => array_flip(bugspatrol_get_sc_param('schemes')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "image",
                    "heading" => esc_html__("Image", 'bugspatrol'),
                    "description" => wp_kses_data( __("Item's image", 'bugspatrol') ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => 'services-5'
                    ),
                    "class" => "",
                    "value" => "",
                    "type" => "attach_image"
                ),
                array(
                    "param_name" => "image_align",
                    "heading" => esc_html__("Image alignment", 'bugspatrol'),
                    "description" => wp_kses_data( __("Alignment of the image", 'bugspatrol') ),
                    "class" => "",
                    "value" => array_flip(bugspatrol_get_sc_param('align')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "slider",
                    "heading" => esc_html__("Slider", 'bugspatrol'),
                    "description" => wp_kses_data( __("Use slider to show services", 'bugspatrol') ),
                    "admin_label" => true,
                    "group" => esc_html__('Slider', 'bugspatrol'),
                    "class" => "",
                    "std" => "no",
                    "value" => array_flip(bugspatrol_get_sc_param('yes_no')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "controls",
                    "heading" => esc_html__("Controls", 'bugspatrol'),
                    "description" => wp_kses_data( __("Slider controls style and position", 'bugspatrol') ),
                    "admin_label" => true,
                    "group" => esc_html__('Slider', 'bugspatrol'),
                    'dependency' => array(
                        'element' => 'slider',
                        'value' => 'yes'
                    ),
                    "class" => "",
                    "std" => "no",
                    "value" => array_flip($controls),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "slides_space",
                    "heading" => esc_html__("Space between slides", 'bugspatrol'),
                    "description" => wp_kses_data( __("Size of space (in px) between slides", 'bugspatrol') ),
                    "admin_label" => true,
                    "group" => esc_html__('Slider', 'bugspatrol'),
                    'dependency' => array(
                        'element' => 'slider',
                        'value' => 'yes'
                    ),
                    "class" => "",
                    "value" => "0",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "interval",
                    "heading" => esc_html__("Slides change interval", 'bugspatrol'),
                    "description" => wp_kses_data( __("Slides change interval (in milliseconds: 1000ms = 1s)", 'bugspatrol') ),
                    "group" => esc_html__('Slider', 'bugspatrol'),
                    'dependency' => array(
                        'element' => 'slider',
                        'value' => 'yes'
                    ),
                    "class" => "",
                    "value" => "7000",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "autoheight",
                    "heading" => esc_html__("Autoheight", 'bugspatrol'),
                    "description" => wp_kses_data( __("Change whole slider's height (make it equal current slide's height)", 'bugspatrol') ),
                    "group" => esc_html__('Slider', 'bugspatrol'),
                    'dependency' => array(
                        'element' => 'slider',
                        'value' => 'yes'
                    ),
                    "class" => "",
                    "value" => array("Autoheight" => "yes" ),
                    "type" => "checkbox"
                ),
                array(
                    "param_name" => "align",
                    "heading" => esc_html__("Alignment", 'bugspatrol'),
                    "description" => wp_kses_data( __("Alignment of the services block", 'bugspatrol') ),
                    "class" => "",
                    "value" => array_flip(bugspatrol_get_sc_param('align')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "custom",
                    "heading" => esc_html__("Custom", 'bugspatrol'),
                    "description" => wp_kses_data( __("Allow get services from inner shortcodes (custom) or get it from specified group (cat)", 'bugspatrol') ),
                    "class" => "",
                    "value" => array("Custom services" => "yes" ),
                    "type" => "checkbox"
                ),
                array(
                    "param_name" => "title",
                    "heading" => esc_html__("Title", 'bugspatrol'),
                    "description" => wp_kses_data( __("Title for the block", 'bugspatrol') ),
                    "admin_label" => true,
                    "group" => esc_html__('Captions', 'bugspatrol'),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "subtitle",
                    "heading" => esc_html__("Subtitle", 'bugspatrol'),
                    "description" => wp_kses_data( __("Subtitle for the block", 'bugspatrol') ),
                    "group" => esc_html__('Captions', 'bugspatrol'),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "description",
                    "heading" => esc_html__("Description", 'bugspatrol'),
                    "description" => wp_kses_data( __("Description for the block", 'bugspatrol') ),
                    "group" => esc_html__('Captions', 'bugspatrol'),
                    "class" => "",
                    "value" => "",
                    "type" => "textarea"
                ),
                array(
                    "param_name" => "cat",
                    "heading" => esc_html__("Categories", 'bugspatrol'),
                    "description" => wp_kses_data( __("Select category to show services. If empty - select services from any category (group) or from IDs list", 'bugspatrol') ),
                    "group" => esc_html__('Query', 'bugspatrol'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "class" => "",
                    "value" => array_flip(bugspatrol_array_merge(array(0 => esc_html__('- Select category -', 'bugspatrol')), $services_groups)),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "columns",
                    "heading" => esc_html__("Columns", 'bugspatrol'),
                    "description" => wp_kses_data( __("How many columns use to show services list", 'bugspatrol') ),
                    "group" => esc_html__('Query', 'bugspatrol'),
                    "admin_label" => true,
                    "class" => "",
                    "value" => "4",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "count",
                    "heading" => esc_html__("Number of posts", 'bugspatrol'),
                    "description" => wp_kses_data( __("How many posts will be displayed? If used IDs - this parameter ignored.", 'bugspatrol') ),
                    "admin_label" => true,
                    "group" => esc_html__('Query', 'bugspatrol'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "class" => "",
                    "value" => "4",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "offset",
                    "heading" => esc_html__("Offset before select posts", 'bugspatrol'),
                    "description" => wp_kses_data( __("Skip posts before select next part.", 'bugspatrol') ),
                    "group" => esc_html__('Query', 'bugspatrol'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "class" => "",
                    "value" => "0",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "orderby",
                    "heading" => esc_html__("Post sorting", 'bugspatrol'),
                    "description" => wp_kses_data( __("Select desired posts sorting method", 'bugspatrol') ),
                    "group" => esc_html__('Query', 'bugspatrol'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "std" => "date",
                    "class" => "",
                    "value" => array_flip(bugspatrol_get_sc_param('sorting')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "order",
                    "heading" => esc_html__("Post order", 'bugspatrol'),
                    "description" => wp_kses_data( __("Select desired posts order", 'bugspatrol') ),
                    "group" => esc_html__('Query', 'bugspatrol'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "std" => "desc",
                    "class" => "",
                    "value" => array_flip(bugspatrol_get_sc_param('ordering')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "ids",
                    "heading" => esc_html__("Service's IDs list", 'bugspatrol'),
                    "description" => wp_kses_data( __("Comma separated list of service's ID. If set - parameters above (category, count, order, etc.)  are ignored!", 'bugspatrol') ),
                    "group" => esc_html__('Query', 'bugspatrol'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "readmore",
                    "heading" => esc_html__("Read more", 'bugspatrol'),
                    "description" => wp_kses_data( __("Caption for the Read more link (if empty - link not showed)", 'bugspatrol') ),
                    "admin_label" => true,
                    "group" => esc_html__('Captions', 'bugspatrol'),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "link",
                    "heading" => esc_html__("Button URL", 'bugspatrol'),
                    "description" => wp_kses_data( __("Link URL for the button at the bottom of the block", 'bugspatrol') ),
                    "group" => esc_html__('Captions', 'bugspatrol'),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "link_caption",
                    "heading" => esc_html__("Button caption", 'bugspatrol'),
                    "description" => wp_kses_data( __("Caption for the button at the bottom of the block", 'bugspatrol') ),
                    "group" => esc_html__('Captions', 'bugspatrol'),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                bugspatrol_vc_width(),
                bugspatrol_vc_height(),
                bugspatrol_get_vc_param('margin_top'),
                bugspatrol_get_vc_param('margin_bottom'),
                bugspatrol_get_vc_param('margin_left'),
                bugspatrol_get_vc_param('margin_right'),
                bugspatrol_get_vc_param('id'),
                bugspatrol_get_vc_param('class'),
                bugspatrol_get_vc_param('animation'),
                bugspatrol_get_vc_param('css')
            ),
            'default_content' => '
					[trx_services_item title="' . esc_attr__( 'Service item 1', 'bugspatrol' ) . '"][/trx_services_item]
					[trx_services_item title="' . esc_attr__( 'Service item 2', 'bugspatrol' ) . '"][/trx_services_item]
					[trx_services_item title="' . esc_attr__( 'Service item 3', 'bugspatrol' ) . '"][/trx_services_item]
					[trx_services_item title="' . esc_attr__( 'Service item 4', 'bugspatrol' ) . '"][/trx_services_item]
				',
            'js_view' => 'VcTrxColumnsView'
        ) );


        vc_map( array(
            "base" => "trx_services_item",
            "name" => esc_html__("Services item", 'bugspatrol'),
            "description" => wp_kses_data( __("Custom services item - all data pull out from shortcode parameters", 'bugspatrol') ),
            "show_settings_on_create" => true,
            "class" => "trx_sc_collection trx_sc_column_item trx_sc_services_item",
            "content_element" => true,
            "is_container" => true,
            'icon' => 'icon_trx_services_item',
            "as_child" => array('only' => 'trx_services'),
            "as_parent" => array('except' => 'trx_services'),
            "params" => array(
                array(
                    "param_name" => "title",
                    "heading" => esc_html__("Title", 'bugspatrol'),
                    "description" => wp_kses_data( __("Item's title", 'bugspatrol') ),
                    "admin_label" => true,
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "icon",
                    "heading" => esc_html__("Icon", 'bugspatrol'),
                    "description" => wp_kses_data( __("Select icon for the item from Fontello icons set", 'bugspatrol') ),
                    "admin_label" => true,
                    "class" => "",
                    "value" => bugspatrol_get_sc_param('icons'),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "image",
                    "heading" => esc_html__("Image", 'bugspatrol'),
                    "description" => wp_kses_data( __("Item's image (if icon is empty)", 'bugspatrol') ),
                    "class" => "",
                    "value" => "",
                    "type" => "attach_image"
                ),
                array(
                    "param_name" => "link",
                    "heading" => esc_html__("Link", 'bugspatrol'),
                    "description" => wp_kses_data( __("Link on item's page", 'bugspatrol') ),
                    "admin_label" => true,
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "readmore",
                    "heading" => esc_html__("Read more", 'bugspatrol'),
                    "description" => wp_kses_data( __("Caption for the Read more link (if empty - link not showed)", 'bugspatrol') ),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                bugspatrol_get_vc_param('id'),
                bugspatrol_get_vc_param('class'),
                bugspatrol_get_vc_param('animation'),
                bugspatrol_get_vc_param('css')
            ),
            'js_view' => 'VcTrxColumnItemView'
        ) );

        class WPBakeryShortCode_Trx_Services extends Bugspatrol_VC_ShortCodeColumns {}
        class WPBakeryShortCode_Trx_Services_Item extends Bugspatrol_VC_ShortCodeCollection {}

    }
}