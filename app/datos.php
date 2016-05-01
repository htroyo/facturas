<?php
require_once("mongodb.php");
$resultado = array();
if (isset($_GET["a"])) {
    $a = strtolower(trim(filter_input(INPUT_GET, "a",FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH)));
    switch ($a) {
	case "ver":
	    $r = $db->datos->find();
		foreach ($r as $datos) {
		$resultado = $datos;
	    }
	    break;
	case "modificar":
	    $datos["nombre"] = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING);
	    $datos["direccion"] = filter_input(INPUT_POST, "direccion", FILTER_SANITIZE_STRING);
	    $datos["telefono"] = filter_input(INPUT_POST, "telefono", FILTER_SANITIZE_STRING);
	    $datos["impuesto"] = filter_input(INPUT_POST, "impuesto", FILTER_SANITIZE_NUMBER_INT);
	    $r = $db->datos->find();
	    foreach ($r as $d) {
		$nombreviejo = $d["nombre"];
	    }
	    $db->datos->update(array("nombre" => $nombreviejo),$datos);
	    $err = $db->lastError();
	    if ($err["ok"] != 1) {
		$resultado["estado"] = "error";
	    } else {
		$resultado["estado"] = "modificado";
	    }
    }
} else {
	$resultado["estado"] = "noaccion";
}
echo json_encode($resultado);
?>