<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 * @分页插件
 * @example:{{pager count=100 pagesize=10 page=1 pagelink="" list=5}}
 */

function smarty_function_img_url($arrParams, &$smarty)
{
    $arrParams = array_merge(array(
        'w' => 0,   //width
        'h' => 0,   //height
        'c' => 1000,//config id
    ), $arrParams);
    return RongImageUtil::get_url($arrParams['url'], $arrParams['w'], $arrParams['h'], $arrParams['c']);
}


