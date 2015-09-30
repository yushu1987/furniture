{%extends file="page/base.tpl" %}
{%block name="title"%}订单详情{%/block%}
{%block name="content"%}
<div id="content" class="container" >
	<table class=" table table-bordered table-hover" id="product_list" style="">
		<thead>
			<tr>
				<th>id</th>
				<th>产品</th>
				<th>类型</th>
				<th>系列</th>
				<th>价格</th>
				<th>销量</th>
				<th>颜色</th>
				<th>图片</th>
				<th>上架时间</th>
			</tr>
		</thead>
		<tbody>
			{%foreach from=$data.list key=k item=v%}
			<tr id="tr{%$k+ 1 %}">
				<td>{%$k +1%}</td>
				{%if $v.hot==1%}
					<td title='热销'><a href="/product/pcinfo?pid={%$v.id%}">{%$v.name%}</a><span style="color:red">[热]</span></i></td>
				{%else%}
					<td><a href="/product/pcinfo?pid={%$v.id%}">{%$v.name%}</a></td>
				{%/if%}
				<td>{%$v.type%}</td>
				<td>{%$v.series%}</td>
				<td>{%$v.price%}</td>
				<td>{%$v.sold%}</td>
				<td>{%$v.color%}</td>
				<td>{%$v.picture%}</td>
				<td>{%$v.createTime|date_format:'%Y-%m-%d %H:%M:%S'%}</td>
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
			<a href="{%$uri%}?pn={%$pn - 10%}">上一页</a></li>
		{%/if%}
		<li>第{%$pn/10 + 1%}页</li>
		{%if $data.total > ($pn+10)%}
			<li><a href="{%$uri%}?pn={%$pn + 10%}">下一页</a></li>
		{%/if%}
	</ul>
	</div>
</div>
</div>
</div>
{%/block%}
