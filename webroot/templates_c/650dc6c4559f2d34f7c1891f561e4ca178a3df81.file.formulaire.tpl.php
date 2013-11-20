<?php /* Smarty version Smarty-3.1.14, created on 2013-11-14 20:09:00
         compiled from "F:\wamp\www\safrandevilaine_v3\tpl\contact\formulaire.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1386952852ddc199179-90389597%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '650dc6c4559f2d34f7c1891f561e4ca178a3df81' => 
    array (
      0 => 'F:\\wamp\\www\\safrandevilaine_v3\\tpl\\contact\\formulaire.tpl',
      1 => 1384364825,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1386952852ddc199179-90389597',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Infos' => 0,
    'form' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52852ddc1ddcc1_99240408',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52852ddc1ddcc1_99240408')) {function content_52852ddc1ddcc1_99240408($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['Infos']->value;?>

<form action="<?php echo Router::url('contact');?>
" method="post" class="contact">
    <?php echo Form::input('subject','','Demande de contact (site Web)','hidden');?>

    <fieldset>
    	<legend>Indiquer vos coordonnées</legend>
    	<?php echo Form::input('name','Votre nom :',$_smarty_tpl->tpl_vars['form']->value->name);?>

    	<?php echo Form::input('email','Votre E-mail :',$_smarty_tpl->tpl_vars['form']->value->email);?>

    </fieldset>
    <fieldset class="comments">
    	<legend>Votre message</legend>
    	<?php echo form::input('content','',$_smarty_tpl->tpl_vars['form']->value->content,'textarea','rows="10" cols="45"');?>

    </textarea>
	</fieldset>
    <input type="submit" value="Envoyer">
</form>
<div style="height:20px;"></div><?php }} ?>