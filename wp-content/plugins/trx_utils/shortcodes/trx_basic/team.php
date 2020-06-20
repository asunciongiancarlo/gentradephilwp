<?php


// Register shortcodes [trx_team] and [trx_team_item]

if (function_exists('bugspatrol_exists_visual_composer') && bugspatrol_exists_visual_composer())
    add_action('bugspatrol_action_shortcodes_list',		'bugspatrol_team_reg_shortcodes');
    add_action('bugspatrol_action_shortcodes_list_vc','bugspatrol_team_reg_shortcodes_vc');





// ---------------------------------- [trx_team] ---------------------------------------

/*
[trx_team id="unique_id" columns="3" style="team-1|team-2|..."]
	[trx_team_item user="user_login"]
	[trx_team_item member="member_id"]
	[trx_team_item name="team member name" photo="url" email="address" position="director"]
[/trx_team]
*/
if ( !function_exists( 'bugspatrol_sc_team' ) ) {
    function bugspatrol_sc_team($atts, $content=null){
        if (bugspatrol_in_shortcode_blogger()) return '';
        extract(bugspatrol_html_decode(shortcode_atts(array(
            // Individual params
            "style" => "team-1",
            "slider" => "no",
            "controls" => "no",
            "slides_space" => 0,
            "interval" => "",
            "autoheight" => "no",
            "align" => "",
            "custom" => "no",
            "ids" => "",
            "cat" => "",
            "count" => 3,
            "columns" => 3,
            "offset" => "",
            "orderby" => "title",
            "order" => "asc",
            "title" => "",
            "subtitle" => "",
            "description" => "",
            "link_caption" => esc_html__('Learn more', 'bugspatrol'),
            "link" => '',
            "scheme" => '',
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

        if (empty($id)) $id = "sc_team_".str_replace('.', '', mt_rand());
        if (empty($width)) $width = "100%";
        if (!empty($height) && bugspatrol_param_is_on($autoheight)) $autoheight = "no";
        if (empty($interval)) $interval = mt_rand(5000, 10000);

        $class .= ($class ? ' ' : '') . bugspatrol_get_css_position_as_classes($top, $right, $bottom, $left);

        $ws = bugspatrol_get_css_dimensions_from_values($width);
        $hs = bugspatrol_get_css_dimensions_from_values('', $height);
        $css .= ($hs) . ($ws);

        $count = max(1, (int) $count);
        $columns = max(1, min(12, (int) $columns));
        if (bugspatrol_param_is_off($custom) && $count < $columns) $columns = $count;

        bugspatrol_storage_set('sc_team_data', array(
                'id' => $id,
                'style' => $style,
                'columns' => $columns,
                'counter' => 0,
                'slider' => $slider,
                'css_wh' => $ws . $hs
            )
        );

        if (bugspatrol_param_is_on($slider)) bugspatrol_enqueue_slider('swiper');

        $output = '<div' . ($id ? ' id="'.esc_attr($id).'_wrap"' : '')
            . ' class="sc_team_wrap'
            . ($scheme && !bugspatrol_param_is_off($scheme) && !bugspatrol_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '')
            .'">'
            . '<div' . ($id ? ' id="'.esc_attr($id).'"' : '')
            . ' class="sc_team sc_team_style_'.esc_attr($style)
            . ' ' . esc_attr(bugspatrol_get_template_property($style, 'container_classes'))
            . (!empty($class) ? ' '.esc_attr($class) : '')
            . ($align!='' && $align!='none' ? ' align'.esc_attr($align) : '')
            .'"'
            . ($css!='' ? ' style="'.esc_attr($css).'"' : '')
            . (!bugspatrol_param_is_off($animation) ? ' data-animation="'.esc_attr(bugspatrol_get_animation_classes($animation)).'"' : '')
            . '>'
            . (!empty($subtitle) ? '<h6 class="sc_team_subtitle sc_item_subtitle">' . trim(bugspatrol_strmacros($subtitle)) . '</h6>' : '')
            . (!empty($title) ? '<h2 class="sc_team_title sc_item_title">' . trim(bugspatrol_strmacros($title)) . '</h2>' : '')
            . (!empty($description) ? '<div class="sc_team_descr sc_item_descr">' . trim(bugspatrol_strmacros($description)) . '</div>' : '')
            . (bugspatrol_param_is_on($slider)
                ? ('<div class="sc_slider_swiper swiper-slider-container'
                    . ' ' . esc_attr(bugspatrol_get_slider_controls_classes($controls))
                    . (bugspatrol_param_is_on($autoheight) ? ' sc_slider_height_auto' : '')
                    . ($hs ? ' sc_slider_height_fixed' : '')
                    . '"'
                    . (!empty($width) && bugspatrol_strpos($width, '%')===false ? ' data-old-width="' . esc_attr($width) . '"' : '')
                    . (!empty($height) && bugspatrol_strpos($height, '%')===false ? ' data-old-height="' . esc_attr($height) . '"' : '')
                    . ((int) $interval > 0 ? ' data-interval="'.esc_attr($interval).'"' : '')
                    . ($slides_space > 0 ? ' data-slides-space="' . esc_attr($slides_space) . '"' : '')
                    . ($columns > 1 ? ' data-slides-per-view="' . esc_attr($columns) . '"' : '')
                    . ' data-slides-min-width="250"'
                    . '>'
                    . '<div class="slides swiper-wrapper">')
                : ($columns > 1 							? '<div class="sc_columns columns_wrap">'
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
                'post_type' => 'team',
                'post_status' => 'publish',
                'posts_per_page' => $count,
                'ignore_sticky_posts' => true,
                'order' => $order=='asc' ? 'asc' : 'desc',
            );

            if ($offset > 0 && empty($ids)) {
                $args['offset'] = $offset;
            }

            $args = bugspatrol_query_add_sort_order($args, $orderby, $order);
            $args = bugspatrol_query_add_posts_and_cats($args, $ids, 'team', $cat, 'team_group');
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
                    "columns_count" => $columns,
                    'slider' => $slider,
                    'tag_id' => $id ? $id . '_' . $post_number : '',
                    'tag_class' => '',
                    'tag_animation' => '',
                    'tag_css' => '',
                    'tag_css_wh' => $ws . $hs
                );
                $post_data = bugspatrol_get_post_data($args);
                $post_meta = get_post_meta($post_data['post_id'], bugspatrol_storage_get('options_prefix').'_team_data', true);
                $thumb_sizes = bugspatrol_get_thumb_sizes(array('layout' => $style));
                $args['position'] = $post_meta['team_member_position'];
                $args['link'] = !empty($post_meta['team_member_link']) ? $post_meta['team_member_link'] : $post_data['post_link'];
                $args['email'] = $post_meta['team_member_email'];
                $args['photo'] = $post_data['post_thumb'];
                $mult = bugspatrol_get_retina_multiplier();
                if (empty($args['photo']) && !empty($args['email'])) $args['photo'] = get_avatar($args['email'], $thumb_sizes['w']*$mult);
                $args['socials'] = '';
                $soc_list = $post_meta['team_member_socials'];
                if (is_array($soc_list) && count($soc_list)>0) {
                    $soc_str = '';
                    foreach ($soc_list as $sn=>$sl) {
                        if (!empty($sl))
                            $soc_str .= (!empty($soc_str) ? '|' : '') . ($sn) . '=' . ($sl);
                    }
                    if (!empty($soc_str))
                        $args['socials'] = bugspatrol_do_shortcode('[trx_socials size="tiny" shape="round" socials="'.esc_attr($soc_str).'"][/trx_socials]');
                }

                $output .= bugspatrol_show_post_layout($args, $post_data);
            }
            wp_reset_postdata();
        }

        if (bugspatrol_param_is_on($slider)) {
            $output .= '</div>'
                . '<div class="sc_slider_controls_wrap"><a class="sc_slider_prev" href="#"></a><a class="sc_slider_next" href="#"></a></div>'
                . '<div class="sc_slider_pagination_wrap"></div>'
                . '</div>';
        } else if ($columns > 1) {			$output .= '</div>';
        }

        $output .= (!empty($link) ? '<div class="sc_team_button sc_item_button">'.bugspatrol_do_shortcode('[trx_button link="'.esc_url($link).'" icon="icon-right"]'.esc_html($link_caption).'[/trx_button]').'</div>' : '')
            . '</div><!-- /.sc_team -->'
            . '</div><!-- /.sc_team_wrap -->';

        // Add template specific scripts and styles
        do_action('bugspatrol_action_blog_scripts', $style);

        return apply_filters('bugspatrol_shortcode_output', $output, 'trx_team', $atts, $content);
    }
    bugspatrol_require_shortcode('trx_team', 'bugspatrol_sc_team');
}


if ( !function_exists( 'bugspatrol_sc_team_item' ) ) {
    function bugspatrol_sc_team_item($atts, $content=null) {
        if (bugspatrol_in_shortcode_blogger()) return '';
        extract(bugspatrol_html_decode(shortcode_atts( array(
            // Individual params
            "user" => "",
            "member" => "",
            "name" => "",
            "position" => "",
            "photo" => "",
            "email" => "",
            "link" => "",
            "socials" => "",
            // Common params
            "id" => "",
            "class" => "",
            "animation" => "",
            "css" => ""
        ), $atts)));

        bugspatrol_storage_inc_array('sc_team_data', 'counter');

        $id = $id ? $id : (bugspatrol_storage_get_array('sc_team_data', 'id') ? bugspatrol_storage_get_array('sc_team_data', 'id') . '_' . bugspatrol_storage_get_array('sc_team_data', 'counter') : '');

        $descr = trim(chop(do_shortcode($content)));

        $thumb_sizes = bugspatrol_get_thumb_sizes(array('layout' => bugspatrol_storage_get_array('sc_team_data', 'style')));

        if (!empty($socials)) $socials = bugspatrol_do_shortcode('[trx_socials size="tiny" shape="round" socials="'.esc_attr($socials).'"][/trx_socials]');

        if (!empty($user) && $user!='none' && ($user_obj = get_user_by('login', $user)) != false) {
            $meta = get_user_meta($user_obj->ID);
            if (empty($email))		$email = $user_obj->data->user_email;
            if (empty($name))		$name = $user_obj->data->display_name;
            if (empty($position))	$position = isset($meta['user_position'][0]) ? $meta['user_position'][0] : '';
            if (empty($descr))		$descr = isset($meta['description'][0]) ? $meta['description'][0] : '';
            if (empty($socials))	$socials = bugspatrol_show_user_socials(array('author_id'=>$user_obj->ID, 'echo'=>false));
        }

        if (!empty($member) && $member!='none' && ($member_obj = (intval($member) > 0 ? get_post($member, OBJECT) : get_page_by_title($member, OBJECT, 'team'))) != null) {
            if (empty($name))		$name = $member_obj->post_title;
            if (empty($descr))		$descr = $member_obj->post_excerpt;
            $post_meta = get_post_meta($member_obj->ID, bugspatrol_storage_get('options_prefix').'_team_data', true);
            if (empty($position))	$position = $post_meta['team_member_position'];
            if (empty($link))		$link = !empty($post_meta['team_member_link']) ? $post_meta['team_member_link'] : get_permalink($member_obj->ID);
            if (empty($email))		$email = $post_meta['team_member_email'];
            if (empty($photo)) 		$photo = wp_get_attachment_url(get_post_thumbnail_id($member_obj->ID));
            if (empty($socials)) {
                $socials = '';
                $soc_list = $post_meta['team_member_socials'];
                if (is_array($soc_list) && count($soc_list)>0) {
                    $soc_str = '';
                    foreach ($soc_list as $sn=>$sl) {
                        if (!empty($sl))
                            $soc_str .= (!empty($soc_str) ? '|' : '') . ($sn) . '=' . ($sl);
                    }
                    if (!empty($soc_str))
                        $socials = bugspatrol_do_shortcode('[trx_socials size="tiny" shape="round" socials="'.esc_attr($soc_str).'"][/trx_socials]');
                }
            }
        }
        if (empty($photo)) {
            $mult = bugspatrol_get_retina_multiplier();
            if (!empty($email)) $photo = get_avatar($email, $thumb_sizes['w']*$mult);
        } else {
            if ($photo > 0) {
                $attach = wp_get_attachment_image_src( $photo, 'full' );
                if (isset($attach[0]) && $attach[0]!='')
                    $photo = $attach[0];
            }
            $photo = bugspatrol_get_resized_image_tag($photo, $thumb_sizes['w'], $thumb_sizes['h']);
        }
        $post_data = array(
            'post_title' => $name,
            'post_excerpt' => $descr
        );
        $args = array(
            'layout' => bugspatrol_storage_get_array('sc_team_data', 'style'),
            'number' => bugspatrol_storage_get_array('sc_team_data', 'counter'),
            'columns_count' => bugspatrol_storage_get_array('sc_team_data', 'columns'),
            'slider' => bugspatrol_storage_get_array('sc_team_data', 'slider'),
            'show' => false,
            'descr'  => 0,
            'tag_id' => $id,
            'tag_class' => $class,
            'tag_animation' => $animation,
            'tag_css' => $css,
            'tag_css_wh' => bugspatrol_storage_get_array('sc_team_data', 'css_wh'),
            'position' => $position,
            'link' => $link,
            'email' => $email,
            'photo' => $photo,
            'socials' => $socials
        );
        $output = bugspatrol_show_post_layout($args, $post_data);

        return apply_filters('bugspatrol_shortcode_output', $output, 'trx_team_item', $atts, $content);
    }
    bugspatrol_require_shortcode('trx_team_item', 'bugspatrol_sc_team_item');
}
// ---------------------------------- [/trx_team] ---------------------------------------



// Add [trx_team] and [trx_team_item] in the shortcodes list
if (!function_exists('bugspatrol_team_reg_shortcodes')) {
    function bugspatrol_team_reg_shortcodes() {
        if (bugspatrol_storage_isset('shortcodes')) {

            $users = bugspatrol_get_list_users();
            $members = bugspatrol_get_list_posts(false, array(
                    'post_type'=>'team',
                    'orderby'=>'title',
                    'order'=>'asc',
                    'return'=>'title'
                )
            );
            $team_groups = bugspatrol_get_list_terms(false, 'team_group');
            $team_styles = bugspatrol_get_list_templates('team');
            $controls	 = bugspatrol_get_list_slider_controls();

            bugspatrol_sc_map_after('trx_tabs', array(

                // Team
                "trx_team" => array(
                    "title" => esc_html__("Team", 'bugspatrol'),
                    "desc" => wp_kses_data( __("Insert team in your page (post)", 'bugspatrol') ),
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
                            "title" => esc_html__("Team style", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Select style to display team members", 'bugspatrol') ),
                            "value" => "1",
                            "type" => "select",
                            "options" => $team_styles
                        ),
                        "columns" => array(
                            "title" => esc_html__("Columns", 'bugspatrol'),
                            "desc" => wp_kses_data( __("How many columns use to show team members", 'bugspatrol') ),
                            "value" => 3,
                            "min" => 2,
                            "max" => 5,
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
                            "desc" => wp_kses_data( __("Use slider to show team members", 'bugspatrol') ),
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
                            "desc" => wp_kses_data( __("Alignment of the team block", 'bugspatrol') ),
                            "divider" => true,
                            "value" => "",
                            "type" => "checklist",
                            "dir" => "horizontal",
                            "options" => bugspatrol_get_sc_param('align')
                        ),
                        "custom" => array(
                            "title" => esc_html__("Custom", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Allow get team members from inner shortcodes (custom) or get it from specified group (cat)", 'bugspatrol') ),
                            "divider" => true,
                            "value" => "no",
                            "type" => "switch",
                            "options" => bugspatrol_get_sc_param('yes_no')
                        ),
                        "cat" => array(
                            "title" => esc_html__("Categories", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Select categories (groups) to show team members. If empty - select team members from any category (group) or from IDs list", 'bugspatrol') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "divider" => true,
                            "value" => "",
                            "type" => "select",
                            "style" => "list",
                            "multiple" => true,
                            "options" => bugspatrol_array_merge(array(0 => esc_html__('- Select category -', 'bugspatrol')), $team_groups)
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
                            "value" => "title",
                            "type" => "select",
                            "options" => bugspatrol_get_sc_param('sorting')
                        ),
                        "order" => array(
                            "title" => esc_html__("Post order", 'bugspatrol'),
                            "desc" => wp_kses_data( __("Select desired posts order", 'bugspatrol') ),
                            "dependency" => array(
                                'custom' => array('no')
                            ),
                            "value" => "asc",
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
                        "name" => "trx_team_item",
                        "title" => esc_html__("Member", 'bugspatrol'),
                        "desc" => wp_kses_data( __("Team member", 'bugspatrol') ),
                        "container" => true,
                        "params" => array(
                            "user" => array(
                                "title" => esc_html__("Registerd user", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Select one of registered users (if present) or put name, position, etc. in fields below", 'bugspatrol') ),
                                "value" => "",
                                "type" => "select",
                                "options" => $users
                            ),
                            "member" => array(
                                "title" => esc_html__("Team member", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Select one of team members (if present) or put name, position, etc. in fields below", 'bugspatrol') ),
                                "value" => "",
                                "type" => "select",
                                "options" => $members
                            ),
                            "link" => array(
                                "title" => esc_html__("Link", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Link on team member's personal page", 'bugspatrol') ),
                                "divider" => true,
                                "value" => "",
                                "type" => "text"
                            ),
                            "name" => array(
                                "title" => esc_html__("Name", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Team member's name", 'bugspatrol') ),
                                "divider" => true,
                                "dependency" => array(
                                    'user' => array('is_empty', 'none'),
                                    'member' => array('is_empty', 'none')
                                ),
                                "value" => "",
                                "type" => "text"
                            ),
                            "position" => array(
                                "title" => esc_html__("Position", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Team member's position", 'bugspatrol') ),
                                "dependency" => array(
                                    'user' => array('is_empty', 'none'),
                                    'member' => array('is_empty', 'none')
                                ),
                                "value" => "",
                                "type" => "text"
                            ),
                            "email" => array(
                                "title" => esc_html__("E-mail", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Team member's e-mail", 'bugspatrol') ),
                                "dependency" => array(
                                    'user' => array('is_empty', 'none'),
                                    'member' => array('is_empty', 'none')
                                ),
                                "value" => "",
                                "type" => "text"
                            ),
                            "photo" => array(
                                "title" => esc_html__("Photo", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Team member's photo (avatar)", 'bugspatrol') ),
                                "dependency" => array(
                                    'user' => array('is_empty', 'none'),
                                    'member' => array('is_empty', 'none')
                                ),
                                "value" => "",
                                "readonly" => false,
                                "type" => "media"
                            ),
                            "socials" => array(
                                "title" => esc_html__("Socials", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Team member's socials icons: name=url|name=url... For example: facebook=http://facebook.com/myaccount|twitter=http://twitter.com/myaccount", 'bugspatrol') ),
                                "dependency" => array(
                                    'user' => array('is_empty', 'none'),
                                    'member' => array('is_empty', 'none')
                                ),
                                "value" => "",
                                "type" => "text"
                            ),
                            "_content_" => array(
                                "title" => esc_html__("Description", 'bugspatrol'),
                                "desc" => wp_kses_data( __("Team member's short description", 'bugspatrol') ),
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


// Add [trx_team] and [trx_team_item] in the VC shortcodes list
if (!function_exists('bugspatrol_team_reg_shortcodes_vc')) {
    function bugspatrol_team_reg_shortcodes_vc() {

        $users = bugspatrol_get_list_users();
        $members = bugspatrol_get_list_posts(false, array(
                'post_type'=>'team',
                'orderby'=>'title',
                'order'=>'asc',
                'return'=>'title'
            )
        );
        $team_groups = bugspatrol_get_list_terms(false, 'team_group');
        $team_styles = bugspatrol_get_list_templates('team');
        $controls	 = bugspatrol_get_list_slider_controls();

        // Team
        vc_map( array(
            "base" => "trx_team",
            "name" => esc_html__("Team", 'bugspatrol'),
            "description" => wp_kses_data( __("Insert team members", 'bugspatrol') ),
            "category" => esc_html__('Content', 'bugspatrol'),
            'icon' => 'icon_trx_team',
            "class" => "trx_sc_columns trx_sc_team",
            "content_element" => true,
            "is_container" => true,
            "show_settings_on_create" => true,
            "as_parent" => array('only' => 'trx_team_item'),
            "params" => array(
                array(
                    "param_name" => "style",
                    "heading" => esc_html__("Team style", 'bugspatrol'),
                    "description" => wp_kses_data( __("Select style to display team members", 'bugspatrol') ),
                    "class" => "",
                    "admin_label" => true,
                    "value" => array_flip($team_styles),
                    "type" => "dropdown"
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
                    "param_name" => "slider",
                    "heading" => esc_html__("Slider", 'bugspatrol'),
                    "description" => wp_kses_data( __("Use slider to show team members", 'bugspatrol') ),
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
                    "description" => wp_kses_data( __("Alignment of the team block", 'bugspatrol') ),
                    "class" => "",
                    "value" => array_flip(bugspatrol_get_sc_param('align')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "custom",
                    "heading" => esc_html__("Custom", 'bugspatrol'),
                    "description" => wp_kses_data( __("Allow get team members from inner shortcodes (custom) or get it from specified group (cat)", 'bugspatrol') ),
                    "class" => "",
                    "value" => array("Custom members" => "yes" ),
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
                    "description" => wp_kses_data( __("Select category to show team members. If empty - select team members from any category (group) or from IDs list", 'bugspatrol') ),
                    "group" => esc_html__('Query', 'bugspatrol'),
                    'dependency' => array(
                        'element' => 'custom',
                        'is_empty' => true
                    ),
                    "class" => "",
                    "value" => array_flip(bugspatrol_array_merge(array(0 => esc_html__('- Select category -', 'bugspatrol')), $team_groups)),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "columns",
                    "heading" => esc_html__("Columns", 'bugspatrol'),
                    "description" => wp_kses_data( __("How many columns use to show team members", 'bugspatrol') ),
                    "group" => esc_html__('Query', 'bugspatrol'),
                    "admin_label" => true,
                    "class" => "",
                    "value" => "3",
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
                    "std" => "title",
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
                    "std" => "asc",
                    "class" => "",
                    "value" => array_flip(bugspatrol_get_sc_param('ordering')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "ids",
                    "heading" => esc_html__("Team member's IDs list", 'bugspatrol'),
                    "description" => wp_kses_data( __("Comma separated list of team members's ID. If set - parameters above (category, count, order, etc.)  are ignored!", 'bugspatrol') ),
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
					[trx_team_item user="' . esc_html__( 'Member 1', 'bugspatrol' ) . '"][/trx_team_item]
					[trx_team_item user="' . esc_html__( 'Member 2', 'bugspatrol' ) . '"][/trx_team_item]
					[trx_team_item user="' . esc_html__( 'Member 4', 'bugspatrol' ) . '"][/trx_team_item]
				',
            'js_view' => 'VcTrxColumnsView'
        ) );


        vc_map( array(
            "base" => "trx_team_item",
            "name" => esc_html__("Team member", 'bugspatrol'),
            "description" => wp_kses_data( __("Team member - all data pull out from it account on your site", 'bugspatrol') ),
            "show_settings_on_create" => true,
            "class" => "trx_sc_collection trx_sc_column_item trx_sc_team_item",
            "content_element" => true,
            "is_container" => true,
            'icon' => 'icon_trx_team_item',
            "as_child" => array('only' => 'trx_team'),
            "as_parent" => array('except' => 'trx_team'),
            "params" => array(
                array(
                    "param_name" => "user",
                    "heading" => esc_html__("Registered user", 'bugspatrol'),
                    "description" => wp_kses_data( __("Select one of registered users (if present) or put name, position, etc. in fields below", 'bugspatrol') ),
                    "admin_label" => true,
                    "class" => "",
                    "value" => array_flip($users),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "member",
                    "heading" => esc_html__("Team member", 'bugspatrol'),
                    "description" => wp_kses_data( __("Select one of team members (if present) or put name, position, etc. in fields below", 'bugspatrol') ),
                    "admin_label" => true,
                    "class" => "",
                    "value" => array_flip($members),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "link",
                    "heading" => esc_html__("Link", 'bugspatrol'),
                    "description" => wp_kses_data( __("Link on team member's personal page", 'bugspatrol') ),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "name",
                    "heading" => esc_html__("Name", 'bugspatrol'),
                    "description" => wp_kses_data( __("Team member's name", 'bugspatrol') ),
                    "admin_label" => true,
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "position",
                    "heading" => esc_html__("Position", 'bugspatrol'),
                    "description" => wp_kses_data( __("Team member's position", 'bugspatrol') ),
                    "admin_label" => true,
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "email",
                    "heading" => esc_html__("E-mail", 'bugspatrol'),
                    "description" => wp_kses_data( __("Team member's e-mail", 'bugspatrol') ),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "photo",
                    "heading" => esc_html__("Member's Photo", 'bugspatrol'),
                    "description" => wp_kses_data( __("Team member's photo (avatar)", 'bugspatrol') ),
                    "class" => "",
                    "value" => "",
                    "type" => "attach_image"
                ),
                array(
                    "param_name" => "socials",
                    "heading" => esc_html__("Socials", 'bugspatrol'),
                    "description" => wp_kses_data( __("Team member's socials icons: name=url|name=url... For example: facebook=http://facebook.com/myaccount|twitter=http://twitter.com/myaccount", 'bugspatrol') ),
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

        class WPBakeryShortCode_Trx_Team extends Bugspatrol_VC_ShortCodeColumns {}
        class WPBakeryShortCode_Trx_Team_Item extends Bugspatrol_VC_ShortCodeCollection {}

    }
}