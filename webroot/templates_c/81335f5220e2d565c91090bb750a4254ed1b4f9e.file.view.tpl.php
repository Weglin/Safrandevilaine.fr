<?php /* Smarty version Smarty-3.1.14, created on 2013-11-14 20:09:00
         compiled from "F:\wamp\www\safrandevilaine_v3\tpl\contact\view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2182852852ddc125bf1-00132978%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81335f5220e2d565c91090bb750a4254ed1b4f9e' => 
    array (
      0 => 'F:\\wamp\\www\\safrandevilaine_v3\\tpl\\contact\\view.tpl',
      1 => 1384363091,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2182852852ddc125bf1-00132978',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'file' => 0,
    'infos' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52852ddc17c430_62003951',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52852ddc17c430_62003951')) {function content_52852ddc17c430_62003951($_smarty_tpl) {?><h1>Formulaire de contact</h1>
<hr />
<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['file']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('Infos'=>(($tmp = @$_smarty_tpl->tpl_vars['infos']->value)===null||$tmp==='' ? null : $tmp),'form'=>(($tmp = @$_smarty_tpl->tpl_vars['data']->value)===null||$tmp==='' ? null : $tmp)), 0);?>
<?php }} ?>