<?php /* Smarty version Smarty-3.1.14, created on 2014-10-02 18:19:15
         compiled from "/home2/amorales/public_html/backoffice/themes/default/template/helpers/tree/tree_toolbar_link.tpl" */ ?>
<?php /*%%SmartyHeaderCode:33078327542dc1536bd0b6-45066665%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba0677375d6668e37678e7dd49c825da1abdbbb7' => 
    array (
      0 => '/home2/amorales/public_html/backoffice/themes/default/template/helpers/tree/tree_toolbar_link.tpl',
      1 => 1406318375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '33078327542dc1536bd0b6-45066665',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'action' => 0,
    'id' => 0,
    'icon_class' => 0,
    'label' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_542dc1536f1086_97975777',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542dc1536f1086_97975777')) {function content_542dc1536f1086_97975777($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
"<?php if (isset($_smarty_tpl->tpl_vars['action']->value)){?> onclick="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
"<?php }?><?php if (isset($_smarty_tpl->tpl_vars['id']->value)){?> id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"<?php }?> class="btn btn-default">
	<?php if (isset($_smarty_tpl->tpl_vars['icon_class']->value)){?><i class="<?php echo $_smarty_tpl->tpl_vars['icon_class']->value;?>
"></i><?php }?>
	<?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['label']->value),$_smarty_tpl);?>

</a><?php }} ?>