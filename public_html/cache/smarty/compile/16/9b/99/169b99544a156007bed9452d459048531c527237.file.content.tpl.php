<?php /* Smarty version Smarty-3.1.14, created on 2014-08-25 13:40:51
         compiled from "/home2/amorales/public_html/backoffice/themes/default/template/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:57085666353fb75230a0e19-98649343%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '57085666353fb75230a0e19-98649343',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53fb75230b3291_96618107',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53fb75230b3291_96618107')) {function content_53fb75230b3291_96618107($_smarty_tpl) {?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>

<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)){?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div><?php }} ?>