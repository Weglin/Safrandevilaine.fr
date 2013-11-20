<?php /* Smarty version Smarty-3.1.14, created on 2013-11-14 20:08:56
         compiled from "F:\wamp\www\safrandevilaine_v3\tpl\layout\menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2965452852dd8da2e80-42700468%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '965f9a2049c8a230f2fb8243f6af7ca2dfeb54a0' => 
    array (
      0 => 'F:\\wamp\\www\\safrandevilaine_v3\\tpl\\layout\\menu.tpl',
      1 => 1384331972,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2965452852dd8da2e80-42700468',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52852dd8e9ed68_72362946',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52852dd8e9ed68_72362946')) {function content_52852dd8e9ed68_72362946($_smarty_tpl) {?><nav><ul id="menu">
   <li><a href="<?php echo Router::url('accueil');?>
">Accueil</a></li>
   <li><a href="<?php echo Router::url('produits');?>
">Nos produits</a></li>
   <li><a href="<?php echo Router::url('safraniere');?>
">Notre safranière</a></li>
   <li><a href="<?php echo Router::url('degustation');?>
">Sites de dégustation</a></li>
   <li><a href="<?php echo Router::url('commerces');?>
">Points de vente</a></li>
   <li><a href="<?php echo Router::url('contact');?>
">Contact</a></li>
   <li><a href="<?php echo Router::url('actualite');?>
">Actualités</a></li>
   <li><a href="<?php echo Router::url('album');?>
">Album photos</a></li>
   <li><a href="<?php echo Router::url('presse');?>
">Dossier de presse</a></li>
   <li><a href="<?php echo Router::url('safran');?>
">Le safran</a></li>
   <li><a href="<?php echo Router::url('preparations');?>
">Préparations</a></li>
   <li><a href="<?php echo Router::url('labelbio');?>
">Le label Bio</a></li>
   <li id="lastItem"><a href="<?php echo Router::url('lavilaine');?>
">La vallée de la Vilaine</a></li>
</ul></nav>
<?php }} ?>