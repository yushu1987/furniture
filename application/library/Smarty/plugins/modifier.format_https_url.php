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
function smarty_modifier_format_https_url($url, $domain)
{
    if (Config :: $supportHttps)
    {
        return 'https://' . $domain . $url;
    }
    else
    {
        return 'http://' . $domain . $url;
    }
}

?>
