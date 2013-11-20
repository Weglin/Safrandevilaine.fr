<?php /* Smarty version Smarty-3.1.14, created on 2013-11-18 14:08:00
         compiled from "F:\wamp\www\safrandevilaine_v3\tpl\media\admin_index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18248528a1f40d2ba05-57162103%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '389975b522a90a0c424eb45da74b05894adecc54' => 
    array (
      0 => 'F:\\wamp\\www\\safrandevilaine_v3\\tpl\\media\\admin_index.tpl',
      1 => 1383907249,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18248528a1f40d2ba05-57162103',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'infos' => 0,
    'directories' => 0,
    'dirNow' => 0,
    'images' => 0,
    'element' => 0,
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_528a1f40dc6ac4_57227782',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528a1f40dc6ac4_57227782')) {function content_528a1f40dc6ac4_57227782($_smarty_tpl) {?><header><h1>Bibliothèque des médias</h1></header>
<?php echo (($tmp = @$_smarty_tpl->tpl_vars['infos']->value)===null||$tmp==='' ? null : $tmp);?>

<div class=mediaMenu>
	<a href="<?php echo Router::url('admin/media/add');?>
"><button>Ajouter des médias</button></a>
	<form action="<?php echo Router::url('admin/media/index');?>
" method="post" class="mediaIndex">
		<fieldset>
			<legend>Choisir un répertoire d'images :</legend>
			<?php echo Form::input('replist','',$_smarty_tpl->tpl_vars['directories']->value,'select',$_smarty_tpl->tpl_vars['dirNow']->value);?>

			<input type="submit" value="Appliquer">
		</fieldset>
	</form>
</div>
<hr />
<div class="img_column">
<?php  $_smarty_tpl->tpl_vars['element'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['element']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['images']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['element']->key => $_smarty_tpl->tpl_vars['element']->value){
$_smarty_tpl->tpl_vars['element']->_loop = true;
?>
	<div class="element">
		<a onclick="return confirm('Vous êtes sur le point de supprimer une image.\nCelle-ci est peut être encore utilisé par le site.\n\n Merci de confirmer cette action');" href="<?php echo Router::url(('admin/media/delete/').($_smarty_tpl->tpl_vars['element']->value->id));?>
" class="suppr">delete</a>
		<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
/webroot/medias/img/<?php echo $_smarty_tpl->tpl_vars['element']->value->dir;?>
/<?php echo $_smarty_tpl->tpl_vars['element']->value->fileName;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['element']->value->fileName;?>
" /></div>
		<div class="titre"><?php echo $_smarty_tpl->tpl_vars['element']->value->titre;?>
</div>
	</div>
<?php } ?>
</div>

<?php }} ?>