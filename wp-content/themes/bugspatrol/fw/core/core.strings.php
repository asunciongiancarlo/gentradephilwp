<?php
/**
 * BugsPatrol Framework: strings manipulations
 *
 * @package	bugspatrol
 * @since	bugspatrol 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Check multibyte functions
if ( ! defined( 'BUGSPATROL_MULTIBYTE' ) ) define( 'BUGSPATROL_MULTIBYTE', function_exists('mb_strpos') ? 'UTF-8' : false );

if (!function_exists('bugspatrol_strlen')) {
	function bugspatrol_strlen($text) {
		return BUGSPATROL_MULTIBYTE ? mb_strlen($text) : strlen($text);
	}
}

if (!function_exists('bugspatrol_strpos')) {
	function bugspatrol_strpos($text, $char, $from=0) {
		return BUGSPATROL_MULTIBYTE ? mb_strpos($text, $char, $from) : strpos($text, $char, $from);
	}
}

if (!function_exists('bugspatrol_strrpos')) {
	function bugspatrol_strrpos($text, $char, $from=0) {
		return BUGSPATROL_MULTIBYTE ? mb_strrpos($text, $char, $from) : strrpos($text, $char, $from);
	}
}

if (!function_exists('bugspatrol_substr')) {
	function bugspatrol_substr($text, $from, $len=-999999) {
		if ($len==-999999) { 
			if ($from < 0)
				$len = -$from; 
			else
				$len = bugspatrol_strlen($text)-$from;
		}
		return BUGSPATROL_MULTIBYTE ? mb_substr($text, $from, $len) : substr($text, $from, $len);
	}
}

if (!function_exists('bugspatrol_strtolower')) {
	function bugspatrol_strtolower($text) {
		return BUGSPATROL_MULTIBYTE ? mb_strtolower($text) : strtolower($text);
	}
}

if (!function_exists('bugspatrol_strtoupper')) {
	function bugspatrol_strtoupper($text) {
		return BUGSPATROL_MULTIBYTE ? mb_strtoupper($text) : strtoupper($text);
	}
}

if (!function_exists('bugspatrol_strtoproper')) {
	function bugspatrol_strtoproper($text) { 
		$rez = ''; $last = ' ';
		for ($i=0; $i<bugspatrol_strlen($text); $i++) {
			$ch = bugspatrol_substr($text, $i, 1);
			$rez .= bugspatrol_strpos(' .,:;?!()[]{}+=', $last)!==false ? bugspatrol_strtoupper($ch) : bugspatrol_strtolower($ch);
			$last = $ch;
		}
		return $rez;
	}
}

if (!function_exists('bugspatrol_strrepeat')) {
	function bugspatrol_strrepeat($str, $n) {
		$rez = '';
		for ($i=0; $i<$n; $i++)
			$rez .= $str;
		return $rez;
	}
}

if (!function_exists('bugspatrol_strshort')) {
	function bugspatrol_strshort($str, $maxlength, $add='...') {
		if ($maxlength < 0) 
			return $str;
		if ($maxlength == 0) 
			return '';
		if ($maxlength >= bugspatrol_strlen($str)) 
			return strip_tags($str);
		$str = bugspatrol_substr(strip_tags($str), 0, $maxlength - bugspatrol_strlen($add));
		$ch = bugspatrol_substr($str, $maxlength - bugspatrol_strlen($add), 1);
		if ($ch != ' ') {
			for ($i = bugspatrol_strlen($str) - 1; $i > 0; $i--)
				if (bugspatrol_substr($str, $i, 1) == ' ') break;
			$str = trim(bugspatrol_substr($str, 0, $i));
		}
		if (!empty($str) && bugspatrol_strpos(',.:;-', bugspatrol_substr($str, -1))!==false) $str = bugspatrol_substr($str, 0, -1);
		return ($str) . ($add);
	}
}

// Clear string from spaces, line breaks and tags (only around text)
if (!function_exists('bugspatrol_strclear')) {
	function bugspatrol_strclear($text, $tags=array()) {
		if (empty($text)) return $text;
		if (!is_array($tags)) {
			if ($tags != '')
				$tags = explode($tags, ',');
			else
				$tags = array();
		}
		$text = trim(chop($text));
		if (is_array($tags) && count($tags) > 0) {
			foreach ($tags as $tag) {
				$open  = '<'.esc_attr($tag);
				$close = '</'.esc_attr($tag).'>';
				if (bugspatrol_substr($text, 0, bugspatrol_strlen($open))==$open) {
					$pos = bugspatrol_strpos($text, '>');
					if ($pos!==false) $text = bugspatrol_substr($text, $pos+1);
				}
				if (bugspatrol_substr($text, -bugspatrol_strlen($close))==$close) $text = bugspatrol_substr($text, 0, bugspatrol_strlen($text) - bugspatrol_strlen($close));
				$text = trim(chop($text));
			}
		}
		return $text;
	}
}

// Return slug for the any title string
if (!function_exists('bugspatrol_get_slug')) {
	function bugspatrol_get_slug($title) {
		return bugspatrol_strtolower(str_replace(array('\\','/','-',' ','.'), '_', $title));
	}
}

// Replace macros in the string
if (!function_exists('bugspatrol_strmacros')) {
	function bugspatrol_strmacros($str) {
		return str_replace(array("{{", "}}", "((", "))", "||"), array("<i>", "</i>", "<b>", "</b>", "<br>"), $str);
	}
}

// Unserialize string (try replace \n with \r\n)
if (!function_exists('bugspatrol_unserialize')) {
	function bugspatrol_unserialize($str) {
		if ( is_serialized($str) ) {
			try {
				$data = unserialize($str);
			} catch (Exception $e) {
                bugspatrol_dcl($e->getMessage());
				$data = false;
			}
			if ($data===false) {
				try {
					$data = unserialize(str_replace("\n", "\r\n", $str));
				} catch (Exception $e) {
                    bugspatrol_dcl($e->getMessage());
					$data = false;
				}
			}
			return $data;
		} else
			return $str;
	}
}
?>