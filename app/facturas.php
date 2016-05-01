<?php
require_once("mongodb.php");
if (isset($_GET["a"])) {
    $a = strtolower(trim(filter_input(INPUT_GET, "a",FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH)));
    switch ($a) {
	case "listar":
	    $r = $db->facturas->find();
	    $resultado = array();
	    foreach ($r as $factura) {
		array_push($resultado, $factura);
	    }
	    break;
	case "detalle":
	    $f = filter_input(INPUT_GET, "numero", FILTER_SANITIZE_NUMBER_INT);
	    $r = $db->facturas->find(array("numero" => $f));
	    if ($r->count() == 1) {
		foreach ($r as $factura) {
		    $resultado = $factura;
		}
	    } else {
		$resultado["estado"] = "facturainvalida";
	    }
	    break;
	case "insertar":
	    $factura["numero"] = filter_input(INPUT_POST, "fact_num",FILTER_SANITIZE_NUMBER_INT);
	    $factura["fecha"] = filter_input(INPUT_POST, "fact_fecha",FILTER_SANITIZE_STRING);
	    $factura["cliente"]["nombre"] = filter_input(INPUT_POST, "fact_cl_nombre",FILTER_SANITIZE_STRING);
	    $factura["cliente"]["apellido"] = filter_input(INPUT_POST, "fact_cl_apellido",FILTER_SANITIZE_STRING);
	    $factura["cliente"]["telefono"] = filter_input(INPUT_POST, "fact_cl_telefono",FILTER_SANITIZE_STRING);
	    $factura["cliente"]["direccion"] = filter_input(INPUT_POST, "fact_cl_direccion",FILTER_SANITIZE_STRING);
	    $factura["detalle"] = array();
	    $pr_producto = filter_var_array($_POST["producto"],FILTER_SANITIZE_STRING);
	    $pr_cantidad = filter_var_array($_POST["cantidad"],FILTER_SANITIZE_NUMBER_INT);
	    $pr_precio = filter_var_array($_POST["precio"],FILTER_SANITIZE_NUMBER_FLOAT);
	    $pr_descuento = filter_var_array($_POST["descuento"],FILTER_SANITIZE_NUMBER_FLOAT);
	    $t = count($_POST["producto"]);
	    for ($i = 0; $i < $t; $i++) {
		$producto["producto"] = $pr_producto[$i];
		$producto["cantidad"] = $pr_cantidad[$i];
		$producto["preciounidad"] = $pr_precio[$i];
		if ($_POST["impuesto"][$i] == 1) {
		    $producto["impuesto"] = true;
		} else {
		    $producto["impuesto"] = false;
		}
		$producto["descuento"] = $pr_descuento[$i];
		array_push($factura["detalle"], $producto);
	    }
	    $db->facturas->insert($factura);
	    $err = $db->lastError();
	    if ($err["ok"] != 1) {
		$resultado["estado"] = "error";
	    } else {
		$resultado["estado"] = "insertado";
	    }
	    break;
	case "eliminar":
	    $id = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_NUMBER_INT);
	    $db->facturas->remove(array("numero" => $id));
	    $err = $db->lastError();
	    if ($err["ok"] != 1) {
		$resultado["estado"] = "error";
	    } else {
		$resultado["estado"] = "eliminado";
	    }
	default:
	    $resultado["estado"] = "accioninvalida";
    }
} else {
    $resultado["estado"] = "noaccion";
}
echo json_encode($resultado)
?>