<?php 	
	session_start();
	$alert = '';
	
	
	if (!empty($_SESSION)) {
		header('location: sistema/');
	}else{

	if (!empty($_POST)) {
		if (empty($_POST['usuario']) || empty($_POST['clave'])) {
			$alert = "Inserte su Usuario y Contraseña";
		}else{
			require_once "conexion.php";

			$user = mysqli_real_escape_string($conection,$_POST['usuario']);
			$pass = md5(mysqli_real_escape_string($conection,$_POST['clave']));

			$query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$pass'");
			$result = mysqli_num_rows($query);

			if ($result > 0 ) {
				$data = mysqli_fetch_array($query);

				$_SESSION['active'] = true;
				$_SESSION['idUser'] = $data['idusuario'];
				$_SESSION['nombre'] = $data['nombre'];
				$_SESSION['email'] = $data['email'];
				$_SESSION['rol'] = $data['rol'];

				header('location: sistema/');
			}else{
				$alert = "El usuario o la clave son incorrectos";
				session_destroy();
			}
		}
		}
	}



?>



<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="css/stilo.css">
	<title>Login | Sisfinco</title>
</head>
<body>
	<section id="container">
		<form action="" method="post">
			<h3>Iniciar Sesiòn</h3> 

			<input type="text" name="usuario" placeholder="Ingrese Usuario">
			<input type="password" name="clave" placeholder="Ingrese Contraseña">
			<div class="alert"><?php echo isset($alert)? $alert : ''; ?></div>
			<input type="submit" value="Ingresar" class="ingreso">
		</form>

	</section>

</body>
</html>