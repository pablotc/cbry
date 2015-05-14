<?php /* Smarty version Smarty-3.1.14, created on 2015-05-13 17:49:44
         compiled from "/home2/amorales/public_html/modules/webpayment/webpay.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4985746195553c6f8981170-67106756%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa16f97dc3a50537d445b4c31eacff65cc4fbf92' => 
    array (
      0 => '/home2/amorales/public_html/modules/webpayment/webpay.tpl',
      1 => 1431550467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4985746195553c6f8981170-67106756',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_enviar' => 0,
    'id_cart' => 0,
    'total' => 0,
    'token' => 0,
    'module_template_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5553c6f9291b95_81049924',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5553c6f9291b95_81049924')) {function content_5553c6f9291b95_81049924($_smarty_tpl) {?><script type="text/javascript" src="/modules/webpayment/jquery.Rut.min.js"></script>
<script type="text/javascript">
	// $(document).ready(function(){
	// 	$(".payment_module a").click(function(event){
	// 		var elemento = this;
	// 		if($("input[name=boleta]:checked").val()=="Factura"){
	// 		    event.preventDefault();
	// 		    total_inputs = $(".factura_content input[type=text]").length;
	// 	    	count = 0
	// 		    $(".factura_content input[type=text]").each(function(){
	// 		    	if($(this).val().length >= 3){
	// 		    		console.log($(this).val());
	// 		    		count = count + 1;
	// 		    	}
	// 		    	if(count==total_inputs){
	// 		    		rut_empresa = $("input[name=rut_empresa]").val();
	// 		    		razon_social = $("input[name=razon_social]").val();
	// 		    		giro_empresa = $("input[name=giro_empresa]").val();
	// 		    		direccion_empresa = $("input[name=direccion_empresa]").val();
	// 		    		telefono_empresa = $("input[name=telefono_empresa]").val();
	// 		    		ciudad_empresa = $("input[name=ciudad_empresa]").val();
	// 		    		comuna_empresa = $("input[name=comuna_empresa]").val();
	// 		    		$.ajax({
	// 					  		type: 'POST',
	// 							url: baseDir+'modules/webpay/ajax.php',
	// 					  		data: {
	// 					  			id: $("input[name=id]").val(),
	// 					  			tipo: $("input[name=boleta]:checked").val(),
	// 					  			rutEmpresa: rut_empresa,
	// 						  		razonSocial: razon_social, 
	// 						  		giroEmpresa: giro_empresa, 
	// 						  		direccionEmpresa: direccion_empresa,
	// 						  		telefonoEmpresa: telefono_empresa,
	// 						  		ciudadEmpresa: ciudad_empresa,
	// 						  		comunaEmpresa: comuna_empresa
	// 				  		},
	// 					    success: function(data){
	// 				   			// console.log(data);
	// 				   			document.location.href = $(elemento).attr("href");
	// 					    },
	// 					    error: function(XMLHttpRequest, textStatus, errorThrown){
	// 					   		alert('Se ha producido un error al intentar enviar los datos, por favor intente nuevamente: ' + XMLHttpRequest + '\n' + 'Estado: ' + textStatus);
	// 					   }
	// 					});
	// 		    	}
	// 		    });
	// 			if(count<total_inputs){
	// 	    		alert("Complete todos los datos para su Factura.");
	// 			}
	// 		}else{
	// 			$.ajax({
	// 			  		type: 'POST',
	// 					url: baseDir+'modules/webpay/ajax.php',
	// 			  		data: {
	// 			  			id: $("input[name=id]").val(),
	// 			  			tipo: $("input[name=boleta]:checked").val(),
	// 			  			rutEmpresa: rut_empresa,
	// 				  		razonSocial: razon_social, 
	// 				  		giroEmpresa: giro_empresa, 
	// 				  		direccionEmpresa: direccion_empresa,
	// 				  		telefonoEmpresa: telefono_empresa,
	// 				  		ciudadEmpresa: ciudad_empresa,
	// 				  		comunaEmpresa: comuna_empresa
	// 		  		},
	// 			    success: function(data){
	// 		   			// console.log(data);
	// 		   			document.location.href = $(elemento).attr("href");
	// 			    },
	// 			    error: function(XMLHttpRequest, textStatus, errorThrown){
	// 			   		alert('Se ha producido un error al intentar enviar los datos, por favor intente nuevamente: ' + XMLHttpRequest + '\n' + 'Estado: ' + textStatus);
	// 			   }
	// 			});
	// 		}
	// 	});

	// 	$("div.factura_content").hide();
	// 	$(".disabledDefault").attr("disabled","disabled");
	// 	$('#rut_empresa').Rut({
	// 	  on_error: function(){ alert('Rut incorrecto'); $(".disabledDefault").prop("disabled",true);},
	// 	  on_success: function(){ $(".disabledDefault").prop("disabled",false);}
	// 	});
	// });
	// $("input[name='boleta']").live("change",function(){
	// 	if ($('#factura_payment').is(':checked')){
	// 		$("div.factura_content").slideDown();
	// 	}else{
	// 		$("div.factura_content").slideUp();
	// 	}
	// });
</script>
<style type="text/css">
	input.disabledDefault{
	}
</style>
<form action="<?php echo $_smarty_tpl->tpl_vars['url_enviar']->value;?>
" method="post" id="webpay_form">
		<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id_cart']->value;?>
">
		<input type="hidden" name="monto" value="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
">
		<input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
">
</form>
<p class="payment_module">
	<a href="javascript:$('#webpay_form').submit();" title="<?php echo smartyTranslate(array('s'=>'Pago con WebPay pesos chilenos','mod'=>'webpay'),$_smarty_tpl);?>
">
		<img src="<?php echo $_smarty_tpl->tpl_vars['module_template_dir']->value;?>
/web-pay-adq.gif" alt="<?php echo smartyTranslate(array('s'=>'Pago con WebPay pesos chilenos','mod'=>'webpay'),$_smarty_tpl);?>
" />
		<?php echo smartyTranslate(array('s'=>'Pago con WebPay pesos chilenos','mod'=>'webpay'),$_smarty_tpl);?>

	</a>
</p><?php }} ?>