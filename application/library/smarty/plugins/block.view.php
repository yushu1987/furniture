<?php
	
	//view
	function smarty_block_view($params, $content, &$smarty, &$repeat)
	{
	    if(!$repeat){
	        if (isset($content)) {
	            $name = $params['name'];
$result=<<<si
	<div data-view="{$name}">$content</div>
si;
	            return $result;
	        }
	    }
	}

	//工具栏
	function smarty_block_bar($params, $content, &$smarty, &$repeat)
	{
	    if(!$repeat){
	        if (isset($content)) {
	            $bottom = $params['bottom']?' data-bottom="' . $params['bottom'] . '"':"";
	            $type = $params['type']?' data-xtype="' . $params['type'] . '"':"";
$result=<<<si
	<div class="ui-bar"$type$bottom>$content</div>
si;
				$result = str_replace('<right>', '<div class="bar-right">', $result);
				$result = str_replace('</right>', '</div>', $result);
	            return $result;
	        }
	    }
	}

	function smarty_block_barItem($params, $content, &$smarty, &$repeat)
	{
	    if(!$repeat){
	        if (isset($content)) {
	            $css = $params['css']?" " . $params['css']:"";
	            $icon = $params['icon']?' data-icon="' . $params['icon'] . '"':'';
	            $tap = $params['tap']?' data-tap="' . $params['tap'] . '"':'';
$result=<<<si
	<div class="bar-item$css"$icon$tap>$content</div>
si;
	            return $result;
	        }
	    }
	}

	function smarty_block_left($params, $content, &$smarty, &$repeat)
	{
	    if(!$repeat){
	        if (isset($content)) {
	            $color = $params['color']?' data-color="' . $params['color'] . '"':'';
$result=<<<si
	<div class="bar-left"$color>$content</div>
si;
	            return $result;
	        }
	    }
	}
	function smarty_block_right($params, $content, &$smarty, &$repeat)
	{
	    if(!$repeat){
	        if (isset($content)) {
$result=<<<si
	<div class="bar-right">$content</div>
si;
	            return $result;
	        }
	    }
	}
	function smarty_block_center($params, $content, &$smarty, &$repeat)
	{
	    if(!$repeat){
	        if (isset($content)) {
$result=<<<si
	<div class="bar-center">$content</div>
si;
	            return $result;
	        }
	    }
	}


//box
		function smarty_block_box($params, $content, &$smarty, &$repeat)
	{
	    if(!$repeat){
	        if (isset($content)) {
	            $top = $params['top']?' data-top="' . $params['top'] . '"':'';
	            $bottom = $params['bottom']?' data-bottom="' . $params['bottom'] . '"':'';
	            $padding = $params['padding']?' data-padding="' . $params['padding'] . '"':'';
	            $size = $params['size']?' data-size="' . $params['size'] . '"':'';
	            $align = $params['align']?' data-align="' . $params['align'] . '"':'';
	            $lazy = $params['lazy']?' data-lazy="' . $params['lazy'] . '"':'';
	            $url = $params['url']?' data-url="' . $params['url'] . '"':'';
	            $action = $params['action']?' data-action="' . $params['action'] . '"':'';
	            $param = $params['param']?' data-param="' . $params['param'] . '"':'';
	            $id = $params['id']?' id="' . $params['id'] . '"':'';
	            $css = $params['css']?' ' . $params['css']:'';
$result=<<<si
	<div class="wrap-box$css"$top$bottom$padding$size$lazy$url$param$id>$content</div>
si;
	            return $result;
	        }
	    }
	}
	function smarty_block_boxItem($params, $content, &$smarty, &$repeat)
	{
	    if(!$repeat){
	        if (isset($content)) {
	            $align = $params['align']?' data-align="' . $params['align'] . '"':'';
	            $left = $params['left']?' data-left="' . $params['left'] . '"':'';
	            $padding = $params['padding']?' data-padding="' . $params['padding'] . '"':'';
$result=<<<si
	<div class="box-item"$align$left$padding>$content</div>
si;
	            return $result;
	        }
	    }
	}


//btn
	function smarty_block_btn($params, $content, &$smarty, &$repeat)
	{
	    if(!$repeat){
	        if (isset($content)) {
	            $id = $params['id']?' id="' . $params['id'] . '"':"";
	            $color = $params['color']?' data-color="' . $params['color'] . '"':"";
	            $type = $params['type']?' data-xtype="' . $params['type'] . '"':"";
	            $icon = $params['icon']?' data-icon="' . $params['icon'] . '"':"";
	            $tap = $params['tap']?' data-tap="' . $params['tap'] . '"':"";
	            $value = $params['value']?' data-value="' . $params['value'] . '"':"";
	            $name = $params['name']?' data-name="' . $params['name'] . '"':"";
	            $action = $params['action']?' data-action="' . $params['action'] . '"':"";
	            $css = $params['css']?' ' . $params['css']:"";
$result=<<<si
	<b class="ui-btn$css"$name$id$color$type$icon$tap$value$action>$content</b>
si;
	            return $result;
	        }
	    }
	}

//doc
	function smarty_block_doc($params, $content, &$smarty, &$repeat)
	{
	    if(!$repeat){
	        if (isset($content)) {
	            $color = $params['color']?" data-color=" . $params['color']:"";
	            $size = $params['size']?" data-size=" . $params['size']:"";
$result=<<<si
	<span$color$padding$size>$content</span>
si;
	            return $result;
	        }
	    }
	}
//h2
	function smarty_block_h2($params, $content, &$smarty, &$repeat)
	{
	    if(!$repeat){
	        if (isset($content)) {
	            $bottom = $params['bottom']?" data-bottom=" . $params['bottom']:"";
	            $padding = $params['padding']?" data-padding=" . $params['padding']:"";
	            $size = $params['size']?" data-size=" . $params['size']:"";
	            $align = $params['align']?" data-align=" . $params['align']:"";
$result=<<<si
	<h2 $bottom$padding$size>$content</h2>
si;
	            return $result;
	        }
	    }
	}

//loading
	function smarty_block_loading($params, $content, &$smarty, &$repeat)
	{
	    if(!$repeat){
	        if (isset($content)) {
	            $size = $params['size']?" data-size=" . $params['size']:"";
$result=<<<si
	<div class="ui-widget" data-xtype="loading"$size>
		<span class="icon"></span>
		<span class="text">{$content}</span>
	</div>
si;
	            return $result;
	        }
	    }
	}

//tab
	function smarty_block_tab($params, $content, &$smarty, &$repeat)
	{
	    if(!$repeat){
	        if (isset($content)) {
	            $bottom = $params['bottom']?' data-bottom="' . $params['bottom'] . '"':'';
	            $id = $params['id']?' id="' . $params['id'] + '"':'';
$result=<<<si
	<div data-ui="tab"$bottom$id>$content</div>
si;
	            return $result;
	        }
	    }
	}
	function smarty_block_content($params, $content, &$smarty, &$repeat)
	{
	    if(!$repeat){
	        if (isset($content)) {
	            $css = $params['css']?' ' . $params['css']:'';
	            $id = $params['id']?' id="' . $params['id'] . '"':'';
	            $lazy = $params['lazy']?' data-lazy="' . $params['lazy'] . '"':'';
	            $padding = $params['padding']?' data-padding="' . $params['padding'] . '"':'';
	            $url = $params['url']?' data-url="' . $params['url'] . '"':'';
$result=<<<si
	<div class="tab-content$css"$id$lazy$url$padding>$content</div>
si;
	            return $result;
	        }
	    }
	}
	function smarty_block_conItem($params, $content, &$smarty, &$repeat)
	{
	    if(!$repeat){
	        if (isset($content)) {
	            $css = $params['css']?" " . $params['css']:"";
$result=<<<si
	<div class="content-item$css">$content</div>
si;
	            return $result;
	        }
	    }
	}


//wrap
	function smarty_block_wrap($params, $content, &$smarty, &$repeat)
	{
	    if(!$repeat){
	        if (isset($content)) {
	            $bottom = $params['bottom']?' data-bottom="' . $params['bottom'] . '"':'';
	            $top = $params['top']?' data-top="' . $params['top'] . '"':'';
	            $padding = $params['padding']?' data-padding="' . $params['padding'] . '"':'';
	            $size = $params['size']?' data-size="' . $params['size'] . '"':'';
	            $lazy = $params['lazy']?' data-lazy="' . $params['lazy'] . '"':'';
	            $url = $params['url']?' data-url="' . $params['url'] . '"':'';
	            $param = $params['param']?' data-param="' . $params['param'] . '"':'';
	            $id = $params['id']?' id="' . $params['id'] . '"':'';
	            $namespace = $params['namespace']?' data-namespace="' . $params['namespace'] . '"':'';
	            $css = $params['css']?' class="' . $params['css'] . '"':'';
$result=<<<si
	<div$css$top$bottom$padding$size$url$lazy$param$id$namespace>$content</div>
si;
	            return $result;
	        }
	    }
	}


	
?>