<?php /*%%SmartyHeaderCode:123138829455477f2ecd4df6-15227850%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ee49c1c6f18ded3de30ea97d6d58771c696e0a0' => 
    array (
      0 => '/home2/amorales/public_html/themes/default-bootstrap/modules/blockcontact/nav.tpl',
      1 => 1422024603,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123138829455477f2ecd4df6-15227850',
  'variables' => 
  array (
    'link' => 0,
    'search_query' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_55477f2ed5fd43_66733412',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55477f2ed5fd43_66733412')) {function content_55477f2ed5fd43_66733412($_smarty_tpl) {?><div id="contact-link">
	<a href="http://cccchile.cl/index.php?controller=contact" title="Contacta con nosotros"><!--Contacte con nosotros-->Contacto</a>
</div>

<!-- Block search module TOP -->
<div id="search_block_top" class="col-sm-4 clearfix" style="float:left; margin-left:-10px;">
	<form id="searchbox" method="get" action="http://cccchile.cl/index.php?controller=search" >
		<input type="hidden" name="controller" value="search" />
		<input type="hidden" name="orderby" value="position" />
		<input type="hidden" name="orderway" value="desc" />
		<input class="search_query form-control" type="text" id="search_query_top" name="search_query" placeholder=" Buscar" value=""/>

		<button type="submit" name="submit_search" class="btn btn-default button-search">
			<span>Search</span>
		</button>

	</form>
</div>
<!-- /Block search module TOP --><?php }} ?>