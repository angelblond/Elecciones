<?php 
	include_once "conectorBD.php";
	$nombre = $_POST['partido'];
	$tendencia = $_POST['tendencia'];
	$conexion = conectorBD::getInstance();
	$nuevoPartido = new Partido($nombre, $tendencia);
	$nuevoPartido.agregarPartido();
	
?>