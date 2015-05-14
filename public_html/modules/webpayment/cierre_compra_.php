<?php	
	// $mosConfig_absolute_path = "/home/repuesto/public_html";
	// $mosConfig_live_site = "http://repuesto-facil.cl";
	
	ini_set('allow_url_fopen', 'On');
	// ini_set('display_errors', 'on'); 

	$mosConfig_absolute_path = "/home1/empresb1/public_html/fuud";
	$mosConfig_live_site = "http://fuud.empresaslusitania.com";
	$TBK_RESPUESTA		=	$_POST["TBK_RESPUESTA"];
	$TBK_ORDEN_COMPRA	=	$_POST["TBK_ORDEN_COMPRA"];
	$TBK_MONTO			=	$_POST["TBK_MONTO"];
	$TBK_ID_SESION		=	$_POST["TBK_ID_SESION"];

	// WEBPAY EXITO	
	include("../../config/settings.inc.php");
	include('../../config/config.inc.php');
	// echo _DB_SERVER_;
	// include('/home1/empresb1/public_html/fuud/modules/webpay.php');
	// if($TBK_ORDEN_COMPRA){
	// 	$webpay = new webpay();
	// 	$trs_orden_compra = $TBK_ORDEN_COMPRA;
	// 	$orden_pedido=$webpay->ordenCompra($trs_orden_compra);
	// 	$context = Context::getContext();
	// 	$currency = $context->currency;
	// 	$order = new Order($trs_orden_compra);
	// 	$trs_monto = $TBK_MONTO;
	// 	$webpay->validateOrder(intval($trs_orden_compra),Configuration::get('PS_OS_PAYMENT'),$trs_monto, $webpay->displayName, NULL, array(), null, false, '');
	// }

	// print_r(dirname(__FILE__));
	// $filename = $mosConfig_absolute_path."/cgi-bin/log/temporal.txt";
	// if( $fp = fopen($filename, "w")) {		fwrite($fp, $trs_cod_autorizacion);
	// 	fclose($fp);
	// }	/* 1.- Abrir archivo y guardar variables POST recibidas */ 	
	// $filename = $mosConfig_absolute_path."/cgi-bin/log/log".$TBK_ID_SESION.".txt";
	// $filename2 = "log".$TBK_ID_SESION.".txt";
	// $fp=fopen($filename,"w");
	// reset($_POST);
	// while (list($key,$val) = each($_POST))	{		fwrite($fp,"$key=$val&");
	// }	fclose($fp);
	// 	$resultado = file_get_contents($mosConfig_live_site."/cgi-bin/chkmac.cgi?filename=".$filename2);
	// $result[0] = trim($resultado);
	// print_r($result[0]);

	// RESPALDAMOS INFORMACION// $database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
	// // BORRAMOS// $query_RS_Busca = "DELETE FROM `webpay_orden` where (`id` = ".$TBK_ORDEN_COMPRA.");
	// ";

 // $database->setQuery( $query_RS_Busca );
// $database->query();
// // AGREGAMOS// $query_RS_Busca = 'INSERT INTO webpay_orden (id,monto,estado) VALUES ("'.$TBK_ORDEN_COMPRA.'", "'.$TBK_MONTO.'", "0")';
 // $database->setQuery( $query_RS_Busca );
// $database->query();
 // To INSERT , UPDATE, DELETE// $acepta=false;
if($TBK_RESPUESTA=="0"){ $acepta=true;
 } else { $acepta=false;
 }if ($acepta==true){ 	$acepta=true;
 }else{ 	$acepta=false;
}//En esta linea agregar comprobaciones a la base de datos, si es que la Orden de compra YA existe?>
<html><?php if ($acepta==true){?>ACEPTADO<?php } else {?>RECHAZADO<?php }?></html>