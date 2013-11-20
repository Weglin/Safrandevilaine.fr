<?php /* Smarty version Smarty-3.1.14, created on 2013-11-14 20:08:57
         compiled from "F:\wamp\www\safrandevilaine_v3\tpl\layout\admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2419752852dd9457055-29766458%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6746352b48971668391f63be57fbfb22f6cbdb93' => 
    array (
      0 => 'F:\\wamp\\www\\safrandevilaine_v3\\tpl\\layout\\admin.tpl',
      1 => 1384248401,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2419752852dd9457055-29766458',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CSS' => 0,
    'body' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52852dd947dd77_48777406',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52852dd947dd77_48777406')) {function content_52852dd947dd77_48777406($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//FR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    
    <head>
    	<title>Safran de Vilaine</title>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" media="screen" href="<?php echo $_smarty_tpl->tpl_vars['CSS']->value;?>
/style.css">
        <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['CSS']->value;?>
images/favicon.ico'" >
        <link rel="icon" type="image/gif" href="<?php echo $_smarty_tpl->tpl_vars['CSS']->value;?>
images/animated_favicon1.gif" >
    </head>
    <body>
        <header>
            <?php echo $_smarty_tpl->getSubTemplate ('./admin_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </header>
        <section class="content">
            <!-- affichage du menu -->
            <?php echo $_smarty_tpl->getSubTemplate ('./admin_menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

            <!-- affichage du corps de la page-->
            <?php echo $_smarty_tpl->tpl_vars['body']->value;?>

        </section>
        <footer>
            <!-- affichage du pied de page-->
            <?php echo $_smarty_tpl->getSubTemplate ('./footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </footer>


    </body>
</html>





<?php }} ?>