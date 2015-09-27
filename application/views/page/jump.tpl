<script>
{if $data.ret}
alert('提交成功!');
location.href="{$data.jumpUrl}";
{else}
alert("提交失败!");
{/if}
</script>
