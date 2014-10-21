<?php /*%%SmartyHeaderCode:581976641542dc1628e9bd2-69214497%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '581976641542dc1628e9bd2-69214497',
  'variables' => 
  array (
    'PS_SC_TWITTER' => 0,
    'PS_SC_FACEBOOK' => 0,
    'PS_SC_GOOGLE' => 0,
    'PS_SC_PINTEREST' => 0,
    'product' => 0,
    'link' => 0,
    'module_dir' => 0,
    'product_image_id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_542dc1629aa181_33849856',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542dc1629aa181_33849856')) {function content_542dc1629aa181_33849856($_smarty_tpl) {?>	<p class="socialsharing_product list-inline no-print">
					<button type="button" class="btn btn-default btn-twitter" onclick="socialsharing_twitter_click('CLUB PLUS HEADGUARD BLACK http://cccchile.cl/index.php?id_product=12&controller=product');">
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
										<button type="button" class="btn btn-default btn-pinterest" onclick="socialsharing_pinterest_click('http://cccchile.cl/img/p/3/6/36-thickbox_default.jpg');">
				<i class="icon-pinterest"></i> Pinterest
				<!-- <img src="http://cccchile.cl/modules/socialsharing/img/pinterest.gif" alt="Pinterest" /> -->
			</button>
			</p>
<?php }} ?>