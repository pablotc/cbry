<?php /* Smarty version Smarty-3.1.14, created on 2014-08-28 12:32:06
         compiled from "/home2/amorales/public_html/modules/payulatam/tpl/credential.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204833404753ff5986534c67-64405975%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a82a2670e1759dc3857c7991b71c79769dafad65' => 
    array (
      0 => '/home2/amorales/public_html/modules/payulatam/tpl/credential.tpl',
      1 => 1406697624,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204833404753ff5986534c67-64405975',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'formCredential' => 0,
    'credentialText' => 0,
    'credentialInputVar' => 0,
    'input' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53ff59865e5ff4_88671916',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ff59865e5ff4_88671916')) {function content_53ff59865e5ff4_88671916($_smarty_tpl) {?>

<form action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['formCredential']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" method="POST">
	<fieldset>
		<p><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['credentialText']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</p>
		<input type="hidden" name="submitPayU" value="1" />
		<?php  $_smarty_tpl->tpl_vars['input'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['input']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['credentialInputVar']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['input']->key => $_smarty_tpl->tpl_vars['input']->value){
$_smarty_tpl->tpl_vars['input']->_loop = true;
?>
		<label from="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['input']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['input']->value['label'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</label>
		<div class="margin-form">
		<?php if ($_smarty_tpl->tpl_vars['input']->value['type']=='text'){?>
			<input type="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['input']->value['type'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" name="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['input']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['input']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['input']->value['value'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" /> <?php if ($_smarty_tpl->tpl_vars['input']->value['required']){?><span style="color:red">*</span><?php }?> <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['input']->value['desc'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

			<?php }elseif($_smarty_tpl->tpl_vars['input']->value['type']=='radio'){?>
	    	<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['input']->value['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
	    		<input type="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['input']->value['type'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['val']->value==$_smarty_tpl->tpl_vars['input']->value['value']){?>checked='checked'<?php }?> name="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['input']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['input']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['val']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" /> <?php if ($_smarty_tpl->tpl_vars['input']->value['required']){?><span style="color:red">*</span><?php }?> <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['val']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

			<?php } ?>
		<?php }?>
		</div>
		<?php } ?>
		<div class="margin-form">
			<input type="submit" class="button" value="<?php echo smartyTranslate(array('s'=>'Save','mod'=>'payulatam'),$_smarty_tpl);?>
" />
		</div>
	</fieldset>
</form><?php }} ?>