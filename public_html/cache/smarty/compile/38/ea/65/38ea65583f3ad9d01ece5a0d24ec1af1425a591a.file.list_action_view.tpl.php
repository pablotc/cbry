<?php /* Smarty version Smarty-3.1.14, created on 2014-10-02 18:19:14
         compiled from "/home2/amorales/public_html/backoffice/themes/default/template/helpers/list/list_action_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:948552172542dc152380f48-56917887%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '38ea65583f3ad9d01ece5a0d24ec1af1425a591a' => 
    array (
      0 => '/home2/amorales/public_html/backoffice/themes/default/template/helpers/list/list_action_view.tpl',
      1 => 1406318375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '948552172542dc152380f48-56917887',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_542dc15238d495_99734977',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542dc15238d495_99734977')) {function content_542dc15238d495_99734977($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" >
	<i class="icon-search-plus"></i> <?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a><?php }} ?>