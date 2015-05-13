<?php /* Smarty version Smarty-3.1.14, created on 2015-05-04 20:36:03
         compiled from "/home2/amorales/public_html/backoffice/themes/default/template/controllers/stats/calendar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8658527335548107396fde1-77219002%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d272194b6fe51c5374d17c5a38347964871bb11' => 
    array (
      0 => '/home2/amorales/public_html/backoffice/themes/default/template/controllers/stats/calendar.tpl',
      1 => 1406318375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8658527335548107396fde1-77219002',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5548107397be98_43734948',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5548107397be98_43734948')) {function content_5548107397be98_43734948($_smarty_tpl) {?>

<div id="statsContainer" class="col-md-9">
	<?php echo $_smarty_tpl->getSubTemplate ("../../form_date_range_picker.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>