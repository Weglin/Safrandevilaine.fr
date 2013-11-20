<?php /* Smarty version Smarty-3.1.14, created on 2013-11-18 14:07:46
         compiled from "F:\wamp\www\safrandevilaine_v3\tpl\user\admin_index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31845528a1f323d61d8-44860795%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e512326f22060ef16c856f1573caa80835117f5' => 
    array (
      0 => 'F:\\wamp\\www\\safrandevilaine_v3\\tpl\\user\\admin_index.tpl',
      1 => 1381139491,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31845528a1f323d61d8-44860795',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'infos' => 0,
    'users' => 0,
    'element' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_528a1f324c9c66_56505358',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528a1f324c9c66_56505358')) {function content_528a1f324c9c66_56505358($_smarty_tpl) {?><header><h1>Gestion des utilisateurs</h1></header>
<?php echo (($tmp = @$_smarty_tpl->tpl_vars['infos']->value)===null||$tmp==='' ? null : $tmp);?>

<a href="<?php echo Router::url('admin/user/add');?>
"><button>Nouvel utilisateur</button></a>
<hr />
<table>
	<tr><th>Nom</th>
		<th>Prénom</th>
		<th>CP</th>
		<th>Ville</th>
		<th>E-mail</th>
		<th>Créé le</th>
		<th colspan=2>Actions</th>
	</tr>
<?php  $_smarty_tpl->tpl_vars['element'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['element']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['element']->key => $_smarty_tpl->tpl_vars['element']->value){
$_smarty_tpl->tpl_vars['element']->_loop = true;
?>
	<tr>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->nom;?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->prenom;?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->cp;?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->ville;?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->email;?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['element']->value->created;?>
</td>
		<td><a href="<?php echo Router::url(('admin/user/edit/').($_smarty_tpl->tpl_vars['element']->value->id));?>
"><button>Editer</button></a></td>
		<td><a onclick="return confirm('Êtes vous sûr de vouloir supprimer cet utilisateur ?\n\nCette opération est définitive et peut provoquer des erreurs dans l'application.\nNe supprimer cet utilisateur que si vous savez exactement ce que vous faite !');" href="<?php echo Router::url(((((('admin/user/delete/').($_smarty_tpl->tpl_vars['element']->value->id)).('/')).($_smarty_tpl->tpl_vars['element']->value->prenom)).(' ')).($_smarty_tpl->tpl_vars['element']->value->nom));?>
"><button>Supprimer</button></a></td>	
	</tr>
<?php } ?>
</table><?php }} ?>