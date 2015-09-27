{%extends file="page/base.tpl" %}
{%block name="title"%}上传列表{%/block%}
{%block name="content"%}
<div id="content" class="container" >
	<table class=" table table-bordered table-hover" id="group_list" style="">
		<thead>
			<tr>
				<th>id</th>
				<th>产品</th>
				<th>版本</th>
				<th>渠道组</th>
				<th>母包</th>
				<th>渠道包</th>
				<th>状态</th>
				<th>操作人</th>
				<th>时间</th>
			</tr>
		</thead>
		<tbody>
			{%foreach from=$list key=k item=v%}
			<tr id="tr{%$v.id + 1 %}">
				<td>{%$v.id +1%}</td>
				<td>{%$v.product%}</td>
				<td>{%$v.product_version%}</td>
				<td><a href="#" name="channel_group" id="channel_group" rel="popover" data-trigger="hover" data-content="{%$v.channel_list%}" data-original-title="详细">{%$v.channel_group%}</a>
				<td><a href="{%$v.parent_url%}">下载</a></td>
				<td><a href="{%$v.channel_url%}">下载</a></td>
				<td>
					{%if $v.status == '未执行'%}
						<statusU>{%$v.status%}</statusU>
					{%elseif $v.status == '执行中'%}
						<statusI>{%$v.status%}</statusI>
					{%elseif $v.status == '成功'%}
						<statusD>{%$v.status%}</statusD>
					{%else%}
						<statusF>{%$v.status%}</statusF>
					{%/if%}
				</td>
				<td>{%$v.owner%}</td>
				<td>{%$v.task_time|date_format:'%Y-%m-%d %H:%M:%S'%}</td>
			</tr>
			{%/foreach%}
		</tbody>
	</table>
	<div>
	{%assign var="pn" value=$smarty.get.pn%}
	{%$x = explode('?', $smarty.server.REQUEST_URI)%}
	{%assign var="uri" value=$x[0]%}
	<ul align='right'>
		{%if $pn && $pn >=10%}
			<li>
			<a href="{%$uri%}?pn={%$pn - 10%}">Prev</a></li>
			<li>{%$pn/10 + 1%}</li>
			<li><a href="{%$uri%}?pn={%$pn + 10%}">Next</a></li>
		{%else%}
			<li>1</li>
			<li><a href="{%$uri%}?pn=10">Next</a></li>
		{%/if%}
	</ul>
	</div>
</div>
</div>
</div>
<script>
$(function ()
{% 
	$('[name="channel_group"]').popover('hide');

%});
</script>
{%/block%}
