<?php /* Smarty version Smarty-3.1.14, created on 2013-11-14 20:10:15
         compiled from "F:\wamp\www\safrandevilaine_v3\tpl\commerce\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1021652852e27978eb0-46224435%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '69f76c0d1b01a16940401f77cc30737c224364ce' => 
    array (
      0 => 'F:\\wamp\\www\\safrandevilaine_v3\\tpl\\commerce\\index.tpl',
      1 => 1379595849,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1021652852e27978eb0-46224435',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titre' => 0,
    'commerces' => 0,
    'element' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52852e27a51d40_00085751',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52852e27a51d40_00085751')) {function content_52852e27a51d40_00085751($_smarty_tpl) {?><header><h1><?php echo $_smarty_tpl->tpl_vars['titre']->value;?>
</h1></header><hr />
<?php  $_smarty_tpl->tpl_vars['element'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['element']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['commerces']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['element']->key => $_smarty_tpl->tpl_vars['element']->value){
$_smarty_tpl->tpl_vars['element']->_loop = true;
?>
    <div class=commercant>
        <h4><?php echo $_smarty_tpl->tpl_vars['element']->value->nom;?>
</h4>
        <?php echo $_smarty_tpl->tpl_vars['element']->value->activite;?>
<br />
        <?php echo $_smarty_tpl->tpl_vars['element']->value->proprio;?>
<br />
        <?php echo $_smarty_tpl->tpl_vars['element']->value->adresse;?>
<br />
        <?php echo $_smarty_tpl->tpl_vars['element']->value->cp;?>
<br />
        <?php echo $_smarty_tpl->tpl_vars['element']->value->ville;?>
<br />
        <?php echo $_smarty_tpl->tpl_vars['element']->value->tel1;?>
<br />
        <?php echo $_smarty_tpl->tpl_vars['element']->value->tel2;?>
<br />
        <?php echo $_smarty_tpl->tpl_vars['element']->value->web;?>
<br />
     </div>
<?php } ?><?php }} ?>