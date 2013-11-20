<?php /* Smarty version Smarty-3.1.14, created on 2013-11-18 14:07:51
         compiled from "F:\wamp\www\safrandevilaine_v3\tpl\actualite\admin_index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27962528a1f37804300-47170516%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '26a0e6d6c72e6c2d55c6629bea5befdaee21bee8' => 
    array (
      0 => 'F:\\wamp\\www\\safrandevilaine_v3\\tpl\\actualite\\admin_index.tpl',
      1 => 1379598993,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27962528a1f37804300-47170516',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'infos' => 0,
    'actualites' => 0,
    'element' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_528a1f378a77e2_13166483',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528a1f378a77e2_13166483')) {function content_528a1f378a77e2_13166483($_smarty_tpl) {?><header><h1>Gestion des actualités</h1></header>
<?php echo (($tmp = @$_smarty_tpl->tpl_vars['infos']->value)===null||$tmp==='' ? null : $tmp);?>

<a href="<?php echo Router::url('admin/actualite/add');?>
"><button>Nouvelle actualité</button></a>
<hr />
<table>
	<tr><th>Titre</th>
		<th>Date de création</th>
		<th>URL</th>
		<th>Créé par</th>
		<th>Publié</th>
		<th colspan=2>Actions</th>
	</tr>
<?php  $_smarty_tpl->tpl_vars['element'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['element']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['actualites']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['element']->key => $_smarty_tpl->tpl_vars['element']->value){
$_smarty_tpl->tpl_vars['element']->_loop = true;
?>
	<tr>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->name;?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->created;?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->slug;?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->compte_id;?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->online;?>
</td>
		<td><a href="<?php echo Router::url(('admin/actualite/edit/').($_smarty_tpl->tpl_vars['element']->value->id));?>
"><button>Editer</button></a></td>
		<td><a onclick="return confirm('Êtes vous sûr de vouloir supprimer cette actualité ?\n\n(Vous pouver la mettre hors-ligne avant sa suppression définitive)');" href="<?php echo Router::url(((('admin/actualite/delete/').($_smarty_tpl->tpl_vars['element']->value->id)).('/')).($_smarty_tpl->tpl_vars['element']->value->name));?>
"><button>Supprimer</button></a></td>	
	</tr>
<?php } ?>
</table><?php }} ?>