{%extends file="page/base.tpl" %}
{%block name="title"%}渠道组列表{%/block%}
{%block name="content"%}
<table class="table table-bordered table-hover" id="groupTbl" style="">
 	<thead>
		<tr>
			<th>ID</th>
			<th>用户名</th>
		</tr>
	</thead>
	<tbody>
		{%foreach from=$admins key=k item=v%}
		<tr id="tr{%$k++%}">
			<td>{%$k%}</td>
			<td>{%$v%}</td>
		</tr>
		{%/foreach%}
	</tbody>
</table>
{%/block%}
