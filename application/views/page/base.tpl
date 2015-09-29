<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>{%block name="title"%}家具后台管理{%/block%}</title>
<link href="/static/css/bootstrap.css" rel="stylesheet">
<link href="/static/css/lrtk.css" rel="stylesheet">
<link href="/static/css/main.css" rel="stylesheet">
<link href="/static/css/tooltip.css" rel="stylesheet">
<script src="/static/js/jquery-1.10.2.min.js"></script>
<script src="/static/js/jquery.form.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/bootstrap.js"></script>
<script src="/static/js/jquery.imgbox.pack.js"></script>
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
				{%block name="content"%}{%/block%}
			</div>
		 </div>
    	<div class="subcontainer footer">
			<center>{%$smarty.now|date_format:'%Y'%}@<strong>&nbsp; &nbsp;居然之家</strong>&nbsp; &nbsp;Design By: 王坚</center>
		</div>
    </div>
</html>
