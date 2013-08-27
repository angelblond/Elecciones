<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Elecciones</title>
		<link href='http://fonts.googleapis.com/css?family=Archivo+Narrow:400,700|Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
		<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
	</head>
	<body>
		<div id="wrapper">
			<div id="header-wrapper">
				<div id="header" class="container">
					<div id="logo">
						<h1><a href="index.php">CNE</a></h1>
					</div>
					<div id="menu">
						<ul>
							<li class="active"><a href="index.php" accesskey="1" title="Regresar al inicio">Inicio</a></li>
							<li><a href="listarCandidato.php" accesskey="2" title="Datos de candidatos">Candidatos</a></li>
							<li><a href="listarCentro.php" accesskey="3" title="Datos de centros de votación">Centros</a></li>
							<li><a href="resultados.php" accesskey="4" title="Presentación de resultados">Resultados</a></li>
							<?php
								session_start();
								if(isset($_SESSION['usuario'])){
									echo "<li><a href='cerrar.php' accesskey='5' title='Cierra la sesión actual'>Cerrar Sesion</a></li>";
								}
								else{
									echo "<li><a href='IniciarSesion.php' accesskey='5' title='Iniciar sesión en el sistema CNE'>Iniciar Sesion</a></li>";
								}
							?>
							
						</ul>
					</div>
				</div>
			</div>
			<div id="page" class="container">
				<div id="content">
					<div id="box1">
						<h2 class="title">Elecciones Municipales</h2><br/>
						<p>Seleccione una opción <strong>del menu inferior</strong> para trabajar</p>
					</div>
					<div>
						<ul class="style1">
						<?php 
							if (isset($_GET['tipo'])){
								if ($_GET['tipo']=="usuario"){
									echo "<li class='first'>
											<h3><em><img src='images/agregar.png' alt='' width='50' height='50' class='alignleft border' /></em>Agregar Usuario</h3><br/>
											<p><a href='AgregarUsuario.php' class='button-style'>Agregar</a></p>
										</li>
										<li>
											<h3><em><img src='images/listar.png' alt='' width='50' height='50' class='alignleft border' /></em>Listar Usuarios</h3><br/>
											<p><a href='ListarUsuario.php' class='button-style'>Listar</a></p>
										</li>
										";
								}
								else if ($_GET['tipo']=="municipio"){
									echo "<li class='first'>
											<h3><em><img src='images/agregar.png' alt='' width='50' height='50' class='alignleft border' /></em>Agregar Municipio</h3><br/>
											<p><a href='AgregarMunicipio.php' class='button-style'>Agregar</a></p>
										</li>
										<li>
											<h3><em><img src='images/listar.png' alt='' width='50' height='50' class='alignleft border' /></em>Listar Municipios</h3><br/>
											<p><a href='ListarMunicipio.php' class='button-style'>Listar</a></p>
										</li>
										";
								}
								
								else if ($_GET['tipo']=="centro"){
									echo "<li class='first'>
											<h3><em><img src='images/agregar.png' alt='' width='50' height='50' class='alignleft border' /></em>Agregar Centro de Votación</h3><br/>
											<p><a href='AgregarCentro.php' class='button-style'>Agregar</a></p>
										</li>
										<li>
											<h3><em><img src='images/listar.png' alt='' width='50' height='50' class='alignleft border' /></em>Listar Centros de Votación</h3><br/>
											<p><a href='ListarCentro.php' class='button-style'>Listar</a></p>
										</li>
										";
								}
								else if ($_GET['tipo']=="partido"){
									echo "<li class='first'>
											<h3><em><img src='images/agregar.png' alt='' width='50' height='50' class='alignleft border' /></em>Agregar Partido</h3><br/>
											<p><a href='AgregarPartido.php' class='button-style'>Agregar</a></p>
										</li>
										<li>
											<h3><em><img src='images/listar.png' alt='' width='50' height='50' class='alignleft border' /></em>Listar Partidos</h3><br/>
											<p><a href='ListarPartido.php' class='button-style'>Listar</a></p>
										</li>
										";
								}
								else if ($_GET['tipo']=="candidato"){
									echo "<li class='first'>
											<h3><em><img src='images/agregar.png' alt='' width='50' height='50' class='alignleft border' /></em>Agregar Candidatura</h3><br/>
											<p><a href='AgregarCandidato.php' class='button-style'>Agregar</a></p>
										</li>
										<li>
											<h3><em><img src='images/listar.png' alt='' width='50' height='50' class='alignleft border' /></em>Listar Candidatos</h3><br/>
											<p><a href='ListarCandidato.php' class='button-style'>Listar</a></p>
										</li>
										";
								}
								else if ($_GET['tipo']=="votante"){
									echo "<li class='first'>
											<h3><em><img src='images/agregar.png' alt='' width='50' height='50' class='alignleft border' /></em>Agregar Votante</h3><br/>
											<p><a href='AgregarCandidato.php' class='button-style'>Agregar</a></p>
										</li>
										<li>
											<h3><em><img src='images/listar.png' alt='' width='50' height='50' class='alignleft border' /></em>Listar Votantes</h3><br/>
											<p><a href='ListarVotante.php' class='button-style'>Listar</a></p>
										</li>
										";
								}
								else if ($_GET['tipo']=="resultados"){
									echo "<li class='first'>
											<h3><em><img src='images/mesa.png' alt='' width='50' height='50' class='alignleft border' /></em>Consultar resultados por Mesa</h3><br/>
											<p><a href='ResultadosMesa.php' class='button-style'>Resultados por Mesa</a></p>
										</li>
										<li>
											<h3><em><img src='images/centro.png' alt='' width='50' height='50' class='alignleft border' /></em>Consultar Resultados por Centro</h3><br/>
											<p><a href='ResultadosCentro.php' class='button-style'>Resultados por Centro</a></p>
										</li>
										<li>
											<h3><em><img src='images/municipio.png' alt='' width='50' height='50' class='alignleft border' /></em>Consultar Resultados por Municipio</h3><br/>
											<p><a href='ResultadosMunicipio.php' class='button-style'>Resultados por Municipio</a></p>
										</li>
										";
								}
							}
						?>
						</ul>
					</div>
				</div>
				<div id="sidebar">
					<table>
						<tr>
							<td><img src="images/usuario1.png" width="70" height="70" /></td>
							<td><h2>
							<?php 
								if(isset($_SESSION['usuario'])){
									echo $_SESSION['usuario'];
								}
								else{
									echo "Visitante";
								}
							?>
							</h2></td>
						</tr>
					</table>
					<ul class="style3">
						<li class="first">
						<?php 
							if (isset($_SESSION['usuario'])){
								if ($_SESSION['nivel'] == 1){
									echo "<p><a href='menu.php?tipo=usuario'>Gestionar Usuarios del Sistema</a></p>";
								}
							}
						?>
						</li>						
						<?php 
							if (isset($_SESSION['usuario'])){
								if ($_SESSION['nivel'] == 1){
									echo "<li><p><a href='menu.php?tipo=municipio'>Gestionar Municipios</a></p></li>";
									echo "<li><p><a href='menu.php?tipo=centro'>Gestionar Centros de Votación</a></p></li>";
									echo "<li><p><a href='menu.php?tipo=partido'>Gestionar Partidos</a></p></li>";
									echo "<li><p><a href='menu.php?tipo=candidato'>Gestionar Candidaturas</a></p></li>";
								}
								
								if ($_SESSION['nivel'] <= 2){
									echo "<li><p><a href='menu.php?tipo=votante'>Gestionar Votantes</a></p></li>";
									echo "<li><p><a href='simulacion.php'>Simulación de Voto</a></p></li>";
								}
							}							
						?>
						<li>
							<p><a href="menu.php?tipo=resultados">Presentación de Resultados</a></p>
						</li>
					</ul>
				</div>
			</div>
			<div id="footer">
				<p>Copyright (c) 2013 UNEFA</p>
			</div>
		</div>
	</body>
</html>
