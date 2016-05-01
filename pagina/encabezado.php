<!DOCTYPE html>
<html>
<head>
    <title><?php echo $titulo ?></title>
    <link href="css/black-tie/jquery-ui-1.10.3.custom.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/jquery-ui-1.10.3.custom.js"></script>
    <?php
    if (isset($script)) {
	echo '<script src="js/'.$script.'.js"></script>';
    }
    ?>
    <script>
    $(function() {
	$("#nav a").button({
	    icons : {primary: "ui-icon-carat-1-e"}
	});
	<?php
	if (isset($script)) {
	    echo "init();";
	}
	?>
    });
    </script>
</head>
<body class="ui-widget-content">
    <table id="principal">
	<tr>
	    <td id="encabezado" class="ui-widget-header ss">Administrador de facturas</td>
	</tr>
	<tr>
	    <td id="menu" class="ui-widget-header" style="background-image: none;">
		<ul id="nav">
		    <li><a href="index.php">Inicio</a></li>
		    <li><a href="index.php?p=datosempresa">Datos de la empres</a></li>
		    <li><a href="index.php?p=listafacturas">Ver facturas</a></li>
		</ul></td>
	</tr>
	<tr>
	    <td id="contenido" class="ui-widget-content ss">