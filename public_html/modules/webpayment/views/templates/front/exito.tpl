{include file="$tpl_dir./breadcrumb.tpl"}
<h1>Orden de Compra N {$Tbk_orden_compra}</h1>
<p><strong>Nombre de Comercio:</strong> Comercial Fuud</p>
<p><strong>Sitio Web:</strong> Fuud.cl</p>
<p><strong>Nombre Cliente:</strong> {$Nombre_Cliente} {$Apellido_Cliente}</p>
<p><strong>Tipo de transacción:</strong> Venta</p>
<p><strong>Fecha Transacción:</strong> {$Tbk_fecha_transaccion}</p>
<p><strong>Codigo Autorizacion:</strong> {$Tbk_codigo_autorizacion}</p>
<p><strong>Numero de tarjeta:</strong> XXXXXXXXXXXX-{$Tbk_numero_final_tarjeta}</p> 
<p><strong>Orden de Pedido:</strong> {$Tbk_orden_compra}</p>
<p><strong>Numero de cuotas:</strong> {$Tbk_numero_cuotas}</p>
<p><strong>Tipo de cuotas:</strong>: 
	{if ($Tbk_tipo_pago=="VN")}
          Sin Cuotas
    {elseif ($Tbk_tipo_pago=="VC")}
          Cuotas normales
    {elseif ($Tbk_tipo_pago=="SI")}
          Sin interés   
    {elseif ($Tbk_tipo_pago=="CI")}
          Cuotas Comercio
    {elseif ($Tbk_tipo_pago=="VD")}
          Venta debito
    {/if}
</p>
<p><strong>Tipo de pago:</strong>
	{if ($Tbk_tipo_pago=="VN")}
          Crédito
    {elseif ($Tbk_tipo_pago=="VC")}
          Crédito
    {elseif ($Tbk_tipo_pago=="SI")}
          Crédito   
    {elseif ($Tbk_tipo_pago=="CI")}
          Crédito
    {elseif ($Tbk_tipo_pago=="VD")}
          Redcompra
    {/if}
</p>
<h2>Resumen de su Compra</h2>
<table id="cart_summary" class="std">
  <thead>
    <tr>
      <th class="cart_product first_item">Producto</th>
      <th class="cart_unit item">Precio unitario</th>
      <th class="cart_quantity item">Cantidad</th>
      <th class="cart_total item">Total</th>
      <th class="cart_delete last_item">&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    {foreach key=key item=item from=$product}
      <tr>
          <td>{$item.nombre}</td>
          <td>${str_replace(",",".",number_format($item.price,0))}</td>
          <td>{$item.stock}</td>
          <td>${str_replace(",",".",number_format($item.price*$item.stock,0))}</td>
          <td></td>
      </tr>
    {/foreach}
  </tbody>
  <tfoot>
  <tr class="cart_total_price">
    <td colspan="3">Total de productos (IVA incluído):</td>
    <td colspan="2" class="price" id="total_product">${$subTotal}</td>
  </tr>
  {if ($transport_amount>=1)}
  <tr class="cart_total_delivery">
    <td colspan="3">Total de envío (IVA incluído):</td>
    <td colspan="2" class="price" id="total_shipping">${$transport_amount}</td>
  </tr>
  {/if}
  {if (1==2)}
    {if ($totalPaid>=1)}
    <tr class="cart_total_voucher">
      <td colspan="3">
        Total de cupones de descuento (IVA incluído):
      </td>
      <td colspan="2" class="price-discount price" id="total_discount">-$ 9.196</td>
    </tr>
    {/if}
  {/if}
  <tr class="cart_total_price">
    <td colspan="3" id="cart_voucher" class="cart_voucher">
    </td>
    <td colspan="2" class="price total_price_container" id="total_price_container">
      <p>Total</p>
      <span id="total_price">${$totalPaid}</span>
    </td>
  </tr>
</tfoot>
</table><br />

<p>En caso de <b>requerir devoluciones</b> o <b>reembolsos</b> favor de contactar <b>ventas@fuud.cl</b>