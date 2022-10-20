<?php
include ("../../model/conexion.php");
session_start();
if(!isset($_SESSION['usuario'])){
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/template/login.php';</script>";
    session_destroy();
    die();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="/hj/css/dshbadmin.css">
    <link rel="stylesheet" href="/hj/css/responsive.css">
    <link rel="stylesheet" href="/hj/css/personaldata.css">
    <title>Actualizar Contraseña</title>
</head>
<body>
    <!--SIDEBAR-->
    <div class="main">
        <div class="sidebar">
            <center><a href="/hj/view/dshb_home.php"><img src="/hj/images/Logo.png" id="logo"></a></center>
            <ul>
            <ul>
                <li>
                    <a href="/hj/view/user-home.php">
                        <i class='bx bxs-home' title="Principal"></i>
                        <span class="item">Reservas</span>
                    </a>
                </li>
                <li>
                    <a href="/hj/view/user-pqrs.php">
                        <i class='bx bxs-message-dots' title="Clientes"></i>
                        <span class="item">PQRS</span>
                    </a>
                </li>
                <li>
                    <a href="/hj/view//template/personaldata.php">
                    <i class='bx bxs-envelope'></i>
                        <span class="item">Cambiar Correo</span>
                    </a>
                </li>
                <li>
                    <a href="/hj/view//template/personalContra.php">
                    <i class='bx bx-key' ></i>
                        <span class="item">Cambiar Clave</span>
                    </a>
                </li>
                <li>
                    <a href="/hj/view/user.php">
                        <i class='bx bxs-home' title="Principal"></i>
                        <span class="item">Volver a inicio</span>
                    </a>
                </li>
        </div>

        <!--NAVBAR-->
        <div class="content">
            <div class="navbar">
                <div class="n1">
                    <i class='bx bx-menu' id="btn-menu"></i>
                    <h2>PRINCIPAL</h2>
                </div>
                <div class="n2">
                    <h4><?php echo $_SESSION['usuario']?></h4>
                    <a href="/hj/model/close_session.php">
                        <i class='bx bx-log-in' title="Cerrar Sesión"></i>
                    </a>
                </div>
            </div>
            

            <!--STATS-->
            <div class="dataP">
                        <form class="formuG" action="/hj/model/updateContra.php" method="POST">
                        <center><h2>Actualizar contraseña</h2></center><br>
                        <?php foreach ($conx->query("SELECT * from usuarios WHERE Nombre = '".$_SESSION['usuario']."'") as $row){?>
                            <p>Contraseña Anterior</p>
                            <input type="password" name="contraseñaAnterior">
                            <input type="hidden" value="<?php echo $row["idUsuario"] ?>" name="id">
                            <p>Contraseña Nueva</p>
                            <input type="password" name="contraseñaNueva">
                            <center>
                            <input type="submit" value="Actualizar datos">
                            </center>
                            <?php } ?>
                        </form>
                        
                        
            </div>
        </div>
    </div>

    <script src="/hj/js/menu.js"></script>
    <script src="/hj/js/user_modal.js"></script>
</body>
</html>