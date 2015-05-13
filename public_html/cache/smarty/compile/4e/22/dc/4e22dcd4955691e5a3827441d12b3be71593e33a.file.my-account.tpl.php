<?php /* Smarty version Smarty-3.1.14, created on 2015-05-04 11:49:16
         compiled from "/home2/amorales/public_html/themes/default-bootstrap/my-account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1067434971554794fcd6db42-89948957%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e22dcd4955691e5a3827441d12b3be71593e33a' => 
    array (
      0 => '/home2/amorales/public_html/themes/default-bootstrap/my-account.tpl',
      1 => 1406318375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1067434971554794fcd6db42-89948957',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'account_created' => 0,
    'has_customer_an_address' => 0,
    'link' => 0,
    'returnAllowed' => 0,
    'voucherAllowed' => 0,
    'HOOK_CUSTOMER_ACCOUNT' => 0,
    'base_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_554794fce9dcb9_25032150',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_554794fce9dcb9_25032150')) {function content_554794fce9dcb9_25032150($_smarty_tpl) {?>

<?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?><?php echo smartyTranslate(array('s'=>'My account'),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<h1 class="page-heading"><?php echo smartyTranslate(array('s'=>'My account'),$_smarty_tpl);?>
</h1>
<?php if (isset($_smarty_tpl->tpl_vars['account_created']->value)){?>
	<p class="alert alert-success">
		<?php echo smartyTranslate(array('s'=>'Your account has been created.'),$_smarty_tpl);?>

	</p>
<?php }?>
<p class="info-account"><?php echo smartyTranslate(array('s'=>'Welcome to your account. Here you can manage all of your personal information and orders.'),$_smarty_tpl);?>
</p>
<div class="row addresses-lists">
	<div class="col-xs-12 col-sm-6 col-lg-4">
		<ul class="myaccount-link-list">
            <?php if ($_smarty_tpl->tpl_vars['has_customer_an_address']->value){?>
            <li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('address',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Add my first address'),$_smarty_tpl);?>
"><i class="icon-building"></i><span><?php echo smartyTranslate(array('s'=>'Add my first address'),$_smarty_tpl);?>
</span></a></li>
            <?php }?>
            <li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('history',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Orders'),$_smarty_tpl);?>
"><i class="icon-list-ol"></i><span><?php echo smartyTranslate(array('s'=>'Order history and details'),$_smarty_tpl);?>
</span></a></li>
            <?php if ($_smarty_tpl->tpl_vars['returnAllowed']->value){?>
                <li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('order-follow',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Merchandise returns'),$_smarty_tpl);?>
"><i class="icon-refresh"></i><span><?php echo smartyTranslate(array('s'=>'My merchandise returns'),$_smarty_tpl);?>
</span></a></li>
            <?php }?>
            <li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('order-slip',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Credit slips'),$_smarty_tpl);?>
"><i class="icon-ban-circle"></i><span><?php echo smartyTranslate(array('s'=>'My credit slips'),$_smarty_tpl);?>
</span></a></li>
            <li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('addresses',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Addresses'),$_smarty_tpl);?>
"><i class="icon-building"></i><span><?php echo smartyTranslate(array('s'=>'My addresses'),$_smarty_tpl);?>
</span></a></li>
            <li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('identity',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Information'),$_smarty_tpl);?>
"><i class="icon-user"></i><span><?php echo smartyTranslate(array('s'=>'My personal information'),$_smarty_tpl);?>
</span></a></li>
        </ul>
	</div>
<?php if ($_smarty_tpl->tpl_vars['voucherAllowed']->value||isset($_smarty_tpl->tpl_vars['HOOK_CUSTOMER_ACCOUNT']->value)&&$_smarty_tpl->tpl_vars['HOOK_CUSTOMER_ACCOUNT']->value!=''){?>
	<div class="col-xs-12 col-sm-6 col-lg-4">
        <ul class="myaccount-link-list">
            <?php if ($_smarty_tpl->tpl_vars['voucherAllowed']->value){?>
                <li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('discount',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Vouchers'),$_smarty_tpl);?>
"><i class="icon-barcode"></i><span><?php echo smartyTranslate(array('s'=>'My vouchers'),$_smarty_tpl);?>
</span></a></li>
            <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['HOOK_CUSTOMER_ACCOUNT']->value;?>

        </ul>
    </div>
<?php }?>
</div>
<ul class="footer_links clearfix">
<li><a class="btn btn-default button button-small" href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
" title="<?php echo smartyTranslate(array('s'=>'Home'),$_smarty_tpl);?>
"><span><i class="icon-chevron-left"></i> <?php echo smartyTranslate(array('s'=>'Home'),$_smarty_tpl);?>
</span></a></li>
</ul>
<?php }} ?>