<?php 
	include_once "conectorBD.php";
	include "Partido.php";
	$nombre = $_POST['partido'];
	$tendencia = $_POST['tendencia'];
	$conexion = conectorBD::getInstance();
	$nuevoPartido = new Partido($nombre, $tendencia);
	$inserta = $nuevoPartido->agregarPartido();
	if (inserta == 0){
		header("Location: Mensaje.php?comando=AgregarPExito");
	}
	else{
		header("Location: Mensaje.php?comando=AgregarPFracaso");
	}
?>
