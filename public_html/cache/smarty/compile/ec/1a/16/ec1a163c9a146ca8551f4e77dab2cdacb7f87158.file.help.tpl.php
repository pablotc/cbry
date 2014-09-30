<?php /* Smarty version Smarty-3.1.14, created on 2014-08-28 12:32:06
         compiled from "/home2/amorales/public_html/modules/payulatam/tpl/help.tpl" */ ?>
<?php /*%%SmartyHeaderCode:208663490653ff598646f8b9-62189679%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec1a163c9a146ca8551f4e77dab2cdacb7f87158' => 
    array (
      0 => '/home2/amorales/public_html/modules/payulatam/tpl/help.tpl',
      1 => 1406697624,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '208663490653ff598646f8b9-62189679',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53ff598652bc95_26283969',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ff598652bc95_26283969')) {function content_53ff598652bc95_26283969($_smarty_tpl) {?>
<fieldset class="tab-configure">
	<h4 class="first"><?php echo smartyTranslate(array('s'=>'How to get a PayU Latam account:','mod'=>'payulatam'),$_smarty_tpl);?>
</h4>
	<p><?php echo smartyTranslate(array('s'=>'Go to','mod'=>'payulatam'),$_smarty_tpl);?>
 <a href="http://www.latinamericanpayments.com/prestashop" rel="external"><?php echo smartyTranslate(array('s'=>'PayU Latam','mod'=>'payulatam'),$_smarty_tpl);?>
</a> <?php echo smartyTranslate(array('s'=>'and fill out the form to create your account.','mod'=>'payulatam'),$_smarty_tpl);?>
</p>
	<h4><?php echo smartyTranslate(array('s'=>'How to configure the PayU Latam module:','mod'=>'payulatam'),$_smarty_tpl);?>
</h4>
	<ul>
		<li class="first"><p><?php echo smartyTranslate(array('s'=>'Enter your username and password to the Sign in  located in the upper right corner in','mod'=>'payulatam'),$_smarty_tpl);?>
 <a href="http://www.payulatam.com" rel="external"><?php echo smartyTranslate(array('s'=>'www.payulatam.com','mod'=>'payulatam'),$_smarty_tpl);?>
</a><br>
		<img alt="" class="info-img" src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
img/info-img1.jpg" /></p></li>
		<li><p><?php echo smartyTranslate(array('s'=>'In the PayU Latam administrative module go to the "Configuration" tab','mod'=>'payulatam'),$_smarty_tpl);?>
<br><br>
		<img alt="" class="info-img" src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
img/info-img2.jpg" /></p>
</li>
		<li><p><?php echo smartyTranslate(array('s'=>'In the "Technical information" section you will find the ApiKey and Merchant Id','mod'=>'payulatam'),$_smarty_tpl);?>
<br>
		<img alt="" class="info-img" src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
img/info-img3.jpg" /></p></li>
		<li class="last"><p><?php echo smartyTranslate(array('s'=>'With this information, go to "Credentials" within the PrestaShop PayU Latam module and fill in the required fields','mod'=>'payulatam'),$_smarty_tpl);?>
</p><br>
		<p><?php echo smartyTranslate(array('s'=>'Press the "Save" button','mod'=>'payulatam'),$_smarty_tpl);?>
</p></li>
	</ul>
	<h4><?php echo smartyTranslate(array('s'=>'Please consider:','mod'=>'payulatam'),$_smarty_tpl);?>
</h4>
	<p><?php echo smartyTranslate(array('s'=>'If you enable the "Test Mode" all transactions to be processed will not be real','mod'=>'payulatam'),$_smarty_tpl);?>
 <sup>*</sup></p>
	<p class="note"><sup>*</sup> <?php echo smartyTranslate(array('s'=>'this mode should never be active in production for real transactions','mod'=>'payulatam'),$_smarty_tpl);?>
</p>
</fieldset><?php }} ?>