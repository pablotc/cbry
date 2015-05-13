<?php /*%%SmartyHeaderCode:2096364437554780b6772361-54660267%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b73e8f517423492a8e281b419fa7f85035cc5734' => 
    array (
      0 => '/home2/amorales/public_html/modules/socialsharing/views/templates/hook/socialsharing.tpl',
      1 => 1406696068,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2096364437554780b6772361-54660267',
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5548845ca60867_64670575',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5548845ca60867_64670575')) {function content_5548845ca60867_64670575($_smarty_tpl) {?>	<p class="socialsharing_product list-inline no-print">
					<button type="button" class="btn btn-default btn-twitter" onclick="socialsharing_twitter_click('CORE SWEAT SHORT NAVY http://cccchile.cl/index.php?id_product=58&controller=product');">
				<i class="icon-twitter"></i> Tweet
				<!-- <img src="http://cccchile.cl/modules/socialsharing/img/twitter.gif" alt="Tweet" /> -->
			</button>
							<button type="button" class="btn btn-default btn-facebook" onclick="socialsharing_facebook_click();">
				<i class="icon-facebook"></i> Compartir
				<!-- <img src="http://cccchile.cl/modules/socialsharing/img/facebook.gif" alt="Facebook Like" /> -->
			</button>
							<button type="button" class="btn btn-default btn-google-plus" onclick="socialsharing_google_click();">
				<i class="icon-google-plus"></i> Google+
				<!-- <img src="http://cccchile.cl/modules/socialsharing/img/google.gif" alt="Google Plus" /> -->
			</button>
										<button type="button" class="btn btn-default btn-pinterest" onclick="socialsharing_pinterest_click('http://cccchile.cl/img/p/1/9/5/195-thickbox_default.jpg');">
				<i class="icon-pinterest"></i> Pinterest
				<!-- <img src="http://cccchile.cl/modules/socialsharing/img/pinterest.gif" alt="Pinterest" /> -->
			</button>
			</p>
<?php }} ?>