{%extends file="page/base.tpl" %}
{%block name="title"%}产品详情{%/block%}
{%block name="content"%}
<div id="content" class="container">
	<form class="form-horizontal" enctype="multipart/form-data" method="post" action="/product/modify" >
	  <div class="control-group">
	    <label class="control-label" for="upload">更新图片:</label>
	    <div class="controls">
	      <input type="file" class="input-small" id="upload" name="upload" accept=".jpg,.png,.gif,.jpeg,.bmp" placeholder="图片路径">
	    </div>
	  </div>
	  {%assign var='i' value=1%}
	  {%foreach from=$data key=k item=v%}
	  	<div class="control-group">
			<label class="control-label" for="{%$k%}">{%$v.name%}:</label>
			<div class="controls">
				<input type="text" id="{%$k%}" name="{%$k%}" value='{%$v.val%}' >
			</div>
	  	</div>
	  {%/foreach%}
	  <div class="control-group">
	    <div class="controls">
	      <button type="submit" class="btn" style="margin-left:20px">提交</button>
	    </div>
	  </div>
	</form>
</div>
{%/block%}
