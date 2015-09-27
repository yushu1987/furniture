<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 * @分页插件
 * @example:{{pager count=100 pagesize=10 page=1 pagelink="" list=5}}
 */

function smarty_function_pager($arrParams, &$smarty)
{
    if (intval($arrParams['page']) === 0)
    {
        $arrParams['page'] = 1;     //default page is 1
    }
    $intPages = ceil($arrParams['count']/$arrParams['pagesize']);   //总页数
	if( ! isset($arrParams['page_limit'])) {
		$arrParams['page_limit'] = 0;
	}
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
        if(isset($arrParams['nosprintf']) && $arrParams['nosprintf'])
            $strPager.= '<a class="next-page" style="margin-right:0" href="'.$arrParams['pagelink'].($arrParams['page']-1). '">上一页</a>';
        else
            $strPager.= '<a class="next-page" style="margin-right:0" href="' . sprintf($arrParams['pagelink'], $arrParams['page']-1) . '">上一页</a>';
    }
    for ($i = $intPageStart; $i <= $intPageEnd; $i++)
    {
        if ($arrParams['page'] == $i)
        {
            $strPager .= '<span class="current-page">' . $i . '</span>';
        }
        else
        {
            if( isset($arrParams['nosprintf']) && $arrParams['nosprintf'])
                $strPager .= '<a href="' . $arrParams['pagelink'].$i. '">' . $i . '</a>';
            else
                $strPager .= '<a href="' . sprintf($arrParams['pagelink'], $i) . '">' . $i . '</a>';
        }
    }
    if ($arrParams['page'] < $intPages)
    {
        if( isset( $arrParams['nosprintf']) && $arrParams['nosprintf'])
            $strPager.= '<a class="next-page" href="' . $arrParams['pagelink'].($arrParams['page']+1). '">下一页</a>';
        else
            $strPager.= '<a class="next-page" href="' . sprintf($arrParams['pagelink'], $arrParams['page']+1) . '">下一页</a>';
    }

    return $strPager;
}
?>
