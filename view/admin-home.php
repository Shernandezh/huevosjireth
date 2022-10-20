<?php
include ("../model/conexion.php");
session_start();
if(!isset($_SESSION['usuario'])){
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
$totalusers="SELECT COUNT(*) AS total FROM usuarios WHERE idRol !='1'";
$result=mysqli_query($conx,$totalusers);
$row=mysqli_fetch_assoc($result);

$ingresos="SELECT SUM(Total) suma FROM reservas WHERE Estado='Retirado'";
$query=mysqli_query($conx,$ingresos);
$column=mysqli_fetch_assoc($query);

$reservas="SELECT COUNT(*) vigentes FROM reservas WHERE Estado='Vigente'";
$consulta=mysqli_query($conx,$reservas);
$estado=mysqli_fetch_assoc($consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="/hj/css/dshbadmin.css">
    <link rel="shortcut icon" href="/hj/images/logo.png" type="image/x-icon">
    <title>Panel de Control | Huevos Jireth</title>
</head>
<body>
    <!--SIDEBAR-->
    <div class="main">
        <div class="sidebar">
            <center><a href="/hj/view/admin-home.php"><img src="/hj/images/logo.png" id="logo"></a></center>
            <ul>
                <li>
                    <a href="/hj/view/admin-home.php">
                        <i class='bx bxs-home' title="Principal"></i>
                        <span class="item">Principal</span>
                    </a>
                </li>
                <li>
                    <a href="/hj/view/admin-clients.php">
                        <i class='bx bxs-user' title="Clientes"></i>
                        <span class="item">Clientes</span>
                    </a>
                </li>
                <li>
                    <a href="/hj/view/admin-reservs.php">
                        <i class='bx bxs-bookmark-minus' title="Reservas"></i>
                        <span class="item">Reservas</span>
                    </a>
                </li>
                <li>
                    <a href="/hj/view/admin-products.php">
                        <i class='bx bxs-box' title="Productos"></i>
                        <span class="item">Productos</span>
                    </a>
                </li>
                <li>
                    <a href="/hj/view/admin-messages.php">
                        <i class='bx bxs-envelope' title="Mensajes"></i>
                        <span class="item">Mensajes</span>
                    </a>
                </li>
            </ul>
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
            <div class="stats">
                <div class="inf">
                    <i class='bx bxs-user'></i>
                    <div>
                        <h5>Clientes</h5>
                        <span><?php echo $row["total"]?></span>
                    </div>
                </div>
                <div class="inf">
                    <i class='bx bxs-bookmark-minus'></i>
                    <div>
                        <h5>Reservas</h5>
                        <span><?php echo $estado["vigentes"]?></span>
                    </div>
                </div>
                <div class="inf">
                    <i class='bx bx-dollar'></i>
                    <div>
                        <h5>Ingresos</h5>
                        <span><?php echo $column['suma']?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/hj/js/menu.js"></script>
    <script src="/hj/js/modal-user.js"></script>
</body>
</html>