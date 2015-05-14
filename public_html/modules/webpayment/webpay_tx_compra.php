<?php

// print_r(dirname(__FILE__));
// die();
@ini_set('display_errors', 'off');

$TBK_RESPUESTA		=	$_POST["TBK_RESPUESTA"];
$TBK_ORDEN_COMPRA	=	$_POST["TBK_ORDEN_COMPRA"];
$TBK_MONTO			=	$_POST["TBK_MONTO"];
$TBK_ID_SESION		=	$_POST["TBK_ID_SESION"];

	// // WEBPAY EXITO
	require_once(dirname(__FILE__)."/../../config/settings.inc.php");
	require_once(dirname(__FILE__)."/../../config/defines.inc.php");
	require_once(dirname(__FILE__)."/../../config/autoload.php");

	// include(dirname(__FILE__).'/../../config/config.inc.php');
	include_once(dirname(__FILE__).'/../../tools/profiling/Controller.php');
	include_once(dirname(__FILE__).'/../../tools/profiling/ObjectModel.php');
	include_once(dirname(__FILE__).'/../../tools/profiling/Hook.php');
	include_once(dirname(__FILE__).'/../../tools/profiling/Db.php');
	include_once(dirname(__FILE__).'/../../tools/profiling/Tools.php');
	require_once(dirname(__FILE__).'/webpay.php');
	$webpay = new webpay();

	$trs_orden_compra = $TBK_ORDEN_COMPRA;
	$orden_pedido=$webpay->ordenCompra($trs_orden_compra);
	$currency = $context->currency;
	$order = new Order($trs_orden_compra);
	$trs_monto = $TBK_MONTO;
	// print_r("AQUI");
	// print_r($webpay->displayName);
	// print_r(Configuration::get('PS_OS_PAYMENT'));
	// print_r($trs_monto);
	// print_r("AQUI 2");
	// $nuevoMonto = substr($trs_monto,0,-2);
	// die('ACEPTADO');




	$mosConfig_absolute_path = "/home1/empresb1/public_html/fuud";
	$mosConfig_live_site = "http://www.fuud.cl";
	$filename = $mosConfig_absolute_path."/cgi-bin/log/temporal.txt";
	if( $fp = fopen($filename, "w")) {
		fwrite($fp, $trs_cod_autorizacion);
		fclose($fp);
	}
	/* 1.- Abrir archivo y guardar variables POST recibidas */ 
	$filename = $mosConfig_absolute_path."/cgi-bin/log/log".$TBK_ID_SESION.".txt";
	$filename2 = "log".$TBK_ID_SESION.".txt";
	$fp=fopen($filename,"w");
	reset($_POST);
	while (list($key,$val) = each($_POST))
	{
		fwrite($fp,"$key=$val&");
	}
	fclose($fp);
	
	$resultado = file_get_contents($mosConfig_live_site."/cgi-bin/chkmac.cgi?filename=".$filename2);
	$result[0] = trim($resultado);
	print_r($result[0]);


// RESPALDAMOS INFORMACION
// $database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
// // BORRAMOS
// $query_RS_Busca = "DELETE FROM `webpay_orden` where (`id` = ".$TBK_ORDEN_COMPRA.");"; 
// $database->setQuery( $query_RS_Busca );
// $database->query();
// // AGREGAMOS
// $query_RS_Busca = 'INSERT INTO webpay_orden (id,monto,estado) VALUES ("'.$TBK_ORDEN_COMPRA.'", "'.$TBK_MONTO.'", "0")'; 
// $database->setQuery( $query_RS_Busca );
// $database->query(); // To INSERT , UPDATE, DELETE


// $acepta=false;

if($TBK_RESPUESTA=="0"){ $acepta=true; } else { $acepta=false; }
if ($acepta==true){ 
	$acepta=true;
}else{ 
	$acepta=false;
}//En esta linea agregar comprobaciones a la base de datos, si es que la Orden de compra YA existe

?>
<html>
<?php if ($acepta==true){?>
	ACEPTADO
	<?php 
		$para      = 'rebocano@gmail.com';
		$titulo    = 'Nuevo Pago Recibido';
		$mensaje   = 'Monto: '.substr($trs_monto,0,-2);
		$cabeceras = 'From: rebocano@gmail.com' . "\r\n" .
		    'Reply-To: rebocano@gmail.com' . "\r\n" .
		    'X-Mailer: PHP/' . phpversion();
		mail($para, $titulo, $mensaje, $cabeceras);
		$webpay->validateOrder(intval($trs_orden_compra),Configuration::get('PS_OS_PAYMENT'),substr($trs_monto,0,-2), $webpay->displayName, NULL, array(), null, false, '');
	?>
<?php } else {?>
RECHAZADO
<?php }?>
</html>