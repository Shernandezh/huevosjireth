<?php
include ("../model/conexion.php");
session_start();
if(!isset($_SESSION['usuario'])){
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
$user="SELECT * FROM usuarios WHERE Nombre='$_SESSION[usuario]'";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="shortcut icon" href="/hj/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/hj/css/dshbuser.css">
    <script src="/hj/js/validation.js"></script>
    <title>Huevos Jireth</title>
</head>
<body>
    <!--SIDEBAR-->
    <div class="main">
        <div class="sidebar">
            <center><a href="/hj/view/user.php"><img src="/hj/images/logo.png" id="logo"></a></center>
            <ul>
                <li>
                    <a href="/hj/view/user-home.php">
                        <i class='bx bxs-home' title="Principal"></i>
                        <span class="item">Principal</span>
                    </a>
                </li>
                <li>
                    <a href="/hj/view/user-pqrs.php">
                        <i class='bx bxs-message-dots' title="Clientes"></i>
                        <span class="item">PQRS</span>
                    </a>
                </li>
            </ul>
        </div>

        <!--NAVBAR-->
        <div class="content">
            <div class="navbar">
                <div class="n1">
                    <i class='bx bx-menu' id="btn-menu"></i>
                    <h2>MIS RESERVAS</h2>
                </div>
                <div class="n2">
                    <h4><?php echo $_SESSION['usuario']?></h4>
                    <a href="/hj/model/close_session.php">
                        <i class='bx bx-log-in' title="Cerrar Sesión"></i>
                    </a>
                </div>
            </div>

            <!--PQRS-->
            <div style="padding: 2%;">
            <?php $show=mysqli_query($conx,$user);
            while($row=mysqli_fetch_assoc($show)) { ?>
                <form action="/hj/model/create-pqrs.php" method="post" onsubmit="return pqrs(event)">
                    <div class="text">
                        <h2>Formulario PQRS</h2>
                        <p>Si tienes una pregunta, queja, reclamo o sugerencia, puedes enviar tu inquietud en este formulario y te responderemos por medio de correo electrónico o teléfono.</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input class="form-control" type="text" value="<?php echo $row["Nombre"]?>" name="name" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input class="form-control" type="email" value="<?php echo $row["Correo"]?>" name="email" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input id="tel" type="text" class="form-control" name="phone" onkeypress="return solonumeros(event);">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mensaje</label>
                        <textarea id="text" class="form-control" name="message" cols="30" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            <?php } mysqli_free_result($show)?>
            </div>
        </div>
    </div>
</body>
</html>