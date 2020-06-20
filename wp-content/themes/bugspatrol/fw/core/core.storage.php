<?php
/**
 * BugsPatrol Framework: theme variables storage
 *
 * @package	bugspatrol
 * @since	bugspatrol 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('bugspatrol_storage_get')) {
	function bugspatrol_storage_get($var_name, $default='') {
		global $BUGSPATROL_STORAGE;
		return isset($BUGSPATROL_STORAGE[$var_name]) ? $BUGSPATROL_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('bugspatrol_storage_set')) {
	function bugspatrol_storage_set($var_name, $value) {
		global $BUGSPATROL_STORAGE;
		$BUGSPATROL_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('bugspatrol_storage_empty')) {
	function bugspatrol_storage_empty($var_name, $key='', $key2='') {
		global $BUGSPATROL_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($BUGSPATROL_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($BUGSPATROL_STORAGE[$var_name][$key]);
		else
			return empty($BUGSPATROL_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('bugspatrol_storage_isset')) {
	function bugspatrol_storage_isset($var_name, $key='', $key2='') {
		global $BUGSPATROL_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($BUGSPATROL_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($BUGSPATROL_STORAGE[$var_name][$key]);
		else
			return isset($BUGSPATROL_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('bugspatrol_storage_inc')) {
	function bugspatrol_storage_inc($var_name, $value=1) {
		global $BUGSPATROL_STORAGE;
		if (empty($BUGSPATROL_STORAGE[$var_name])) $BUGSPATROL_STORAGE[$var_name] = 0;
		$BUGSPATROL_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('bugspatrol_storage_concat')) {
	function bugspatrol_storage_concat($var_name, $value) {
		global $BUGSPATROL_STORAGE;
		if (empty($BUGSPATROL_STORAGE[$var_name])) $BUGSPATROL_STORAGE[$var_name] = '';
		$BUGSPATROL_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('bugspatrol_storage_get_array')) {
	function bugspatrol_storage_get_array($var_name, $key, $key2='', $default='') {
		global $BUGSPATROL_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($BUGSPATROL_STORAGE[$var_name][$key]) ? $BUGSPATROL_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($BUGSPATROL_STORAGE[$var_name][$key][$key2]) ? $BUGSPATROL_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('bugspatrol_storage_set_array')) {
	function bugspatrol_storage_set_array($var_name, $key, $value) {
		global $BUGSPATROL_STORAGE;
		if (!isset($BUGSPATROL_STORAGE[$var_name])) $BUGSPATROL_STORAGE[$var_name] = array();
		if ($key==='')
			$BUGSPATROL_STORAGE[$var_name][] = $value;
		else
			$BUGSPATROL_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('bugspatrol_storage_set_array2')) {
	function bugspatrol_storage_set_array2($var_name, $key, $key2, $value) {
		global $BUGSPATROL_STORAGE;
		if (!isset($BUGSPATROL_STORAGE[$var_name])) $BUGSPATROL_STORAGE[$var_name] = array();
		if (!isset($BUGSPATROL_STORAGE[$var_name][$key])) $BUGSPATROL_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$BUGSPATROL_STORAGE[$var_name][$key][] = $value;
		else
			$BUGSPATROL_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Add array element after the key
if (!function_exists('bugspatrol_storage_set_array_after')) {
	function bugspatrol_storage_set_array_after($var_name, $after, $key, $value='') {
		global $BUGSPATROL_STORAGE;
		if (!isset($BUGSPATROL_STORAGE[$var_name])) $BUGSPATROL_STORAGE[$var_name] = array();
		if (is_array($key))
			bugspatrol_array_insert_after($BUGSPATROL_STORAGE[$var_name], $after, $key);
		else
			bugspatrol_array_insert_after($BUGSPATROL_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('bugspatrol_storage_set_array_before')) {
	function bugspatrol_storage_set_array_before($var_name, $before, $key, $value='') {
		global $BUGSPATROL_STORAGE;
		if (!isset($BUGSPATROL_STORAGE[$var_name])) $BUGSPATROL_STORAGE[$var_name] = array();
		if (is_array($key))
			bugspatrol_array_insert_before($BUGSPATROL_STORAGE[$var_name], $before, $key);
		else
			bugspatrol_array_insert_before($BUGSPATROL_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('bugspatrol_storage_push_array')) {
	function bugspatrol_storage_push_array($var_name, $key, $value) {
		global $BUGSPATROL_STORAGE;
		if (!isset($BUGSPATROL_STORAGE[$var_name])) $BUGSPATROL_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($BUGSPATROL_STORAGE[$var_name], $value);
		else {
			if (!isset($BUGSPATROL_STORAGE[$var_name][$key])) $BUGSPATROL_STORAGE[$var_name][$key] = array();
			array_push($BUGSPATROL_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('bugspatrol_storage_pop_array')) {
	function bugspatrol_storage_pop_array($var_name, $key='', $defa='') {
		global $BUGSPATROL_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($BUGSPATROL_STORAGE[$var_name]) && is_array($BUGSPATROL_STORAGE[$var_name]) && count($BUGSPATROL_STORAGE[$var_name]) > 0) 
				$rez = array_pop($BUGSPATROL_STORAGE[$var_name]);
		} else {
			if (isset($BUGSPATROL_STORAGE[$var_name][$key]) && is_array($BUGSPATROL_STORAGE[$var_name][$key]) && count($BUGSPATROL_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($BUGSPATROL_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('bugspatrol_storage_inc_array')) {
	function bugspatrol_storage_inc_array($var_name, $key, $value=1) {
		global $BUGSPATROL_STORAGE;
		if (!isset($BUGSPATROL_STORAGE[$var_name])) $BUGSPATROL_STORAGE[$var_name] = array();
		if (empty($BUGSPATROL_STORAGE[$var_name][$key])) $BUGSPATROL_STORAGE[$var_name][$key] = 0;
		$BUGSPATROL_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('bugspatrol_storage_concat_array')) {
	function bugspatrol_storage_concat_array($var_name, $key, $value) {
		global $BUGSPATROL_STORAGE;
		if (!isset($BUGSPATROL_STORAGE[$var_name])) $BUGSPATROL_STORAGE[$var_name] = array();
		if (empty($BUGSPATROL_STORAGE[$var_name][$key])) $BUGSPATROL_STORAGE[$var_name][$key] = '';
		$BUGSPATROL_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('bugspatrol_storage_call_obj_method')) {
	function bugspatrol_storage_call_obj_method($var_name, $method, $param=null) {
		global $BUGSPATROL_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($BUGSPATROL_STORAGE[$var_name]) ? $BUGSPATROL_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($BUGSPATROL_STORAGE[$var_name]) ? $BUGSPATROL_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('bugspatrol_storage_get_obj_property')) {
	function bugspatrol_storage_get_obj_property($var_name, $prop, $default='') {
		global $BUGSPATROL_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($BUGSPATROL_STORAGE[$var_name]->$prop) ? $BUGSPATROL_STORAGE[$var_name]->$prop : $default;
	}
}
?>