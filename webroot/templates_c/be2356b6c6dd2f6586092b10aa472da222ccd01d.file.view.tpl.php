<?php /* Smarty version Smarty-3.1.14, created on 2013-11-14 20:08:56
         compiled from "F:\wamp\www\safrandevilaine_v3\tpl\page\view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2074652852dd8bd5275-99528259%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be2356b6c6dd2f6586092b10aa472da222ccd01d' => 
    array (
      0 => 'F:\\wamp\\www\\safrandevilaine_v3\\tpl\\page\\view.tpl',
      1 => 1384266944,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2074652852dd8bd5275-99528259',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52852dd8c24ed7_51890093',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52852dd8c24ed7_51890093')) {function content_52852dd8c24ed7_51890093($_smarty_tpl) {?><header><h1><?php echo $_smarty_tpl->tpl_vars['page']->value->name;?>
</h1></header>
<hr />
<?php $_template = new Smarty_Internal_Template('eval:'.$_smarty_tpl->tpl_vars['page']->value->content, $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->fetch(); ?>
<div style="height:30px;"></div>



<?php }} ?>