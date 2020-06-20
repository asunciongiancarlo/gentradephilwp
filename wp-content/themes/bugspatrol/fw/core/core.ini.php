<?php
/**
 * BugsPatrol Framework: ini-files manipulations
 *
 * @package	bugspatrol
 * @since	bugspatrol 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


//  Get value by name from .ini-file
if (!function_exists('bugspatrol_ini_get_value')) {
	function bugspatrol_ini_get_value($file, $name, $defa='') {
		if (!is_array($file)) {
			if (file_exists($file)) {
				$file = bugspatrol_fga($file);
			} else
				return $defa;
		}
		$name = bugspatrol_strtolower($name);
		$rez = $defa;
		for ($i=0; $i<count($file); $i++) {
			$file[$i] = trim($file[$i]);
			if (($pos = bugspatrol_strpos($file[$i], ';'))!==false)
				$file[$i] = trim(bugspatrol_substr($file[$i], 0, $pos));
			$parts = explode('=', $file[$i]);
			if (count($parts)!=2) continue;
			if (bugspatrol_strtolower(trim(chop($parts[0])))==$name) {
				$rez = trim(chop($parts[1]));
				if (bugspatrol_substr($rez, 0, 1)=='"')
					$rez = bugspatrol_substr($rez, 1, bugspatrol_strlen($rez)-2);
				else
					$rez *= 1;
				break;
			}
		}
		return $rez;
	}
}

//  Retrieve all values from .ini-file as assoc array
if (!function_exists('bugspatrol_ini_get_values')) {
	function bugspatrol_ini_get_values($file) {
		$rez = array();
		if (!is_array($file)) {
			if (file_exists($file)) {
				$file = bugspatrol_fga($file);
			} else
				return $rez;
		}
		for ($i=0; $i<count($file); $i++) {
			$file[$i] = trim(chop($file[$i]));
			if (($pos = bugspatrol_strpos($file[$i], ';'))!==false)
				$file[$i] = trim(bugspatrol_substr($file[$i], 0, $pos));
			$parts = explode('=', $file[$i]);
			if (count($parts)!=2) continue;
			$key = trim(chop($parts[0]));
			$rez[$key] = trim($parts[1]);
			if (bugspatrol_substr($rez[$key], 0, 1)=='"')
				$rez[$key] = bugspatrol_substr($rez[$key], 1, bugspatrol_strlen($rez[$key])-2);
			else
				$rez[$key] *= 1;
		}
		return $rez;
	}
}
?>