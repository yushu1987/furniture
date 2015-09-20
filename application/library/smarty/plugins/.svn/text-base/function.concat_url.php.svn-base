<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 * @URL拼装。期待输入：$arrParams保留参数(comm_params[必选], path[必选], param_only[可选,默认为0], concat_exclude[可选，不能包含的，用于去掉form表单中其他输入框])，其他任意名称参数。host在comm_params数组中。
 * @example:{{concat_url comm_params=$comm_params path='/search.html' t1='aa'}}
 */

function smarty_function_concat_url($arrParams, &$smarty)
{
	$commParams = $arrParams['comm_params'];
	$host = $commParams['host'];
	$path = $arrParams['path'];
	if(empty($commParams) || empty($host) || empty($path) ){
		return false;
	}
	$param_only = false;
	if($arrParams['param_only'] == 1) {
		$param_only = true;
	}

	$reserved_keys = array('comm_params'=>1,'host'=>1, 'path'=>1, 'concat_exclude'=>1, 'param_only'=>1);
	$strExclude=$arrParams['concat_exclude'];
	$arrExclude = explode(',', $strExclude);
	 foreach ($arrExclude as $k) {
		 $reserved_keys[$k] = 1;
	 }

	$arrResult = array();

	foreach($commParams as $k =>$v){
		if(!array_key_exists($k, $reserved_keys)){
			$arrResult[$k] = $v;
		}
	}
	foreach($arrParams as $k =>$v){
		if(!array_key_exists($k, $reserved_keys)){
			$arrResult[$k] = $v;
		}
	}

    if(!$param_only) {
		$str = 'http://' . $host . $path;
	}

	if (!empty($arrResult)){
	    $str = $str . '?' . http_build_query($arrResult);
	}

    return $str;
}
?>
