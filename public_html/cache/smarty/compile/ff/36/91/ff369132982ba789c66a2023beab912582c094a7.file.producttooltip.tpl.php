<?php /* Smarty version Smarty-3.1.14, created on 2015-05-04 10:22:46
         compiled from "/home2/amorales/public_html/modules/producttooltip/views/templates/hook/producttooltip.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1974523515554780b611dbe0-18326557%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ff369132982ba789c66a2023beab912582c094a7' => 
    array (
      0 => '/home2/amorales/public_html/modules/producttooltip/views/templates/hook/producttooltip.tpl',
      1 => 1406318375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1974523515554780b611dbe0-18326557',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'nb_people' => 0,
    'date_last_order' => 0,
    'date_last_cart' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_554780b623bda6_42058140',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_554780b623bda6_42058140')) {function content_554780b623bda6_42058140($_smarty_tpl) {?>
<script type="text/javascript">
    $(document).ready(function () {
        <?php if (isset($_smarty_tpl->tpl_vars['nb_people']->value)){?>
        $.growl({title: '', message: '<?php if ($_smarty_tpl->tpl_vars['nb_people']->value==1){?><?php echo smartyTranslate(array('s'=>'%d person is currently watching this product','sprintf'=>$_smarty_tpl->tpl_vars['nb_people']->value,'mod'=>'producttooltip','js'=>1),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'%d people are currently watching this product','sprintf'=>$_smarty_tpl->tpl_vars['nb_people']->value,'mod'=>'producttooltip','js'=>1),$_smarty_tpl);?>
<?php }?>'});
        <?php }?>

        <?php if (isset($_smarty_tpl->tpl_vars['date_last_order']->value)){?>
        $.growl({title: '', message: '<?php echo smartyTranslate(array('s'=>'This product was bought last','mod'=>'producttooltip','js'=>1),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>$_smarty_tpl->tpl_vars['date_last_order']->value,'full'=>1),$_smarty_tpl);?>
'});
        <?php }?>

        <?php if (isset($_smarty_tpl->tpl_vars['date_last_cart']->value)){?>
        $.growl({title: '', message: '<?php echo smartyTranslate(array('s'=>'This product was added to cart last','mod'=>'producttooltip','js'=>1),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>$_smarty_tpl->tpl_vars['date_last_cart']->value,'full'=>1),$_smarty_tpl);?>
'});
        <?php }?>

        });
</script><?php }} ?>