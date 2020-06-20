<?php
/**
 * BugsPatrol Framework: debug utilities (for internal use only!)
 *
 * @package	bugspatrol
 * @since	bugspatrol 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


// Short analogs for debug functions
if (!function_exists('bugspatrol_dcl')) {	function bugspatrol_dcl($msg)	{ 	if (is_user_logged_in()) echo "<pre class=\"debug_log\">\n" . esc_html($msg) . "\n</pre>"; } }	// Console log - output any message on the screen
if (!function_exists('bugspatrol_dco')) {	function bugspatrol_dco(&$var, $lvl=-1)	{ 	if (is_user_logged_in()) bugspatrol_debug_dump_screen($var, $lvl); } }	// Console obj - output object structure on the screen
if (!function_exists('bugspatrol_dcs')) {	function bugspatrol_dcs($lvl=-1){ 	if (is_user_logged_in()) bugspatrol_debug_calls_stack_screen($lvl); } }			// Console stack - output calls stack on the screen
if (!function_exists('bugspatrol_dcw')) {	function bugspatrol_dcw($q=null) {	if (is_user_logged_in()) bugspatrol_debug_dump_wp($q); } }						// Console WP - output WP is_... states on the screen
if (!function_exists('bugspatrol_ddo')) {	function bugspatrol_ddo(&$var, $lvl=-1)	{ 	if (is_user_logged_in()) bugspatrol_debug_dump_var($var, $lvl); } }	// Return obj - return object structure
if (!function_exists('bugspatrol_dfl')) {	function bugspatrol_dfl($var)	{	if (is_user_logged_in()) bugspatrol_debug_trace_message($var); } }				// File log - output any message into file debug.log
if (!function_exists('bugspatrol_dfo')) {	function bugspatrol_dfo(&$var, $lvl=-1)	{ 	if (is_user_logged_in()) bugspatrol_debug_dump_file($var, $lvl); } }	// File obj - output object structure into file debug.log
if (!function_exists('bugspatrol_dfs')) {	function bugspatrol_dfs($lvl=-1){ 	if (is_user_logged_in()) bugspatrol_debug_calls_stack_file($lvl); } }				// File stack - output calls stack into file debug.log


if (!function_exists('bugspatrol_debug_die_message')) {
	function bugspatrol_debug_die_message($msg) {
		bugspatrol_debug_trace_message($msg);
		wp_die($msg);
	}
}

if (!function_exists('bugspatrol_debug_trace_message')) {
	function bugspatrol_debug_trace_message($msg) {
		bugspatrol_fpc(get_stylesheet_directory().'/debug.log', date('d.m.Y H:i:s')." $msg\n", FILE_APPEND);
	}
}

if (!function_exists('bugspatrol_debug_calls_stack_screen')) {
	function bugspatrol_debug_calls_stack_screen($level=-1) {
		$s = debug_backtrace();
		$s1 = array_splice($s, 1, $level);
		bugspatrol_debug_dump_screen($s1, -1);
	}
}

if (!function_exists('bugspatrol_debug_calls_stack_file')) {
	function bugspatrol_debug_calls_stack_file($level=-1) {
		$s = debug_backtrace();
		$s1 = array_splice($s, 1, $level);
		bugspatrol_debug_dump_file($s1, -1);
	}
}

if (!function_exists('bugspatrol_debug_dump_screen')) {
	function bugspatrol_debug_dump_screen(&$var, $level=-1) {
		if ((is_array($var) || is_object($var)) && count($var))
			echo "<pre class=\"debug_log\">\n".esc_html(bugspatrol_debug_dump_var($var, 0, $level))."\n</pre>";
		else
			echo "<tt>".esc_html(bugspatrol_debug_dump_var($var, 0, $level))."</tt>\n";
	}
}

if (!function_exists('bugspatrol_debug_dump_file')) {
	function bugspatrol_debug_dump_file(&$var, $level=-1) {
		bugspatrol_debug_trace_message("\n\n".bugspatrol_debug_dump_var($var, 0, $level));
	}
}

if (!function_exists('bugspatrol_debug_dump_var')) {
	function bugspatrol_debug_dump_var(&$var, $level=0, $max_level=-1)  {
		if (is_array($var)) $type="Array[".count($var)."]";
		else if (is_object($var)) $type="Object";
		else $type="";
		if ($type) {
			$rez = "$type\n";
			if ($max_level<0 || $level < $max_level) {
				for (Reset($var), $level++; list($k, $v)=each($var); ) {
					if (is_array($v) && $k==="GLOBALS") continue;
					for ($i=0; $i<$level*3; $i++) $rez .= " ";
					$rez .= $k.' => '. bugspatrol_debug_dump_var($v, $level, $max_level);
				}
			}
		} else if (is_bool($var))
			$rez = ($var ? 'true' : 'false')."\n";
		else if (is_long($var) || is_float($var) || intval($var) != 0)
			$rez = $var."\n";
		else
			$rez = '"'.($var).'"'."\n";
		return $rez;
	}
}

if (!function_exists('bugspatrol_debug_dump_wp')) {
	function bugspatrol_debug_dump_wp($query=null) {
		global $wp_query;
		if (!$query) $query = $wp_query;
		echo "<pre class=\"debug_log\">"
			."\nadmin=".is_admin()
			."\nmobile=".wp_is_mobile()
			."\nmain_query=".is_main_query()."  query=".esc_html($query->is_main_query())
			."\nquery->is_posts_page=".esc_html($query->is_posts_page)
			."\nhome=".is_home()."  query=".esc_html($query->is_home())
			."\nfp=".is_front_page()."  query=".esc_html($query->is_front_page())
			."\nsearch=".is_search()."  query=".esc_html($query->is_search())
			."\ncategory=".is_category()."  query=".esc_html($query->is_category())
			."\ntag=".is_tag()."  query=".esc_html($query->is_tag())
			."\narchive=".is_archive()."  query=".esc_html($query->is_archive())
			."\nday=".is_day()."  query=".esc_html($query->is_day())
			."\nmonth=".is_month()."  query=".esc_html($query->is_month())
			."\nyear=".is_year()."  query=".esc_html($query->is_year())
			."\nauthor=".is_author()."  query=".esc_html($query->is_author())
			."\npage=".is_page()."  query=".esc_html($query->is_page())
			."\nsingle=".is_single()."  query=".esc_html($query->is_single())
			."\nsingular=".is_singular()."  query=".esc_html($query->is_singular())
			."\nattachment=".is_attachment()."  query=".esc_html($query->is_attachment())
			."\nWooCommerce=".esc_html(function_exists('bugspatrol_is_woocommerce_page') && bugspatrol_is_woocommerce_page())
			."</pre>";
	}
}
?>