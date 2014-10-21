<?php /* Smarty version Smarty-3.1.14, created on 2014-10-08 23:35:49
         compiled from "/home2/amorales/public_html/modules/payulatam/tpl/admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19633759215435f485391675-68631710%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '67d072c47017dbb1eb9bb63e9f6fad06f998f414' => 
    array (
      0 => '/home2/amorales/public_html/modules/payulatam/tpl/admin.tpl',
      1 => 1406697624,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19633759215435f485391675-68631710',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'css' => 0,
    'tracking' => 0,
    'logo' => 0,
    'lang' => 0,
    'tab' => 0,
    'li' => 0,
    'div' => 0,
    'script' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5435f4854f5362_74965578',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5435f4854f5362_74965578')) {function content_5435f4854f5362_74965578($_smarty_tpl) {?>

<link href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['css']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" rel="stylesheet" type="text/css">
<img src="<?php echo $_smarty_tpl->tpl_vars['tracking']->value;?>
" alt="tracking" style="display:none"/>
<div class="payu-module-wrapper">
	<div class="payu-module-inner-wrap">
		<img src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['logo']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" alt="logo" class="payu-logo" />
		<p class="payu-module-intro"><?php echo smartyTranslate(array('s'=>'The payment solutions offered by PayU Latam adapt to any type of company or business: big or small, beginner or experienced, local or multinational, already selling online or willing to accept payments through the web.','mod'=>'payulatam'),$_smarty_tpl);?>
<br /><br />
		<a class="payu-button" href="http://www.latinamericanpayments.com/prestashop-<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
"><?php echo smartyTranslate(array('s'=>'Open your FREE account today!','mod'=>'payulatam'),$_smarty_tpl);?>
</a></p>
		<div class="payu-module-right-col">
			<h1><?php echo smartyTranslate(array('s'=>'Start selling in Latin America now!','mod'=>'payulatam'),$_smarty_tpl);?>
</h1>
			<ul>
				<li><?php echo smartyTranslate(array('s'=>'Accept','mod'=>'payulatam'),$_smarty_tpl);?>
 <strong><?php echo smartyTranslate(array('s'=>'different payment methods in a single platform:','mod'=>'payulatam'),$_smarty_tpl);?>
</strong> <?php echo smartyTranslate(array('s'=>'cash deposits, bank transfers and credit cards.','mod'=>'payulatam'),$_smarty_tpl);?>
</li>
				<li><?php echo smartyTranslate(array('s'=>'Receive payments in','mod'=>'payulatam'),$_smarty_tpl);?>
 <strong><?php echo smartyTranslate(array('s'=>'several countries in Latin America','mod'=>'payulatam'),$_smarty_tpl);?>
</strong> <?php echo smartyTranslate(array('s'=>'with a single integration.','mod'=>'payulatam'),$_smarty_tpl);?>
</li>
				<li><strong><?php echo smartyTranslate(array('s'=>'Multi-language','mod'=>'payulatam'),$_smarty_tpl);?>
</strong> <?php echo smartyTranslate(array('s'=>'and','mod'=>'payulatam'),$_smarty_tpl);?>
 <strong><?php echo smartyTranslate(array('s'=>'multi-currency','mod'=>'payulatam'),$_smarty_tpl);?>
</strong> <?php echo smartyTranslate(array('s'=>'options.','mod'=>'payulatam'),$_smarty_tpl);?>
</li>
				<li><?php echo smartyTranslate(array('s'=>'Reduce the risk of selling online by a powerful','mod'=>'payulatam'),$_smarty_tpl);?>
 <strong><?php echo smartyTranslate(array('s'=>'Anti-Fraud system','mod'=>'payulatam'),$_smarty_tpl);?>
</strong> <?php echo smartyTranslate(array('s'=>'and transactions control.','mod'=>'payulatam'),$_smarty_tpl);?>
</li>
				<li><?php echo smartyTranslate(array('s'=>'Prevent major investments in infrastructure, technic developments, maintenance and administration of the payment system.','mod'=>'payulatam'),$_smarty_tpl);?>
</li>
			</ul>
			<h2><?php echo smartyTranslate(array('s'=>'Safety and Support','mod'=>'payulatam'),$_smarty_tpl);?>
</h2>
			<ul class="payu-3cols">
				<li><p class="payu-small-col1"><strong><?php echo smartyTranslate(array('s'=>'Anti-fraud Control:','mod'=>'payulatam'),$_smarty_tpl);?>
</strong><br /><?php echo smartyTranslate(array('s'=>'Anti-fraud module for automatic validation of transactions and manual verification procedures, carried out by experts in analysis and identification of fraud.','mod'=>'payulatam'),$_smarty_tpl);?>
</p></li>
				<li><p class="payu-small-col2"><strong><?php echo smartyTranslate(array('s'=>'Certified PCI DSS:','mod'=>'payulatam'),$_smarty_tpl);?>
</strong><br /><?php echo smartyTranslate(array('s'=>'With this certification, PayU Latam ensures the protection, confidentiality, and integrity of the card holder information.','mod'=>'payulatam'),$_smarty_tpl);?>
</p></li>
				<li><p class="payu-small-col3"><strong><?php echo smartyTranslate(array('s'=>'Veracode Recognition:','mod'=>'payulatam'),$_smarty_tpl);?>
</strong><br /><?php echo smartyTranslate(array('s'=>'The unique award-winning company in Latin America thanks to its high safety standards in the development of its transactional platform and related services.','mod'=>'payulatam'),$_smarty_tpl);?>
</p></li>
			</ul>
		</div>
	</div>
	<ul id="menuTab">
	  <?php  $_smarty_tpl->tpl_vars['li'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['li']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tab']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['li']->key => $_smarty_tpl->tpl_vars['li']->value){
$_smarty_tpl->tpl_vars['li']->_loop = true;
?>
	  <li id="menuTab<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['li']->value['tab'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="menuTabButton <?php if ($_smarty_tpl->tpl_vars['li']->value['selected']){?>selected<?php }?>"><?php if ($_smarty_tpl->tpl_vars['li']->value['icon']!=''){?><img src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['li']->value['icon'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['li']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/><?php }?> <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['li']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</li>
	  <?php } ?>
	</ul>
	<div id="tabList">
	  <?php  $_smarty_tpl->tpl_vars['div'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['div']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tab']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['div']->key => $_smarty_tpl->tpl_vars['div']->value){
$_smarty_tpl->tpl_vars['div']->_loop = true;
?>
	  <div id="menuTab<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['div']->value['tab'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
Sheet" class="tabItem <?php if ($_smarty_tpl->tpl_vars['div']->value['selected']){?>selected<?php }?>">
	    <?php echo $_smarty_tpl->tpl_vars['div']->value['content'];?>

	  </div>
	  <?php } ?>
	</div>
</div>
<?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['script']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value){
$_smarty_tpl->tpl_vars['link']->_loop = true;
?>
<script type="text/javascript" src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['link']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"></script>
<?php } ?>
<?php }} ?>