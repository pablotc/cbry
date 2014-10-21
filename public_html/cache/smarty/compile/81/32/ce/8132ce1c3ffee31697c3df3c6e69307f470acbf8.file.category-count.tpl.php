<?php /* Smarty version Smarty-3.1.14, created on 2014-10-02 18:25:11
         compiled from "/home2/amorales/public_html/themes/default-bootstrap/category-count.tpl" */ ?>
<?php /*%%SmartyHeaderCode:572579954542dc2b737b3b9-61865866%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8132ce1c3ffee31697c3df3c6e69307f470acbf8' => 
    array (
      0 => '/home2/amorales/public_html/themes/default-bootstrap/category-count.tpl',
      1 => 1406318374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '572579954542dc2b737b3b9-61865866',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category' => 0,
    'nb_products' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_542dc2b73d1f27_12054097',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542dc2b73d1f27_12054097')) {function content_542dc2b73d1f27_12054097($_smarty_tpl) {?>
<span class="heading-counter"><?php if ((isset($_smarty_tpl->tpl_vars['category']->value)&&$_smarty_tpl->tpl_vars['category']->value->id==1)||(isset($_smarty_tpl->tpl_vars['nb_products']->value)&&$_smarty_tpl->tpl_vars['nb_products']->value==0)){?><?php echo smartyTranslate(array('s'=>'There are no products in this category.'),$_smarty_tpl);?>
<?php }else{ ?><?php if (isset($_smarty_tpl->tpl_vars['nb_products']->value)&&$_smarty_tpl->tpl_vars['nb_products']->value==1){?><?php echo smartyTranslate(array('s'=>'There is 1 product.'),$_smarty_tpl);?>
<?php }elseif(isset($_smarty_tpl->tpl_vars['nb_products']->value)){?><?php echo smartyTranslate(array('s'=>'There are %d products.','sprintf'=>$_smarty_tpl->tpl_vars['nb_products']->value),$_smarty_tpl);?>
<?php }?><?php }?></span>
<?php }} ?>