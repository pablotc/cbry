<?php /* Smarty version Smarty-3.1.14, created on 2014-12-16 13:43:43
         compiled from "/home2/amorales/public_html/modules/payulatam/views/templates/front/response.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9158921945490613f447ad1-03452571%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4f706ce96cab1d45b372ebc3be4f1d686a54bd23' => 
    array (
      0 => '/home2/amorales/public_html/modules/payulatam/views/templates/front/response.tpl',
      1 => 1417140760,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9158921945490613f447ad1-03452571',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'css_dir' => 0,
    'css' => 0,
    'valid' => 0,
    'estadoTx' => 0,
    'transactionId' => 0,
    'reference_pol' => 0,
    'referenceCode' => 0,
    'pseBank' => 0,
    'cus' => 0,
    'value' => 0,
    'currency' => 0,
    'description' => 0,
    'lapPaymentMethod' => 0,
    'messageApproved' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5490613f5bd104_06475146',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5490613f5bd104_06475146')) {function content_5490613f5bd104_06475146($_smarty_tpl) {?>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
global.css" type="text/css" media="all">
<link href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['css']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
payu.css" rel="stylesheet" type="text/css">
<?php if ($_smarty_tpl->tpl_vars['valid']->value){?>
	<center>
		<table class="table-response">
			<tr align="center">
				<th colspan="2"><h1 class="md-h1"><?php echo smartyTranslate(array('s'=>'Purchase Data','mod'=>'payulatam'),$_smarty_tpl);?>
</h1></th>
			</tr>
			<tr align="left">
				<td><?php echo smartyTranslate(array('s'=>'Transaction State','mod'=>'payulatam'),$_smarty_tpl);?>
</td>
				<td><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['estadoTx']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</td>
			</tr>
			<tr align="left">
				<td><?php echo smartyTranslate(array('s'=>'Transaction ID','mod'=>'payulatam'),$_smarty_tpl);?>
</td>
				<td><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['transactionId']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</td>
			</tr>		
			<tr align="left">
				<td><?php echo smartyTranslate(array('s'=>'Purchase Reference','mod'=>'payulatam'),$_smarty_tpl);?>
</td>
				<td><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reference_pol']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</td>
			</tr>		
			<tr align="left">
				<td><?php echo smartyTranslate(array('s'=>'Transaction Reference','mod'=>'payulatam'),$_smarty_tpl);?>
</td>
				<td><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['referenceCode']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</td>
			</tr>	
			<?php if ($_smarty_tpl->tpl_vars['pseBank']->value!=null){?>
				<tr align="left">
					<td>CUS</td>
					<td><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['cus']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</td>
				</tr>
				<tr align="left">
					<td><?php echo smartyTranslate(array('s'=>'Bank','mod'=>'payulatam'),$_smarty_tpl);?>
</td>
					<td><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['pseBank']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</td>
				</tr>
			<?php }?>
			<tr align="left">
				<td><?php echo smartyTranslate(array('s'=>'Total Value','mod'=>'payulatam'),$_smarty_tpl);?>
</td>
				<td>$<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['value']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</td>
			</tr>
			<tr align="left">
				<td><?php echo smartyTranslate(array('s'=>'Currency','mod'=>'payulatam'),$_smarty_tpl);?>
</td>
				<td><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</td>
			</tr>
			<tr align="left">
				<td><?php echo smartyTranslate(array('s'=>'Description','mod'=>'payulatam'),$_smarty_tpl);?>
</td>
				<td><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['description']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</td>
			</tr>
			<tr align="left">
				<td><?php echo smartyTranslate(array('s'=>'Entity','mod'=>'payulatam'),$_smarty_tpl);?>
</td>
				<td><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['lapPaymentMethod']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</td>
			</tr>
		</table>
		<p/>
		<h1><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['messageApproved']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</h1>
	</center>
<?php }else{ ?>
	<h1><center><?php echo smartyTranslate(array('s'=>'The request is incorrect! There is an error in the digital signature.','mod'=>'payulatam'),$_smarty_tpl);?>
</center></h1>
<?php }?><?php }} ?>