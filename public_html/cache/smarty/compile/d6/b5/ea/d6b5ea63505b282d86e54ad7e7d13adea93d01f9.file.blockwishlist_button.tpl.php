<?php /* Smarty version Smarty-3.1.14, created on 2014-10-02 18:25:12
         compiled from "/home2/amorales/public_html/themes/default-bootstrap/modules/blockwishlist/blockwishlist_button.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2002309490542dc2b88be9d6-40850256%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6b5ea63505b282d86e54ad7e7d13adea93d01f9' => 
    array (
      0 => '/home2/amorales/public_html/themes/default-bootstrap/modules/blockwishlist/blockwishlist_button.tpl',
      1 => 1406318375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2002309490542dc2b88be9d6-40850256',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_542dc2b8902e18_92766364',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542dc2b8902e18_92766364')) {function content_542dc2b8902e18_92766364($_smarty_tpl) {?>

<div class="wishlist">
	<a class="addToWishlist wishlistProd_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" href="#" rel="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" onclick="WishlistCart('wishlist_block_list', 'add', '<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
', false, 1); return false;">
		<?php echo smartyTranslate(array('s'=>"Add to Wishlist",'mod'=>'blockwishlist'),$_smarty_tpl);?>

	</a>
</div><?php }} ?>