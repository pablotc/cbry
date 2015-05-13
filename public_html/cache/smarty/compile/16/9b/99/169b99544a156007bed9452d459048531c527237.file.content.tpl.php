<?php /* Smarty version Smarty-3.1.14, created on 2015-05-04 10:11:58
         compiled from "/home2/amorales/public_html/backoffice/themes/default/template/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:102282830455477e2e2e9512-52919441%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '169b99544a156007bed9452d459048531c527237' => 
    array (
      0 => '/home2/amorales/public_html/backoffice/themes/default/template/content.tpl',
      1 => 1406318375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '102282830455477e2e2e9512-52919441',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_55477e2e5252c8_54477195',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55477e2e5252c8_54477195')) {function content_55477e2e5252c8_54477195($_smarty_tpl) {?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>

<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)){?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div><?php }} ?>