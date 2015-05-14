<script type="text/javascript" src="/modules/webpayment/jquery.Rut.min.js"></script>
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
<form action="{$url_enviar}" method="post" id="webpay_form">
		<input type="hidden" name="id" value="{$id_cart}">
		<input type="hidden" name="monto" value="{$total}">
		<input type="hidden" name="token" value="{$token}">
</form>
<p class="payment_module">
	<a href="javascript:$('#webpay_form').submit();" title="{l s='Pago con WebPay pesos chilenos' mod='webpay'}">
		<img src="{$module_template_dir}/web-pay-adq.gif" alt="{l s='Pago con WebPay pesos chilenos' mod='webpay'}" />
		{l s='Pago con WebPay pesos chilenos' mod='webpay'}
	</a>
</p>