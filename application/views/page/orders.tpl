{%extends file="page/base.tpl" %}
{%block name="title"%}订单列表{%/block%}
{%block name="content"%}
<ul id="myTab" class="nav nav-tabs">
   {%if $smarty.get.status==''%}<li class="active">{%else%}<li>{%/if%}
      <a href="/orders/pclist" data-toggle="tab">全部</a>
   </li>
   {%if isset($smarty.get.status) && $smarty.get.status==0%}<li class="active">{%else%}<li>{%/if%}
      <a href="/orders/pclist?status=0" data-toggle="tab">新订单</a>
   </li>
   {%if $smarty.get.status==1%}<li class="active">{%else%}<li>{%/if%}
      <a href="/orders/pclist?status=1" data-toggle="tab">已取消</a>
   </li>
   {%if $smarty.get.status==2%}<li class="active">{%else%}<li>{%/if%}
      <a href="/orders/pclist?status=2" data-toggle="tab">未派送</a>
   </li>
   {%if $smarty.get.status==3%}<li class="active">{%else%}<li>{%/if%}
      <a href="/orders/pclist?status=3" data-toggle="tab">待定中</a>
   </li>
   {%if $smarty.get.status==4%}<li class="active">{%else%}<li>{%/if%}
      <a href="/orders/pclist?status=4" data-toggle="tab">已结单</a>
   </li>
</ul>
<table class="table table-bordered table-hover" id="groupTbl" style="table-layout: fixed;">
 	<thead>
		<tr>
			<th colspan=1>订单号</th>
			<th colspan=1>客户</th>
			<th colspan=2>手机</th>
			<th colspan=1>总额</th>
			<th colspan=2>地址</th>
			<th colspan=3>详细</th>
			<th colspan=1>时间</th>
			<th colspan=1>处理人</th>
			<th colspan=1>状态</th>
		</tr>
	</thead>
	<tbody>
		{%foreach from=$data key=k item=v%}
		<tr id="tr{%$k+1%}">
			<td colspan=1>{%$v.id%}<br><a href="/orders/pcinfo?orderId={%$v.id%}"><span style="font-size:12px">详情</span></a></td>
			<td colspan=1>{%$v.uname%}</td>
			<td colspan=2>{%$v.phone%}</td>
			<td colspan=1>{%$v.amount%}</td>
			<td colspan=2>{%$v.address%}</td>
			<td colspan=3>
				{%foreach from=$v.pinfo key=subk item=subv%}
					<a href="/product/pcinfo?pid={%$subv.id%}" target='_blank'>{%$subv.name%}&nbsp;</a>
				{%/foreach%}
			</td>
			<td colspan=1>{%$v.createTime|date_format:"m-d H:i"%}</td>
			<td colspan=1>{%$v.operator%}</td>
			{%assign var='statusArr' value=array('新订单','已取消','未派送','待定中','已结单')%}
			{%assign var='i' value=0%}
			<td colspan=1>
				<form method="post" action="/orders/update?id={%$v.id%}">
				<select name='status'>
					{%foreach from=$statusArr item=status%}
						{%if $v.status == $i %}
							<option value={%$i%} selected>{%$status%}</option>
						{%else%}
							<option value={%$i%}>{%$status%}</option>
						{%/if%}
						{%$i++%}
					{%/foreach%}
				</select>
				<button type="submit" class="btn">确定</button>
				</form>
			</td>
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
