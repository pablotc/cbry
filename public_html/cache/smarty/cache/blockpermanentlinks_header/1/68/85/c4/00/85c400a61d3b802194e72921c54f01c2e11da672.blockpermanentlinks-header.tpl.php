<?php /*%%SmartyHeaderCode:17354116155553aa123f9360-39797702%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '85c400a61d3b802194e72921c54f01c2e11da672' => 
    array (
      0 => '/home2/amorales/public_html/modules/blockpermanentlinks/blockpermanentlinks-header.tpl',
      1 => 1431546371,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17354116155553aa123f9360-39797702',
  'variables' => 
  array (
    'link' => 0,
    'come_from' => 0,
    'meta_title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5553aa1260c836_11475661',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5553aa1260c836_11475661')) {function content_5553aa1260c836_11475661($_smarty_tpl) {?>
<!-- Block permanent links module HEADER -->
<ul id="header_links">
	<li id="header_link_contact"><a href="http://cccchile.cl/index.php?controller=contact" title="contacto">contacto</a></li>
	<li id="header_link_sitemap"><a href="http://cccchile.cl/index.php?controller=sitemap" title="mapa sitio">mapa sitio</a></li>
	<li id="header_link_bookmark">
		<script type="text/javascript">writeBookmarkLink('http://cccchile.cl/index.php?controller=contact', 'Contáctenos - Canterbury Chile', 'Favoritos');</script>
	</li>
</ul>
<!-- /Block permanent links module HEADER -->
<?php }} ?>