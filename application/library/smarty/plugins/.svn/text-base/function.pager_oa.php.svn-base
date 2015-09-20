<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 * @分页插件
 * @example:{{pager count=100 pagesize=10 page=1 pagelink="" list=5}}
 * @history modify by guofeng 添加异步支持，将页面传入标签属性，href置为"#"以触发js函数
 */

function smarty_function_pager_oa($arrParams, &$smarty)
{
    if (intval($arrParams['page']) === 0)
    {
        $arrParams['page'] = 1;     //default page is 1
    }
    $intPages = ceil($arrParams['count']/$arrParams['pagesize']);   //总页数
    if(($intPageLimit = intval($arrParams['page_limit'])) > 0)
    {
        $intPages = $intPages > $intPageLimit ? $intPageLimit : $intPages;
    }

    if($arrParams['list']>0)
    {
        $intPageStart = $arrParams['page'] > $arrParams['list'] ? $arrParams['page'] - $arrParams['list'] : 1;
        $intPageEnd   = $arrParams['page'] + $arrParams['list'] > $intPages ? $intPages : $arrParams['page'] + $arrParams['list'];
    }
    else
    {
        $intPageStart = 1;
        $intPageEnd = $intPages;
    }

    preg_match('/page=(\d+)/', $arrParams['pagelink'], $arrPage);
    if (!empty($arrPage))
    {
        $arrParams['pagelink'] = str_replace(array('&' . $arrPage[0], $arrPage[0]), '', $arrParams['pagelink']);
    }
    
    $strPager = '';
    if ($arrParams['page'] > 1)
    {

        if($arrParams['nosprintf']){
            $strPager.= '<li class="prev"><a style="margin-right:0"  data-id="1" href="'.$arrParams['pagelink'].'1'. '">第一页</a></li>';
            $strPager.= '<li class="prev"><a style="margin-right:0"  data-id='.($arrParams['page']-1).' href="'.$arrParams['pagelink'].($arrParams['page']-1). '">上一页</a>';
        }else{
            $strPager.= '<li class="prev"><a style="margin-right:0" data-id="1" href="' . sprintf($arrParams['pagelink'], 1). '">第一页</a></li>';
            $strPager.= '<li class="prev"><a style="margin-right:0" data-id='.($arrParams['page']-1).' href="' . sprintf($arrParams['pagelink'], $arrParams['page']-1) . '">上一页</a></li>';
        }

    }
    for ($i = $intPageStart; $i <= $intPageEnd; $i++)
    {
        if ($arrParams['page'] == $i)
        {
            $strPager .= '<li class="active"><span class="current-page">' . $i . '</span></li>';
        }
        else
        {
            if($arrParams['nosprintf'])
                $strPager .= '<li><a href="' . $arrParams['pagelink'].$i. '">' . $i . '</a></li>';
            else
                $strPager .= '<li><a href="' . sprintf($arrParams['pagelink'], $i) . '">' . $i . '</a></li>';
        }
    }
    if ($arrParams['page'] < $intPages)
    {
        if($arrParams['nosprintf']){
            $strPager.= '<li class="next"><a data-id='.($arrParams['page']+1).' href="' . $arrParams['pagelink'].($arrParams['page']+1). '">下一页</a></li>';
            $strPager.= '<li class="next"><a data-id='.$intPages.' href="' . $arrParams['pagelink']. $intPages. '">最后一页</a></li>';
        }else{
            $strPager.= '<li class="next"><a data-id='.($arrParams['page']+1).' href="' . sprintf($arrParams['pagelink'], $arrParams['page']+1) . '">下一页</a></li>';
            $strPager.= '<li class="next"><a data-id='.$intPages.' href="' . sprintf($arrParams['pagelink'], $intPages) . '">最后一页</a></li>';
        }
    }

    return $strPager;
}
?>
