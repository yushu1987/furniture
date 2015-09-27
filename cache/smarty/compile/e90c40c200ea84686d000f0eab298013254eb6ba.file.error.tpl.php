<?php /* Smarty version Smarty 3.1.4, created on 2015-09-26 00:33:21
         compiled from "/home/wangjian/furniture/application/views/error/error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29897985456057751ad6107-19057310%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e90c40c200ea84686d000f0eab298013254eb6ba' => 
    array (
      0 => '/home/wangjian/furniture/application/views/error/error.tpl',
      1 => 1442323149,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29897985456057751ad6107-19057310',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_56057751b07e9',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56057751b07e9')) {function content_56057751b07e9($_smarty_tpl) {?><<?php ?>?php
echo "Error Msg:"  . $exception->getMessage();
?<?php ?>>
<?php }} ?>