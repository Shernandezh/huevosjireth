<?php
if(!isset($_SESSION['usuario'])){
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
	<link rel="shortcut icon" href="/hj/images/logo.png" type="image/x-icon">
	<link rel="stylesheet" href="/hj/css/header.css">
	<title>Huevos Jireth</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg" style="background-color: #ff9710;">
  		<div class="container-fluid">
    		<a class="navbar-brand" href="/hj/view/user.php">
				<img src="/hj/images/logo.png" alt="HuevosJireth" height="50">
			</a>
    		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      			<span class="navbar-toggler-icon"></span>
    		</button>
    		<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      			<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" style="color:black;" href="/hj/view/user-home.php"><b><?php echo $_SESSION['usuario']?></b></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" style="color:white;" href="#reservar">Reservar</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" style="color:white;" href="#productos">Productos</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" style="color:white;" href="#recetas">Recetas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" style="color:white;" href="/hj/view/mision2.php">Misión/Visión</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" style="color:white;" href="/hj/model/close_session.php">
							<i class='bx bx-log-in' title="Cerrar Sesión"></i>
						</a>
					</li>
      			</ul>
    		</div>
  		</div>
	</nav>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>