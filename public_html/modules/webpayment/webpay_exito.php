<?php
	@ini_set('display_errors', 'on');
	$trs_orden_compra = $_POST['TBK_ORDEN_COMPRA'];
	
	$hola = "hola";
	
	require("../../config/settings.inc.php");
	include("includes_webpay/configuration.php");
	include("includes_webpay/database.php");
	$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );

	$query_RS_Busca = "select * from webpay where Tbk_orden_compra='".$trs_orden_compra."' and Tbk_respuesta ='0' limit 0,1"; 
	$database->setQuery( $query_RS_Busca );
	$rows = $database->loadObjectList();
	
	if(count($rows)==0){
		header("Location: webpay_fracaso.php");
		// die();
	}
	
	$trs_monto = substr($rows[0]->Tbk_monto,0,-3);
	include('../../config/config.inc.php');
	include('../../header.php');
	include('webpayment.php');
	// die();
	$webpay = new webpayment();
	$orden_pedidoX=$webpay->ordenCompra($trs_orden_compra);
	if(!$orden_pedidoX){
		$webpay->validateOrder(intval($trs_orden_compra),Configuration::get('PS_OS_PAYMENT'),$trs_monto, $webpay->displayName, NULL, array(), null, false, '');
		$orden_pedido=$webpay->ordenCompra($trs_orden_compra);
		$order = new Order($orden_pedido);
		Tools::redirectLink('http://cccchile.cl/order-confirmation.php?id_cart='.$trs_orden_compra.'&key='.$order->secure_key.'&id_module='.$webpay->id);
	}else{
		$orden_pedido=$webpay->ordenCompra($trs_orden_compra);
		$order = new Order($orden_pedido);
		Tools::redirectLink('http://cccchile.cl/order-confirmation.php?id_cart='.$trs_orden_compra.'&key='.$order->secure_key.'&id_module='.$webpay->id);
		
	}
?>