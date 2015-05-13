<?php /* Smarty version Smarty-3.1.14, created on 2015-05-04 10:16:12
         compiled from "/home2/amorales/public_html/modules/themeconfigurator/views/templates/hook/hook.tpl" */ ?>
<?php /*%%SmartyHeaderCode:41445619655477f2c33cce2-73463253%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '82355587375a39f5d8bfd24eadc8e6931a82f638' => 
    array (
      0 => '/home2/amorales/public_html/modules/themeconfigurator/views/templates/hook/hook.tpl',
      1 => 1418614272,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '41445619655477f2c33cce2-73463253',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'htmlitems' => 0,
    'hook' => 0,
    'hItem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_55477f2c3f8999_56897329',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55477f2c3f8999_56897329')) {function content_55477f2c3f8999_56897329($_smarty_tpl) {?>
<?php if (isset($_smarty_tpl->tpl_vars['htmlitems']->value)&&$_smarty_tpl->tpl_vars['htmlitems']->value){?>
<div id="htmlcontent_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
	<ul class="htmlcontent-home clearfix row">
		<?php  $_smarty_tpl->tpl_vars['hItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['hItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['htmlitems']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['items']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['hItem']->key => $_smarty_tpl->tpl_vars['hItem']->value){
$_smarty_tpl->tpl_vars['hItem']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['items']['iteration']++;
?>
			<?php if ($_smarty_tpl->tpl_vars['hook']->value=='left'||$_smarty_tpl->tpl_vars['hook']->value=='right'){?>
				<li class="htmlcontent-item-<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->getVariable('smarty')->value['foreach']['items']['iteration'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 col-xs-12">
			<?php }else{ ?>
				<li class="htmlcontent-item-<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->getVariable('smarty')->value['foreach']['items']['iteration'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 col-xs-4">
			<?php }?>
						
						<?php if ($_smarty_tpl->tpl_vars['hItem']->value['html']){?>
							<div class="item-html">
								<?php echo $_smarty_tpl->tpl_vars['hItem']->value['html'];?>
 <i class="icon-double-angle-right"></i>
							</div>
						<?php }?>
				
				</li>
		<?php } ?>
	</ul>
</div>
<?php }?>
<?php }} ?>