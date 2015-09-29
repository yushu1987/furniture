<?php /* Smarty version Smarty 3.1.4, created on 2015-09-29 17:44:09
         compiled from "/home/wangjian/furniture/application/views/error/error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7758366345608da588cb354-75574105%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e90c40c200ea84686d000f0eab298013254eb6ba' => 
    array (
      0 => '/home/wangjian/furniture/application/views/error/error.tpl',
      1 => 1443519847,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7758366345608da588cb354-75574105',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5608da588cec3',
  'variables' => 
  array (
    'errno' => 0,
    'errmsg' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5608da588cec3')) {function content_5608da588cec3($_smarty_tpl) {?><html>
It is Exception. Errno : <?php echo $_smarty_tpl->tpl_vars['errno']->value;?>
, Errmsg : <?php echo $_smarty_tpl->tpl_vars['errmsg']->value;?>
;
</html>
<?php }} ?>