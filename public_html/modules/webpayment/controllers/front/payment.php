<?php
// include('/../../webpay.php');
// include('/../../database.php');
// include('/../../configuration.php');
class webpayPaymentModuleFrontController extends ModuleFrontController{
    // require("../../../../config/settings.inc.php");
    // include('../../../../config/defines.inc.php');
    // include('../../../../config/config.inc.php');
    // @ini_set('display_errors', 'on');
    public $ssl = true;

    const URL_LOGO_JPG = "modules/webpayment/webpay-plus.gif";
    public function initContent() {

        $product_session = array();
        $products = $this->context->cart->getProducts();
        $this->display_column_left = false;

        for ($i = 0; $i < count($products); $i++) {
            $product_session[$i]["id_product_attribute"]    = $products[$i]["id_product_attribute"];
            $product_session[$i]["id_product"]              = $products[$i]["id_product"];
            $product_session[$i]["cart_quantity"]           = $products[$i]["cart_quantity"];
            $product_session[$i]["name"]                    = $products[$i]["name"];
            $product_session[$i]["price_wt"]                = $products[$i]["price_wt"];
        }

        $position = 0;
        $total_gross_amount = 0;
        foreach ($products as $product) {
            for ($i = 0; $i < (int) $product_session[$position]["cart_quantity"]; $i++) {
                $total_gross_amount+=$product["price_wt"];
            }
            $position++;
        }

        $transport_amount = $this->context->cart->getOrderTotal(true, Cart::BOTH) - $total_gross_amount;

        parent::initContent();

        $this->context->smarty->assign('nbProducts', $this->context->cart->nbProducts());
        $this->context->smarty->assign("product", $product_session);
        $this->context->smarty->assign("total", (int)$this->context->cart->getOrderTotal(true, Cart::BOTH));
        $this->context->smarty->assign("url_submit", Tools::getShopDomainSsl(true, true) . __PS_BASE_URI__ . "cgi-bin/tbk_bp_pago.cgi");
        $this->context->smarty->assign("transport_amount", $transport_amount);
        $this->context->smarty->assign('idOrder', $this->context->cart->id);
        $this->context->smarty->assign("orangeconnect_logo", Tools::getShopDomainSsl(true, true) . __PS_BASE_URI__ . self::URL_LOGO_JPG);
        // print_r($this->context->cart->id);

        // RESPALDAMOS INFORMACION
        $sqlDelete = "DELETE FROM webpay_orden where id=".$this->context->cart->id.";";
        Db::getInstance()->execute($sqlDelete);
        Db::getInstance()->autoExecute('webpay_orden', array('id' => (int)($this->context->cart->id), 'monto' => (int)($this->context->cart->getOrderTotal(true, Cart::BOTH)), 'estado' => 0), 'INSERT');
        
        // $result = Db::getInstance()->getRow(' SELECT id_order FROM `'._DB_PREFIX_.'orders` pc   WHERE `id_cart` ='.$id_cart );  
        // RESPALDAMOS INFORMACION
        // $database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
        // BORRAMOS
        // $query_RS_Busca = "DELETE FROM `webpay_orden` where (`id` = ".$TBK_ORDEN_COMPRA.");"; 
        // $database->setQuery( $query_RS_Busca );
        // $database->query();
        // AGREGAMOS
        // $query_RS_Busca = 'INSERT INTO webpay_orden (id,monto,estado) VALUES ("'.$TBK_ORDEN_COMPRA.'", "'.$TBK_MONTO.'", "0")'; 
        // $database->setQuery( $query_RS_Busca );
        // $database->query(); // To INSERT , UPDATE, DELETE
        $this->setTemplate("payment_execution.tpl");
    }
}

?>