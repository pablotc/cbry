<?php /* Smarty version Smarty-3.1.14, created on 2014-10-02 18:19:29
         compiled from "/home2/amorales/public_html/modules/socialsharing/views/templates/hook/socialsharing_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2028140395542dc161564e13-46282941%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '316ec1cc541be4c9d187ffbba97d45ab81bf4b66' => 
    array (
      0 => '/home2/amorales/public_html/modules/socialsharing/views/templates/hook/socialsharing_header.tpl',
      1 => 1406696068,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2028140395542dc161564e13-46282941',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link_rewrite' => 0,
    'cover' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_542dc1616a4793_89843553',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542dc1616a4793_89843553')) {function content_542dc1616a4793_89843553($_smarty_tpl) {?>
<meta property="og:title" content="" />
<meta property="og:type" content="product" />
<meta property="og:site_name" content="" />
<meta property="og:description" content="" />
<meta property="og:email" content="" />
<meta property="og:phone_number" content="" />
<meta property="og:street-address" content="" />
<meta property="og:locality" content="" />
<meta property="og:country-name" content="" />
<meta property="og:postal-code" content="" />
<?php if (isset($_smarty_tpl->tpl_vars['link_rewrite']->value)&&isset($_smarty_tpl->tpl_vars['cover']->value)&&isset($_smarty_tpl->tpl_vars['cover']->value['id_image'])){?>
<meta property="og:image" content="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['link_rewrite']->value,$_smarty_tpl->tpl_vars['cover']->value['id_image'],'large_default');?>
" />
<?php }?><?php }} ?>