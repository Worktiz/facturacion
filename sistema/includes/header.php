<?php 

session_start();
	if (empty($_SESSION)) {
		header('location: ../');
	}

?>

<header>
		<div class="header">	
			<h1>Sistema de Financiamiento y Cobranza</h1>
			<div class="optionsBar">
				<p>Venezuela, <?php echo fechaC(); ?></p>
				<span>|</span>
				<span class="user"><?php echo $_SESSION['nombre']; ?></span>
				<img class="photouser" src="img/user.png" alt="Usuario">
				<a href="../salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>
		<?php include "includes/nav.php"; ?>
	</header>