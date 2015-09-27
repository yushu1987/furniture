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
function smarty_modifier_format_month_to_year($month)
{
    if (strval($month) === '')
    {
        return '';
    }
    else
    {
        $year = intval($month / 12);
        $mon = $month % 12;
        if($year>0)
        {
            $year = $year.'年';
        }
        else
        {
            $year = '';
        }
        if($mon>0)
        {
            $mon = $mon . '个月';
        }
        else
        {
            $mon = '';
        }
        return $year . $mon;
    }
}
?>
