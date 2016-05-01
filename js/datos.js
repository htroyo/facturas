function init() {
    actualizardatos();
    $("#btn_modificar").button().click(function(ev,ui) {
	var datos = {"nombre" : $("#nombre").val(), "direccion" : $("#direccion").val(), "telefono" : $("#telefono").val(), "impuesto" : $("#impuesto").val()};
	$.ajax({
	    url : "app/datos.php?a=modificar",
	    type : "POST",
	    data : datos,
	    dataType : "json",
	    error : function(d,s,e) {
		alert(s);
	    }
	})
	actualizardatos();
    });
    $("#btn_refrescar").button().click(function(ev,ui) {
	actualizardatos();
    });
}
function actualizardatos() {
    $.ajax({
	url : "app/datos.php?a=ver",
	type : "GET",
	dataType : "json",
	success : function(data) {
	    $("#nombre").val(data.nombre);
	    $("#direccion").val(data.direccion);
	    $("#telefono").val(data.telefono);
	    $("#impuesto").val(data.impuesto);
	},
	error : function(d,s,e) {
	    alert(s);
	}
    })
}