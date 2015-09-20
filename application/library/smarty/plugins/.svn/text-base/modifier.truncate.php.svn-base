<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsModifier
 */
 
/**
 * Smarty truncate modifier plugin
 * 
 * Type:     modifier<br>
 * Name:     truncate<br>
 * Purpose:  Truncate a string to a certain length if necessary,
 *               optionally splitting in the middle of a word, and
 *               appending the $etc string or inserting $etc into the middle.
 * 
 * @link http://smarty.php.net/manual/en/language.modifier.truncate.php truncate (Smarty online manual)
 * @author Monte Ohrt <monte at ohrt dot com> 
 * @param string  $string      input string
 * @param integer $length      length of truncated text
 * @param string  $etc         end string
 * @param boolean $break_words truncate at word boundary
 * @param boolean $middle      truncate in the middle of text
 * @return string truncated string
 */
function smarty_modifier_truncate($string, $sublen = 80, $etc = '...', $break_words = false, $middle = false, $code="UTF-8") {
    $start=0;
    if($code=='UTF-8' || $code=='GBK'||$code=='GB2312')
    {
        //如果有中文则减去中文的个数        
        $cncount=cncount($string);
        if($cncount>($sublen/2)){
            $sublen=ceil($sublen/2);         
        }else{
            $sublen=$sublen-$cncount;
        }
               
        if($code=='UTF-8')
        {
            $pa="/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";         
        }
        else{
            $pa = "/[\x01-\x7f]|[\xa1-\xff][\xa1-\xff]/";
        }
                       
                               
        preg_match_all($pa,$string,$t_string);                   
        if(count($t_string[0])-$start>$sublen)             
            return join('',array_slice($t_string[0],$start,$sublen)).$etc;
        
        return join('',array_slice($t_string[0],$start,$sublen));     
    
    }else{         
        $start=$start*2;         
        $sublen=$sublen*2;         
        $strlen=strlen($string);         
        $tmpstr='';                   
        for($i=0;$i<$strlen;$i++){
            if($i>=$start&&$i<($start+$sublen)){                 
                if(ord(substr($string,$i,1))>129){                     
                    $tmpstr.=substr($string,$i,2);                 
                }else{                     
                    $tmpstr.=substr($string,$i,1);                 
                }             
             }             
            
            if(ord(substr($string,$i,1))>129)                 
                $i++;         
        }         
        
        if(strlen($tmpstr)<$strlen)             
            $tmpstr.=$etc;         
        return $tmpstr;     
    }  
}

function cncount($str){    
    $len=strlen($str);     
    $cncount=0;           
    for($i=0;$i<$len;$i++){         
        $temp_str=substr($str,$i,1);                   
        
        if(ord($temp_str)>127){             
            $cncount++;         
        }     
    }           
    return ceil($cncount/3);
}

?>
