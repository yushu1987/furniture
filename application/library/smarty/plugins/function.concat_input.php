<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 * @URL拼装。期待输入：$arrParams保留参数(concat_params[必选],concat_exclude[可选，不能包含的，用于去掉form表单中其他输入框])，其他任意名称参数。
 * @example:{concat_input concat_params=$comm_params t1='aa' concat_exclude='car_price,loan_limit,loan_term'}
 */

function smarty_function_concat_input($arrParams, &$smarty)
{
	$concatParams = $arrParams['concat_params'];
	if(empty($concatParams)){
		return false;
	}

    $strExclude=$arrParams['concat_exclude'];
    $arrExclude = explode(',', $strExclude);
	$reserved_keys = array('concat_params'=>1,'host'=>1,'concat_exclude'=>1);
    foreach ($arrExclude as $k) {
		$reserved_keys[$k] = 1;
	}

	$arrResult = array();

	foreach($concatParams as $k =>$v){
		if(!array_key_exists($k, $reserved_keys)){
			$arrResult[$k] = $v;
		}
	}
	foreach($arrParams as $k =>$v){
		if(!array_key_exists($k, $reserved_keys)){
			$arrResult[$k] = $v;
		}
	}

    $str = '';
	if (!empty($arrResult)){
		foreach ($arrResult as $k=>$v) {
		    //暂时支持一位数组。
			if(is_array($arrResult[$k])){
  			    foreach($arrResult[$k] as $subK=>$subV){
					$str .= sprintf('<input type="hidden" name="%s" value="%s"/>' , 
					    htmlspecialchars($k).'['.$subK.']' , htmlspecialchars($subV));
			    }
			} else { 
		        $str .= sprintf('<input type="hidden" name="%s" value="%s"/>' ,
		        	htmlspecialchars($k) , htmlspecialchars($v));
			}
		}
	}

    return $str;
}
?>
