<?php

// Register shortcodes [trx_testimonials] and [trx_testimonials_item]

if (function_exists('bugspatrol_exists_visual_composer') && bugspatrol_exists_visual_composer())
    add_action('bugspatrol_action_shortcodes_list',		'bugspatrol_testimonials_reg_shortcodes');
    add_action('bugspatrol_action_shortcodes_list_vc','bugspatrol_testimonials_reg_shortcodes_vc');






// ---------------------------------- [trx_testimonials] ---------------------------------------

/*
[trx_testimonials id="unique_id" style="1|2|3"]
	[trx_testimonials_item user="user_login"]Testimonials text[/trx_testimonials_item]
	[trx_testimonials_item email="" name="" position="" photo="photo_url"]Testimonials text[/trx_testimonials]
[/trx_testimonials]
*/

if (!function_exists('bugspatrol_sc_testimonials')) {
    function bugspatrol_sc_testimonials($atts, $content=null){
        if (bugspatrol_in_shortcode_blogger()) return '';
        extract(bugspatrol_html_decode(shortcode_atts(array(
            // Individual params
            "style" => "testimonials-1",
            "columns" => 1,
            "slider" => "yes",
            "style_color" => "",
            "slides_space" => 0,
            "controls" => "no",
            "interval" => "",
            "autoheight" => "no",
            "align" => "",
            "custom" => "no",
            "ids" => "",
            "cat" => "",
            "count" => "3",
            "offset" => "",
            "orderby" => "date",
            "order" => "desc",
            "scheme" => "",
            "bg_color" => "",
            "bg_image" => "",
            "bg_overlay" => "",
            "bg_texture" => "",
            "title" => "",
            "subtitle" => "",
            "description" => "",
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

        if (empty($id)) $id = "sc_testimonials_".str_replace('.', '', mt_rand());
        if (empty($width)) $width = "100%";
        if (!empty($height) && bugspatrol_param_is_on($autoheight)) $autoheight = "no";
        if (empty($interval)) $interval = mt_rand(5000, 10000);

        if ($bg_image > 0) {
            $attach = wp_get_attachment_image_src( $bg_image, 'full' );
            if (isset($attach[0]) && $attach[0]!='')
                $bg_image = $attach[0];
        }

        if ($bg_overlay > 0) {
            if ($bg_color=='') $bg_color = bugspatrol_get_scheme_color('bg');
            $rgb = bugspatrol_hex2rgb($bg_color);
        }

        $class .= ($class ? ' ' : '') . bugspatrol_get_css_position_as_classes($top, $right, $bottom, $left);

        $ws = bugspatrol_get_css_dimensions_from_values($width);
        $hs = bugspatrol_get_css_dimensions_from_values('', $height);
        $css .= ($hs) . ($ws);

        $count = max(1, (int) $count);
        $columns = max(1, min(12, (int) $columns));
        if (bugspatrol_param_is_off($custom) && $count < $columns) $columns = $count;

        bugspatrol_storage_set('sc_testimonials_data', array(
                'id' => $id,
                'style' => $style,
                'columns' => $columns,
                'counter' => 0,
                'slider' => $slider,
                'css_wh' => $ws . $hs
            )
        );

        if (bugspatrol_param_is_on($slider)) bugspatrol_enqueue_slider('swiper');

        $output = ($bg_color!='' || $bg_image!='' || $bg_overlay>0 || $bg_texture>0 || bugspatrol_strlen($bg_texture)>2 || ($scheme && !bugspatrol_param_is_off($scheme) && !bugspatrol_param_is_inherit($scheme))
                ? '<div class="sc_testimonials_wrap sc_section'
                . ($scheme && !bugspatrol_param_is_off($scheme) && !bugspatrol_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '')
                . '"'
                .' style="'
                . ($bg_color !== '' && $bg_overlay==0 ? 'background-color:' . esc_attr($bg_color) . ';' : '')
                . ($bg_image !== '' ? 'background-image:url(' . esc_url($bg_image) . ');' : '')
                . '"'
                . (!bugspatrol_param_is_off($animation) ? ' data-animation="'.esc_attr(bugspatrol_get_animation_classes($animation)).'"' : '')
                . '>'
                . '<div class="sc_section_overlay'.($bg_texture>0 ? ' texture_bg_'.esc_attr($bg_texture) : '') . '"'
                . ' style="' . ($bg_overlay>0 ? 'background-color:rgba('.(int)$rgb['r'].','.(int)$rgb['g'].','.(int)$rgb['b'].','.min(1, max(0, $bg_overlay)).');' : '')
                . (bugspatrol_strlen($bg_texture)>2 ? 'background-image:url('.esc_url($bg_texture).');' : '')
                . '"'
                . ($bg_overlay > 0 ? ' data-overlay="'.esc_attr($bg_overlay).'" data-bg_color="'.esc_attr($bg_color).'"' : '')
                . '>'
                : '')
            . '<div' . ($id ? ' id="'.esc_attr($id).'"' : '')
            . ' class="sc_testimonials sc_testimonials_style_'.esc_attr($style)
            . ' ' . esc_attr(bugspatrol_get_template_property($style, 'container_classes'))
            . (!empty($class) ? ' '.esc_attr($class) : '')
            . (!empty($style_color) ? ' '.esc_attr($style_color) : '')
            . ($align!='' && $align!='none' ? ' align'.esc_attr($align) : '')
            . '"'
            . ($bg_color=='' && $bg_image=='' && $bg_overlay==0 && ($bg_texture=='' || $bg_texture=='0') && !bugspatrol_param_is_off($animation) ? ' data-animation="'.esc_attr(bugspatrol_get_animation_classes($animation)).'"' : '')
            . ($css!='' ? ' style="'.esc_attr($css).'"' : '')
            . '>'
            . (!empty($subtitle) ? '<h6 class="sc_testimonials_subtitle sc_item_subtitle">' . trim(bugspatrol_strmacros($subtitle)) . '</h6>' : '')
            . (!empty($title) ? '<h2 class="sc_testimonials_title sc_item_title">' . trim(bugspatrol_strmacros($title)) . '</h2>' : '')
            . (!empty($description) ? '<div class="sc_testimonials_descr sc_item_descr">' . trim(bugspatrol_strmacros($description)) . '</div>' : '')
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
                    ? '<div class="sc_columns columns_wrap">'
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
                'post_type' => 'testimonial',
                'post_status' => 'publish',
                'posts_per_page' => $count,
                'ignore_sticky_posts' => true,
                'order' => $order=='asc' ? 'asc' : 'desc',
            );

            if ($offset > 0 && empty($ids)) {
                $args['offset'] = $offset;
            }

            $args = bugspatrol_query_add_sort_order($args, $orderby, $order);
            $args = bugspatrol_query_add_posts_and_cats($args, $ids, 'testimonial', $cat, 'testimonial_group');

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
                    'columns_count' => $columns,
                    'slider' => $slider,
                    'tag_id' => $id ? $id . '_' . $post_number : '',
                    'tag_class' => '',
                    'tag_animation' => '',
                    'tag_css' => '',
                    'tag_css_wh' => $ws . $hs
                );
                $post_data = bugspatrol_get_post_data($args);
                $post_data['post_content'] = wpautop($post_data['post_content']);	// Add <p> around text and paragraphs. Need separate call because 'content'=>false (see above)
                $post_meta = get_post_meta($post_data['post_id'], bugspatrol_storage_get('options_prefix').'_testimonial_data', true);
                $thumb_sizes = bugspatrol_get_thumb_sizes(array('layout' => $style));
                $args['author'] = $post_meta['testimonial_author'];
                $args['position'] = $post_meta['testimonial_position'];
                $args['link'] = !empty($post_meta['testimonial_link']) ? $post_meta['testimonial_link'] : '';					$args['email'] = $post_meta['testimonial_email'];
                $args['photo'] = $post_data['post_thumb'];
                $mult = bugspatrol_get_retina_multiplier();
                if (empty($args['photo']) && !empty($args['email'])) $args['photo'] = get_avatar($args['email'], $thumb_sizes['w']*$mult);
                $output .= bugspatrol_show_post_layout($args, $post_data);
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
        }

        $output .= '</div>'
            . ($bg_color!='' || $bg_image!='' || $bg_overlay>0 || $bg_texture>0 || bugspatrol_strlen($bg_texture)>2 || ($scheme && !bugspatrol_param_is_off($scheme) && !bugspatrol_param_is_inherit($scheme))
                ?  '</div></div>'
                : '');

        // Add template specific scripts and styles
        do_action('bugspatrol_action_blog_scripts', $style);

        return apply_filters('bugspatrol_shortcode_output', $output, 'trx_testimonials', $atts, $content);
    }
    bugspatrol_require_shortcode('trx_testimonials', 'bugspatrol_sc_testimonials');
}


if (!function_exists('bugspatrol_sc_testimonials_item')) {
    function bugspatrol_sc_testimonials_item($atts, $content=null){
        if (bugspatrol_in_shortcode_blogger()) return '';
        extract(bugspatrol_html_decode(shortcode_atts(array(
            // Individual params
            "author" => "",
            "position" => "",
            "link" => "",
            "photo" => "",
            "email" => "",
            // Common params
            "id" => "",
            "class" => "",
            "css" => "",
        ), $atts)));

        bugspatrol_storage_inc_array('sc_testimonials_data', 'counter');

        $id = $id ? $id : (bugspatrol_storage_get_array('sc_testimonials_data', 'id') ? bugspatrol_storage_get_array('sc_testimonials_data', 'id') . '_' . bugspatrol_storage_get_array('sc_testimonials_data', 'counter') : '');

        $thumb_sizes = bugspatrol_get_thumb_sizes(array('layout' => bugspatrol_storage_get_array('sc_testimonials_data', 'style')));

        if (empty($photo)) {
            if (!empty($email))
                $mult = bugspatrol_get_retina_multiplier();
            $photo = get_avatar($email, $thumb_sizes['w']*$mult);
        } else {
            if ($photo > 0) {
                $attach = wp_get_attachment_image_src( $photo, 'full' );
                if (isset($attach[0]) && $attach[0]!='')
                    $photo = $attach[0];
            }
            $photo = bugspatrol_get_resized_image_tag($photo, $thumb_sizes['w'], $thumb_sizes['h']);
        }

        $post_data = array(
            'post_content' => do_shortcode($content)
        );
        $args = array(
            'layout' => bugspatrol_storage_get_array('sc_testimonials_data', 'style'),
            'number' => bugspatrol_storage_get_array('sc_testimonials_data', 'counter'),
            'columns_count' => bugspatrol_storage_get_array('sc_testimonials_data', 'columns'),
            'slider' => bugspatrol_storage_get_array('sc_testimonials_data', 'slider'),
            'show' => false,
            'descr'  => 0,
            'tag_id' => $id,
            'tag_class' => $class,
            'tag_animation' => '',
            'tag_css' => $css,
            'tag_css_wh' => bugspatrol_storage_get_array('sc_testimonials_data', 'css_wh'),
            'author' => $author,
            'position' => $position,
            'link' => $link,
            'email' => $email,
            'photo' => $photo
        );
        $output = bugspatrol_show_post_layout($args, $post_data);

        return apply_filters('bugspatrol_shortcode_output', $output, 'trx_testimonials_item', $atts, $content);
    }
    bugspatrol_require_shortcode('trx_testimonials_item', 'bugspatrol_sc_testimonials_item');
}
// ---------------------------------- [/trx_testimonials] ---------------------------------------



// Add [trx_testimonials] and [trx_testimonials_item] in the shortcodes list
if (!function_exists('bugspatrol_testimonials_reg_shortcodes')) {
    function bugspatrol_testimonials_reg_shortcodes() {
        if (bugspatrol_storage_isset('shortcodes')) {

            $testimonials_groups = bugspatrol_get_list_terms(false, 'testimonial_group');
            $testimonials_styles = bugspatrol_get_list_templates('testimonials');
            $controls = bugspatrol_get_list_slider_controls();

            bugspatrol_sc_map_before('trx_title', array(

                // Testimonials
                "trx_testimonials" => array(
                    "title" => esc_html__("Testimonials", 'bugspatrol'),
                    "desc" => wp_kses_data( __("Insert testimonials into post (page)", 'bugspatrol') ),
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
                            "title" => esc_html__("Testimonials style", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Select style to display testimonials", 'bugspatrol') ),
                            "value" => "testimonials-1",
                            "type" => "select",
                            "options" => $testimonials_styles
                        ),
                        "columns" => array(
                            "title" => esc_html__("Columns", 'bugspatrol'),
                            "desc" => wp_kses_data( __("How many columns use to show testimonials", 'bugspatrol') ),
                            "value" => 1,
                            "min" => 1,
                            "max" => 6,
                            "step" => 1,
                            "type" => "spinner"
                        ),
                        "slider" => array(
                            "title" => esc_html__("Slider", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Use slider to show testimonials", 'bugspatrol') ),
                            "value" => "yes",
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
                            "desc" => wp_kses_data( __("Alignment of the testimonials block", 'bugspatrol') ),
                            "divider" => true,
                            "value" => "",
                            "type" => "checklist",
                            "dir" => "horizontal",
                            "options" => bugspatrol_get_sc_param('align')
                        ),
                        "custom" => array(
                            "title" => esc_html__("Custom", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Allow get testimonials from inner shortcodes (custom) or get it from specified group (cat)", 'bugspatrol') ),
                            "divider" => true,
                            "value" => "no",
                            "type" => "switch",
                            "options" => bugspatrol_get_sc_param('yes_no')
                        ),
                        "cat" => array(
                            "title" => esc_html__("Categories", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Select categories (groups) to show testimonials. If empty - select testimonials from any category (group) or from IDs list", 'bugspatrol') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "divider" => true,
                            "value" => "",
                            "type" => "select",
                            "style" => "list",
                            "multiple" => true,
                            "options" => bugspatrol_array_merge(array(0 => esc_html__('- Select category -', 'bugspatrol')), $testimonials_groups)
                        ),
                        "count" => array(
                            "title" => esc_html__("Number of posts", 'bugspatrol'),
                            "desc" => wp_kses_data( __("How many posts will be displayed? If used IDs - this parameter ignored.", 'bugspatrol') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "value" => 3,
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
                        "scheme" => array(
                            "title" => esc_html__("Color scheme", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Select color scheme for this block", 'bugspatrol') ),
                            "value" => "",
                            "type" => "checklist",
                            "options" => bugspatrol_get_sc_param('schemes')
                        ),
                        "bg_color" => array(
                            "title" => esc_html__("Background color", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Any background color for this section", 'bugspatrol') ),
                            "value" => "",
                            "type" => "color"
                        ),
                        "bg_image" => array(
                            "title" => esc_html__("Background image URL", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Select or upload image or write URL from other site for the background", 'bugspatrol') ),
                            "readonly" => false,
                            "value" => "",
                            "type" => "media"
                        ),
                        "bg_overlay" => array(
                            "title" => esc_html__("Overlay", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Overlay color opacity (from 0.0 to 1.0)", 'bugspatrol') ),
                            "min" => "0",
                            "max" => "1",
                            "step" => "0.1",
                            "value" => "0",
                            "type" => "spinner"
                        ),
                        "bg_texture" => array(
                            "title" => esc_html__("Texture", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Predefined texture style from 1 to 11. 0 - without texture.", 'bugspatrol') ),
                            "min" => "0",
                            "max" => "11",
                            "step" => "1",
                            "value" => "0",
                            "type" => "spinner"
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
                        "name" => "trx_testimonials_item",
                        "title" => esc_html__("Item", 'bugspatrol'),
                        "desc" => wp_kses_data( __("Testimonials item (custom parameters)", 'bugspatrol') ),
                        "container" => true,
                        "params" => array(
                            "author" => array(
                                "title" => esc_html__("Author", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Name of the testimonmials author", 'bugspatrol') ),
                                "value" => "",
                                "type" => "text"
                            ),
                            "link" => array(
                                "title" => esc_html__("Link", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Link URL to the testimonmials author page", 'bugspatrol') ),
                                "value" => "",
                                "type" => "text"
                            ),
                            "email" => array(
                                "title" => esc_html__("E-mail", 'bugspatrol'),
                                "desc" => wp_kses_data( __("E-mail of the testimonmials author (to get gravatar)", 'bugspatrol') ),
                                "value" => "",
                                "type" => "text"
                            ),
                            "photo" => array(
                                "title" => esc_html__("Photo", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Select or upload photo of testimonmials author or write URL of photo from other site", 'bugspatrol') ),
                                "value" => "",
                                "type" => "media"
                            ),
                            "_content_" => array(
                                "title" => esc_html__("Testimonials text", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Current testimonials text", 'bugspatrol') ),
                                "divider" => true,
                                "rows" => 4,
                                "value" => "",
                                "type" => "textarea"
                            ),
                            "id" => bugspatrol_get_sc_param('id'),
                            "class" => bugspatrol_get_sc_param('class'),
                            "css" => bugspatrol_get_sc_param('css')
                        )
                    )
                )

            ));
        }
    }
}


// Add [trx_testimonials] and [trx_testimonials_item] in the VC shortcodes list
if (!function_exists('bugspatrol_testimonials_reg_shortcodes_vc')) {
    function bugspatrol_testimonials_reg_shortcodes_vc() {

        $testimonials_groups = bugspatrol_get_list_terms(false, 'testimonial_group');
        $testimonials_styles = bugspatrol_get_list_templates('testimonials');
        $controls			 = bugspatrol_get_list_slider_controls();

        // Testimonials
        vc_map( array(
            "base" => "trx_testimonials",
            "name" => esc_html__("Testimonials", 'bugspatrol'),
            "description" => wp_kses_data( __("Insert testimonials slider", 'bugspatrol') ),
            "category" => esc_html__('Content', 'bugspatrol'),
            'icon' => 'icon_trx_testimonials',
            "class" => "trx_sc_columns trx_sc_testimonials",
            "content_element" => true,
            "is_container" => true,
            "show_settings_on_create" => true,
            "as_parent" => array('only' => 'trx_testimonials_item'),
            "params" => array(
                array(
                    "param_name" => "style",
                    "heading" => esc_html__("Testimonials style", 'bugspatrol'),
                    "description" => wp_kses_data( __("Select style to display testimonials", 'bugspatrol') ),
                    "class" => "",
                    "admin_label" => true,
                    "value" => array_flip($testimonials_styles),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "style_color",
                    "heading" => esc_html__("Testimonials style color", 'bugspatrol'),
                    "description" => wp_kses_data( __("Testimonials style color", 'bugspatrol') ),
                    "class" => "",
                    "value" => array(
                        esc_html__('Original', 'bugspatrol') => 'original_style',
                        esc_html__('White text', 'bugspatrol') => 'white_text_testim'
                    ),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "slider",
                    "heading" => esc_html__("Slider", 'bugspatrol'),
                    "description" => wp_kses_data( __("Use slider to show testimonials", 'bugspatrol') ),
                    "admin_label" => true,
                    "group" => esc_html__('Slider', 'bugspatrol'),
                    "class" => "",
                    "std" => "yes",
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
                    "description" => wp_kses_data( __("Alignment of the testimonials block", 'bugspatrol') ),
                    "class" => "",
                    "value" => array_flip(bugspatrol_get_sc_param('align')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "custom",
                    "heading" => esc_html__("Custom", 'bugspatrol'),
                    "description" => wp_kses_data( __("Allow get testimonials from inner shortcodes (custom) or get it from specified group (cat)", 'bugspatrol') ),
                    "class" => "",
                    "value" => array("Custom slides" => "yes" ),
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
                    "description" => wp_kses_data( __("Select categories (groups) to show testimonials. If empty - select testimonials from any category (group) or from IDs list", 'bugspatrol') ),
                    "group" => esc_html__('Query', 'bugspatrol'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "class" => "",
                    "value" => array_flip(bugspatrol_array_merge(array(0 => esc_html__('- Select category -', 'bugspatrol')), $testimonials_groups)),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "columns",
                    "heading" => esc_html__("Columns", 'bugspatrol'),
                    "description" => wp_kses_data( __("How many columns use to show testimonials", 'bugspatrol') ),
                    "group" => esc_html__('Query', 'bugspatrol'),
                    "admin_label" => true,
                    "class" => "",
                    "value" => "1",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "count",
                    "heading" => esc_html__("Number of posts", 'bugspatrol'),
                    "description" => wp_kses_data( __("How many posts will be displayed? If used IDs - this parameter ignored.", 'bugspatrol') ),
                    "group" => esc_html__('Query', 'bugspatrol'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "class" => "",
                    "value" => "3",
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
                    "heading" => esc_html__("Post IDs list", 'bugspatrol'),
                    "description" => wp_kses_data( __("Comma separated list of posts ID. If set - parameters above are ignored!", 'bugspatrol') ),
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
                    "param_name" => "scheme",
                    "heading" => esc_html__("Color scheme", 'bugspatrol'),
                    "description" => wp_kses_data( __("Select color scheme for this block", 'bugspatrol') ),
                    "group" => esc_html__('Colors and Images', 'bugspatrol'),
                    "class" => "",
                    "value" => array_flip(bugspatrol_get_sc_param('schemes')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "bg_color",
                    "heading" => esc_html__("Background color", 'bugspatrol'),
                    "description" => wp_kses_data( __("Any background color for this section", 'bugspatrol') ),
                    "group" => esc_html__('Colors and Images', 'bugspatrol'),
                    "class" => "",
                    "value" => "",
                    "type" => "colorpicker"
                ),
                array(
                    "param_name" => "bg_image",
                    "heading" => esc_html__("Background image URL", 'bugspatrol'),
                    "description" => wp_kses_data( __("Select background image from library for this section", 'bugspatrol') ),
                    "group" => esc_html__('Colors and Images', 'bugspatrol'),
                    "class" => "",
                    "value" => "",
                    "type" => "attach_image"
                ),
                array(
                    "param_name" => "bg_overlay",
                    "heading" => esc_html__("Overlay", 'bugspatrol'),
                    "description" => wp_kses_data( __("Overlay color opacity (from 0.0 to 1.0)", 'bugspatrol') ),
                    "group" => esc_html__('Colors and Images', 'bugspatrol'),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "bg_texture",
                    "heading" => esc_html__("Texture", 'bugspatrol'),
                    "description" => wp_kses_data( __("Texture style from 1 to 11. Empty or 0 - without texture.", 'bugspatrol') ),
                    "group" => esc_html__('Colors and Images', 'bugspatrol'),
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
            'js_view' => 'VcTrxColumnsView'
        ) );


        vc_map( array(
            "base" => "trx_testimonials_item",
            "name" => esc_html__("Testimonial", 'bugspatrol'),
            "description" => wp_kses_data( __("Single testimonials item", 'bugspatrol') ),
            "show_settings_on_create" => true,
            "class" => "trx_sc_collection trx_sc_column_item trx_sc_testimonials_item",
            "content_element" => true,
            "is_container" => true,
            'icon' => 'icon_trx_testimonials_item',
            "as_child" => array('only' => 'trx_testimonials'),
            "as_parent" => array('except' => 'trx_testimonials'),
            "params" => array(
                array(
                    "param_name" => "author",
                    "heading" => esc_html__("Author", 'bugspatrol'),
                    "description" => wp_kses_data( __("Name of the testimonmials author", 'bugspatrol') ),
                    "admin_label" => true,
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "link",
                    "heading" => esc_html__("Link", 'bugspatrol'),
                    "description" => wp_kses_data( __("Link URL to the testimonmials author page", 'bugspatrol') ),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "email",
                    "heading" => esc_html__("E-mail", 'bugspatrol'),
                    "description" => wp_kses_data( __("E-mail of the testimonmials author", 'bugspatrol') ),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "photo",
                    "heading" => esc_html__("Photo", 'bugspatrol'),
                    "description" => wp_kses_data( __("Select or upload photo of testimonmials author or write URL of photo from other site", 'bugspatrol') ),
                    "class" => "",
                    "value" => "",
                    "type" => "attach_image"
                ),
                /*
                array(
                    "param_name" => "content",
                    "heading" => esc_html__("Testimonials text", 'bugspatrol'),
                    "description" => wp_kses_data( __("Current testimonials text", 'bugspatrol') ),
                    "class" => "",
                    "value" => "",
                    "type" => "textarea_html"
                ),
                */
                bugspatrol_get_vc_param('id'),
                bugspatrol_get_vc_param('class'),
                bugspatrol_get_vc_param('css')
            ),
            'js_view' => 'VcTrxColumnItemView'
        ) );

        class WPBakeryShortCode_Trx_Testimonials extends Bugspatrol_VC_ShortCodeColumns {}
        class WPBakeryShortCode_Trx_Testimonials_Item extends Bugspatrol_VC_ShortCodeCollection {}

    }
}