<?php /* Smarty version Smarty-3.1.14, created on 2013-11-18 14:41:24
         compiled from "F:\wamp\www\safrandevilaine_v3\tpl\config\admin_index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29020528a1f2bc52556-16563873%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f9cc852cde5e1589a9df34ec92dca2584da6a301' => 
    array (
      0 => 'F:\\wamp\\www\\safrandevilaine_v3\\tpl\\config\\admin_index.tpl',
      1 => 1384785682,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29020528a1f2bc52556-16563873',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_528a1f2bc95364_30536643',
  'variables' => 
  array (
    'infos' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528a1f2bc95364_30536643')) {function content_528a1f2bc95364_30536643($_smarty_tpl) {?><header><h1>Administration du site</h1></header>
<?php echo (($tmp = @$_smarty_tpl->tpl_vars['infos']->value)===null||$tmp==='' ? null : $tmp);?>

<hr />
<h2>Options générales</h2>
Raccourci URL de l'administration :<br />
<hr />
<h2>Gestion du Menu </h2>
Accueil				▼ 	x<br />
Nos produits		▲▼	x<br />
Notre safranière	▲	x<br />
-Combo page-      Ajouter<br />
<br />

<hr />
<h2>Nlk, llasdfdqs qdsd</h2><hr />
<h2>Pllflll qqqdttht</h2><hr />
<h2>Paramètres mail</h2>
<a href="<?php echo Router::url('admin/config/SMTP');?>
"><button>Paramètre SMTP</button></a>
<hr /><?php }} ?>