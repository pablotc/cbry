<?php /* Smarty version Smarty-3.1.14, created on 2014-12-15 00:14:41
         compiled from "/home2/amorales/public_html/modules/themeconfigurator/views/templates/admin/messages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:985712138548e52219f7156-28852848%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b841e9087eb1b7b639d8533ddc895a0908e4ee6' => 
    array (
      0 => '/home2/amorales/public_html/modules/themeconfigurator/views/templates/admin/messages.tpl',
      1 => 1413915787,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '985712138548e52219f7156-28852848',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id' => 0,
    'text' => 0,
    'class' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_548e5221bb8c57_22763472',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548e5221bb8c57_22763472')) {function content_548e5221bb8c57_22763472($_smarty_tpl) {?>

<div id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
-response" <?php if (!isset($_smarty_tpl->tpl_vars['text']->value)){?>style="display:none;"<?php }?> class="message alert alert-<?php if (isset($_smarty_tpl->tpl_vars['class']->value)&&$_smarty_tpl->tpl_vars['class']->value=='error'){?>danger<?php }else{ ?>success<?php }?>">
	<div><?php if (isset($_smarty_tpl->tpl_vars['text']->value)){?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['text']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?></div>
</div><?php }} ?>