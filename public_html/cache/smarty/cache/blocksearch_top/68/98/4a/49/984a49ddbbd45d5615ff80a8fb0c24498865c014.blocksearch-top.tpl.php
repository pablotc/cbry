<?php /*%%SmartyHeaderCode:164247640153ecec18305653-90433395%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '984a49ddbbd45d5615ff80a8fb0c24498865c014' => 
    array (
      0 => '/home2/amorales/public_html/themes/default-bootstrap/modules/blocksearch/blocksearch-top.tpl',
      1 => 1407293931,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '164247640153ecec18305653-90433395',
  'variables' => 
  array (
    'link' => 0,
    'search_query' => 0,
    'base_dir' => 0,
    'shop_name' => 0,
    'logo_url' => 0,
    'logo_image_width' => 0,
    'logo_image_height' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53ecec1837fb40_54978324',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ecec1837fb40_54978324')) {function content_53ecec1837fb40_54978324($_smarty_tpl) {?><!-- Block search module TOP -->
<div id="search_block_top" class="col-sm-4 clearfix">
	<form id="searchbox" method="get" action="http://cccchile.cl/index.php?controller=search" >
		<input type="hidden" name="controller" value="search" />
		<input type="hidden" name="orderby" value="position" />
		<input type="hidden" name="orderway" value="desc" />
		<input class="search_query form-control" type="text" id="search_query_top" name="search_query" placeholder="Buscar" value="" />
		<button type="submit" name="submit_search" class="btn btn-default button-search">
			<span>Buscar</span>
		</button>
	</form>
</div>
<!-- /Block search module TOP -->
<!-- AÑADIDO NUEVO-->
<div id="header_logo">
	<a href="http://cccchile.cl/" title="Canterbury">
		<img class="logo img-responsive" src="http://cccchile.cl/img/canterbury-1407293167.jpg" alt="Canterbury" width="213" height="167"/>
	</a>
</div><?php }} ?>