<?php /*%%SmartyHeaderCode:1788700270542dc16353b251-75135359%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '42429bc2b56894b8b54c03527ee570e3b22fc1ec' => 
    array (
      0 => '/home2/amorales/public_html/themes/default-bootstrap/modules/blockmyaccountfooter/blockmyaccountfooter.tpl',
      1 => 1406318375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1788700270542dc16353b251-75135359',
  'variables' => 
  array (
    'link' => 0,
    'returnAllowed' => 0,
    'voucherAllowed' => 0,
    'HOOK_BLOCK_MY_ACCOUNT' => 0,
    'is_logged' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_542dc163879a39_44682285',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542dc163879a39_44682285')) {function content_542dc163879a39_44682285($_smarty_tpl) {?>
<!-- Block myaccount module -->
<section class="footer-block col-xs-12 col-sm-4">
	<h4><a href="http://cccchile.cl/index.php?controller=my-account" title="Administrar mi cuenta de cliente" rel="nofollow">Mi cuenta</a></h4>
	<div class="block_content toggle-footer">
		<ul class="bullet">
			<li><a href="http://cccchile.cl/index.php?controller=history" title="Mis compras" rel="nofollow">Mis compras</a></li>
						<li><a href="http://cccchile.cl/index.php?controller=order-slip" title="Mis vales descuento" rel="nofollow">Mis vales descuento</a></li>
			<li><a href="http://cccchile.cl/index.php?controller=addresses" title="Mis direcciones" rel="nofollow">Mis direcciones</a></li>
			<li><a href="http://cccchile.cl/index.php?controller=identity" title="Administrar mi información personal" rel="nofollow">Mis datos personales</a></li>
			<li><a href="http://cccchile.cl/index.php?controller=discount" title="Mis vales" rel="nofollow">Mis vales</a></li>			
            		</ul>
	</div>
</section>
<!-- /Block myaccount module -->
<?php }} ?>