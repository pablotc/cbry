<?php /* Smarty version Smarty-3.1.14, created on 2015-05-04 23:07:08
         compiled from "/home2/amorales/public_html/themes/default-bootstrap/modules/blocksearch/blocksearch-top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1300857391554833dc38e6c9-46936660%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '984a49ddbbd45d5615ff80a8fb0c24498865c014' => 
    array (
      0 => '/home2/amorales/public_html/themes/default-bootstrap/modules/blocksearch/blocksearch-top.tpl',
      1 => 1422025135,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1300857391554833dc38e6c9-46936660',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_dir' => 0,
    'shop_name' => 0,
    'logo_url' => 0,
    'logo_image_width' => 0,
    'logo_image_height' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_554833dc869184_83665668',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_554833dc869184_83665668')) {function content_554833dc869184_83665668($_smarty_tpl) {?>

<!-- Block search module TOP -->
<!--cambiado a blockcontact/nav.tpl-->

<div id="search_block_top" class="col-sm-4 clearfix" style="float:left">

</div>
<!-- /Block search module TOP -->

<!-- AÑADIDO NUEVO-->
<div id="header_logo" style="">
	<a href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop_name']->value, ENT_QUOTES, 'UTF-8', true);?>
">
		<img class="logo img-responsive" style="margin: 0px auto;" src="<?php echo $_smarty_tpl->tpl_vars['logo_url']->value;?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop_name']->value, ENT_QUOTES, 'UTF-8', true);?>
"<?php if (isset($_smarty_tpl->tpl_vars['logo_image_width']->value)&&$_smarty_tpl->tpl_vars['logo_image_width']->value){?> width="<?php echo $_smarty_tpl->tpl_vars['logo_image_width']->value;?>
"<?php }?><?php if (isset($_smarty_tpl->tpl_vars['logo_image_height']->value)&&$_smarty_tpl->tpl_vars['logo_image_height']->value){?> height="<?php echo $_smarty_tpl->tpl_vars['logo_image_height']->value;?>
"<?php }?>/>
	</a>
</div><?php }} ?>