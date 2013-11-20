<?php /* Smarty version Smarty-3.1.14, created on 2013-11-14 20:08:57
         compiled from "F:\wamp\www\safrandevilaine_v3\tpl\layout\admin_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2381952852dd94cf7a1-32578208%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9fd1469f1c16deedb7b607868d398b6d8f968383' => 
    array (
      0 => 'F:\\wamp\\www\\safrandevilaine_v3\\tpl\\layout\\admin_menu.tpl',
      1 => 1380894174,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2381952852dd94cf7a1-32578208',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52852dd9514116_98362053',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52852dd9514116_98362053')) {function content_52852dd9514116_98362053($_smarty_tpl) {?><ul id="menu">
   <li><a href="<?php echo Router::url('admin');?>
">Général</a></li>
   <li><a href="<?php echo Router::url('admin/user/index');?>
">Utilisateurs</a></li>
   <li><a href="<?php echo Router::url('admin/produit/index');?>
">Produits</a></li>
   <li><a href="<?php echo Router::url('admin/commande/index');?>
">Commandes</a></li>
   <li><a href="<?php echo Router::url('admin/actualite/index');?>
">Actualité</a></li>
   <li><a href="<?php echo Router::url('admin/album/index');?>
">Album</a></li>
   <li><a href="<?php echo Router::url('admin/commerce/index');?>
">Commerces</a></li>
   <li><a href="<?php echo Router::url('admin/presse/index');?>
">Presse</a></li>
   <li><a href="<?php echo Router::url('admin/media/index');?>
">Médias</a></li>
   <li><a href="<?php echo Router::url('admin/page/index');?>
">Pages statiques</a></li>
   <li id="lastItem"><a href="<?php echo Router::url('');?>
" target="safran de vilaine">Voir le site</a></li>
</ul>
<?php }} ?>