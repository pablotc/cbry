<?php
class webpayExitoModuleFrontController extends ModuleFrontController{
    public $ssl = true;

    const URL_LOGO_JPG = "modules/webpay/webpay-plus.gif";
    public function initContent() {
        // print_r(print_r($_SERVER['HTTP_REFERER']);)
        if(isset($_POST['TBK_ORDEN_COMPRA'])){
            // @ini_set('display_errors', 'on');
            $idOrden = $_POST['TBK_ORDEN_COMPRA'];
            $sql=' SELECT * FROM `webpay` WHERE Tbk_orden_compra="'.$idOrden.'" ';
            $result = Db::getInstance()->ExecuteS($sql);


            $sql=' SELECT id_order FROM `fuud_orders` WHERE id_cart="'.$idOrden.'" ';
            $idOrdenPS = Db::getInstance()->ExecuteS($sql);
            // print_r($idOrdenPS);
            // print_r();

            // print_r($result);
            $this->context->smarty->assign('Tbk_codigo_autorizacion', $result[0]['Tbk_codigo_autorizacion']);
            $this->context->smarty->assign('Tbk_fecha_transaccion', $result[0]['Tbk_fecha_transaccion']);
            $this->context->smarty->assign('Tbk_numero_final_tarjeta', $result[0]['Tbk_numero_final_tarjeta']);
            $this->context->smarty->assign('Tbk_tipo_pago', $result[0]['Tbk_tipo_pago']);
            $this->context->smarty->assign('Tbk_numero_cuotas', $result[0]['Tbk_numero_cuotas']);
            $this->context->smarty->assign('Tbk_orden_compra', $result[0]['Tbk_orden_compra']);
            global $cookie;
            $this->context->smarty->assign('Nombre_Cliente', $cookie->customer_firstname);
            $this->context->smarty->assign('Apellido_Cliente', $cookie->customer_lastname);

            // Creamos carro
            $webpay = new webpay();

            $trs_orden_compra = $_POST['TBK_ORDEN_COMPRA'];
            $trs_monto = $_POST['TBK_MONTO']; 
            $orden_pedido=$webpay->ordenCompra($trs_orden_compra);

            if (!$orden_pedido and $result and !$idOrdenPS) {
                $webpay->validateOrder(intval($trs_orden_compra),Configuration::get('PS_OS_PAYMENT'),$trs_monto, $webpay->displayName, NULL, array(), null, false, '');
            }else{
                $confirmacion = Db::getInstance()->getRow('SELECT estado FROM `webpay_orden`  WHERE `id` ='.$trs_orden_compra );  
                // print_r($confirmacion['estado']);
                if($confirmacion['estado']==0 and $result and $idOrdenPS[0]['id_order']){
                    $updToPagado = Db::getInstance()->execute('UPDATE `webpay_orden` SET estado = 1  WHERE `id` ='.$trs_orden_compra );

                }else{
                    // print_r("REDIRECT 1");
                    // print_r($updToPagado);
                    Tools::redirect('/');
                    // print_r("YA HA SIDO CANCELADA ESTA ORDEN");
                    // print_r("Id Orden : ".$orden_pedido);
                }
            }
            // PRODUCTS
            $product_session = array(); 
            $products = Db::getInstance()->executeS(' SELECT * FROM `'._DB_PREFIX_.'cart_product`  WHERE `id_cart` ='.$idOrden );  
            for ($i=0; $i < count($products); $i++) { 
                $auxProduct = new Product((int)($products[$i]['id_product']));
                $producto[$i]['nombre'] = $auxProduct->name[1];
                $producto[$i]['price'] = (int)$auxProduct->getPrice();
                $producto[$i]['stock'] = $products[$i]['quantity'];
            }
            $discount = Db::getInstance()->getRow(' SELECT total_discounts_tax_incl FROM `'._DB_PREFIX_.'orders`  WHERE `id_cart` ='.$idOrden );  
            $transport_amount = Db::getInstance()->getRow(' SELECT total_shipping_tax_incl FROM `'._DB_PREFIX_.'orders`  WHERE `id_cart` ='.$idOrden );  
            $totalPaid = Db::getInstance()->getRow(' SELECT total_paid_real FROM `'._DB_PREFIX_.'orders`  WHERE `id_cart` ='.$idOrden );
            $subTotal = Db::getInstance()->getRow(' SELECT total_products_wt FROM `'._DB_PREFIX_.'orders`  WHERE `id_cart` ='.$idOrden );
            // $discount = $this->context->cart->getOrderTotal(true, Cart::BOTH) - $total_gross_amount;
            // $discount = $this->context->cart->getOrderTotal(true, Cart::BOTH) - $total_gross_amount;

            // $this->context->smarty->assign('nbProducts', $this->context->cart->nbProducts());
            $this->context->smarty->assign("product", $producto);
            $this->context->smarty->assign("subTotal", (int)$subTotal['total_products_wt']);
            $this->context->smarty->assign("transport_amount", (int)$transport_amount['total_shipping_tax_incl']);
            $this->context->smarty->assign("discount", (int)$discount['total_discounts_tax_incl']);
            $this->context->smarty->assign("totalPaid", (int)$totalPaid['total_paid_real']);

            // END PRODUCTS

            
            parent::initContent();


            $this->setTemplate("exito.tpl");
        }else{
            Tools::redirect('/');
            // print_r("REDIRECT 2");
        }
    }
}

?>