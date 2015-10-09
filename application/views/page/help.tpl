{%extends file="page/base.tpl" %}
{%block name="title"%}帮助{%/block%}

{%block name="content"%}
	<h3>简介</h3>
	{%foreach from=$data.title item=detail%}
		<h4>{%$detail.key%}</h4>
		{%$detail.val%}
		<br>
	{%/foreach%}

	<hr>
	<h3>操作</h3>
	{%foreach from=$data.content item=detail%}
		<h4>{%$detail.key%}</h4>
		{%$detail.val%}
		<br>
	{%/foreach%}

	<hr>
	<h3>备注</h3>
	{%assign var="i" value=1%}
	{%foreach from=$data.notice item=n%}
		<h4>{%$i++%}</h4>
		{%$n.content%}
	{%/foreach%}
{%/block%}
