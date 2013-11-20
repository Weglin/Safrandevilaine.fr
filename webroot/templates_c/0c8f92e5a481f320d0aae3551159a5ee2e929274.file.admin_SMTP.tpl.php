<?php /* Smarty version Smarty-3.1.14, created on 2013-11-18 14:55:55
         compiled from "F:\wamp\www\safrandevilaine_v3\tpl\config\admin_SMTP.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32038528a22d321c6b3-55411908%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c8f92e5a481f320d0aae3551159a5ee2e929274' => 
    array (
      0 => 'F:\\wamp\\www\\safrandevilaine_v3\\tpl\\config\\admin_SMTP.tpl',
      1 => 1384786553,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32038528a22d321c6b3-55411908',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_528a22d32ad125_89078858',
  'variables' => 
  array (
    'infos' => 0,
    'smtp' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528a22d32ad125_89078858')) {function content_528a22d32ad125_89078858($_smarty_tpl) {?><header><h1>Edition des paramètres d'envoie de mail (SMTP)</h1></header>
<?php echo (($tmp = @$_smarty_tpl->tpl_vars['infos']->value)===null||$tmp==='' ? null : $tmp);?>

<hr />
<form action="<?php echo Router::url('admin/config/SMTP');?>
" method="post">
	<?php echo Form::input('name','smtp','smtp','hidden');?>

	<?php echo Form::input('host','Host :',$_smarty_tpl->tpl_vars['smtp']->value->host);?>

	<?php echo Form::input('port','Port :',$_smarty_tpl->tpl_vars['smtp']->value->port);?>

	<?php echo Form::input('username','Identifiant :',$_smarty_tpl->tpl_vars['smtp']->value->username);?>

	<?php echo Form::input('password','Mot de passe :',$_smarty_tpl->tpl_vars['smtp']->value->password);?>

<input type="submit" value="Valider"><a href="<?php echo Router::url('admin/config/index');?>
"><button type="button">Retour</button></a>
</form>
<?php }} ?>