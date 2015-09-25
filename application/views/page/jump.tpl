<script>
{if $ret}
alert('提交成功!');
location.href="{$jumpUrl}";
{else}
alert("提交失败!");
{/if}
</script>
