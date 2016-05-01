<?php
$inc = "index";
$titulo = "Administrador de Facturas";
if (isset($_GET["p"])) {
    $p = trim(filter_input(INPUT_GET, "p",FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH));
    switch ($p) {
	case "datosempresa":
	    $titulo = "Datos de la empresa";
	    $script = "datos";
	    break;
	case "listafacturas":
	    $titulo = "Lista de facturas";
	    $script = "listafact";
	    break;
	case "verfactura":
	    $titulo = "Ver factura";
	    $script = "verfactura";
	default:
	    $titulo = "Administrador de facturas";
    }
    if (file_exists("pagina/contenido/$p.php")) {
	$inc = $p;
    }
}
require_once("pagina/encabezado.php");
require_once("pagina/contenido/$inc.php");
require_once("pagina/pie.php");