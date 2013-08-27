<?php 
	include_once "conectorBD.php";
	session_start();
	$_SESSION = array();
	$_SESSION['usuario'] = $_POST['usuario'];
	$_SESSION['clave'] = $_POST['clave'];
    $conexion = conectorBD::getInstance();
    $elUsuario = $_POST['usuario'];
	$laClave = $_POST['clave'];
	$autorizado = $conexion->acceso($elUsuario, $laClave);
    if ($autorizado!=false){
		$_SESSION['nivel'] = $autorizado[2];
		header("Location: index.php");
    }
    else {
		header("Location: Falla.php");		
    }
?>