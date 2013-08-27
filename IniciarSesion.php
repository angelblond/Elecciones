<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Iniciar Sesión</title>
		<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
	</head>
	<body id="login-bg"> 
	 
		<!-- Start: login-holder -->
		<div id="login-holder">

			<!-- start logo -->
			
			<div id="logo-login">
				<h1 style="color:#fff">Ingresar al Sistema</h1>
			</div>
			<!-- end logo -->
			
			<div class="clear"></div>
			
			<!--  start loginbox ................................................................................. -->
			<div id="loginbox">
			
				<!--  start login-inner -->
				<div id="login-inner">
					<form action="controlSesion.php" method="post" >
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<th>Usuario</th>
								<td><input name="usuario" type="text"  class="login-inp" /></td>
							</tr>
							<tr>
								<th>Clave</th>
								<td><input name="clave" type="password" value="************"  onfocus="this.value=''" class="login-inp" /></td>
							</tr>
							<tr>
								<th></th>
								<td valign="top"><font color="red">
								<?php 
									if (isset($_GET['msg'])){
										if ($_GET['msg']=="error"){
											echo "Usuario o clave errada";
										}
									}
								?>						
								</font></td>
							</tr>
							<tr>
								<th></th>
								<td><input type="submit" class="submit-login"  /></td>
							</tr>
						</table>
					</form>
				</div>
				<!--  end login-inner -->
				<div class="clear"></div>
			</div>
			<!--  end loginbox -->
		</div>
		<!-- End: login-holder -->
	</body>
</html>