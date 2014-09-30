<?php /*%%SmartyHeaderCode:92832743953fb7536eadd56-27656503%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ee49c1c6f18ded3de30ea97d6d58771c696e0a0' => 
    array (
      0 => '/home2/amorales/public_html/themes/default-bootstrap/modules/blockcontact/nav.tpl',
      1 => 1410671099,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '92832743953fb7536eadd56-27656503',
  'cache_lifetime' => 31536000,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54170a46551ac2_43774093',
  'has_nocache_code' => false,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54170a46551ac2_43774093')) {function content_54170a46551ac2_43774093($_smarty_tpl) {?><div id="contact-link">
	<a href="http://cccchile.cl/index.php?controller=contact" title="Contacta con nosotros">Contacte con nosotros</a>
</div>

<!-- Block search module TOP -->
<div id="search_block_top" class="col-sm-4 clearfix">
	<form id="searchbox" method="get" action="http://cccchile.cl/index.php?controller=search" >
		<input type="hidden" name="controller" value="search" />
		<input type="hidden" name="orderby" value="position" />
		<input type="hidden" name="orderway" value="desc" />
		<input class="search_query form-control" type="text" id="search_query_top" name="search_query" placeholder="Search" value="" />
		<button type="submit" name="submit_search" class="btn btn-default button-search">
			<span>Search</span>
		</button>
	</form>
</div>
<!-- /Block search module TOP --><?php }} ?>