function init() {
    $.ajax({
	url : "app/datos.php?a=ver",
	type : "GET",
	dataType : "json",
	success : function(data) {
	    $("#nombreempresa").text(data.nombre);
	    $("#direccionempresa").text(data.direccion);
	    $("#telefonoempresa").text(data.telefono);
	    $("#detalle").data("impuesto",parseInt(data.impuesto));
	    calcular();
	}
    })
}
function calcular() {
    var detalle = $("#detallefactura");
    var impuestoventa = parseFloat($("#detalle").data("impuesto"));
    var productos = $("<table />").css({
	width: "600px",
	border : "none"
    })
    var encabezado = $("<tr />").html("<td>Producto</td><td>Cantidad</td><td>Precio/unidad</td><td>Precio con descuento</td></td><td>Precio final</td>");
    productos.append(encabezado);
    $.ajax({
	url : "app/facturas.php?a=detalle",
	type : "GET",
	dataType : "json",
	data : {"numero" : numerofactura},
	success : function(data) {
	    $("#nombrecliente").text(data.cliente.nombre+" "+data.cliente.apellido);
	    $("#direccioncliente").text(data.cliente.direccion);
	    $("#telefonocliente").text(data.cliente.telefono);
	   var subtotal = 0;
	   var impuestos = 0;
	   var total = 0;
	    for (i=0;i<data.detalle.length;i++) {
		var info = "<td>"+data.detalle[i].producto+"</td>"+
			"<td>"+data.detalle[i].cantidad+"</td>"+
			"<td>"+data.detalle[i].preciounidad+"</td>";
		var pr_descuento = parseInt(data.detalle[i].preciounidad)*(100-parseFloat(data.detalle[i].descuento))/100;
		info = info+"<td>"+pr_descuento+"</td>";
		var pr_precio = parseInt(data.detalle[i].cantidad)*pr_descuento;
		subtotal = subtotal+pr_precio;
		if (data.detalle[i].impuesto) {
		    impuestos = impuestos+pr_precio*impuestoventa/100;
		}
		info = info+"<td>"+pr_precio+"</td>";
		var pr = $("<tr />").html(info);
		productos.append(pr);
		
	    }
	    total = subtotal+impuestos;
	    detalle.append(productos);
	    var precioinfo = "Subtotal: "+subtotal+"<br>"
	    +"Impuesto de venta: "+impuestos+"<br>"
	    +"<b>Total: "+total+"</b>";
	    $("#precio").html(precioinfo);
	}
    })
}