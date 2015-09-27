{%extends file="page/base.tpl" %}
{%block name="title"%}订单列表{%/block%}
{%block name="content"%}
<table class="table table-bordered table-hover" id="groupTbl" style="">
 	<thead>
		<tr>
			<th width='5%'>ID</th>
			<th width='5%'>客户</th>
			<th width='5%'>手机</th>
			<th width='5%>总额</th>
			<th width='20%'>地址</th>
			<th width='30%'>详细</th>
			<th width='10%'>时间</th>
			<th width='10%'>状态</th>
		</tr>
	</thead>
	<tbody>
		{%foreach from=$channelList key=k item=v%}
		<tr id="tr{%$k+1%}">
			<td>{%$v.id%}</td>
			<td>{%$v.product%}</td>
			<form method="post" action="/channel/updatechannelgroup?id={%$v.id%}">
			<td><input type="text" name="name" value="{%$v.channel_group%}" id="name" /></td>
			<td><input type="text" name="detail" value="{%$v.channel_list%}" id="detail" /></td>
			<td>
				<input type="text" name="owner" value="" class="span2" id="owner" placeholder="输入操作人"/>
				<button type="submit" class="btn">更改</button>
			</td>
			</form>
		</tr>
		{%/foreach%}
	</tbody>
</table>

<div align=right>
	{%assign var="pn" value=$smarty.get.pn%}
	{%$x = explode('?', $smarty.server.REQUEST_URI)%}
	{%assign var="uri" value=$x[0]%}
	<ul>
		{%if $pn && $pn >=10%}
			<li><a href="{%$uri%}?pn={%$pn - 10%}">Prev</a></li>
			<li>{%$pn/10 + 1%}</li>
			<li><a href="{%$uri%}?pn={%$pn + 10%}">Next</a></li>
		{%else%}
			<li>1</li>
			<li><a href="{%$uri%}?pn=10">Next</a></li>
		{%/if%}
	</ul>
</div>
{%/block%}
