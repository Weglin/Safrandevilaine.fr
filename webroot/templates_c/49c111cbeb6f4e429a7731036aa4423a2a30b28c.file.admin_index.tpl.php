<?php /* Smarty version Smarty-3.1.14, created on 2013-11-18 14:07:57
         compiled from "F:\wamp\www\safrandevilaine_v3\tpl\commerce\admin_index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24043528a1f3d4a0de4-28085488%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49c111cbeb6f4e429a7731036aa4423a2a30b28c' => 
    array (
      0 => 'F:\\wamp\\www\\safrandevilaine_v3\\tpl\\commerce\\admin_index.tpl',
      1 => 1379597979,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24043528a1f3d4a0de4-28085488',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'infos' => 0,
    'commerces' => 0,
    'element' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_528a1f3d552082_33279552',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528a1f3d552082_33279552')) {function content_528a1f3d552082_33279552($_smarty_tpl) {?><header><h1>Gestion des commerces</h1></header>
<?php echo (($tmp = @$_smarty_tpl->tpl_vars['infos']->value)===null||$tmp==='' ? null : $tmp);?>

<a href="<?php echo Router::url('admin/commerce/add');?>
"><button>Nouveau commerce</button></a>
<hr />
<table>
	<tr><th>Nom</th>
		<th>Propriétaire</th>
		<th>CP</th>
		<th>Ville</th>
		<th>Degus.</th>
		<th>Vente</th>
		<th>Online</th>
		<th colspan=2>Actions</th>
	</tr>
<?php  $_smarty_tpl->tpl_vars['element'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['element']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['commerces']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['element']->key => $_smarty_tpl->tpl_vars['element']->value){
$_smarty_tpl->tpl_vars['element']->_loop = true;
?>
	<tr>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->nom;?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->proprio;?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->cp;?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->ville;?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->degustation;?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->vente;?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->online;?>
</td>
		<td><a href="<?php echo Router::url(('admin/commerce/edit/').($_smarty_tpl->tpl_vars['element']->value->id));?>
"><button>Editer</button></a></td>
		<td><a onclick="return confirm('Êtes vous sûr de vouloir supprimer ce commerce ?\n\n(Vous pouver le mettre hors-ligne avant sa suppression définitive)');" href="<?php echo Router::url(((('admin/commerce/delete/').($_smarty_tpl->tpl_vars['element']->value->id)).('/')).($_smarty_tpl->tpl_vars['element']->value->nom));?>
"><button>Supprimer</button></a></td>	
	</tr>
<?php } ?>
</table><?php }} ?>