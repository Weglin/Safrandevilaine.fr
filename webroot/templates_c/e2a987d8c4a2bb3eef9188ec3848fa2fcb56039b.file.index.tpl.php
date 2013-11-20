<?php /* Smarty version Smarty-3.1.14, created on 2013-11-15 10:45:30
         compiled from "F:\wamp\www\safrandevilaine_v3\tpl\actualite\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:145285fb4a92db50-23586746%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e2a987d8c4a2bb3eef9188ec3848fa2fcb56039b' => 
    array (
      0 => 'F:\\wamp\\www\\safrandevilaine_v3\\tpl\\actualite\\index.tpl',
      1 => 1379600499,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145285fb4a92db50-23586746',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'actualites' => 0,
    'actualite' => 0,
    'link' => 0,
    'endLinkPage' => 0,
    'startLinkPage' => 0,
    'linkPage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5285fb4aab9601_86549434',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5285fb4aab9601_86549434')) {function content_5285fb4aab9601_86549434($_smarty_tpl) {?><header><h1>Actualité</h1></header>

<?php  $_smarty_tpl->tpl_vars['actualite'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['actualite']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['actualites']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['actualite']->key => $_smarty_tpl->tpl_vars['actualite']->value){
$_smarty_tpl->tpl_vars['actualite']->_loop = true;
?>
	<h3><?php echo $_smarty_tpl->tpl_vars['actualite']->value->name;?>
</h3>
	<?php echo $_smarty_tpl->tpl_vars['actualite']->value->content;?>

	<?php $_smarty_tpl->assign("link" , insert_DynamicUrl (array('type' => 'actu', 'id' => $_smarty_tpl->tpl_vars['actualite']->value->id, 'slug' => $_smarty_tpl->tpl_vars['actualite']->value->slug),$_smarty_tpl), true);?>
	<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
" title="Lire tout l'article">Lire la suite ></a>
	<hr />	
<?php } ?>
<br />
<?php if ($_smarty_tpl->tpl_vars['endLinkPage']->value>1){?>
<ul>
<?php $_smarty_tpl->tpl_vars['linkPage'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['linkPage']->step = 1;$_smarty_tpl->tpl_vars['linkPage']->total = (int)ceil(($_smarty_tpl->tpl_vars['linkPage']->step > 0 ? $_smarty_tpl->tpl_vars['endLinkPage']->value+1 - ($_smarty_tpl->tpl_vars['startLinkPage']->value) : $_smarty_tpl->tpl_vars['startLinkPage']->value-($_smarty_tpl->tpl_vars['endLinkPage']->value)+1)/abs($_smarty_tpl->tpl_vars['linkPage']->step));
if ($_smarty_tpl->tpl_vars['linkPage']->total > 0){
for ($_smarty_tpl->tpl_vars['linkPage']->value = $_smarty_tpl->tpl_vars['startLinkPage']->value, $_smarty_tpl->tpl_vars['linkPage']->iteration = 1;$_smarty_tpl->tpl_vars['linkPage']->iteration <= $_smarty_tpl->tpl_vars['linkPage']->total;$_smarty_tpl->tpl_vars['linkPage']->value += $_smarty_tpl->tpl_vars['linkPage']->step, $_smarty_tpl->tpl_vars['linkPage']->iteration++){
$_smarty_tpl->tpl_vars['linkPage']->first = $_smarty_tpl->tpl_vars['linkPage']->iteration == 1;$_smarty_tpl->tpl_vars['linkPage']->last = $_smarty_tpl->tpl_vars['linkPage']->iteration == $_smarty_tpl->tpl_vars['linkPage']->total;?>
	<li><a href="?page=<?php echo $_smarty_tpl->tpl_vars['linkPage']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['linkPage']->value;?>
</li>
<?php }} ?>
</ul>
<?php }?>

<?php }} ?>