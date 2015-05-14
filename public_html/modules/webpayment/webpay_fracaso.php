<?php
$trs_orden_compra = $_POST['TBK_ORDEN_COMPRA'];
include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../header.php');

?>

<h1>Transacci&oacute;n fracasada</h1>
<br>
<p>Su transacci&oacute;n n&uacute;mero  <?php echo $trs_orden_compra; ?> no ha podido ser procesada </p>

<br><p>Las posibles causas de este rechazo son:<br />
  - Error en el ingreso de los datos de su tarjeta de cr&eacute;dito o debito (fecha y/o c&oacute;digo de seguridad).<br />
  - Su tarjeta de cr&eacute;dito o debito no cuenta con el cupo necesario para cancelar la compra.<br />
  - Tarjeta a&uacute;n no habilitada en el sistema financiero. <br />
</p>
<br>
<p>Si desea confirmar su compra porfavor cont&aacute;ctese con ventas@pxl.cl</p>



<?php
include(dirname(__FILE__).'/../../footer.php');
?>
