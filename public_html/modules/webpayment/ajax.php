<?php 
// Insertar datos factura Checkout / Payment
	require("../../config/settings.inc.php");
	include("includes_webpay/configuration.php");
	include("includes_webpay/database.php");
	$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );

// Factura
	$id=$_POST['id'];
	// echo $_POST["tipo"];
	
	$query_RS_Busca = "DELETE FROM `ps_factura` where (`id` = ".$id.");"; 
	$database->setQuery( $query_RS_Busca );
	$database->query();

	if ($_POST["tipo"]=="Factura") {
		$rut = utf8_decode($_POST["rutEmpresa"]);
		$razon_social = utf8_decode($_POST["razonSocial"]);
		$giro = utf8_decode($_POST["giroEmpresa"]);
		$direccion = utf8_decode($_POST["direccionEmpresa"]);
		$telefono = utf8_decode($_POST["telefonoEmpresa"]);
		$ciudad = utf8_decode($_POST["ciudadEmpresa"]);
		$comuna = utf8_decode($_POST["comunaEmpresa"]);


		$query_RS_Busca	= "INSERT INTO `ps_factura` (`id`, `rut`, `razon_social`, `giro`, `direccion`, `telefono`, `ciudad`, `comuna`) VALUES (".$id.", '".$rut."', '".$razon_social."', '".$giro."', '".$direccion."', '".$telefono."', '".$ciudad."', '".$comuna."');";
		$database->setQuery( $query_RS_Busca );
		$database->query();
		echo "OK";
	}
	// else{ // Borrar si es Boleta
	// 	$query_RS_Busca = "DELETE FROM `ps_factura` where (`id` = ".$id.");"; 
	// 	$database->setQuery( $query_RS_Busca );
	// 	$database->query();		
	// 	echo "NO OK";
	// }

?>