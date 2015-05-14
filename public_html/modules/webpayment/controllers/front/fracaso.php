<?php
class webpayFracasoModuleFrontController extends ModuleFrontController{
	public function initContent() {
        parent::initContent();
        $idOrden = $_POST['TBK_ORDEN_COMPRA'];
        $this->context->smarty->assign('Tbk_orden_compra', $idOrden);
        // $sql=' SELECT id_order FROM `fuud_orders` WHERE id_cart="'.$idOrden.'" ';
        Db::getInstance()->execute('DELETE FROM webpay WHERE Tbk_orden_compra='.$idOrden);
        // Db::getInstance()->delete('webpay', 'Tbk_orden_compra = '.$idOrden, 1);
        $this->setTemplate("fracaso.tpl");
    }
}


?>