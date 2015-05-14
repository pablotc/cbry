<?php

$trs_orden_compra = $_POST['TBK_ORDEN_COMPRA'];
$trs_monto = substr($_POST['TBK_MONTO'],0,-2);
$trs_transaccion = $_POST['TBK_TIPO_TRANSACCION'];
$trs_respuesta = $_POST['TBK_RESPUESTA']; 
$trs_id_session = $_POST['TBK_ID_SESION'];
$trs_cod_autorizacion = $_POST['TBK_CODIGO_AUTORIZACION'];
$trs_nro_final_tarjeta = $_POST['TBK_FINAL_NUMERO_TARJETA'];
$trs_nro_tarjeta = $_POST['TBK_NUMERO_TARJETA']; 
$trs_fecha_expiracion = $_POST['TBK_FECHA_EXPIRACION']; 
$trs_fecha_contable = $_POST['TBK_FECHA_CONTABLE']; 
$trs_fecha_transaccion = $_POST['TBK_FECHA_TRANSACCION'];
$trs_hora_transaccion = $_POST['TBK_HORA_TRANSACCION']; 
$trs_id_transaccion = $_POST['TBK_ID_TRANSACCION']; 
$trs_tipo_pago = $_POST['TBK_TIPO_PAGO']; 
$trs_nro_cuotas = $_POST['TBK_NUMERO_CUOTAS']; 
$trs_mac = $_POST['TBK_MAC']; 
$trs_monto_cuota = $_POST['TBK_MONTO_CUOTA']; 
$trs_tasa_interes_max = $_POST['TBK_TASA_INTERES_MAX'];
$trs_fecha_transaccion = ($trs_fecha_transaccion=='') ? strftime('%Y-%m-%d') : strftime('%Y').'-'.substr($trs_fecha_transaccion,0,2).'-'.substr($trs_fecha_transaccion,2,2);
$trs_fecha_expiracion = ($trs_fecha_expiracion=='') ? strftime('%Y-%m-%d') : strftime('%Y').'-'.substr($trs_fecha_expiracion,0,2).'-'.substr($trs_fecha_expiracion,2,2);
$trs_fecha_contable = ($trs_fecha_contable=='') ? strftime('%Y-%m-%d') : strftime('%Y').'-'.substr($trs_fecha_contable,0,2).'-'.substr($trs_fecha_contable,2,2);

//	$trs_orden_compra="2250";
//$trs_monto=	"15810";

include(dirname(__FILE__).'/../../config/config.inc.php');
//include(dirname(__FILE__).'/../../header.php');
include(dirname(__FILE__).'/webpay.php');
$webpay = new webpay();
$errors="0";
$bandera_no_aceptado_banco="";

/****************REVISA APROBACIONDE TRANSACCION DE WEBPAY SI $trs_respuesta=0***********/
	$theValue = ($trs_respuesta==0 ) ?  "ACEPTADO": "RECHAZADO"; 
	if ($theValue=="RECHAZADO") {
		$bandera_no_aceptado_banco="si";
		$errors="No aceptado por Webpay";
	}
/****************************************REVISA MONTOS**************************************/
	if ($theValue=="ACEPTADO") {
		$monto_tienda=$webpay->montoCompra($trs_orden_compra);//trae el monto del pedodo de la tienda
		$monto_webpay=round($trs_monto);
		$theValue = ($monto_webpay!=$monto_tienda) ? "RECHAZADO" : "ACEPTADO"; 
		if ($theValue=="RECHAZADO") {
			$errors="Monto cancelado por Webpay (".$monto_webpay.") con respecto al del pedido Numero".$trs_orden_compra ."(".$monto_tienda.")";
		} 
	}
/****************************VERIFICA SI ESTA PAGADO***************************************/
	if ($theValue=="ACEPTADO"){
		$query="SELECT count(*) as total FROM `webpay` WHERE `Tbk_orden_compra` =".$trs_orden_compra ." AND Tbk_respuesta ='0'"; 
		$result = Db::getInstance()->getRow($query);
		$theValue = ($result['total']>0) ? "RECHAZADO" : "ACEPTADO";
		 if ($theValue=="RECHAZADO") {
				$errors="Numero de orden pedido ".$trs_orden_compra." ya pagado";
		 }
	}
/****************************************INSERTA EN TABLA WEBPAY***************************/
	$sql="insert into webpay (Tbk_tipo_transaccion, Tbk_respuesta, Tbk_orden_compra, Tbk_id_sesion, Tbk_codigo_autorizacion, Tbk_monto, Tbk_numero_tarjeta, Tbk_numero_final_tarjeta, Tbk_fecha_expiracion, Tbk_fecha_contable, Tbk_fecha_transaccion, Tbk_hora_transaccion, Tbk_id_transaccion, Tbk_tipo_pago, Tbk_numero_cuotas, Tbk_mac, Tbk_monto_cuota, Tbk_tasa_interes_max,Tbk_ip)
	Values ('".$trs_transaccion."',
	'".$errors."','".$trs_orden_compra."','".$trs_id_session."','".$trs_cod_autorizacion."','".$trs_monto."','".$trs_nro_tarjeta."',
	'".$trs_nro_final_tarjeta."','".$trs_fecha_expiracion."','".$trs_fecha_contable."','".$trs_fecha_transaccion."','".$trs_hora_transaccion."',
	'".$trs_id_transaccion."','".$trs_tipo_pago."','".$trs_nro_cuotas."','".$trs_mac."','".$trs_monto_cuota."','".$trs_tasa_interes_max."',
	'".$_SERVER['REMOTE_ADDR']."')";
	
$webpay->ejecuta_query($sql);


if ($theValue=="ACEPTADO"){
/****************************vALIDACION DE MAC**************************************************/
	$mosConfig_absolute_path="/home/webadmin/htdocs";
	$mosConfig_live_site="http://www.mallconnection.com";
	$filename = $mosConfig_absolute_path."/cgi-bin/log/temporal.txt";
	if( $fp = fopen($filename, "w")) {
		fwrite($fp, $trs_cod_autorizacion);
		fclose($fp);
	}
	/* 1.- Abrir archivo y guardar variables POST recibidas */ 
	$filename = $mosConfig_absolute_path."/cgi-bin/log/log".$trs_id_transaccion.".txt";
	$filename2 = "log".$trs_id_transaccion.".txt";
	$fp=fopen($filename,"w");
	reset($_POST);
	while (list($key,$val) = each($_POST))
	{
		fwrite($fp,"$key=$val&");
	}
	fclose($fp);
	/* 2.- Invocar a tbk_check_mac (Que en realidad no es una cgi) usando como parámetro el archivo generado */ 

	$resultado = file_get_contents($mosConfig_live_site."/cgi-bin/chkmac.cgi?filename=".$filename2);
	$result[0] = trim($resultado);

	/* Si $result[0]="CORRECTO" , entonces mac válido/*/ 
	if ($result[0]=="CORRECTO") { 
		/***************CONFIRMAR EN EL SISTEMA EL PAGO************************************************/
		$webpay->validateOrder(intval($trs_orden_compra), _PS_OS_PAYMENT_,$trs_monto, $webpay->displayName, '<br />');
		echo "ACEPTADO";
	} else {
		 echo "RECHAZADO"; 
		 $errors="check MAc adress, no coincide con el servidor";
		 $webpay->validateOrder(intval($trs_orden_compra), _PS_OS_ERROR_,$trs_monto, $webpay->displayName, $errors.'<br />');
	} 
}else{
	if ($bandera_no_aceptado_banco=="si"){//solo en el caso que el banco lo rechazo, para poder enviar a la pagina rechazo
		echo "ACEPTADO"; //ojo pero no a pagado si no que lo envbiara a la pagina fracaso
	}else{
		echo "RECHAZADO"; //caso de montos, orden de compra o mac
	}
	$webpay->validateOrder(intval($trs_orden_compra), _PS_OS_ERROR_,$trs_monto, $webpay->displayName, $errors.'<br />');
}	
?> 


