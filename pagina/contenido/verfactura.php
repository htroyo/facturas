<?php
if (isset($_GET["numero"])) {
    $factura = filter_input(INPUT_GET,"numero",FILTER_SANITIZE_NUMBER_INT);
} else {
    $factura = -1;
}
?>
<h3>Detalle de factura</h3>
<br>
<div id="detalle">
    <fieldset><legend>Datos de la empresa</legend>
	<div id="nombreempresa"></div>
	<div id="direccionempresa"></div>
	<div id="telefonoempresa"></div>
    </fieldset>
    <fieldse><legend>Datos del cliente</legend>
	<div id="nombrecliente"></div>
	<div id="direccioncliente"></div>
	<div id="telefonocliente"></div>
    </fieldse>
    <fieldse><legend>Detalle</legend>
	<div id="detallefactura"></div>
    </fieldse>
    <fieldset><legend>Precio</legend>
	<div id="precio"></div>
    </fieldset>
</div>
<script>
    var numerofactura = <?php echo $factura ?>;
</script>