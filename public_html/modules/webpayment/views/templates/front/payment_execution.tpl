{capture name=path}{l s='Pago con Webpay' mod='webpay'}{/capture}
{include file="$tpl_dir./breadcrumb.tpl"}

    <h2>{l s='Resumen del pedido' mod='webpay'}</h2>

{assign var='current_step' value='payment'}
{include file="$tpl_dir./order-steps.tpl"}
    {if $nbProducts <= 0}
	<p class="warning">{l s='Tu carro de compras está vacío.' mod='webpay'}</p>
    {else}
        <h3>{l s='Pago con Webpay' mod='webpay'}</h3>
        <div id="description">
            <div class="left-position">
                <img alt="logo" src="{$orangeconnect_logo}" />
            </div>
            <div class="left-position">
                Ha elegido pago con webpay.<br /><br />
                Y Cancelará el total de:
            </div>
        </div>
<form method="post" action="{$url_submit}">
    <p>
    <div id="total">
        <h3>Total: ${str_replace(",",".",number_format($total,0))}</h3>
    </div><br />
    <b>Por favor, confirme su compra pulsando en "Confirmo mi compra".</b>
    <p class="cart_navigation">
	<a href="{$link->getPageLink('order', true, NULL, "step=3")}" class="button_large">{l s='Otros métodos de pago' mod='webpay'}</a>
        <input type="submit" name="submit" value="{l s='Confirmo mi compra' mod='webpay'}" class="exclusive_large" />
    </p>

              <input name="TBK_TIPO_TRANSACCION" value="TR_NORMAL" type="HIDDEN">
              <input name="TBK_ID_SESION" value="{$idOrder}" type="HIDDEN">
              <input name="TBK_URL_EXITO" size="40" value="http://fuud.empresaslusitania.com/carrito?fc=module&module=webpay&controller=exito" type="HIDDEN">
              <input name="TBK_URL_FRACASO" size="40" value="http://fuud.empresaslusitania.com/carrito?fc=module&module=webpay&controller=fracaso" type="HIDDEN">
              <input name="TBK_ORDEN_COMPRA" size="40" value="{$idOrder}" type="HIDDEN">
              <input name="TBK_MONTO" size="40" value="{$total}00" type="HIDDEN">

</form>
    {/if}
