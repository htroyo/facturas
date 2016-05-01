<h3>Lista de facturas</h3>
<br>
<table id="facturas">
    <tr>
	<td colspan="6"><button id="btn_nueva">Nueva Factura</button>
	    <button id="btn_refrescar">Refrescar</button></td>
    </tr>
    <tr>
	<td style="width: 10%;">N&uacute;mero</td>
	<td style="width: 10%;">Fecha</td>
	<td style="width: 60%;">Cliente</td>
	<td style="width: 10%;">Eliminar</td>
	<td style="width: 10%;">Ver</td>
    </tr>
</table>
<div id="eliminar" class="ui-helper-hidden">&iquest;Est&aacute; seguro de eliminar esta factura?</div>
<div id="agregar" class="ui-helper-hidden">
    <div id="fact_msj" class="ui-helper-hidden"></div>
    <form id="fact_agregar">
	<fieldset><legend>Datos</legend>
	    <table class="dlg_tabla_1">
		<tr>
		    <td>Numero</td>
		    <td><input type="text" name="fact_num"></td>
		</tr>
		<tr>
		    <td>Fecha</td>
		    <td><input type="text" name="fact_fecha"></td>
		</tr>
	    </table>
	</fieldset><br>
	<fieldset><legend>Cliente</legend>
	    <table class="dlg_tabla_1">
		<tr>
		    <td>Nombre</td>
		    <td><input type="text" name="fact_cl_nombre"></td>
		</tr>
		<tr>
		    <td>Apellido</td>
		    <td><input type="text" name="fact_cl_apellido"></td>
		</tr>
		<tr>
		    <td>Telefono</td>
		    <td><input type="text" name="fact_cl_telefono"></td>
		</tr>
		<tr>
		    <td>Direccion</td>
		    <td><input name="fact_cl_direccion"></td>
		</tr>
	    </table>
	</fieldset><br>
	<fieldset><legend>Detalle</legend>
	    <div style="width: 500px; height: 200px; overflow: auto;"><table id="fact_detalle" class="dlg_tabla_1">
		<tr>
		    <td>Producto</td>
		    <td>Cantidad</td>
		    <td>Precio</td>
		    <td>Imp. venta</td>
		    <td>Descuento</td>
		    <td>Eliminar</td>
		</tr>
		<tr>
		    <td><input name="producto[]" size="2"></td>
		    <td><input name="cantidad[]" size="4"></td>
		    <td><input name="precio[]" size="r"></td>
		    <td><input name="impuesto[]" type="checkbox"></td>
		    <td><input name="descuento[]" size="3"></td>
		    <td><button class="btn_elim_pr">Eliminar</button></td>
		</tr>
		</table></div>
	</fieldset>
    </form>
</div>