<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsModifierCompiler
 */

/**
 * Smarty count_words modifier plugin
 *
 * Type:     modifier<br>
 * Name:     count_words<br>
 * Purpose:  count the number of words in a text
 *
 * @link http://www.smarty.net/manual/en/language.modifier.count.words.php count_words (Smarty online manual)
 * @author Uwe Tews
 * @param array $params parameters
 * @return string with compiled code
*/
function smarty_modifier_format_city_url($url, $city='')
{
	if(empty($city)){
		$city = (Yii :: app()->params['cityDomain']) ? Yii :: app()->params['cityDomain'] : 'www';
	}
	$www_str_reg = "/www\.rong360\.com/i";
	if (preg_match("/^https/i", $url) || !(preg_match($www_str_reg, $url))){
		return $url;
	}
	return preg_replace("/www/i", $city, $url);
}
?>
