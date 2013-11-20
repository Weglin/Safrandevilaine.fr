<?php /* Smarty version Smarty-3.1.14, created on 2013-11-14 20:08:57
         compiled from "F:\wamp\www\safrandevilaine_v3\tpl\page\admin_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204452852dd9345422-29107917%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0cfaef81c50f5e9d6e91a5ee40cc66f495c613c2' => 
    array (
      0 => 'F:\\wamp\\www\\safrandevilaine_v3\\tpl\\page\\admin_edit.tpl',
      1 => 1380893989,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204452852dd9345422-29107917',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'infos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52852dd9418df5_44707674',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52852dd9418df5_44707674')) {function content_52852dd9418df5_44707674($_smarty_tpl) {?><header><h1>Edition de la page : <?php echo $_smarty_tpl->tpl_vars['page']->value->name;?>
 </h1></header>
<?php echo (($tmp = @$_smarty_tpl->tpl_vars['infos']->value)===null||$tmp==='' ? null : $tmp);?>

<a href="<?php echo Router::url(('admin/page/view/').($_smarty_tpl->tpl_vars['page']->value->id));?>
"><button>Prévisualisation</button></a>
<hr />
<form action="<?php echo Router::url(('admin/page/edit/').($_smarty_tpl->tpl_vars['page']->value->id));?>
" method="post">
<?php echo Form::input('id',null,$_smarty_tpl->tpl_vars['page']->value->id,'hidden');?>

<?php echo Form::input('name','Nom :',$_smarty_tpl->tpl_vars['page']->value->name);?>

<?php echo Form::input('slug','Raccourci URL :',$_smarty_tpl->tpl_vars['page']->value->slug);?>

<?php echo Form::input('created','Date de création :',$_smarty_tpl->tpl_vars['page']->value->created,'date');?>

<?php echo Form::input('online','Publiée :',$_smarty_tpl->tpl_vars['page']->value->online,'checkbox');?>

<?php echo Form::input('content','Contenu :',$_smarty_tpl->tpl_vars['page']->value->content,'textarea','rows="20" cols="100"');?>

<input type="submit" value="Valider"><a href="<?php echo Router::url('admin/page/index');?>
"><button type="button">Retour</button></a>
</form>


<?php }} ?>