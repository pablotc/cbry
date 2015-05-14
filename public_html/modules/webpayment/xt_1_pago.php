<?php
require("../../config/settings.inc.php");
include("includes_webpay/configuration.php");
include("includes_webpay/database.php");
$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );

if (isset($_POST['id'])) {
	$id = (int)$_POST['id'];
} else {
	die('ID no especificado!');
}
$token = $_POST['token'];
$token = str_replace("=","",$token);

$token2 = base64_encode($id."superclave");
$token2 = str_replace("=","",$token2);

if ($token!=$token2){
		die('Error de llave');
}

/**
 * Chequear que no este pagada actualmente
 */
// INSERT INTO `webpay_transaccion` (`id`, `monto`, `glosa`, `usuario`, `estado`, `traspasado`) VALUES 
//(NULL, '40000', 'Asesoría en Construcción 3 ', 'Juan pablo henriquez', '0', '0');
$id=$_POST['id'];
$monto=$_POST['monto'];
$estado=0;
$token=$_POST['token'];

$query_RS_Busca = "DELETE FROM `webpay_orden` where (`id` = ".$id.");"; 
$database->setQuery( $query_RS_Busca );
$database->query();


$query_RS_Busca = "INSERT INTO `webpay_orden` (`id`, `monto`, `estado`) VALUES "
				." (".$id.", '".$monto."',  '0');"; 
$database->setQuery( $query_RS_Busca );
$database->query();

// // Factura
// 	$rut = utf8_decode($_POST["rut_empresa"]);
// 	$razon_social = utf8_decode($_POST["razon_social"]);
// 	$giro = utf8_decode($_POST["giro_empresa"]);
// 	$direccion = utf8_decode($_POST["direccion_empresa"]);

	
	// print_r($rut);
	// print_r($razon_social);
	// print_r($giro);
	// print_r($direccion);
	
	// $query_RS_Busca = "DELETE FROM `ps_factura` where (`id` = ".$id.");"; 
	// $database->setQuery( $query_RS_Busca );
	// $database->query();

	// $query_RS_Busca	= "INSERT INTO `abreyacl_tienda`.`ps_factura` (`id`, `rut`, `razon_social`, `giro`, `direccion`) VALUES (".$id.", '".$rut."', '".$razon_social."', '".$giro."', '".$direccion."');";
	// $database->setQuery( $query_RS_Busca );
	// $database->query();

?>
<form name="webpay" id="webpay" action="/cgi-bin/tbk_bp_pago.cgi" method="post">
<input type="hidden" name="TBK_MONTO" value="<?php echo $monto;?>00" />
<input type="hidden" name="TBK_TIPO_TRANSACCION" value="TR_NORMAL" />
<input type="hidden" name="TBK_ORDEN_COMPRA" value="<?php echo $id;?>" />
<input type="hidden" name="TBK_ID_SESION" value="<?php echo $id;?>" />
<input type="hidden" name="TBK_URL_EXITO" value="http://cccchile.cl/modules/webpayment/webpay_exito.php" />
<input type="hidden" name="TBK_URL_FRACASO" value="http://cccchile.cl/modules/webpayment/webpay_fracaso.php" />
</form>

<script>document.getElementById('webpay').submit();</script>
