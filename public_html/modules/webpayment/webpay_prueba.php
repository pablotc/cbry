<?php 
include("includes_webpay/configuration.php");
include("includes_webpay/database.php");
require_once( 'includes_webpay/phpmailer/class.phpmailer.php' );
$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
/*************************************RECOGE VALORES PARA INSERTARLOS EN LA TABLA WEBPAY******/
$row=$rows[0];

$query_RS_Busca = "SELECT * FROM `webpay_pedido` AS a "
									." WHERE a.estado =0 "; 

$database->setQuery( $query_RS_Busca );
$rows2 = $database->loadObjectList();
$row2=$rows2[0];

$comprador= $row2->usuario;

$servicios= "

Para finalizar el proceso de compra debes ingresar a Web Pay y realizar el pago con Tarjeta de Credito: Visa, Mastercard, Magna, American Express y Diners Club. 
		 Si está todo ok tu pedido será Confirmado Definitivamente<br>
	 <img src='web-pay-adq.gif' alt='WebPay'/>	
	 <br>
<table>
	<tr>
		<td>orden</td>
		<td>glosa</td>
		<td>monto</td>
		
		<td></td>
	</tr>

";
for ($j=0;$j<count($rows2);$j++){
	$row2=$rows2[$j];
	$link = '<form action="xt_1_pago.php" method="post">
				<input type="hidden" name="id" value="'.$row2->id.'"  /><input type="hidden" name="monto" value="'.$row2->monto.'"  />
				<input type="hidden" name="glosa" value="'.$row2->glosa.'"  /><input type="hidden" name="usuario" value="'.$row2->usuario.'"  />
				<input type="hidden" name="token" value="'.base64_encode($row2->id."arenasycayo").'"  /><input  type="submit" value="ir a pagar a webpay" />
			</form>';
	$servicios = $servicios
					."<tr>
						<td>".$row2->id."</td>
						<td>".$row2->glosa."</td>
						<td align='right'>"."$".number_format($row2->monto, 0, ",", ".")."</td>
						
						<td>".$link."</td>
					</tr>";
	
	}
	$servicios =$servicios."</table>";
	
echo $servicios;	
?>
