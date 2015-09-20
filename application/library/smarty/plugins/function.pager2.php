<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 * @分页插件
 * @example:{{pager count=100 pagesize=10 page=1 pagelink="" list=5}}
 */

function smarty_function_pager2($arrParams, &$smarty)
{
    if (intval($arrParams['page']) === 0)
    {
        $arrParams['page'] = 1;     //default page is 1
    }
    $arrParams['pagesize'] = isset($arrParams['pagesize'])?$arrParams['pagesize']: 20;
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
        $strPager.= '<a class="next-page" style="margin-right:0" href="' . _sf_pager2_get_url($arrParams, $arrParams['page']-1) . '">上一页</a>';
    }
    for ($i = $intPageStart; $i <= $intPageEnd; $i++)
    {
        if ($arrParams['page'] == $i)
        {
            $strPager .= '<span class="current-page">' . $i . '</span>';
        }
        else
        {
            $strPager .= '<a href="' . _sf_pager2_get_url($arrParams, $i). '">' . $i . '</a>';
        }
    }
    if ($arrParams['page'] < $intPages)
    {
        $strPager.= '<a class="next-page" href="' . _sf_pager2_get_url($arrParams, $arrParams['page']+1). '">下一页</a>';
    }

    return $strPager;
}

function _sf_pager2_get_url($arrParams, $page)
{
    if( isset( $arrParams['nosprintf']) && $arrParams['nosprintf']){
        return $arrParams['pagelink'].$page;
    }else if (strpos($arrParams['pagelink'], '{page}')!==false){
        return str_replace('{page}', $page, $arrParams['pagelink']);
    }else{
        return sprintf($arrParams['pagelink'], $page);
    }
}
?>
