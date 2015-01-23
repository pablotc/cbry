<?php /* Smarty version Smarty-3.1.14, created on 2014-12-12 14:25:03
         compiled from "/home2/amorales/public_html/modules/payulatam/views/templates/hook/payulatam_payment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:467335502548b24ef154160-29998529%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c43eaeb9a6713b9ec4be2dde0b956bcf4b546fce' => 
    array (
      0 => '/home2/amorales/public_html/modules/payulatam/views/templates/hook/payulatam_payment.tpl',
      1 => 1417140760,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '467335502548b24ef154160-29998529',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'css' => 0,
    'module_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_548b24ef1a12d6_06839339',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548b24ef1a12d6_06839339')) {function content_548b24ef1a12d6_06839339($_smarty_tpl) {?>
<link href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['css']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
payu.css" rel="stylesheet" type="text/css">
<div class="row">
	<div class="col-xs-12 col-md-6">
		<p class="payment_module">
			<a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
validation.php" class="link-redirect">
						
				<img src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
img/logoPayU.png" height="50" width="135"/>	
				<?php echo smartyTranslate(array('s'=>'Pay by PayU Latam','mod'=>'payulatam'),$_smarty_tpl);?>

			</a>
		</p>
	</div>
</div><?php }} ?>