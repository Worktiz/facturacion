<?php 
	
	include "../conexion.php";

	if (!empty($_POST)) {
		$alert= '';
		if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol'])) {
			$alert= '<p class=""msg_error">Todos Los Campos Son Obligatorios</p>';
		}else{
			

			$nombre = $_POST['nombre'];
			$email = $_POST['correo'];
			$user = $_POST['usuario'];
			$clave = md5($_POST['clave']);
			$rol = $_POST['rol'];



			$query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email' ");

			$result = mysqli_fetch_array($query);

			if ($result > 0) {
				$alert = '<p class="msg_error">El Correo o El Usuario Ya existe</p>';

			} else {
				$query_insert = mysqli_query($conection,"INSERT INTO usuario(nombre,correo,usuario,clave,rol) VALUES('$nombre' ,'$email', '$user', '$clave',  '$rol')");

				if ($query_insert) {
					$alert = '<p class="msg_save">Usuario Creado Correctamente</p>';
				}else{
					$alert = '<p class="msg_error">Error al Crear el Usuario</p>';
				}
			}
		
	}

}
?>







<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
<title> SisFinCo | Registro </title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
	
		<div class="form_register">
			<h1>Registro Usuario </h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">
				<label for="correo">Correo Electronico</label>
				<input type="email" name="correo" id="correo" placeholder="Ingrese Correo">
				<label for="usuario">Usuario</label>
				<input type="usuario" name="usuario" id="usuario" placeholder="Ingrese Usuario">
				<label for="clave">Contraseña</label>
				<input type="password" name="clave" id="clave" placeholder="Ingrese Contraseña">
				<label for="rol">Tipo de Usuario</label>


				<?php          

				$query_rol = mysqli_query($conection,"SELECT * FROM rol");
				$result_rol = mysqli_num_rows($query_rol);

				 ?>


				<select name="rol" id="rol">


						<?php          
				if ($result_rol > 0) {
				
				while ($rol = mysqli_fetch_array($query_rol)){
					?>
					<option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"]; ?> </option>
					<?php
				}
				 
					
				}
				?>
					
					
				</select>
				<input type="submit" value="Crear Usuario" class="btn_save">
			</form>



		</div>

	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>