<?php
/**
 * BugsPatrol Framework: Inherited properties for taxonomies
 *
 * @package	bugspatrol
 * @since	bugspatrol 1.0
 */

// Theme init
if (!function_exists('bugspatrol_taxonomy_theme_setup')) {
	add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_taxonomy_theme_setup');
	function bugspatrol_taxonomy_theme_setup() {
		$inheritance = bugspatrol_get_theme_inheritance();
		if (!empty($inheritance) && is_array($inheritance)) {
			$show_overriden = bugspatrol_get_theme_option('show_overriden_taxonomies')=='yes';
			foreach($inheritance as $k=>$v) {
				// Set taxonomy actions
				if (!empty($v['taxonomy']) && is_array($v['taxonomy'])) {
					foreach ($v['taxonomy'] as $tax) {
						// Add the fields to the taxonomy, using our callback function  
						add_action( $tax.'_edit_form_fields',	'bugspatrol_taxonomy_show_custom_fields', 10, 1 );  
						add_action( $tax.'_add_form_fields',	'bugspatrol_taxonomy_show_custom_fields', 10, 1 );  
						// Save the changes made on the taxonomy, using our callback function  
						add_action( 'edited_'.($tax),			'bugspatrol_taxonomy_save_custom_fields', 10, 1 );
						add_action( 'created_'.($tax),			'bugspatrol_taxonomy_save_custom_fields', 10, 1 );
						// Extra column for taxonomies lists
						if ($show_overriden) {
							add_filter('manage_edit-'.($tax).'_columns',	'bugspatrol_taxonomy_add_options_column', 9);
							add_filter('manage_'.($tax).'_custom_column',	'bugspatrol_taxonomy_fill_options_column', 9, 3);
						}
					}
				}
			}
		}
	}
}


/* Extra column for taxonomies lists
-------------------------------------------------------------------------------------------- */

// Create additional column
if (!function_exists('bugspatrol_taxonomy_add_options_column')) {
		function bugspatrol_taxonomy_add_options_column( $columns ){
		$columns['theme_options'] = esc_html__('Theme Options', 'bugspatrol');
		return $columns;
	}
}

// Fill column with data
if (!function_exists('bugspatrol_taxonomy_fill_options_column')) {
		function bugspatrol_taxonomy_fill_options_column($output='', $column_name='', $tax_id=0) {
		if ($column_name != 'theme_options') return;
		if ($props = bugspatrol_taxonomy_load_custom_options($tax_id)) {
			$options = '';
			if (is_array($props) && count($props) > 0) {
				foreach ($props as $prop_name=>$prop_value) {
					if (!bugspatrol_is_inherit_option($prop_value) && bugspatrol_storage_get_array('options', $prop_name, 'type')!='hidden') {
						$prop_title = bugspatrol_storage_get_array('options', $prop_name, 'title');
						if (empty($prop_title)) $prop_title = $prop_name;
						$options .= '<div class="bugspatrol_options_prop_row"><span class="bugspatrol_options_prop_name">' . esc_html($prop_title) . '</span>&nbsp;=&nbsp;<span class="bugspatrol_options_prop_value">' . (is_array($prop_value) ? esc_html__('[Complex Data]', 'bugspatrol') : '"' . esc_html(bugspatrol_strshort($prop_value, 80)) . '"') . '</span></div>';
					}
				}
			}
		}
		if (!empty($options)) echo '<div class="bugspatrol_options_list">'.trim(chop($options)).'</div>';
	}
}


/* Inherited properties for taxonomies
-------------------------------------------------------------------------------------------- */

// Return taxonomy's inherited property value (from parent taxonomies)
if (!function_exists('bugspatrol_taxonomy_get_inherited_property')) {
	function bugspatrol_taxonomy_get_inherited_property($tax, $id, $prop, $defa='') {
		if (!empty($id) && (int) $id == 0) {
			$obj = get_term_by( 'slug', $id, $tax, OBJECT);
			$id = $obj->term_id;
		}
		$val = $defa;
		if (!empty($id)) {
			$tax_obj = get_taxonomy($tax);
			do {
				if ($props = bugspatrol_taxonomy_load_custom_options($id, $tax)) {
					if (isset($props[$prop]) && !empty($props[$prop]) && !bugspatrol_is_inherit_option($props[$prop])) {
						$val = $props[$prop];
						break;
					}
				}
				if (!$tax_obj->hierarchical) break;
				$obj = get_term_by( 'id', $id, $tax, OBJECT);
				$id = !empty($obj->parent) ? $obj->parent : 0;
			} while ($id);
		}
		return $val;
	}
}

// Return all inherited properties for taxonomy (from parent taxonomies)
if (!function_exists('bugspatrol_taxonomy_get_inherited_properties')) {
	function bugspatrol_taxonomy_get_inherited_properties($tax, $id) {
		if (!empty($id) && (int) $id == 0) {
			$obj = get_term_by( 'slug', $id, $tax, OBJECT);
			$id = $obj->term_id;
		}
		$val = array('taxonomy_id'=>$id);
		if (!empty($id)) {
			$tax_obj = get_taxonomy($tax);
			do {
				if ($props = bugspatrol_taxonomy_load_custom_options($id, $tax)) {
					if (is_array($props) && count($props) > 0) {
						foreach ($props as $prop_name=>$prop_value) {
							if (!isset($val[$prop_name]) || empty($val[$prop_name]) || bugspatrol_is_inherit_option($val[$prop_name])) {
								$val[$prop_name] = $prop_value;
							}
						}
					}
				}
				if (!$tax_obj->hierarchical) break;
				$obj = get_term_by( 'id', $id, $tax, OBJECT);
				$id = $obj->parent;
			} while ($id);
		}
		return $val;
	}
}

// Return all inherited properties value (from parent categories) for list taxonomies
if (!function_exists('bugspatrol_taxonomies_get_inherited_properties')) {
	function bugspatrol_taxonomies_get_inherited_properties($tax, $list) {
		$tax_options = array();
		$tax_obj = get_taxonomy($tax);
		if (!empty($list->terms) && is_array($list->terms)) {
			foreach ($list->terms as $obj) {
				$new_options = bugspatrol_taxonomy_get_inherited_properties($tax, $obj->term_id);
				if (is_array($new_options) && count($new_options) > 0) {
					foreach ($new_options as $k=>$v) {
						if (!empty($v) && !bugspatrol_is_inherit_option($v) && (!isset($tax_options[$k]) || empty($tax_options[$k]) || bugspatrol_is_inherit_option($tax_options[$k])))
							$tax_options[$k] = $v;
					}
				}
			}
		}
		return $tax_options;
	}
}


/* Custom fields for taxonomies
-------------------------------------------------------------------------------------------- */

// Add the fields to the "category" taxonomy, using our callback function  
if (!function_exists('bugspatrol_taxonomy_show_custom_fields')) {
	function bugspatrol_taxonomy_show_custom_fields($tax_obj = null) {  
		?>  
		<table border="0" cellpadding="0" cellspacing="0" class="form-table">
		<tr class="form-field" valign="top">  
			<td span="2">
		<div class="section section-info ">
			<h3 class="heading"><?php esc_html_e('Custom settings for this taxonomy (and nested):', 'bugspatrol'); ?></h3>
			<div class="option">
				<div class="controls">
					<div class="info">
						<?php esc_html_e('Select parameters for showing posts from this taxonomy and all nested taxonomies.', 'bugspatrol'); ?><br />
						<?php esc_html_e('Attention: In each nested taxonomy you can override this settings.', 'bugspatrol'); ?>
					</div>
				</div>
			</div>
		</div>
		<?php 
		$tax_type = is_object($tax_obj) ? $tax_obj->taxonomy : $tax_obj;
		$override_key = bugspatrol_get_override_key($tax_type, 'taxonomy');

		// Use nonce for verification
		echo '<input type="hidden" name="override_options_taxonomy_nonce" value="'.esc_attr(wp_create_nonce(admin_url())).'" />';
		echo '<input type="hidden" name="override_options_taxonomy_type" value="'.esc_attr($tax_type).'" />';
	
		$custom_options = bugspatrol_taxonomy_load_custom_options($tax_obj, $tax_type);

		do_action('bugspatrol_action_taxonomy_before_show_override_options', $tax_type, $tax_obj);

		$data = bugspatrol_storage_get('options');

		bugspatrol_options_page_start(array(
			'data' => $data,
			'add_inherit' => true,
			'create_form' => false,
			'buttons' => array('import', 'export'),
			'override' => $override_key
			));
	
		if (count($data) > 0) {
			foreach ($data as $id=>$option) { 
				if (!isset($option['override']) || !in_array($override_key, explode(',', $option['override']))) continue;
	
				$option = apply_filters('bugspatrol_filter_taxonomy_show_custom_field_option', $option, $id, $tax_type, $tax_obj);
				$meta = isset($custom_options[$id]) ? apply_filters('bugspatrol_filter_taxonomy_show_custom_field_value', $custom_options[$id], $option, $id, $tax_type, $tax_obj) : '';

				do_action('bugspatrol_action_taxonomy_before_show_custom_field', $tax_type, $tax_obj, $option, $id, $meta);
	
				bugspatrol_options_show_field($id, $option, $meta);

				do_action('bugspatrol_action_taxonomy_after_show_custom_field', $tax_type, $tax_obj, $option, $id, $meta);
			}
		}
	
		bugspatrol_options_page_stop();

		do_action('bugspatrol_action_taxonomy_after_show_override_options', $tax_type, $tax_obj);
		?>
			</td>
		</tr>
		</table>
		<?php
	} 
}


  
// Save the changes made on the taxonomy, using our callback function  
if (!function_exists('bugspatrol_taxonomy_save_custom_fields')) {
	function bugspatrol_taxonomy_save_custom_fields( $term_id=0 ) {  

		// verify nonce
		if ( !wp_verify_nonce( bugspatrol_get_value_gp('override_options_taxonomy_nonce'), admin_url() ) )
			return $term_id;
		
		$tax_type = isset($_POST['override_options_taxonomy_type']) ? sanitize_text_field($_POST['override_options_taxonomy_type']) : 'category';
		$override_key = bugspatrol_get_override_key($tax_type, 'taxonomy');

		$custom_options = bugspatrol_taxonomy_load_custom_options($term_id, $tax_type);

		if (bugspatrol_options_merge_new_values(bugspatrol_storage_get('options'), $custom_options, $_POST, 'save', $override_key))
			bugspatrol_taxonomy_save_custom_options($term_id, $tax_type, $custom_options);
	}
}

// Get taxonomy custom fields
if (!function_exists('bugspatrol_taxonomy_load_custom_options')) {
	function bugspatrol_taxonomy_load_custom_options($tax_obj, $tax_type = '') {  
		$t_id = is_object($tax_obj) ? $tax_obj->term_id : $tax_obj; 					// Get the ID of the term you're editing
		if ((int) $t_id == 0) {
			$tax_obj = get_term_by( 'slug', $t_id, $tax_type, OBJECT);
			$t_id = $tax_obj!==false ? $tax_obj->term_id : 0;
		}
		return apply_filters('bugspatrol_filter_taxonomy_load_custom_options', $t_id ? get_option( bugspatrol_storage_get('options_prefix') . "_options_taxonomy_{$t_id}" ) : false, $tax_type, $tax_obj); 
	}
}

// Set taxonomy custom fields
if (!function_exists('bugspatrol_taxonomy_save_custom_options')) {
	function bugspatrol_taxonomy_save_custom_options($term_id, $tax_type, $term_meta) {  
		update_option( bugspatrol_storage_get('options_prefix') . "_options_taxonomy_{$term_id}", apply_filters('bugspatrol_filter_taxonomy_save_custom_options', $term_meta, $tax_type, $term_id) );  
	}
}
?>