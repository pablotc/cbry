<?php /* Smarty version Smarty-3.1.14, created on 2014-10-06 23:38:13
         compiled from "/home2/amorales/public_html/backoffice/themes/default/template/helpers/list/list_action_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8470115954335215559068-61622807%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a5132f32f7b205b89853054b15569759811b93ee' => 
    array (
      0 => '/home2/amorales/public_html/backoffice/themes/default/template/helpers/list/list_action_delete.tpl',
      1 => 1406318375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8470115954335215559068-61622807',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'confirm' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54335215658654_85208051',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54335215658654_85208051')) {function content_54335215658654_85208051($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['confirm']->value)){?>onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
')){ return true; }else{ event.stopPropagation(); event.preventDefault();};"<?php }?> title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" class="delete">
	<i class="icon-trash"></i> <?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a><?php }} ?>