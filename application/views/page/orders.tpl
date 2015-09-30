{%extends file="page/base.tpl" %}
{%block name="title"%}订单列表{%/block%}
{%block name="content"%}
<ul id="myTab" class="nav nav-tabs">
   <li class="active">
      <a href="/orders/pclist" data-toggle="tab">全部</a>
   </li>
   <li>
      <a href="/orders/pclist?status=0" data-toggle="tab">新订单</a>
   </li>
   <li>
      <a href="/orders/pclist?status=1" data-toggle="tab">已取消</a>
   </li>
   <li>
      <a href="/orders/pclist?status=2" data-toggle="tab">未派送</a>
   </li>
    <li >
      <a href="/orders/pclist?status=3" data-toggle="tab">待定中</a>
   </li>
    <li>
      <a href="/orders/pclist?status=4" data-toggle="tab">已结单</a>
   </li>
</ul>
<table class="table table-bordered table-hover" id="groupTbl" style="">
 	<thead>
		<tr>
			<th width='5%'>订单号</th>
			<th width='5%'>客户</th>
			<th width='5%'>手机</th>
			<th width='5%>总额</th>
			<th width='20%'>地址</th>
			<th width='25%'>详细</th>
			<th width='10%'>时间</th>
			<th width='5%'>处理人</th>
			<th width='10%'>状态</th>
		</tr>
	</thead>
	<tbody>
		{%foreach from=$data key=k item=v%}
		<tr id="tr{%$k+1%}">
			<td>{%$v.id%}</td>
			<td>{%$v.uname%}</td>
			<td>{%$v.phone%}</td>
			<td>{%$v.amount%}</td>
			<td>{%$v.address%}</td>
			<td>
				{%foreach from=$data.pinfo key=subk item=subv%}
					<a href="/product/pcinfo?pid={%$subv.id%}">{%subv.name%}&nbsp;</a>
				{%/foreach%}
			</td>
			<td>{%$v.createTime|data_format:"Y-m-d H:i:s"%}</td>
			<td>{%$v.operator%}</td>
			{%assign var='statusArr' value=array('新订单','已取消','未派送','待定中','已结单')%}
			{%assign var='i' value=0%}
			<td>
				<form method="post" action="/channel/updatechannelgroup?id={%$v.id%}">
				<select name='status'>
					{%foreach from=$statusArr $item=status%}
						{%if $v.status == $i %}
							<option value={%$i%} selected>{%$status%}</option>
						{%else%}
							<option value={%$i%}>{%$status%}</option>
						{%/if%}
						{%$i++%}
					{%/foreach%}
				</select>
				<button type="submit" class="btn">确定</button>
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
{%/block%}
