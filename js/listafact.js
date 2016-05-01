function init() {
    llenartabla();
    $(".btn_elim_pr").button({
	icons : {primary : "ui-icon-trash"},
	text : false
    }).click(function(e) {
	$(this).parents("tr").remove();
    });
    $("#facturas tr:first, #facturas tr:nth-child(2)").css({
	"font-size" : "14px",
	"font-weight" : "bold",
	"background-color" : "#dddddd"
    });
    $("#btn_nueva").button({
	icons : {primary : "ui-icon-circle-plus"}
    }).click(function() {
	$("#agregar").dialog({
	    title : "Agregar nueva factura",
	    width : "auto",
	    height : "auto",
	    modal : true,
	    resizable : false,
	    draggable : false,
	    dialogClass : "dialogo",
	    create : function(e) {
		$("html,body").css({"overflow": "hidden"})
	    },
	    close : function(event,ui) {
		$("#fact_detalle tr:gt(1)").remove();
		$("#fact_agregar")[0].reset();
		$("#fact_msj").addClass("ui-helper-hidden");
		$("html,body").css({"overflow": "auto"});
	    },
	    buttons : [{
		    text : "Agregar producto",
		    click : function() {
			var producto = $("<tr />");
			producto.html('<td><input name="producto[]" size="2"></td>'
		    +'<td><input name="cantidad[]" size="4"></td>'
		    +'<td><input name="precio[]" size="r"></td>'
		    +'<td><input name="impuesto[]" type="checkbox"></td>'
		    +'<td><input name="descuento[]" size="3"f/td>'
		    +'<td><button class="btn_elim_pr">Eliminar</button></td>');
			$("#fact_detalle").append(producto).animate({
			    scrollTop : producto.position().top
			},2000);
			$(".btn_elim_pr").button({
			    icons : {primary : "ui-icon-trash"},
			    text : false
			}).click(function(e) {
			    $(this).parents("tr").remove();
			});
		    }
		},{
		    text : "Agregar factura",
		    click : function(event,ui) {
			var factura = {};
			factura["fact_num"] = $("input[name='fact_num']").val();
			factura["fact_fecha"] = $("input[name='fact_fecha']").val();
			factura["fact_cl_nombre"] = $("input[name='fact_cl_nombre']").val();
			factura["fact_cl_apellido"] = $("input[name='fact_cl_apellido']").val();
			factura["fact_cl_direccion"] = $("input[name='fact_cl_direccion']").val();
			factura["fact_cl_telefono"] = $("input[name='fact_cl_telefono']").val();
			factura["producto"] = new Array();
			factura["cantidad"] = new Array();
			factura["precio"] = new Array();
			factura["impuesto"] = new Array();
			factura["descuento"] = new Array();
			var producto = $("input[name^='producto']");
			var cantidad = $("input[name^='cantidad']");
			var precio = $("input[name^='precio']");
			var impuesto = $("input[name^='impuesto']");;
			var descuento = $("input[name^='descuento']");
			for (i=0;i<producto.length;i++) {
    			    factura["producto"].push(producto[i].value);
			    factura["cantidad"].push(cantidad[i].value);
			    factura["precio"].push(precio[i].value);
			    if (impuesto[i].checked) {
				factura["impuesto"].push(1);
			    } else {
				factura["impuesto"].push(0);
			    }
			    factura["descuento"].push(descuento[i].value);
			}
			$.ajax({
			    url : "app/facturas.php?a=insertar",
			    type : "POST",
			    data : factura,
			    dataType : "json",
			    success : function(data) {
				$("#fact_msj").html("<b>Factura agregada con &eacute;xito.</b>").removeClass("ui-helper-hidden").addClass("ui-state-highlight ui-corner-all");
				llenartabla();
			    },
			    error : function(x,s,e) {
				$("#fact_msj").html("<b>Error: "+s+"</b>").removeClass("ui-helper-hidden").addClass("ui-state-error ui-corner-all");
				llenartabla();
			    }
			});
			llenartabla();
		    }
		},{
		    text : "Cerrar",
		    click : function(event,ui) {
			$(this).dialog("close");
		    }
		}]
	});
    });
    $("#btn_refrescar").button({
	icons : {primary : "ui-icon-refresh"}
    }).click(function() {
	    llenartabla();
	});
}
function llenartabla() {
    $("#facturas tr:gt(1)").remove();
    $.ajax({
	url : "app/facturas.php?a=listar",
	type : "GET",
	dataType : "json",
	success : function(data) {
	    for (var i = 0; i < data.length; i++) {
		var r = $("<tr />");
		r.html("<td>"+data[i].numero+"</td>"+
			"<td>"+data[i].fecha+"</td>"+
			"<td>"+data[i].cliente.nombre+" "+data[i].cliente.apellido+"</td>"+
			"<td class='tbl_btn'><button class='btn_eliminar'></button></td>"+
			"<td class='tbl_btn'><button class='btn_ver'></button></td>");
		$("#facturas").append(r);
		r.data("factura",data[i].numero);
	    }
	    $(".btn_eliminar").button({
		icons : {primary : "ui-icon-trash"},
		text : false
	    }).click(function(e) {
			$.ajax({
			    url : "app/facturas.php?a=eliminar",
			    type : "POST",
			    dataType : "json",
			    data : {"numero" : $(this).parents("tr").data("factura")}
			});
			llenartabla();

		    //$(this).parent("tr").remove();
		});
	    $(".btn_ver").button({
		icons : {primary : "ui-icon-carat-1-e"},
		text : false
	    }).click(function(e) {
		window.location.href = "index.php?p=verfactura&numero="+$(this).parents("tr").data("factura");
	    });
	    //$(".btn_eliminar").addClass("btn_eliminar");
	}
    });
}