<?php
/**
 * @author    ThemePunch <info@themepunch.com>
 * @link      https://www.themepunch.com/
 * @copyright 2019 ThemePunch
 * @since 	  5.1.0
 * @lastfetch 10.10.2019
 */
 
if(!defined('ABSPATH')) exit();

/**
*** CREATED WITH SCRIPT SNIPPET AND DATA TAKEN FROM https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&fields=items(family%2Csubsets%2Cvariants%2Ccategory)&key={YOUR_API_KEY}

$list_raw = file_get_contents('https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&fields=items(family%2Csubsets%2Cvariants%2Ccategory)&key={YOUR_API_KEY}');

$list = json_decode($list_raw, true);
$list = $list['items'];

echo '<pre>';
foreach($list as $l){
	echo "'".$l['family'] ."' => array("."\n";
	echo "'variants' => array(";
	foreach($l['variants'] as $k => $v){
		if($k > 0) echo ", ";
		if($v == 'regular') $v = '400';
		echo "'".$v."'";
	}
	echo "),\n";
	echo "'subsets' => array(";
	foreach($l['subsets'] as $k => $v){
		if($k > 0) echo ", ";
		echo "'".$v."'";
	}
	echo "),\n";
	echo "'category' => '". $l['category'] ."'";
	echo "\n),\n";
}
echo '</pre>';
**/

$googlefonts = array(
'Roboto' => array(
'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '500', '500italic', '700', '700italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Open Sans' => array(
'variants' => array('300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic', '800', '800italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Lato' => array(
'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '700', '700italic', '900', '900italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Montserrat' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Roboto Condensed' => array(
'variants' => array('300', '300italic', '400', 'italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Source Sans Pro' => array(
'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Oswald' => array(
'variants' => array('200', '300', '400', '500', '600', '700'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Raleway' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Roboto Mono' => array(
'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '500', '500italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'monospace'
),
'Merriweather' => array(
'variants' => array('300', '300italic', '400', 'italic', '700', '700italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Roboto Slab' => array(
'variants' => array('100', '300', '400', '700'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'serif'
),
'Poppins' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Noto Sans' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'devanagari', 'greek-ext', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'PT Sans' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Ubuntu' => array(
'variants' => array('300', '300italic', '400', 'italic', '500', '500italic', '700', '700italic'),
'subsets' => array('cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Playfair Display' => array(
'variants' => array('400', 'italic', '700', '700italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin'),
'category' => 'serif'
),
'Open Sans Condensed' => array(
'variants' => array('300', '300italic', '700'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Muli' => array(
'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'PT Serif' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Lora' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Slabo 27px' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Nunito' => array(
'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Titillium Web' => array(
'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic', '900'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Fira Sans' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Rubik' => array(
'variants' => array('300', '300italic', '400', 'italic', '500', '500italic', '700', '700italic', '900', '900italic'),
'subsets' => array('cyrillic', 'latin-ext', 'latin', 'hebrew'),
'category' => 'sans-serif'
),
'Noto Serif' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'serif'
),
'Noto Sans JP' => array(
'variants' => array('100', '300', '400', '500', '700', '900'),
'subsets' => array('japanese', 'latin'),
'category' => 'sans-serif'
),
'Work Sans' => array(
'variants' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Quicksand' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'PT Sans Narrow' => array(
'variants' => array('400', '700'),
'subsets' => array('cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Arimo' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'hebrew', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Inconsolata' => array(
'variants' => array('400', '700'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'monospace'
),
'Nanum Gothic' => array(
'variants' => array('400', '700', '800'),
'subsets' => array('latin', 'korean'),
'category' => 'sans-serif'
),
'Nunito Sans' => array(
'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Noto Sans KR' => array(
'variants' => array('100', '300', '400', '500', '700', '900'),
'subsets' => array('latin', 'korean'),
'category' => 'sans-serif'
),
'Dosis' => array(
'variants' => array('200', '300', '400', '500', '600', '700', '800'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Oxygen' => array(
'variants' => array('300', '400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Libre Franklin' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Bitter' => array(
'variants' => array('400', 'italic', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Heebo' => array(
'variants' => array('100', '300', '400', '500', '700', '800', '900'),
'subsets' => array('latin', 'hebrew'),
'category' => 'sans-serif'
),
'Libre Baskerville' => array(
'variants' => array('400', 'italic', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Karla' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Cabin' => array(
'variants' => array('400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Hind' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Crimson Text' => array(
'variants' => array('400', 'italic', '600', '600italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Josefin Sans' => array(
'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Indie Flower' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Fjalla One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Anton' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Source Code Pro' => array(
'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'monospace'
),
'Lobster' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'display'
),
'Noto Sans TC' => array(
'variants' => array('100', '300', '400', '500', '700', '900'),
'subsets' => array('chinese-traditional', 'latin'),
'category' => 'sans-serif'
),
'Mukta' => array(
'variants' => array('200', '300', '400', '500', '600', '700', '800'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Barlow' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Abel' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Dancing Script' => array(
'variants' => array('400', '700'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'handwriting'
),
'Source Serif Pro' => array(
'variants' => array('400', '600', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Varela Round' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'hebrew'),
'category' => 'sans-serif'
),
'Arvo' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Pacifico' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'handwriting'
),
'Exo 2' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Merriweather Sans' => array(
'variants' => array('300', '300italic', '400', 'italic', '700', '700italic', '800', '800italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Hind Siliguri' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('bengali', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Shadows Into Light' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Cairo' => array(
'variants' => array('200', '300', '400', '600', '700', '900'),
'subsets' => array('latin-ext', 'latin', 'arabic'),
'category' => 'sans-serif'
),
'Abril Fatface' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Acme' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Asap' => array(
'variants' => array('400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Archivo Narrow' => array(
'variants' => array('400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Overpass' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Questrial' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Teko' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Bree Serif' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Yanone Kaffeesatz' => array(
'variants' => array('200', '300', '400', '700'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'EB Garamond' => array(
'variants' => array('400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'serif'
),
'Barlow Condensed' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Exo' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Kanit' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'sans-serif'
),
'Comfortaa' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'display'
),
'IBM Plex Sans' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Signika' => array(
'variants' => array('300', '400', '600', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Maven Pro' => array(
'variants' => array('400', '500', '700', '900'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Fira Sans Condensed' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Amatic SC' => array(
'variants' => array('400', '700'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'hebrew'),
'category' => 'handwriting'
),
'Righteous' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Catamaran' => array(
'variants' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('latin-ext', 'latin', 'tamil'),
'category' => 'sans-serif'
),
'Ubuntu Condensed' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'PT Sans Caption' => array(
'variants' => array('400', '700'),
'subsets' => array('cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Domine' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Play' => array(
'variants' => array('400', '700'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Cinzel' => array(
'variants' => array('400', '700', '900'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Monda' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Assistant' => array(
'variants' => array('200', '300', '400', '600', '700', '800'),
'subsets' => array('latin', 'hebrew'),
'category' => 'sans-serif'
),
'Ropa Sans' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Vollkorn' => array(
'variants' => array('400', 'italic', '600', '600italic', '700', '700italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Patua One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Satisfy' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Crete Round' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Prompt' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'sans-serif'
),
'News Cycle' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Permanent Marker' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Francois One' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Rajdhani' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Cuprum' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'ABeeZee' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Caveat' => array(
'variants' => array('400', '700'),
'subsets' => array('cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'handwriting'
),
'Hind Madurai' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin', 'tamil'),
'category' => 'sans-serif'
),
'Alegreya Sans' => array(
'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '500', '500italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Noticia Text' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'serif'
),
'Courgette' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Cormorant Garamond' => array(
'variants' => array('300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Fira Sans Extra Condensed' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Kalam' => array(
'variants' => array('300', '400', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'handwriting'
),
'Rokkitt' => array(
'variants' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'serif'
),
'Noto Sans SC' => array(
'variants' => array('100', '300', '400', '500', '700', '900'),
'subsets' => array('vietnamese', 'cyrillic', 'latin', 'chinese-simplified'),
'category' => 'sans-serif'
),
'Martel' => array(
'variants' => array('200', '300', '400', '600', '700', '800', '900'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'serif'
),
'Amiri' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin-ext', 'latin', 'arabic'),
'category' => 'serif'
),
'Pathway Gothic One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Alegreya' => array(
'variants' => array('400', 'italic', '500', '500italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'serif'
),
'Zilla Slab' => array(
'variants' => array('300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Cardo' => array(
'variants' => array('400', 'italic', '700'),
'subsets' => array('greek', 'latin-ext', 'latin', 'greek-ext'),
'category' => 'serif'
),
'Alfa Slab One' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'display'
),
'Tinos' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'hebrew', 'cyrillic-ext'),
'category' => 'serif'
),
'Barlow Semi Condensed' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Kaushan Script' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Great Vibes' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Old Standard TT' => array(
'variants' => array('400', 'italic', '700'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Quattrocento Sans' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Fredoka One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Archivo Black' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Tajawal' => array(
'variants' => array('200', '300', '400', '500', '700', '800', '900'),
'subsets' => array('latin', 'arabic'),
'category' => 'sans-serif'
),
'Advent Pro' => array(
'variants' => array('100', '200', '300', '400', '500', '600', '700'),
'subsets' => array('greek', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Orbitron' => array(
'variants' => array('400', '500', '700', '900'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Cookie' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Istok Web' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Didact Gothic' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Cantarell' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Luckiest Guy' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Lobster Two' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'display'
),
'Gloria Hallelujah' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Nanum Myeongjo' => array(
'variants' => array('400', '700', '800'),
'subsets' => array('latin', 'korean'),
'category' => 'serif'
),
'Concert One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Patrick Hand' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'handwriting'
),
'Volkhov' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Changa' => array(
'variants' => array('200', '300', '400', '500', '600', '700', '800'),
'subsets' => array('latin-ext', 'latin', 'arabic'),
'category' => 'sans-serif'
),
'Sacramento' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Vidaloka' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Frank Ruhl Libre' => array(
'variants' => array('300', '400', '500', '700', '900'),
'subsets' => array('latin-ext', 'latin', 'hebrew'),
'category' => 'serif'
),
'Quattrocento' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'M PLUS 1p' => array(
'variants' => array('100', '300', '400', '500', '700', '800', '900'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'japanese', 'latin', 'greek-ext', 'hebrew', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'IBM Plex Serif' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Gothic A1' => array(
'variants' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('latin', 'korean'),
'category' => 'sans-serif'
),
'Poiret One' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin'),
'category' => 'display'
),
'Economica' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Passion One' => array(
'variants' => array('400', '700', '900'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Lalezar' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'arabic'),
'category' => 'display'
),
'Neuton' => array(
'variants' => array('200', '300', '400', 'italic', '700', '800'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'BenchNine' => array(
'variants' => array('300', '400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Yantramanav' => array(
'variants' => array('100', '300', '400', '500', '700', '900'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Prata' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'cyrillic', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Hind Guntur' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin', 'telugu'),
'category' => 'sans-serif'
),
'Noto Serif JP' => array(
'variants' => array('200', '300', '400', '500', '600', '700', '900'),
'subsets' => array('japanese', 'latin'),
'category' => 'serif'
),
'Special Elite' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Hind Vadodara' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin', 'gujarati'),
'category' => 'sans-serif'
),
'Russo One' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Gudea' => array(
'variants' => array('400', 'italic', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Handlee' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Playfair Display SC' => array(
'variants' => array('400', 'italic', '700', '700italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin'),
'category' => 'serif'
),
'Bangers' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'display'
),
'Josefin Slab' => array(
'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Neucha' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin'),
'category' => 'handwriting'
),
'Sanchez' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Ruda' => array(
'variants' => array('400', '700', '900'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Yrsa' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Montserrat Alternates' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Chivo' => array(
'variants' => array('300', '300italic', '400', 'italic', '700', '700italic', '900', '900italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Amaranth' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Bad Script' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin'),
'category' => 'handwriting'
),
'Philosopher' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Ultra' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Viga' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Saira Extra Condensed' => array(
'variants' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Arapey' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Sunflower' => array(
'variants' => array('300', '500', '700'),
'subsets' => array('latin', 'korean'),
'category' => 'sans-serif'
),
'Pontano Sans' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Paytone One' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Cabin Condensed' => array(
'variants' => array('400', '500', '600', '700'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Archivo' => array(
'variants' => array('400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Marck Script' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin'),
'category' => 'handwriting'
),
'Baloo' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'devanagari'),
'category' => 'display'
),
'Sawarabi Mincho' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'japanese', 'latin'),
'category' => 'sans-serif'
),
'Armata' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'PT Mono' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'monospace'
),
'Yellowtail' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Monoton' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Architects Daughter' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Khand' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Unica One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'M PLUS Rounded 1c' => array(
'variants' => array('100', '300', '400', '500', '700', '800', '900'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'japanese', 'latin', 'greek-ext', 'hebrew', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Tangerine' => array(
'variants' => array('400', '700'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Hammersmith One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Parisienne' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Spectral' => array(
'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin'),
'category' => 'serif'
),
'Gochi Hand' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Saira' => array(
'variants' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Varela' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Alice' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Asap Condensed' => array(
'variants' => array('400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Enriqueta' => array(
'variants' => array('400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Gentium Basic' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Schoolbell' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Taviraj' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'serif'
),
'Sigmar One' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'display'
),
'Scada' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Audiowide' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Signika Negative' => array(
'variants' => array('300', '400', '600', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Gentium Book Basic' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Shadows Into Light Two' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Actor' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Adamina' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Pragati Narrow' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Staatliches' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'El Messiri' => array(
'variants' => array('400', '500', '600', '700'),
'subsets' => array('cyrillic', 'latin', 'arabic'),
'category' => 'sans-serif'
),
'Julius Sans One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Rock Salt' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Pridi' => array(
'variants' => array('200', '300', '400', '500', '600', '700'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'serif'
),
'Homemade Apple' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Playball' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Karma' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'serif'
),
'Ubuntu Mono' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'monospace'
),
'Kreon' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Sorts Mill Goudy' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Nanum Pen Script' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'handwriting'
),
'Fugaz One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Allura' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Press Start 2P' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'greek', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'display'
),
'Glegoo' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'serif'
),
'Yeseva One' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'display'
),
'Merienda' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Sintony' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Damion' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Cantata One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Lusitana' => array(
'variants' => array('400', '700'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Carter One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Oleo Script' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Sarala' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Allerta' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Mitr' => array(
'variants' => array('200', '300', '400', '500', '600', '700'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'sans-serif'
),
'Rasa' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin', 'gujarati'),
'category' => 'serif'
),
'Alegreya Sans SC' => array(
'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '500', '500italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Bowlby One SC' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Nothing You Could Do' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Cormorant' => array(
'variants' => array('300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Cousine' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'hebrew', 'cyrillic-ext'),
'category' => 'monospace'
),
'Antic Slab' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Jura' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Covered By Your Grace' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'PT Serif Caption' => array(
'variants' => array('400', 'italic'),
'subsets' => array('cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Arbutus Slab' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Forum' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'display'
),
'Marcellus' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Electrolize' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Boogaloo' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Pinyon Script' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Mr Dafoe' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Abhaya Libre' => array(
'variants' => array('400', '500', '600', '700', '800'),
'subsets' => array('sinhala', 'latin-ext', 'latin'),
'category' => 'serif'
),
'Unna' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Rambla' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Palanquin' => array(
'variants' => array('100', '200', '300', '400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Sarabun' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'sans-serif'
),
'Coda' => array(
'variants' => array('400', '800'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Alex Brush' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Basic' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Bevan' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'display'
),
'Marmelad' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Tenor Sans' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Lustria' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Spinnaker' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Rubik Mono One' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Rancho' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Antic' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Chewy' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Chakra Petch' => array(
'variants' => array('300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'sans-serif'
),
'Squada One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Reenie Beanie' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Saira Semi Condensed' => array(
'variants' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Caveat Brush' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Share Tech Mono' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'monospace'
),
'Leckerli One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Khula' => array(
'variants' => array('300', '400', '600', '700', '800'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Saira Condensed' => array(
'variants' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Michroma' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Candal' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Nanum Gothic Coding' => array(
'variants' => array('400', '700'),
'subsets' => array('latin', 'korean'),
'category' => 'monospace'
),
'Aclonica' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Sawarabi Gothic' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'japanese', 'latin'),
'category' => 'sans-serif'
),
'Fredericka the Great' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Niconne' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Marvel' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Magra' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Molengo' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Alef' => array(
'variants' => array('400', '700'),
'subsets' => array('latin', 'hebrew'),
'category' => 'sans-serif'
),
'Black Ops One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'VT323' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'monospace'
),
'Reem Kufi' => array(
'variants' => array('400'),
'subsets' => array('latin', 'arabic'),
'category' => 'sans-serif'
),
'Average' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Lateef' => array(
'variants' => array('400'),
'subsets' => array('latin', 'arabic'),
'category' => 'handwriting'
),
'Markazi Text' => array(
'variants' => array('400', '500', '600', '700'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'arabic'),
'category' => 'serif'
),
'Aldrich' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Days One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Nobile' => array(
'variants' => array('400', 'italic', '500', '500italic', '700', '700italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Allerta Stencil' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Quantico' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Itim' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'handwriting'
),
'Fira Mono' => array(
'variants' => array('400', '500', '700'),
'subsets' => array('cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'monospace'
),
'Rufina' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Lilita One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Coming Soon' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Biryani' => array(
'variants' => array('200', '300', '400', '600', '700', '800', '900'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'IBM Plex Mono' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'monospace'
),
'Rochester' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Italianno' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Cabin Sketch' => array(
'variants' => array('400', '700'),
'subsets' => array('latin'),
'category' => 'display'
),
'Jaldi' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Syncopate' => array(
'variants' => array('400', '700'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Just Another Hand' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Overlock' => array(
'variants' => array('400', 'italic', '700', '700italic', '900', '900italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Love Ya Like A Sister' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Telex' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Space Mono' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'monospace'
),
'Fauna One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Pangolin' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'handwriting'
),
'DM Sans' => array(
'variants' => array('400', 'italic', '500', '500italic', '700', '700italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Scheherazade' => array(
'variants' => array('400', '700'),
'subsets' => array('latin', 'arabic'),
'category' => 'serif'
),
'Mukta Malar' => array(
'variants' => array('200', '300', '400', '500', '600', '700', '800'),
'subsets' => array('latin-ext', 'latin', 'tamil'),
'category' => 'sans-serif'
),
'Knewave' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Encode Sans' => array(
'variants' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Cinzel Decorative' => array(
'variants' => array('400', '700', '900'),
'subsets' => array('latin'),
'category' => 'display'
),
'Kameron' => array(
'variants' => array('400', '700'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Gruppo' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Oranienbaum' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Arima Madurai' => array(
'variants' => array('100', '200', '300', '400', '500', '700', '800', '900'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'tamil'),
'category' => 'display'
),
'Miriam Libre' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin', 'hebrew'),
'category' => 'sans-serif'
),
'Baloo Bhai' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'gujarati'),
'category' => 'display'
),
'Berkshire Swash' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Grand Hotel' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Radley' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Martel Sans' => array(
'variants' => array('200', '300', '400', '600', '700', '800', '900'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Anonymous Pro' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('cyrillic', 'greek', 'latin-ext', 'latin'),
'category' => 'monospace'
),
'Marcellus SC' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Share' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Noto Serif TC' => array(
'variants' => array('200', '300', '400', '500', '600', '700', '900'),
'subsets' => array('vietnamese', 'cyrillic', 'chinese-traditional', 'latin'),
'category' => 'serif'
),
'Yesteryear' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Encode Sans Condensed' => array(
'variants' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Arsenal' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Halant' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'serif'
),
'Coda Caption' => array(
'variants' => array('800'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Copse' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Shrikhand' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'gujarati'),
'category' => 'display'
),
'Alegreya SC' => array(
'variants' => array('400', 'italic', '500', '500italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'serif'
),
'Racing Sans One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Baloo Bhaina' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'oriya'),
'category' => 'display'
),
'Norican' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Pattaya' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'thai'),
'category' => 'sans-serif'
),
'Jockey One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Hanuman' => array(
'variants' => array('400', '700'),
'subsets' => array('khmer'),
'category' => 'serif'
),
'Arizonia' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Carrois Gothic' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Coustard' => array(
'variants' => array('400', '900'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Petit Formal Script' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'DM Serif Display' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Lekton' => array(
'variants' => array('400', 'italic', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Annie Use Your Telescope' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Prosto One' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin'),
'category' => 'display'
),
'Caudex' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('greek', 'latin-ext', 'latin', 'greek-ext'),
'category' => 'serif'
),
'Buenard' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Aleo' => array(
'variants' => array('300', '300italic', '400', 'italic', '700', '700italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Carme' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Kosugi Maru' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'japanese', 'latin'),
'category' => 'sans-serif'
),
'Londrina Solid' => array(
'variants' => array('100', '300', '400', '900'),
'subsets' => array('latin'),
'category' => 'display'
),
'Lemonada' => array(
'variants' => array('300', '400', '600', '700'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'arabic'),
'category' => 'display'
),
'Voltaire' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Allan' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Mali' => array(
'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'handwriting'
),
'Contrail One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Suez One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'hebrew'),
'category' => 'serif'
),
'Noto Serif SC' => array(
'variants' => array('200', '300', '400', '500', '600', '700', '900'),
'subsets' => array('vietnamese', 'cyrillic', 'latin', 'chinese-simplified'),
'category' => 'serif'
),
'Nanum Brush Script' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'handwriting'
),
'Bungee Inline' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'display'
),
'Encode Sans Expanded' => array(
'variants' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Graduate' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Aladin' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Cambo' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Mada' => array(
'variants' => array('200', '300', '400', '500', '600', '700', '900'),
'subsets' => array('latin', 'arabic'),
'category' => 'sans-serif'
),
'Nixie One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Changa One' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin'),
'category' => 'display'
),
'Herr Von Muellerhoff' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Titan One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Delius' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Suranna' => array(
'variants' => array('400'),
'subsets' => array('latin', 'telugu'),
'category' => 'serif'
),
'Judson' => array(
'variants' => array('400', 'italic', '700'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'serif'
),
'Capriola' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Sue Ellen Francisco' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'GFS Didot' => array(
'variants' => array('400'),
'subsets' => array('greek'),
'category' => 'serif'
),
'Metrophobic' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Calligraffitti' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Mr De Haviland' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Bubblegum Sans' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Merienda One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'DM Serif Text' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Ramabhadra' => array(
'variants' => array('400'),
'subsets' => array('latin', 'telugu'),
'category' => 'sans-serif'
),
'Homenaje' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Overpass Mono' => array(
'variants' => array('300', '400', '600', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'monospace'
),
'Kristi' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Kelly Slab' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin'),
'category' => 'display'
),
'Belleza' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Freckle Face' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Goudy Bookletter 1911' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Bungee' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'display'
),
'Oxygen Mono' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'monospace'
),
'Trirong' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'serif'
),
'Rosario' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Mukta Vaani' => array(
'variants' => array('200', '300', '400', '500', '600', '700', '800'),
'subsets' => array('latin-ext', 'latin', 'gujarati'),
'category' => 'sans-serif'
),
'Cutive Mono' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'monospace'
),
'Sriracha' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'handwriting'
),
'Gilda Display' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Bai Jamjuree' => array(
'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'sans-serif'
),
'Slabo 13px' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Andada' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Ceviche One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Eczar' => array(
'variants' => array('400', '500', '600', '700', '800'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'serif'
),
'Cormorant Infant' => array(
'variants' => array('300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'IBM Plex Sans Condensed' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Cutive' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Amethysta' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Shojumaru' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'IM Fell English' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Bentham' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Cambay' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Palanquin Dark' => array(
'variants' => array('400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Faustina' => array(
'variants' => array('400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'serif'
),
'Cedarville Cursive' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Niramit' => array(
'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'sans-serif'
),
'Averia Serif Libre' => array(
'variants' => array('300', '300italic', '400', 'italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'display'
),
'Ovo' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Maitree' => array(
'variants' => array('200', '300', '400', '500', '600', '700'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'serif'
),
'Average Sans' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Hepta Slab' => array(
'variants' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'serif'
),
'Patrick Hand SC' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'handwriting'
),
'Gabriela' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Amita' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'handwriting'
),
'Raleway Dots' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Chelsea Market' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Anaheim' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Pompiere' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Baumans' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Rye' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Trocchi' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Chonburi' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'display'
),
'Vesper Libre' => array(
'variants' => array('400', '500', '700', '900'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'serif'
),
'Kadwa' => array(
'variants' => array('400', '700'),
'subsets' => array('latin', 'devanagari'),
'category' => 'serif'
),
'Athiti' => array(
'variants' => array('200', '300', '400', '500', '600', '700'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'sans-serif'
),
'Duru Sans' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'UnifrakturMaguntia' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Mate' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Convergence' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Krub' => array(
'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'sans-serif'
),
'Poly' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin'),
'category' => 'serif'
),
'IM Fell Double Pica' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Federo' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Gurajada' => array(
'variants' => array('400'),
'subsets' => array('latin', 'telugu'),
'category' => 'serif'
),
'Doppio One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Black Han Sans' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'sans-serif'
),
'Faster One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Montez' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Lemon' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Fresca' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Emilys Candy' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Inder' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Six Caps' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Fanwood Text' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Mountains of Christmas' => array(
'variants' => array('400', '700'),
'subsets' => array('latin'),
'category' => 'display'
),
'Cantora One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Aref Ruqaa' => array(
'variants' => array('400', '700'),
'subsets' => array('latin', 'arabic'),
'category' => 'serif'
),
'Gravitas One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Lexend Deca' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Balthazar' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Battambang' => array(
'variants' => array('400', '700'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Rouge Script' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Fondamento' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Proza Libre' => array(
'variants' => array('400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Alike' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Unkempt' => array(
'variants' => array('400', '700'),
'subsets' => array('latin'),
'category' => 'display'
),
'Do Hyeon' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'sans-serif'
),
'Carrois Gothic SC' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Bowlby One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Amiko' => array(
'variants' => array('400', '600', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Crafty Girls' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Secular One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'hebrew'),
'category' => 'sans-serif'
),
'Oregano' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Manuale' => array(
'variants' => array('400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'serif'
),
'Noto Serif KR' => array(
'variants' => array('200', '300', '400', '500', '600', '700', '900'),
'subsets' => array('latin', 'korean'),
'category' => 'serif'
),
'Vast Shadow' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'McLaren' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'IM Fell DW Pica' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Corben' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Artifika' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'La Belle Aurore' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Spectral SC' => array(
'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin'),
'category' => 'serif'
),
'Skranji' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Sofia' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Sarpanch' => array(
'variants' => array('400', '500', '600', '700', '800', '900'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Brawler' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Qwigley' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Seaweed Script' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Kurale' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin', 'devanagari', 'cyrillic-ext'),
'category' => 'serif'
),
'Limelight' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Rozha One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'serif'
),
'Give You Glory' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Strait' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Wallpoet' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Stardos Stencil' => array(
'variants' => array('400', '700'),
'subsets' => array('latin'),
'category' => 'display'
),
'Waiting for the Sunrise' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Laila' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'serif'
),
'Galada' => array(
'variants' => array('400'),
'subsets' => array('bengali', 'latin'),
'category' => 'display'
),
'Podkova' => array(
'variants' => array('400', '500', '600', '700', '800'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Belgrano' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Sansita' => array(
'variants' => array('400', 'italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Mirza' => array(
'variants' => array('400', '500', '600', '700'),
'subsets' => array('latin-ext', 'latin', 'arabic'),
'category' => 'display'
),
'Montserrat Subrayada' => array(
'variants' => array('400', '700'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Sniglet' => array(
'variants' => array('400', '800'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Gafata' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Denk One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Loved by the King' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Andika' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'sans-serif'
),
'Megrim' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Quando' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Just Me Again Down Here' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Clicker Script' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Harmattan' => array(
'variants' => array('400'),
'subsets' => array('latin', 'arabic'),
'category' => 'sans-serif'
),
'Mako' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Expletus Sans' => array(
'variants' => array('400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'display'
),
'Zeyada' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Wendy One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Baloo Bhaijaan' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'arabic'),
'category' => 'display'
),
'Scope One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Oleo Script Swash Caps' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Tauri' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Finger Paint' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Walter Turncoat' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Delius Swash Caps' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Puritan' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Spicy Rice' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Happy Monkey' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Jua' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'sans-serif'
),
'The Girl Next Door' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Meddon' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Short Stack' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Orienta' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Esteban' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'NTR' => array(
'variants' => array('400'),
'subsets' => array('latin', 'telugu'),
'category' => 'sans-serif'
),
'Tienne' => array(
'variants' => array('400', '700', '900'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Voces' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Sedgwick Ave' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'handwriting'
),
'Katibeh' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'arabic'),
'category' => 'display'
),
'Cormorant Upright' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'serif'
),
'Encode Sans Semi Condensed' => array(
'variants' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Euphoria Script' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Cormorant SC' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Fjord One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Aguafina Script' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Mallanna' => array(
'variants' => array('400'),
'subsets' => array('latin', 'telugu'),
'category' => 'sans-serif'
),
'Mouse Memoirs' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Cherry Swash' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Imprima' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Bungee Shade' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'display'
),
'Iceland' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Wire One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Rationale' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Baloo Paaji' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'gurmukhi'),
'category' => 'display'
),
'Bilbo Swash Caps' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Charm' => array(
'variants' => array('400', '700'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'handwriting'
),
'Dawning of a New Day' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Mrs Saint Delafield' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Creepster' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Alike Angular' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Share Tech' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Averia Sans Libre' => array(
'variants' => array('300', '300italic', '400', 'italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'display'
),
'Bellefair' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'hebrew'),
'category' => 'serif'
),
'IM Fell English SC' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Holtwood One SC' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Salsa' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Averia Libre' => array(
'variants' => array('300', '300italic', '400', 'italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'display'
),
'Over the Rainbow' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Cormorant Unicase' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Kosugi' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'japanese', 'latin'),
'category' => 'sans-serif'
),
'Rammetto One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Headland One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Baloo Chettan' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'malayalam'),
'category' => 'display'
),
'Atma' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('bengali', 'latin-ext', 'latin'),
'category' => 'display'
),
'Ledger' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin'),
'category' => 'serif'
),
'Vampiro One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Lily Script One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Codystar' => array(
'variants' => array('300', '400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Geo' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Port Lligat Sans' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Pavanam' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'tamil'),
'category' => 'sans-serif'
),
'Encode Sans Semi Expanded' => array(
'variants' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Princess Sofia' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Baloo Thambi' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'tamil'),
'category' => 'display'
),
'Krona One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Dekko' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'handwriting'
),
'Dynalight' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Crushed' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Medula One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Nova Square' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Life Savers' => array(
'variants' => array('400', '700', '800'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Fontdiner Swanky' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Libre Barcode 39' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Timmana' => array(
'variants' => array('400'),
'subsets' => array('latin', 'telugu'),
'category' => 'sans-serif'
),
'Habibi' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Shanti' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Prociono' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'BioRhyme' => array(
'variants' => array('200', '300', '400', '700', '800'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Rakkas' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'arabic'),
'category' => 'display'
),
'Numans' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Bubbler One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'B612 Mono' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'monospace'
),
'Nova Round' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Port Lligat Slab' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Nova Mono' => array(
'variants' => array('400'),
'subsets' => array('greek', 'latin'),
'category' => 'monospace'
),
'Slackey' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Eater' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Vibur' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Mandali' => array(
'variants' => array('400'),
'subsets' => array('latin', 'telugu'),
'category' => 'sans-serif'
),
'Modak' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'display'
),
'Poller One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Rum Raisin' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Englebert' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Antic Didone' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Frijole' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Kranky' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Underdog' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin'),
'category' => 'display'
),
'Bilbo' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'IM Fell French Canon SC' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Quintessential' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Engagement' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Cute Font' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'display'
),
'Asul' => array(
'variants' => array('400', '700'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Ranchers' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'K2D' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'sans-serif'
),
'Spirax' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'ZCOOL XiaoWei' => array(
'variants' => array('400'),
'subsets' => array('latin', 'chinese-simplified'),
'category' => 'serif'
),
'Milonga' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Cherry Cream Soda' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Overlock SC' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Koulen' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Metamorphous' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Coiny' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'tamil'),
'category' => 'display'
),
'Padauk' => array(
'variants' => array('400', '700'),
'subsets' => array('myanmar', 'latin'),
'category' => 'sans-serif'
),
'Noto Sans HK' => array(
'variants' => array('100', '300', '400', '500', '700', '900'),
'subsets' => array('chinese-hongkong', 'latin'),
'category' => 'sans-serif'
),
'Chau Philomene One' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'David Libre' => array(
'variants' => array('400', '500', '700'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'hebrew'),
'category' => 'serif'
),
'Mukta Mahee' => array(
'variants' => array('200', '300', '400', '500', '600', '700', '800'),
'subsets' => array('latin-ext', 'latin', 'gurmukhi'),
'category' => 'sans-serif'
),
'Arya' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'sans-serif'
),
'Elsie' => array(
'variants' => array('400', '900'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Tulpen One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Mate SC' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Notable' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Kotta One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Almendra' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Ruslan Display' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin'),
'category' => 'display'
),
'Mystery Quest' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Vollkorn SC' => array(
'variants' => array('400', '600', '700', '900'),
'subsets' => array('vietnamese', 'cyrillic', 'latin-ext', 'latin', 'cyrillic-ext'),
'category' => 'serif'
),
'Sail' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Kite One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Farsan' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'gujarati'),
'category' => 'display'
),
'Amarante' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Meera Inimai' => array(
'variants' => array('400'),
'subsets' => array('latin', 'tamil'),
'category' => 'sans-serif'
),
'Gugi' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'display'
),
'Ruluko' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Condiment' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Donegal One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Nosifer' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Hanalei Fill' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Dokdo' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'handwriting'
),
'Mogra' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'gujarati'),
'category' => 'display'
),
'Buda' => array(
'variants' => array('300'),
'subsets' => array('latin'),
'category' => 'display'
),
'Sumana' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'serif'
),
'Manjari' => array(
'variants' => array('100', '400', '700'),
'subsets' => array('latin', 'malayalam'),
'category' => 'sans-serif'
),
'Chicle' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Peralta' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Baloo Tamma' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'kannada'),
'category' => 'display'
),
'Gaegu' => array(
'variants' => array('300', '400', '700'),
'subsets' => array('latin', 'korean'),
'category' => 'handwriting'
),
'Ramaraja' => array(
'variants' => array('400'),
'subsets' => array('latin', 'telugu'),
'category' => 'serif'
),
'Fascinate Inline' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Fenix' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Yatra One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'display'
),
'Mansalva' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Livvic' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '900', '900italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Sarina' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Paprika' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'IM Fell Great Primer' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Rosarivo' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Inknut Antiqua' => array(
'variants' => array('300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'serif'
),
'League Script' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Akronim' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Baloo Da' => array(
'variants' => array('400'),
'subsets' => array('bengali', 'vietnamese', 'latin-ext', 'latin'),
'category' => 'display'
),
'Flamenco' => array(
'variants' => array('300', '400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Khmer' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Sancreek' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Dorsa' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Moul' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Maiden Orange' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Miniver' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Londrina Outline' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Plaster' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Lovers Quarrel' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Sonsie One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Simonetta' => array(
'variants' => array('400', 'italic', '900', '900italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Junge' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Stint Ultra Condensed' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Redressed' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Stoke' => array(
'variants' => array('300', '400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Baloo Tammudu' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'telugu'),
'category' => 'display'
),
'Germania One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'IM Fell DW Pica SC' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Cagliostro' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Italiana' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Thasadith' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'sans-serif'
),
'Averia Gruesa Libre' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Kumar One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'gujarati'),
'category' => 'display'
),
'ZCOOL QingKe HuangYou' => array(
'variants' => array('400'),
'subsets' => array('latin', 'chinese-simplified'),
'category' => 'display'
),
'IM Fell French Canon' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Angkor' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Ewert' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Pirata One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Sura' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'serif'
),
'Stalemate' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Nova Slim' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Offside' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Uncial Antiqua' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Croissant One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Swanky and Moo Moo' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Trade Winds' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Ribeye' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Text Me One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Kavoon' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Delius Unicase' => array(
'variants' => array('400', '700'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Mina' => array(
'variants' => array('400', '700'),
'subsets' => array('bengali', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'New Rocker' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Bokor' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Macondo Swash Caps' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Revalia' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Julee' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Red Hat Text' => array(
'variants' => array('400', 'italic', '500', '500italic', '700', '700italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Libre Caslon Text' => array(
'variants' => array('400', 'italic', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Marko One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Bahiana' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Jacques Francois Shadow' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Literata' => array(
'variants' => array('400', '500', '600', '700', 'italic', '500italic', '600italic', '700italic'),
'subsets' => array('vietnamese', 'cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext'),
'category' => 'serif'
),
'Inika' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Chela One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'UnifrakturCook' => array(
'variants' => array('700'),
'subsets' => array('latin'),
'category' => 'display'
),
'Griffy' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Glass Antiqua' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Linden Hill' => array(
'variants' => array('400', 'italic'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Nova Flat' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Stint Ultra Expanded' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Ribeye Marrow' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Petrona' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Saira Stencil One' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'display'
),
'Henny Penny' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Chango' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Margarine' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Della Respira' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Jim Nightshade' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Be Vietnam' => array(
'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Trykker' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Monsieur La Doulaise' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Ranga' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'display'
),
'Tillana' => array(
'variants' => array('400', '500', '600', '700', '800'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'handwriting'
),
'Eagle Lake' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Monofett' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Darker Grotesque' => array(
'variants' => array('300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Bigshot One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Diplomata' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Autour One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Ruthie' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Smythe' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Irish Grover' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Nokora' => array(
'variants' => array('400', '700'),
'subsets' => array('khmer'),
'category' => 'serif'
),
'Elsie Swash Caps' => array(
'variants' => array('400', '900'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Metal Mania' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'IM Fell Double Pica SC' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Seymour One' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Sree Krushnadevaraya' => array(
'variants' => array('400'),
'subsets' => array('latin', 'telugu'),
'category' => 'serif'
),
'Red Hat Display' => array(
'variants' => array('400', 'italic', '500', '500italic', '700', '700italic', '900', '900italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Charmonman' => array(
'variants' => array('400', '700'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'handwriting'
),
'Galdeano' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Wellfleet' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Blinker' => array(
'variants' => array('100', '200', '300', '400', '600', '700', '800', '900'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Montaga' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Dangrek' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Joti One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Barrio' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Libre Barcode 39 Extended Text' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Dr Sugiyama' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Trochut' => array(
'variants' => array('400', 'italic', '700'),
'subsets' => array('latin'),
'category' => 'display'
),
'IM Fell Great Primer SC' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Song Myung' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'serif'
),
'Oldenburg' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Modern Antiqua' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Chilanka' => array(
'variants' => array('400'),
'subsets' => array('latin', 'malayalam'),
'category' => 'handwriting'
),
'Felipa' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Ravi Prakash' => array(
'variants' => array('400'),
'subsets' => array('latin', 'telugu'),
'category' => 'display'
),
'Kodchasan' => array(
'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'sans-serif'
),
'Almarai' => array(
'variants' => array('300', '400', '700', '800'),
'subsets' => array('arabic'),
'category' => 'sans-serif'
),
'Barriecito' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'display'
),
'Sirin Stencil' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'KoHo' => array(
'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'sans-serif'
),
'Asset' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'ZCOOL KuaiLe' => array(
'variants' => array('400'),
'subsets' => array('latin', 'chinese-simplified'),
'category' => 'display'
),
'Zilla Slab Highlight' => array(
'variants' => array('400', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'MedievalSharp' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Rhodium Libre' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'serif'
),
'Snowburst One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'B612' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Unlock' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Iceberg' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Asar' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'devanagari'),
'category' => 'serif'
),
'Keania One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Major Mono Display' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'monospace'
),
'Arbutus' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Mrs Sheppards' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Content' => array(
'variants' => array('400', '700'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Chathura' => array(
'variants' => array('100', '300', '400', '700', '800'),
'subsets' => array('latin', 'telugu'),
'category' => 'sans-serif'
),
'Smokum' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Molle' => array(
'variants' => array('italic'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Sahitya' => array(
'variants' => array('400', '700'),
'subsets' => array('latin', 'devanagari'),
'category' => 'serif'
),
'Farro' => array(
'variants' => array('300', '400', '500', '700'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Meie Script' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Lancelot' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Libre Barcode 128' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Devonshire' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Bayon' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Grenze' => array(
'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'serif'
),
'Atomic Age' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Poor Story' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'display'
),
'Diplomata SC' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Astloch' => array(
'variants' => array('400', '700'),
'subsets' => array('latin'),
'category' => 'display'
),
'Purple Purse' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Goblin One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Jacques Francois' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Miss Fajardose' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Libre Barcode 39 Text' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Odor Mean Chey' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Freehand' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Original Surfer' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Jolly Lodger' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Kenia' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Siemreap' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Miltonian Tattoo' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Flavors' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Caesar Dressing' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Snippet' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Almendra Display' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Kantumruy' => array(
'variants' => array('300', '400', '700'),
'subsets' => array('khmer'),
'category' => 'sans-serif'
),
'Sunshiney' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Jomhuria' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'arabic'),
'category' => 'display'
),
'Hi Melody' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'handwriting'
),
'Libre Barcode 39 Extended' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Nova Cut' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Gorditas' => array(
'variants' => array('400', '700'),
'subsets' => array('latin'),
'category' => 'display'
),
'Nova Oval' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Londrina Shadow' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Fasthand' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'serif'
),
'Piedra' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Stylish' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'sans-serif'
),
'Suwannaphum' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Nova Script' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Taprom' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Lakki Reddy' => array(
'variants' => array('400'),
'subsets' => array('latin', 'telugu'),
'category' => 'handwriting'
),
'Fahkwang' => array(
'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'sans-serif'
),
'Miltonian' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Romanesco' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'GFS Neohellenic' => array(
'variants' => array('400', 'italic', '700', '700italic'),
'subsets' => array('greek'),
'category' => 'sans-serif'
),
'Almendra SC' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'serif'
),
'Kavivanar' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'tamil'),
'category' => 'handwriting'
),
'Kirang Haerang' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'display'
),
'Macondo' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Londrina Sketch' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Bungee Outline' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'display'
),
'Ruge Boogie' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'East Sea Dokdo' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'handwriting'
),
'Zhi Mang Xing' => array(
'variants' => array('400'),
'subsets' => array('latin', 'chinese-simplified'),
'category' => 'handwriting'
),
'Gamja Flower' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'handwriting'
),
'Galindo' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Long Cang' => array(
'variants' => array('400'),
'subsets' => array('latin', 'chinese-simplified'),
'category' => 'handwriting'
),
'Liu Jian Mao Cao' => array(
'variants' => array('400'),
'subsets' => array('latin', 'chinese-simplified'),
'category' => 'handwriting'
),
'Hanalei' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Gayathri' => array(
'variants' => array('100', '400', '700'),
'subsets' => array('latin', 'malayalam'),
'category' => 'sans-serif'
),
'Geostar Fill' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Srisakdi' => array(
'variants' => array('400', '700'),
'subsets' => array('vietnamese', 'latin-ext', 'latin', 'thai'),
'category' => 'display'
),
'Butcherman' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Tenali Ramakrishna' => array(
'variants' => array('400'),
'subsets' => array('latin', 'telugu'),
'category' => 'sans-serif'
),
'Risque' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Big Shoulders Display' => array(
'variants' => array('100', '300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'display'
),
'Supermercado One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Combo' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Butterfly Kids' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Crimson Pro' => array(
'variants' => array('200', '300', '400', '500', '600', '700', '800', '900', '200italic', '300italic', 'italic', '500italic', '600italic', '700italic', '800italic', '900italic'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'serif'
),
'Sedgwick Ave Display' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'handwriting'
),
'Gidugu' => array(
'variants' => array('400'),
'subsets' => array('latin', 'telugu'),
'category' => 'sans-serif'
),
'Metal' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Libre Barcode 128 Text' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Fruktur' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Fascinate' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Passero One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Sevillana' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Erica One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Preahvihear' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Emblema One' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Bungee Hairline' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'display'
),
'Black And White Picture' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'sans-serif'
),
'Bonbon' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Kumar One Outline' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin', 'gujarati'),
'category' => 'display'
),
'Bigelow Rules' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Sofadi One' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Mr Bedfort' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'handwriting'
),
'Aubrey' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Geostar' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Suravaram' => array(
'variants' => array('400'),
'subsets' => array('latin', 'telugu'),
'category' => 'serif'
),
'Libre Caslon Display' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Chenla' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Peddana' => array(
'variants' => array('400'),
'subsets' => array('latin', 'telugu'),
'category' => 'serif'
),
'Federant' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'display'
),
'Yeon Sung' => array(
'variants' => array('400'),
'subsets' => array('latin', 'korean'),
'category' => 'display'
),
'Kdam Thmor' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Moulpali' => array(
'variants' => array('400'),
'subsets' => array('khmer'),
'category' => 'display'
),
'Stalinist One' => array(
'variants' => array('400'),
'subsets' => array('cyrillic', 'latin-ext', 'latin'),
'category' => 'display'
),
'BioRhyme Expanded' => array(
'variants' => array('200', '300', '400', '700', '800'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'serif'
),
'Turret Road' => array(
'variants' => array('200', '300', '400', '500', '700', '800'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Dhurjati' => array(
'variants' => array('400'),
'subsets' => array('latin', 'telugu'),
'category' => 'sans-serif'
),
'Big Shoulders Text' => array(
'variants' => array('100', '300', '400', '500', '600', '700', '800', '900'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'display'
),
'Beth Ellen' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'handwriting'
),
'Fira Code' => array(
'variants' => array('300', '400', '500', '600', '700'),
'subsets' => array('cyrillic', 'greek', 'latin-ext', 'latin', 'greek-ext', 'cyrillic-ext'),
'category' => 'monospace'
),
'Warnes' => array(
'variants' => array('400'),
'subsets' => array('latin-ext', 'latin'),
'category' => 'display'
),
'Lexend Exa' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Vibes' => array(
'variants' => array('400'),
'subsets' => array('latin', 'arabic'),
'category' => 'display'
),
'Lexend Giga' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Lexend Zetta' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Bahianita' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'display'
),
'Lexend Tera' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Single Day' => array(
'variants' => array('400'),
'subsets' => array('korean'),
'category' => 'display'
),
'Lacquer' => array(
'variants' => array('400'),
'subsets' => array('latin'),
'category' => 'sans-serif'
),
'Lexend Mega' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Lexend Peta' => array(
'variants' => array('400'),
'subsets' => array('vietnamese', 'latin-ext', 'latin'),
'category' => 'sans-serif'
),
'Ma Shan Zheng' => array(
'variants' => array('400'),
'subsets' => array('latin', 'chinese-simplified'),
'category' => 'handwriting'
)
);

?>