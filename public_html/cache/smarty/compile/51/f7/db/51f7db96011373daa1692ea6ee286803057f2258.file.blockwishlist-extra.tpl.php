<?php /* Smarty version Smarty-3.1.14, created on 2014-10-02 18:19:30
         compiled from "/home2/amorales/public_html/themes/default-bootstrap/modules/blockwishlist/blockwishlist-extra.tpl" */ ?>
<?php /*%%SmartyHeaderCode:541570424542dc162a8efb7-37226273%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '51f7db96011373daa1692ea6ee286803057f2258' => 
    array (
      0 => '/home2/amorales/public_html/themes/default-bootstrap/modules/blockwishlist/blockwishlist-extra.tpl',
      1 => 1406318375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '541570424542dc162a8efb7-37226273',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id_product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_542dc162acc111_29494878',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542dc162acc111_29494878')) {function content_542dc162acc111_29494878($_smarty_tpl) {?>

<p class="buttons_bottom_block no-print">
	<a id="wishlist_button" href="#" onclick="WishlistCart('wishlist_block_list', 'add', '<?php echo intval($_smarty_tpl->tpl_vars['id_product']->value);?>
', $('#idCombination').val(), document.getElementById('quantity_wanted').value); return false;" rel="nofollow"  title="<?php echo smartyTranslate(array('s'=>'Add to my wishlist','mod'=>'blockwishlist'),$_smarty_tpl);?>
">
		<?php echo smartyTranslate(array('s'=>'Add to my wishlist','mod'=>'blockwishlist'),$_smarty_tpl);?>

	</a>
</p>
<?php }} ?>