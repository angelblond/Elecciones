<?php 
	include_once "conectorBD.php";
	$nombre = $_POST['partido'];
	$tendencia = $_POST['tendencia'];
	$conexion = conectorBD::getInstance();
	$nuevoPartido = new Partido($nombre, $tendencia);
	$inserta = $nuevoPartido.agregarPartido();
	if (inserta == 0){
		header("Location: Mensaje.php?comando=AgregarExito");
	}
?>