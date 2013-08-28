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
							<li><a href="listarCentros.php" accesskey="3" title="Datos de centros de votación">Centros</a></li>
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
						<p>En las próximas <strong>Elecciones municipales</strong> se eligen a las próximas autoridades que regirán los destinos de las 335 municipios en todo el territorio nacional en sus 23 estados y el Distrito Capital.</p>
					</div>
					<div>
						<ul class="style1">
							<li class="first">
								<?php 
									if(isset($_GET['comando'])){
										if($_GET['comando'] == "AgregarPExito"){
											echo "Partido agregado exitosamente!";
										}
										else if ($_GET['comando'] == "AgregarPFracaso"){
											echo "Error al agregar partido";
										}
									}
								?>
							</li>
							<li>
								
							</li>
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
