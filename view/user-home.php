<?php
include ("../model/conexion.php");
session_start();
if(!isset($_SESSION['usuario'])){
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
//Vigentes
$myrsv1="SELECT * FROM reservas WHERE Cliente = '$_SESSION[usuario]' AND Estado = 'Vigente'";
$conteo1="SELECT COUNT(*) AS conteo FROM reservas WHERE Cliente = '$_SESSION[usuario]' AND Estado = 'Vigente'";
$result1=mysqli_query($conx,$conteo1);
$ok1=mysqli_fetch_assoc($result1);
//Retirados
$myrsv2="SELECT * FROM reservas WHERE Cliente = '$_SESSION[usuario]' AND Estado = 'Retirado'";
$conteo2="SELECT COUNT(*) AS conteo FROM reservas WHERE Cliente = '$_SESSION[usuario]' AND Estado = 'Retirado'";
$result2=mysqli_query($conx,$conteo2);
$ok2=mysqli_fetch_assoc($result2);
//Cancelados
$myrsv3="SELECT * FROM reservas WHERE Cliente = '$_SESSION[usuario]' AND Estado = 'Cancelado'";
$conteo3="SELECT COUNT(*) AS conteo FROM reservas WHERE Cliente = '$_SESSION[usuario]' AND Estado = 'Cancelado'";
$result3=mysqli_query($conx,$conteo3);
$ok3=mysqli_fetch_assoc($result3);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/hj/css/dshbuser.css">
    <link rel="shortcut icon" href="/hj/images/logo.png" type="image/x-icon">
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
                        <i class='bx bxs-home' title="Principal"></i><span class="item">Reservas</span>
                        
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
                        <span class="item">Cambiar clave</span>
                    </a>
                </li>
                <li>
                    <a href="/hj/view/user.php">
                        <i class='bx bxs-home' title="Principal"></i>
                        <span class="item">Volver a inicio</span>
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

            <!--TICKETS-->
            <div class="tickets">
                <h2>Reservas Vigentes (<?php echo $ok1["conteo"]?>)</h2>
                <div class="tarjetasA">
                    <?php $show=mysqli_query($conx,$myrsv1);
                    while($row=mysqli_fetch_assoc($show)) { ?>
                    <div class="tkt1">
                        <p>Producto: <?php echo $row["Producto"]?></p>
                        <p>Precio: $<?php echo $row["Precio"]?></p>
                        <p>Cantidad: <?php echo $row["Cantidad"]?> panales</p>
                        <p>Total: $<?php echo $row["Total"]?></p>
                        <p>Fecha: <?php echo $row["Fecha"]?></p>
                        <p>Hora: <?php echo $row["Hora"]?></p>
                        <p>Estado: <span style="color:gold"><?php echo $row["Estado"]?></span></p>
                        <br>
                        <center>
                            <a href="/hj/model/cancel-reserv2.php?id=<?php echo $row["idReserva"]?>">
                                <button type="button" class="btn btn-danger btn-sm cr">Cancelar</button>
                            </a>
                            <a href="/hj/view/user-edit-reserv.php?id=<?php echo $row["idReserva"]?>">
                                <button type="button" class="btn btn-warning btn-sm cr">Editar</button>
                            </a>
                        </center>
                    </div>
                    <?php } ?>
                </div>
                
                <h2>Reservas Exitosas (<?php echo $ok2["conteo"]?>)</h2>
                <div class="tarjetasB">
                    <?php $show=mysqli_query($conx,$myrsv2);
                    while($row=mysqli_fetch_assoc($show)) { ?>
                    <div class="tkt2">
                        <p>Producto: <?php echo $row["Producto"]?></p>
                        <p>Precio: $<?php echo $row["Precio"]?></p>
                        <p>Cantidad: <?php echo $row["Cantidad"]?> panales</p>
                        <p>Total: $<?php echo $row["Total"]?></p>
                        <p>Fecha: <?php echo $row["Fecha"]?></p>
                        <p>Hora: <?php echo $row["Hora"]?></p>
                        <p>Estado: <span style="color:green"><?php echo $row["Estado"]?></span></p>
                    </div>
                    <?php } ?>
                </div>

                <h2>Reservas Canceladas (<?php echo $ok3["conteo"]?>)</h2>
                <div class="tarjetasC">
                    <?php $show=mysqli_query($conx,$myrsv3);
                    while($row=mysqli_fetch_assoc($show)) { ?>
                    <div class="tkt3">
                        <p>Producto: <?php echo $row["Producto"]?></p>
                        <p>Precio: $<?php echo $row["Precio"]?></p>
                        <p>Cantidad: <?php echo $row["Cantidad"]?> panales</p>
                        <p>Total: $<?php echo $row["Total"]?></p>
                        <p>Fecha: <?php echo $row["Fecha"]?></p>
                        <p>Hora: <?php echo $row["Hora"]?></p>
                        <p>Estado: <span style="color:red"><?php echo $row["Estado"]?></span></p>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script src="/hj/js/menu.js"></script>
    <script src="/hj/js/confirmation.js"></script>
</body>
</html>