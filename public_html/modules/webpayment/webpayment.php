<?php
class webpayment extends PaymentModule{
	private	$_html = '';
	private $_postErrors = array();

	public function __construct()
	{
			$this->name = 'webpayment';
		$this->tab = 'payments_gateways';
		$this->version = '2.0'; 
		
		$this->currencies = true;
		$this->currencies_mode = 'radio';

        parent::__construct();

		$this->page = basename(__FILE__, '.php');
        $this->displayName = $this->l('webpayment');
        $this->description = 'Acepta pagos de WebPay';
		$this->confirmUninstall = $this->l('Are you sure you want to delete your details ?');
	}

	public function getwebpayUrl()
	{
			return Configuration::get('webpay_SANDBOX') ? '../cgi-bin/tbk_bp_pago.cgi' : '../cgi-bin/tbk_bp_pago.cgi';
	}

	public function install()
	{
		if (!parent::install()
			OR !Configuration::updateValue('webpay_BUSINESS', 'webpay@prestashop.com')
			OR !Configuration::updateValue('webpay_SANDBOX', 1)
			OR !$this->registerHook('payment')
			OR !$this->registerHook('paymentReturn'))
			return false;
		return true;
	}

	public function uninstall()
	{
		if (!Configuration::deleteByName('webpay_BUSINESS')
			OR !Configuration::deleteByName('webpay_SANDBOX')
			OR !parent::uninstall())
			return false;
		return true;
	}

	public function getContent()
	{
		$this->_html = '<h2>webpay</h2>';
		if (isset($_POST['submitwebpay']))
		{
			if (empty($_POST['business']))
				$this->_postErrors[] = $this->l('webpay business e-mail address is required.');
			elseif (!Validate::isEmail($_POST['business']))
				$this->_postErrors[] = $this->l('webpay business must be an e-mail address.');
			if (!isset($_POST['sandbox']))
				$_POST['sandbox'] = 1;
			if (!sizeof($this->_postErrors))
			{
				Configuration::updateValue('webpay_BUSINESS', strval($_POST['business']));
				Configuration::updateValue('webpay_SANDBOX', intval($_POST['sandbox']));
				Configuration::updateValue('webpay_HEADER', strval($_POST['header']));
				$this->displayConf();
			}
			else
				$this->displayErrors();
		}

		$this->displaywebpay();
		$this->displayFormSettings();
		return $this->_html;
	}

	public function displayConf()
	{
		$this->_html .= '
		<div class="conf confirm">
			<img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />
			'.$this->l('Settings updated').'
		</div>';
	}

	public function displayErrors()
	{
		$nbErrors = sizeof($this->_postErrors);
		$this->_html .= '
		<div class="alert error">
			<h3>'.($nbErrors > 1 ? $this->l('There are') : $this->l('There is')).' '.$nbErrors.' '.($nbErrors > 1 ? $this->l('errors') : $this->l('error')).'</h3>
			<ol>';
		foreach ($this->_postErrors AS $error)
			$this->_html .= '<li>'.$error.'</li>';
		$this->_html .= '
			</ol>
		</div>';
	}
	
	
	public function displaywebpay()
	{
		$this->_html .= '';
	}

	public function displayFormSettings()
	{
		$conf = Configuration::getMultiple(array('webpay_BUSINESS', 'webpay_SANDBOX', 'webpay_HEADER'));
		$business = array_key_exists('business', $_POST) ? $_POST['business'] : (array_key_exists('webpay_BUSINESS', $conf) ? $conf['webpay_BUSINESS'] : '');
	//	$sandbox = array_key_exists('sandbox', $_POST) ? $_POST['sandbox'] : (array_key_exists('webpay_SANDBOX', $conf) ? $conf['webpay_SANDBOX'] : '');
		//$header = array_key_exists('header', $_POST) ? $_POST['header'] : (array_key_exists('webpay_HEADER', $conf) ? $conf['webpay_HEADER'] : '');

		$this->_html .= '
		<br />
		<fieldset class="width3">
			<legend><img src="../img/admin/warning.gif" />'.$this->l('Information').'</legend>
			<table>
				<tr>
					<td><img src="../modules/webpayment/web-pay-adq.gif" style="float:left; margin-right:15px;" /></td>
					<td>
					Modulo WebPay para prestoshop, certificado por Transbank<br>
Autor: Pixel Ingenieria<br>
e-mail:rebocano@gmail.com
<br />
Empresa: Fuud.cl
					</td>
				</tr>
			</table>
		</fieldset>';
		
		$sql=' SELECT * FROM `webpay` order by Tbk_orden_compra desc ';
		$result = Db::getInstance()->ExecuteS($sql);		
	
		$comments = $result;
			if (sizeof($comments))
			{
				$this->_html .= '
				<fieldset class="width3">
					<legend><img src="../img/admin/warning.gif" />Log Transbank</legend>
				<div style="width:900px;height:370px;overflow:auto;"><table class="table" border="0" cellspacing="0" cellpadding="0">
				 <thead>
				  <tr>
				  	<th> Orden en PrestaShop</th>
				    <th >Tbk_tipo_transaccion</th>
					<th >Tbk_respuesta</th>
					<th >Tbk_orden_compra</th>
					<th >Tbk_id_sesion</th>
			
					<th >Tbk_codigo_autorizacion</th>
					<th >Tbk_monto</th>
					<th >Tbk_numero_tarjeta</th>
					<th >Tbk_numero_final_tarjeta</th>
					<th >Tbk_fecha_expiracion</th>
					<th >Tbk_fecha_contable</th>
			
					<th >Tbk_fecha_transaccion</th>
					<th >Tbk_hora_transaccion</th>
					<th >Tbk_id_transaccion</th>
					<th >Tbk_tipo_pago</th>
					<th >Tbk_numero_cuotas</th>
					<th >Tbk_mac</th>
			
					<th >Tbk_monto_cuota</th>
					<th >Tbk_tasa_interes_max</th>
					<th >Tbk_ip</th>
				  </tr>
				 </thead>
				 <tbody>';
				foreach ($comments as $comment)
				{	$respuesta=$comment['Tbk_respuesta'];
					if ($comment['Tbk_respuesta']=='0'){
						$respuesta="Aceptado";
					}
					$this->_html .= '<tr>
					
					<td >'.$this->ordenCompra($comment['Tbk_orden_compra']).'</td>
					<td >'.$comment['Tbk_tipo_transaccion'].'</td>
					<td >'.$respuesta.'</td>
					<td >'.$comment['Tbk_orden_compra'].'</td>
					<td >'.$comment['Tbk_id_sesion'].'</td>
			
					<td >'.$comment['Tbk_codigo_autorizacion'].'</td>
					<td >'.$comment['Tbk_monto'].'</td>
					<td >'.$comment['Tbk_numero_tarjeta'].'</td>
					<td >'.$comment['Tbk_numero_final_tarjeta'].'</td>
					<td >'.$comment['Tbk_fecha_expiracion'].'</td>
					<td >'.$comment['Tbk_fecha_contable'].'</td>
			
					<td >'.$comment['Tbk_fecha_transaccion'].'</td>
					<td >'.$comment['Tbk_hora_transaccion'].'</td>
					<td >'.$comment['Tbk_id_transaccion'].'</td>
					<td >'.$comment['Tbk_tipo_pago'].'</td>
					<td >'.$comment['Tbk_numero_cuotas'].'</td>
					<td> '.$comment['Tbk_mac'].'</td>
			
					<td >'.$comment['Tbk_monto_cuota'].'</td>
					<td >'.$comment['Tbk_tasa_interes_max'].'</td>
					<td >'.$comment['Tbk_ip'].'</td>
					</tr>';
				}
				$this->_html .= '</tbody>
				</table>
				</div>
				</fieldset>';
			}
		
		
		
		
	}

	public function hookPayment($params)
	{
		if (!$this->active)
			return ;

		global $smarty;

		$address = new Address(intval($params['cart']->id_address_invoice));
		$customer = new Customer(intval($params['cart']->id_customer));
		$business = Configuration::get('webpay_BUSINESS');
		$header = Configuration::get('webpay_HEADER');
		$currency = $this->getCurrency();

		if (!Validate::isEmail($business))
			return $this->l('webpay error: (invalid or undefined business account email)');

		if (!Validate::isLoadedObject($address) OR !Validate::isLoadedObject($customer) OR !Validate::isLoadedObject($currency))
			return $this->l('webpay error: (invalid address or customer)');
			
		$products = $params['cart']->getProducts();

		foreach ($products as $key => $product)
		{
			$products[$key]['name'] = str_replace('"', '\'', $product['name']);
			if (isset($product['attributes']))
				$products[$key]['attributes'] = str_replace('"', '\'', $product['attributes']);
			$products[$key]['name'] = htmlentities(utf8_decode($product['name']));
			$products[$key]['webpayAmount'] = number_format(Tools::convertPrice($product['price_wt'], $currency), 2, '.', '');
		}
		$smarty->assign(array(
			'address' => $address,
			'country' => new Country(intval($address->id_country)),
			'customer' => $customer,
			'business' => $business,
			'header' => $header,
			'currency' => $currency,
			'orden_compra' => $params['cart']->currentOrder,
			'webpayUrl' => $this->getwebpayUrl(),
			// products + discounts - shipping cost
			'amount' => number_format(Tools::convertPrice($params['cart']->getOrderTotal(true, 4), $currency), 2, '.', ''),
			// shipping cost + wrapping
			'shipping' =>  number_format(Tools::convertPrice(($params['cart']->getOrderShippingCost() + $params['cart']->getOrderTotal(true, 6)), $currency), 2, '.', ''),
			'discounts' => $params['cart']->getDiscounts(),
			'products' => $products,
			// products + discounts + shipping cost
			'total' => floor(Tools::convertPrice($params['cart']->getOrderTotal(true, 3), $currency)),

//			'total' => number_format(Tools::convertPrice($params['cart']->getOrderTotal(true, 3), $currency), 2, '.', ''),
			'id_cart' => intval($params['cart']->id),
			'goBackUrl' => 'http://'.htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__.'order-confirmation.php?key='.$customer->secure_key.'&id_cart='.intval($params['cart']->id).'&id_module='.intval($this->id),
			'url_enviar' => 'http://'.htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__.'modules/webpayment/xt_1_pago.php',
			'token' => base64_encode(intval($params['cart']->id)."superclave"),
			'this_path' => $this->_path
					
			
			
		));

		return $this->display(__FILE__, 'webpay.tpl');
	}

	public function hookPaymentReturn($params)
	{
		$sql=" SELECT * FROM `webpay` WHERE Tbk_respuesta = '0' AND `Tbk_orden_compra` = ".$params['objOrder']->id_cart;
		$result = Db::getInstance()->getRow($sql);		
		
		if ($result['Tbk_respuesta']=='0'){  //fue aceptado por el validador, entra a comprobante si no va a fracaso
			$address = new Address(intval($params['objOrder']->id_address_invoice));
			
			$TBK_FINAL_NUMERO_TARJETA=$result['Tbk_numero_final_tarjeta'];
			$TBK_ORDEN_COMPRA=$params['objOrder']->id;
			$Comercio="Comercial Fuud";
			$url="http://www.fuud.cl";
			$trs_monto = substr($result['Tbk_monto'],0,-3);
			$dateArray=explode('-',$result['Tbk_fecha_transaccion']);
			$trs_fecha_transaccion = $dateArray[2]."/".$dateArray[1]."/".$dateArray[0]; 
			
			$TBK_CODIGO_AUTORIZACION = $result['Tbk_codigo_autorizacion'];
			$TIPO_TRANSACCION="Venta";
			$trs_tipo_pago = $result['Tbk_tipo_pago']; 
			$trs_nro_cuotas = $result['Tbk_numero_cuotas'];
			if ($trs_nro_cuotas=='0'){$trs_nro_cuotas='00';}
			$tipo_pago_descripcion="";
			$tipo_pago=" Credito";
			if ($trs_tipo_pago=="VN"){	$tipo_pago_descripcion=" Sin Cuotas";}
			if ($trs_tipo_pago=="VC"){	$tipo_pago_descripcion=" Normales";}
			if ($trs_tipo_pago=="SI"){	$tipo_pago_descripcion=" Sin inter&eacute;s";}
			if ($trs_tipo_pago=="CIC"){	$tipo_pago_descripcion=" Cuotas Comercio";}
			if ($trs_tipo_pago=="VD"){	$tipo_pago_descripcion=" Debito";$tipo_pago=" Redcompra";}
			
			if (!$this->active)
				return ;
				$currency = $this->getCurrency();	
			global $smarty;	
			$smarty->assign(array(
			'address' => $address,
				'orden_compra' => $params['objOrder']->id,
				'id_carro' =>$params['objOrder']->id_cart,
				'TBK_FINAL_NUMERO_TARJETA' =>$TBK_FINAL_NUMERO_TARJETA,
				'TBK_ORDEN_COMPRA' =>$TBK_ORDEN_COMPRA,
				'Comercio' =>$Comercio,
				'url' =>$url,
				'trs_monto' =>$trs_monto,
				'trs_fecha_transaccion' =>$trs_fecha_transaccion,
				'TBK_CODIGO_AUTORIZACION' =>$TBK_CODIGO_AUTORIZACION,
				'TIPO_TRANSACCION' =>$TIPO_TRANSACCION,
				'tipo_pago_descripcion' =>$tipo_pago_descripcion,
				'trs_nro_cuotas' =>$trs_nro_cuotas,
				'total_orden' =>  Tools::displayPrice($params['total_to_pay'], $params['currencyObj']),
				'test' =>  $result['nbr'],
				'tipo_pago' =>  $tipo_pago,
				'this_path' => $this->_path
			));
			
			//Tools::displayPrice($this->context->cart->getOrderTotal(true), $currency),
			
			return $this->display(__FILE__, 'confirmation.tpl');
		}else{
			echo "fracaso";
			return $this->display(__FILE__, 'fracaso.tpl');
		}
		
	}

	public function getL($key)
	{
		$translations = array(
			'mc_gross' => $this->l('webpay key \'mc_gross\' not specified, can\'t control amount paid.'),
			'payment_status' => $this->l('webpay key \'payment_status\' not specified, can\'t control payment validity'),
			'payment' => $this->l('Payment: '),
			'custom' => $this->l('webpay key \'custom\' not specified, can\'t rely to cart'),
			'txn_id' => $this->l('webpay key \'txn_id\' not specified, transaction unknown'),
			'mc_currency' => $this->l('webpay key \'mc_currency\' not specified, currency unknown'),
			'cart' => $this->l('Cart not found'),
			'order' => $this->l('Order has already been placed'),
			'transaction' => $this->l('webpay Transaction ID: '),
			'verified' => $this->l('The webpay transaction could not be VERIFIED.'),
			'connect' => $this->l('Problem connecting to the webpay server.'),
			'nomethod' => $this->l('No communications transport available.'),
			'socketmethod' => $this->l('Verification failure (using fsockopen). Returned: '),
			'curlmethod' => $this->l('Verification failure (using cURL). Returned: '),
			'curlmethodfailed' => $this->l('Connection using cURL failed'),
		);
		return $translations[$key];
	}

	function validateOrder($id_cart, $id_order_state, $amountPaid, $paymentMethod = 'Unknown', $message = NULL, $extraVars = array(), $currency_special = NULL, $dont_touch_amount = false)
	{
		if (!$this->active)
			return ;

		$currency = $this->getCurrency();
		$cart = new Cart(intval($id_cart));
		$cart->id_currency = $currency->id;
		$cart->save();
		//truco para monto
		//$amountPaid =$cart->getOrderTotal(true, 4);
		
		parent::validateOrder($id_cart, $id_order_state, $amountPaid, $paymentMethod, $message, $extraVars, $currency_special, true);
	}
	function ejecuta_query($query){
		//ejecuta un query desde la clase
		$result = Db::getInstance()->Execute($query);	
	}
	function ordenCompra($id_cart){
		//desde un codigo de carro trae el codigo del pedido generado
		$result = Db::getInstance()->getRow(' SELECT id_order FROM `'._DB_PREFIX_.'orders` pc	WHERE `id_cart` ='.$id_cart );	
		return $result['id_order'];	
	}
	
	function montoCompra($id_cart){
		$cart = new Cart(intval($id_cart));
		//$monto=number_format($cart->getOrderTotal(true, 3),0, '.', '');
		
		$monto=floor($cart->getOrderTotal(true, 3));	
		return $monto;	
	}
	
}

	