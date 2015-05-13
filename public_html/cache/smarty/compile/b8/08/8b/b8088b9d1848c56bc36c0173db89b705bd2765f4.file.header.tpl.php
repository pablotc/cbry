<?php /* Smarty version Smarty-3.1.14, created on 2015-05-04 10:16:08
         compiled from "/home2/amorales/public_html/modules/zopimfree/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:187959396355477f2879ebb0-93502616%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8088b9d1848c56bc36c0173db89b705bd2765f4' => 
    array (
      0 => '/home2/amorales/public_html/modules/zopimfree/header.tpl',
      1 => 1418353438,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '187959396355477f2879ebb0-93502616',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'widgetid' => 0,
    'customerName' => 0,
    'customerEmail' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_55477f289553b9_13717891',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55477f289553b9_13717891')) {function content_55477f289553b9_13717891($_smarty_tpl) {?><?php if (!isset($_GET['content_only'])){?>
<!--Start of Zopim Live Chat Script-->

<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//cdn.zopim.com/?<?php echo $_smarty_tpl->tpl_vars['widgetid']->value;?>
';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>

<?php if ($_smarty_tpl->tpl_vars['customerName']->value&&$_smarty_tpl->tpl_vars['customerEmail']->value){?>

<script>
  $zopim(function() {
    $zopim.livechat.setName('<?php if ($_smarty_tpl->tpl_vars['customerName']->value){?><?php echo $_smarty_tpl->tpl_vars['customerName']->value;?>
<?php }?>');
    $zopim.livechat.setEmail('<?php if ($_smarty_tpl->tpl_vars['customerEmail']->value){?><?php echo $_smarty_tpl->tpl_vars['customerEmail']->value;?>
<?php }?>');
  });
</script>

<?php }?>
<!--End of Zopim Live Chat Script-->
<?php }?><?php }} ?>