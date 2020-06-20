<?php
/**
 * BugsPatrol Framework: Team support
 *
 * @package	bugspatrol
 * @since	bugspatrol 1.0
 */

// Theme init
if (!function_exists('bugspatrol_team_theme_setup')) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_team_theme_setup', 1 );
	function bugspatrol_team_theme_setup() {

		// Add item in the admin menu
		add_filter('trx_utils_filter_override_options',						'bugspatrol_team_add_override_options');

		// Save data from override options
		add_action('save_post',								'bugspatrol_team_save_data');
		
		// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
		add_filter('bugspatrol_filter_get_blog_type',			'bugspatrol_team_get_blog_type', 9, 2);
		add_filter('bugspatrol_filter_get_blog_title',		'bugspatrol_team_get_blog_title', 9, 2);
		add_filter('bugspatrol_filter_get_current_taxonomy',	'bugspatrol_team_get_current_taxonomy', 9, 2);
		add_filter('bugspatrol_filter_is_taxonomy',			'bugspatrol_team_is_taxonomy', 9, 2);
		add_filter('bugspatrol_filter_get_stream_page_title',	'bugspatrol_team_get_stream_page_title', 9, 2);
		add_filter('bugspatrol_filter_get_stream_page_link',	'bugspatrol_team_get_stream_page_link', 9, 2);
		add_filter('bugspatrol_filter_get_stream_page_id',	'bugspatrol_team_get_stream_page_id', 9, 2);
		add_filter('bugspatrol_filter_query_add_filters',		'bugspatrol_team_query_add_filters', 9, 2);
		add_filter('bugspatrol_filter_detect_inheritance_key','bugspatrol_team_detect_inheritance_key', 9, 1);

		// Extra column for team members lists
		if (bugspatrol_get_theme_option('show_overriden_posts')=='yes') {
			add_filter('manage_edit-team_columns',			'bugspatrol_post_add_options_column', 9);
			add_filter('manage_team_posts_custom_column',	'bugspatrol_post_fill_options_column', 9, 2);
		}


		// Meta box fields
		bugspatrol_storage_set('team_override_options', array(
			'id' => 'team-override-options',
			'title' => esc_html__('Team Member Details', 'bugspatrol'),
			'page' => 'team',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				"team_member_position" => array(
					"title" => esc_html__('Position',  'bugspatrol'),
					"desc" => wp_kses_data( __("Position of the team member", 'bugspatrol') ),
					"class" => "team_member_position",
					"std" => "",
					"type" => "text"),
				"team_member_email" => array(
					"title" => esc_html__("E-mail",  'bugspatrol'),
					"desc" => wp_kses_data( __("E-mail of the team member - need to take Gravatar (if registered)", 'bugspatrol') ),
					"class" => "team_member_email",
					"std" => "",
					"type" => "text"),
				"team_member_link" => array(
					"title" => esc_html__('Link to profile',  'bugspatrol'),
					"desc" => wp_kses_data( __("URL of the team member profile page (if not this page)", 'bugspatrol') ),
					"class" => "team_member_link",
					"std" => "",
					"type" => "text"),
				"team_member_socials" => array(
					"title" => esc_html__("Social links",  'bugspatrol'),
					"desc" => wp_kses_data( __("Links to the social profiles of the team member", 'bugspatrol') ),
					"class" => "team_member_email",
					"std" => "",
					"type" => "social")
				)
			)
		);
		
		// Add supported data types
		bugspatrol_theme_support_pt('team');
		bugspatrol_theme_support_tx('team_group');
	}
}

if ( !function_exists( 'bugspatrol_team_settings_theme_setup2' ) ) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_team_settings_theme_setup2', 3 );
	function bugspatrol_team_settings_theme_setup2() {
		// Add post type 'team' and taxonomy 'team_group' into theme inheritance list
		bugspatrol_add_theme_inheritance( array('team' => array(
			'stream_template' => 'blog-team',
			'single_template' => 'single-team',
			'taxonomy' => array('team_group'),
			'taxonomy_tags' => array(),
			'post_type' => array('team'),
			'override' => 'custom'
			) )
		);
	}
}



// Add override options
if (!function_exists('bugspatrol_team_add_override_options')) {
        function bugspatrol_team_add_override_options($boxes = array()) {
        $boxes[] = array_merge(bugspatrol_storage_get('team_override_options'), array('callback' => 'bugspatrol_team_show_override_options'));
        return $boxes;
    }
}


// Callback function to show fields in override options
if (!function_exists('bugspatrol_team_show_override_options')) {
	function bugspatrol_team_show_override_options() {
		global $post;

		$data = get_post_meta($post->ID, bugspatrol_storage_get('options_prefix').'_team_data', true);
		$fields = bugspatrol_storage_get_array('team_override_options', 'fields');
		?>
		<input type="hidden" name="override_options_team_nonce" value="<?php echo esc_attr(wp_create_nonce(admin_url())); ?>" />
		<table class="team_area">
		<?php
		if (is_array($fields) && count($fields) > 0) {
			foreach ($fields as $id=>$field) { 
				$meta = isset($data[$id]) ? $data[$id] : '';
				?>
				<tr class="team_field <?php echo esc_attr($field['class']); ?>" valign="top">
					<td><label for="<?php echo esc_attr($id); ?>"><?php echo esc_attr($field['title']); ?></label></td>
					<td>
						<?php
						if ($id == 'team_member_socials') {
							$socials_type = bugspatrol_get_theme_setting('socials_type');
							$social_list = bugspatrol_get_theme_option('social_icons');
							if (is_array($social_list) && count($social_list) > 0) {
								foreach ($social_list as $soc) {
									if ($socials_type == 'icons') {
										$parts = explode('-', $soc['icon'], 2);
										$sn = isset($parts[1]) ? $parts[1] : $soc['icon'];
									} else {
										$sn = basename($soc['icon']);
										$sn = bugspatrol_substr($sn, 0, bugspatrol_strrpos($sn, '.'));
										if (($pos=bugspatrol_strrpos($sn, '_'))!==false)
											$sn = bugspatrol_substr($sn, 0, $pos);
									}   
									$link = isset($meta[$sn]) ? $meta[$sn] : '';
									?>
									<label for="<?php echo esc_attr(($id).'_'.($sn)); ?>"><?php echo esc_attr(bugspatrol_strtoproper($sn)); ?></label><br>
									<input type="text" name="<?php echo esc_attr($id); ?>[<?php echo esc_attr($sn); ?>]" id="<?php echo esc_attr(($id).'_'.($sn)); ?>" value="<?php echo esc_attr($link); ?>" size="30" /><br>
									<?php
								}
							}
						} else {
							?>
							<input type="text" name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($meta); ?>" size="30" />
							<?php
						}
						?>
						<br><small><?php echo esc_attr($field['desc']); ?></small>
					</td>
				</tr>
				<?php
			}
		}
		?>
		</table>
		<?php
	}
}


// Save data from override options
if (!function_exists('bugspatrol_team_save_data')) {
		function bugspatrol_team_save_data($post_id) {
		// verify nonce
		if ( !wp_verify_nonce( bugspatrol_get_value_gp('override_options_team_nonce'), admin_url() ) )
			return $post_id;

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		// check permissions
		if ($_POST['post_type']!='team' || !current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		$data = array();

		$fields = bugspatrol_storage_get_array('team_override_options', 'fields');

		// Post type specific data handling
		if (is_array($fields) && count($fields) > 0) {
			foreach ($fields as $id=>$field) {
				if (isset($_POST[$id])) {
					if (is_array($_POST[$id]) && count($_POST[$id]) > 0) {
						foreach ($_POST[$id] as $sn=>$link) {
							$_POST[$id][$sn] = stripslashes($link);
						}
                        $data[$id] = array_map( 'sanitize_text_field', wp_unslash( $_POST[$id] ) );
					} else {
						$data[$id] = stripslashes($_POST[$id]);
					}
				}
			}
		}

		update_post_meta($post_id, bugspatrol_storage_get('options_prefix').'_team_data', $data);
	}
}



// Return true, if current page is team member page
if ( !function_exists( 'bugspatrol_is_team_page' ) ) {
	function bugspatrol_is_team_page() {
		$is = in_array(bugspatrol_storage_get('page_template'), array('blog-team', 'single-team'));
		if (!$is) {
			if (!bugspatrol_storage_empty('pre_query'))
				$is = bugspatrol_storage_call_obj_method('pre_query', 'get', 'post_type')=='team' 
						|| bugspatrol_storage_call_obj_method('pre_query', 'is_tax', 'team_group') 
						|| (bugspatrol_storage_call_obj_method('pre_query', 'is_page') 
								&& ($id=bugspatrol_get_template_page_id('blog-team')) > 0 
								&& $id==bugspatrol_storage_get_obj_property('pre_query', 'queried_object_id', 0)
							);
			else
				$is = get_query_var('post_type')=='team' || is_tax('team_group') || (is_page() && ($id=bugspatrol_get_template_page_id('blog-team')) > 0 && $id==get_the_ID());
		}
		return $is;
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'bugspatrol_team_detect_inheritance_key' ) ) {
		function bugspatrol_team_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return bugspatrol_is_team_page() ? 'team' : '';
	}
}

// Filter to detect current page slug
if ( !function_exists( 'bugspatrol_team_get_blog_type' ) ) {
		function bugspatrol_team_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;
		if ($query && $query->is_tax('team_group') || is_tax('team_group'))
			$page = 'team_category';
		else if ($query && $query->get('post_type')=='team' || get_query_var('post_type')=='team')
			$page = $query && $query->is_single() || is_single() ? 'team_item' : 'team';
		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'bugspatrol_team_get_blog_title' ) ) {
		function bugspatrol_team_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		if ( bugspatrol_strpos($page, 'team')!==false ) {
			if ( $page == 'team_category' ) {
				$term = get_term_by( 'slug', get_query_var( 'team_group' ), 'team_group', OBJECT);
				$title = $term->name;
			} else if ( $page == 'team_item' ) {
				$title = bugspatrol_get_post_title();
			} else {
				$title = esc_html__('All team', 'bugspatrol');
			}
		}

		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'bugspatrol_team_get_stream_page_title' ) ) {
		function bugspatrol_team_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if (bugspatrol_strpos($page, 'team')!==false) {
			if (($page_id = bugspatrol_team_get_stream_page_id(0, $page=='team' ? 'blog-team' : $page)) > 0)
				$title = bugspatrol_get_post_title($page_id);
			else
				$title = esc_html__('All team', 'bugspatrol');				
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'bugspatrol_team_get_stream_page_id' ) ) {
		function bugspatrol_team_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if (bugspatrol_strpos($page, 'team')!==false) $id = bugspatrol_get_template_page_id('blog-team');
		return $id;
	}
}

// Filter to detect stream page URL
if ( !function_exists( 'bugspatrol_team_get_stream_page_link' ) ) {
		function bugspatrol_team_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if (bugspatrol_strpos($page, 'team')!==false) {
			$id = bugspatrol_get_template_page_id('blog-team');
			if ($id) $url = get_permalink($id);
		}
		return $url;
	}
}

// Filter to detect current taxonomy
if ( !function_exists( 'bugspatrol_team_get_current_taxonomy' ) ) {
		function bugspatrol_team_get_current_taxonomy($tax, $page) {
		if (!empty($tax)) return $tax;
		if ( bugspatrol_strpos($page, 'team')!==false ) {
			$tax = 'team_group';
		}
		return $tax;
	}
}

// Return taxonomy name (slug) if current page is this taxonomy page
if ( !function_exists( 'bugspatrol_team_is_taxonomy' ) ) {
		function bugspatrol_team_is_taxonomy($tax, $query=null) {
		if (!empty($tax))
			return $tax;
		else 
			return $query && $query->get('team_group')!='' || is_tax('team_group') ? 'team_group' : '';
	}
}

// Add custom post type and/or taxonomies arguments to the query
if ( !function_exists( 'bugspatrol_team_query_add_filters' ) ) {
		function bugspatrol_team_query_add_filters($args, $filter) {
		if ($filter == 'team') {
			$args['post_type'] = 'team';
		}
		return $args;
	}
}


?>