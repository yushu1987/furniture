<?php /* Smarty version Smarty 3.1.4, created on 2015-09-30 16:46:03
         compiled from "/home/wangjian/furniture/application/views/page/home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3004242415608da5881a484-93236048%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7cc4017ab22af802f7f760ad12aba61a5cad7e63' => 
    array (
      0 => '/home/wangjian/furniture/application/views/page/home.tpl',
      1 => 1443528192,
      2 => 'file',
    ),
    '1c5dfe95bbdcc708259c242892595daf379a5e00' => 
    array (
      0 => '/home/wangjian/furniture/application/views/page/base.tpl',
      1 => 1443596964,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3004242415608da5881a484-93236048',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5608da588c37e',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5608da588c37e')) {function content_5608da588c37e($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/wangjian/furniture/application/library/Smarty/plugins/modifier.date_format.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>家具后台</title>
<link href="/static/css/bootstrap.css" rel="stylesheet">
<link href="/static/css/lrtk.css" rel="stylesheet">
<link href="/static/css/main.css" rel="stylesheet">
<link href="/static/css/tooltip.css" rel="stylesheet">
<script src="/static/js/jquery-1.10.2.min.js"></script>
<script src="/static/js/jquery.form.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/bootstrap.js"></script>
<script src="/static/js/jquery.imgbox.pack.js"></script>
<style>table{table-layout: fixed;}td{word-break: break-all; word-wrap:break-word;}select{width:60px}</style>
</head>
<body>
    <div class="container">
		<div id="header" class="row header">
	        <div class="logo" title="后台管理" style="margin-top:5px;">
	            <a class="logo" href="#"></a>
	        </div>
		    <div class="systitle">
	           <h3>
	               <a href="/product/home">家具后台管理</a>
	           </h3>
	        </div>
		 </div>
		 <div id="main" class="row" style="margin-top:30px">
			<div class="span2" style="width:250px;">
			 <ul class="nav nav-list bs-docs-sidenav" >
				<li id="home"><a href="/product/home"><i class="icon-chevron-right"></i>上传产品</a></li>
				<li id="pclist"><a href="/product/pclist" ><i class="icon-chevron-right"></i>产品列表</a></li>
				<li id="pcorder"><a href="/order/pcorder"><i class="icon-chevron-right"></i>订单列表</a></li>
				<li id="finance"><a href="/order/finance"><i class="icon-chevron-right"></i>账单分析</a></li>
				<li id="help"><a href="/channel/help" ><i class="icon-chevron-right"></i>帮助</a></li>
			 </ul>
		 </div>
			<div class="span12">
				
<div id="content" class="container">
	<form class="form-horizontal" enctype="multipart/form-data" method="post" action="/product/add" >
	  <div class="control-group">
	    <label class="control-label" for="upload">上传图片:</label>
	    <div class="controls">
	      <input type="file" class="input-small" id="upload" name="upload" accept=".jpg,.png,.gif,.jpeg,.bmp" required placeholder="图片路径">
	    </div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="name">名称:</label>
			<div class="controls">
				<input type="text" id="name" name="name" placeholder="茶几" required >
			</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="type">类型:</label>
			<div class="controls">
				<input type="text" id="type" name="type" placeholder="" required >
			</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="standard">规格:</label>
			<div class="controls">
				<input type="text" id="standard" name="standard" placeholder="" required >
			</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="model">型号:</label>
			<div class="controls">
				<input type="text" id="model" name="model" placeholder="1.8*2.0" required >
			</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="price">价格:</label>
			<div class="controls">
				<input type="text" id="price" name="price" placeholder="价格" required >
			</div>
	  </div>
	  <div class="control-group">
        <label class="control-label" for="color">颜色:</label>
	      <div class="controls">
			    <input type="text" id="color" name="color" placeholder="颜色" required >
		  </div>
	  </div>
	  <div class="control-group">
        <label class="control-label" for="material">材质:</label>
	      <div class="controls">
			    <input type="text" id="material" name="material" placeholder="材质" required >
		  </div>
	  </div>
	 <div class="control-group">
        <label class="control-label" for="area">产地:</label>
              <div class="controls">
                            <input type="text" id="area" name="area" placeholder="北京" required >
                  </div>
          </div>
	  <div class="control-group">
        <label class="control-label" for="series">系列:</label>
	      <div class="controls">
			    <input type="text" id="series" name="series" placeholder="系列" required >
		  </div>
	  </div>
	  <div class="control-group">
	    <div class="controls">
	      <button type="submit" class="btn" style="margin-left:20px">上传</button>
	    </div>
	  </div>
	</form>
</div>

			</div>
		 </div>
    	<div class="subcontainer footer">
			<center><?php echo smarty_modifier_date_format(time(),'%Y');?>
@<strong>&nbsp; &nbsp;居然之家</strong>&nbsp; &nbsp;Design By: 王坚</center>
		</div>
    </div>
</html>
<?php }} ?>