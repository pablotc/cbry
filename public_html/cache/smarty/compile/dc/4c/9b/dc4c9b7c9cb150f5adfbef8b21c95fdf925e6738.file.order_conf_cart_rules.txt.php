<?php /* Smarty version Smarty-3.1.14, created on 2014-12-17 14:40:18
         compiled from "/home2/amorales/public_html/mails/es/order_conf_cart_rules.txt" */ ?>
<?php /*%%SmartyHeaderCode:13140309055491c002dbc388-57848630%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc4c9b7c9cb150f5adfbef8b21c95fdf925e6738' => 
    array (
      0 => '/home2/amorales/public_html/mails/es/order_conf_cart_rules.txt',
      1 => 1413268110,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13140309055491c002dbc388-57848630',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'cart_rule' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5491c002ea66a7_66464306',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5491c002ea66a7_66464306')) {function content_5491c002ea66a7_66464306($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['cart_rule'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cart_rule']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cart_rule']->key => $_smarty_tpl->tpl_vars['cart_rule']->value){
$_smarty_tpl->tpl_vars['cart_rule']->_loop = true;
?>
	<?php echo $_smarty_tpl->tpl_vars['cart_rule']->value['voucher_name'];?>
  <?php echo $_smarty_tpl->tpl_vars['cart_rule']->value['voucher_reduction'];?>

<?php } ?><?php }} ?>