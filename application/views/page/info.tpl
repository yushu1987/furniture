{%extends file="page/base.tpl" %}
{%block name="title"%}产品详情{%/block%}
{%block name="content"%}
<div id="content" class="container">
	<form class="form-horizontal" enctype="multipart/form-data" method="post" action="/product/modify" >
	  <div class="control-group">
	    <label class="control-label" for="upload">更新图片:</label>
	    <div class="controls">
	      <input type="file" class="input-small" id="upload" name="upload" accept=".jpg,.png,.gif,.jpeg,.bmp" placeholder="图片路径" />
	    </div>
	  </div>
	 {%foreach from=$data key=k item=v%}
		{%if $k!='picture'%}
	  	<div class="control-group">
			<label class="control-label" for="{%$k%}">{%$v.name%}:</label>
			<div class="controls">
				{%if $k == 'createTime'%}
				<input type="text" id="{%$k%}" name="{%$k%}" value='{%$v.val|date_format:"Y-m-d H:i:s"%}' readonly=true />
			  	{%elseif in_array($k ,array('id', 'sold'))%}
				<input type="text" id="{%$k%}" name="{%$k%}" value='{%$v.val%}' readonly=true />
				{%elseif in_array($k, array('name','model','type','area','price','series','standard','color','material'))%}
				<input type="text" id="{%$k%}" name="{%$k%}" value='{%$v.val%}'/>
				{%elseif $k == 'hot'%}
				<input type="radio" id="{%$k%}" name="{%$k%}" value="{%$v.val%}" checked="checked"/>{%if $v.val==1%}热门{%else%}非热门{%/if%}
				<input type="radio" id="{%$k%}" name="{%$k%}" value="{%1 - $v.val%}" />{%if $v.val==1%}非热门{%else%}热门{%/if%}
				{%elseif $k == 'status'%}
				<input type="radio" id="{%$k%}" name="{%$k%}" value="{%$v.val%}" checked="checked"/>{%if $v.val==1%}已下架{%else%}销售中{%/if%}
				<input type="radio" id="{%$k%}" name="{%$k%}" value="{%1 - $v.val%}" />{%if $v.val==0%}已下架{%else%}销售中{%/if%}
				{%/if%}	
			</div>
	  	</div>
		{%/if%}
	 {%/foreach%}
	 <div class="control-group" id="images">
	   <label class="control-label" for="pircutre">图片:</label>
		<div class="controls">
		   <a id="picture" title="{%$data.name.val%}" href="{%$data.picture.val.big%}"><img alt="" src="{%$data.picture.val.small%}" /></a>
		</div>
	  </div>
	  <div class="control-group">
	    <div class="controls">
	      <button type="submit" class="btn" style="margin-left:20px">提交</button>
	    </div>
	  </div>
	</form>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$("#picture").imgbox({
			'speedIn'		: 0,
			'speedOut'		: 0,
			'alignment'		: 'center',
			'overlayShow'	: true,
			'allowMultiple'	: false
	});	
});
</script>
{%/block%}
