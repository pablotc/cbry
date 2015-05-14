
	PAGADO 
<?php
	include('/home1/empresb1/public_html/fuud/config/settings.inc.php');
	include('/home1/empresb1/public_html/fuud/config/config.inc.php');
	include('/home1/empresb1/public_html/fuud/modules/webpay/webpay.php');
	// $webpay = new webpay();
	// $trs_orden_compra = $TBK_ORDEN_COMPRA;
	// $orden_pedido=$webpay->ordenCompra($trs_orden_compra);
	// $context = Context::getContext();
	// $currency = $context->currency;
	// $order = new Order($trs_orden_compra);
	// $trs_monto = $TBK_MONTO;
	// $webpay->validateOrder(intval($trs_orden_compra),Configuration::get('PS_OS_PAYMENT'),$trs_monto, $webpay->displayName, NULL, array(), null, false, '');
	// print_r($TBK_ORDEN_COMPRA);



	// @ini_set('display_errors', 'on');

	$webpay = new webpay();
	// print_r($cart);
	$trs_orden_compra = $_POST['TBK_ORDEN_COMPRA'];
	$trs_monto = $_POST['TBK_MONTO']; 
	$webpay->validateOrder(intval($trs_orden_compra),Configuration::get('PS_OS_PAYMENT'),$trs_monto, $webpay->displayName, NULL, array(), null, false, '');
	$orden_pedido=$webpay->ordenCompra($trs_orden_compra);

	// print_r($orden_pedido);



// $context = Context::getContext();
// // $cart = $context->cart;

// // $customer = new Customer((int)$cart->id_customer);
// // if (!Validate::isLoadedObject($customer))
// // 	Tools::redirect('index.php?controller=order&step=1');
// $currency = $context->currency;
// // $total = (float)($cart->getOrderTotal());
// $order = new Order($trs_orden_compra);
// // print_r($trs_orden_compra);
// // print_r($trs_monto);
// $webpay->validateOrder(intval($trs_orden_compra),Configuration::get('PS_OS_PAYMENT'),$trs_monto, $webpay->displayName, NULL, array(), null, false, '');

// print_r("AQUI4");
// Tools::redirect('index.php?controller=order-confirmation&id_cart='.$cart->id.'&id_module='.$webpay->id.'&id_order='.$trs_orden_compra.'&key='.$order->secure_key);





// print_r($orden_pedido);
// echo '<br/>';
// $order = new Order($orden_pedido);
// print_r($order);
// print_r($trs_orden_compra);
// echo '<br/>La compra se realizo sin problemas';
// Tools::redirectLink('http://fuud.empresaslusitania.com/order-confirmation.php?id_cart='.$trs_orden_compra.'&key='.$order->secure_key.'&id_module='.$webpay->id);
?>