<?php
/**
 * Smarty plugin to check rong360 mis priviledge
 *
 *
 * @param array                    $params   parameters
 * @param string                   $content  contents of the block
 * @param Smarty_Internal_Template $template template object
 * @param boolean                  &$repeat  repeat flag
 * @return string content or null
 */
function smarty_block_auth($params, $content, $template, &$repeat)
{
    if (is_null($content)) {
        return;
    }
	$p = $params['p'];
	$right_list =$params['rl']; //暂未找到直接从smarty变量中读取的办法，先从页面传入。
	list($controllerName, $actionName)=explode('.',$p);
	$auth = false;
	foreach($right_list as $key=>$value){
		 if(($value['controller'] == $controllerName) && $value['action'] == $actionName){
			 $auth = true;
			 break;
		 }
	}

	if(!$auth) return '';
	return $content;
}

?>
