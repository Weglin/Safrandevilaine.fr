<?php /* Smarty version Smarty-3.1.14, created on 2013-11-14 20:08:56
         compiled from "F:\wamp\www\safrandevilaine_v3\tpl\layout\public_user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2242452852dd8c4d723-23468416%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '058e863ac46ccd75537fa19dbfa64acbd9289dfb' => 
    array (
      0 => 'F:\\wamp\\www\\safrandevilaine_v3\\tpl\\layout\\public_user.tpl',
      1 => 1373296229,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2242452852dd8c4d723-23468416',
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
  'unifunc' => 'content_52852dd8cea4e0_85735461',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52852dd8cea4e0_85735461')) {function content_52852dd8cea4e0_85735461($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//FR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    
    <head>
        <title>Safran de Vilaine</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" media="screen" href="<?php echo $_smarty_tpl->tpl_vars['CSS']->value;?>
/style.css">

        <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['CSS']->value;?>
/images/favicon.ico'" >
        <link rel="icon" type="image/gif" href="<?php echo $_smarty_tpl->tpl_vars['CSS']->value;?>
/images/animated_favicon1.gif" >
        
    </head>
    <body>
        <header>
            <?php echo $_smarty_tpl->getSubTemplate ('./header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </header>
        <section class="content">
            <!-- affichage du menu -->
            <?php echo $_smarty_tpl->getSubTemplate ('./menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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