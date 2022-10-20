<?php
include ("../model/conexion.php");
session_start();
if(!isset($_SESSION['usuario'])){
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
include("../model/conexion.php");
$reservs1="SELECT * FROM reservas WHERE Estado='Vigente' ORDER BY Hora DESC";
$reservs2="SELECT * FROM reservas WHERE Estado='Retirado' ORDER BY idReserva DESC";
$reservs3="SELECT * FROM reservas WHERE Estado='Cancelado' ORDER BY idReserva DESC";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/hj/css/dshbadmin.css">
    <link rel="shortcut icon" href="/hj/images/logo.png" type="image/x-icon">
    <title>Panel de Control (Reservas) | Huevos Jireth</title>
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
                    <h2>RESERVAS</h2>
                </div>
                <div class="n2">
                    <h4><?php echo $_SESSION['usuario']?></h4>
                    <a href="/hj/model/close_session.php">
                        <i class='bx bx-log-in' title="Cerrar Sesión"></i>
                    </a>
                </div>
            </div>

            <!--TABLA DE RESERVAS-->
            <div style="padding: 2%;">
                <table class="table table-hover table-bordered border-warning" style="text-align: center;">
                    <thead class="table-warning">
                        <tr>
                            <th scope="col">Cliente</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Panales</th>
                            <th scope="col">Total</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Estado</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $show=mysqli_query($conx,$reservs1);
                    while($row=mysqli_fetch_assoc($show)) { ?>
                        <tr>
                            <td><?php echo $row["Cliente"]?></td>
                            <td><?php echo $row["Producto"]?></td>
                            <td>$<?php echo $row["Precio"]?></td>
                            <td><?php echo $row["Cantidad"]?></td>
                            <td>$<?php echo $row["Total"]?></td>
                            <td><?php echo $row["Fecha"]?></td>
                            <td><?php echo $row["Hora"]?></td>
                            <td style="color:gold"><?php echo $row["Estado"]?></td>
                            <td>
                                <a style="text-decoration: none;" href="/hj/model/update-state.php?id=<?php echo $row["idReserva"]?>">
                                    <button type="submit" class="btn btn-warning btn-sm rr">Retirar</button>
                                </a>
                                <a style="text-decoration: none;" href="/hj/model/cancel-reserv1.php?id=<?php echo $row["idReserva"]?>">
                                    <button type="submit" class="btn btn-danger btn-sm cr">Cancelar</button>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php $show2=mysqli_query($conx,$reservs2);
                    while($row2=mysqli_fetch_assoc($show2)) { ?>
                        <tr>
                            <td><?php echo $row2["Cliente"]?></td>
                            <td><?php echo $row2["Producto"]?></td>
                            <td>$<?php echo $row2["Precio"]?></td>
                            <td><?php echo $row2["Cantidad"]?></td>
                            <td>$<?php echo $row2["Total"]?></td>
                            <td><?php echo $row2["Fecha"]?></td>
                            <td><?php echo $row2["Hora"]?></td>
                            <td style="color:green"><?php echo $row2["Estado"]?></td>
                            <td></td>
                        </tr>
                    <?php } ?>
                    <?php $show3=mysqli_query($conx,$reservs3);
                    while($row3=mysqli_fetch_assoc($show3)) { ?>
                        <tr>
                            <td><?php echo $row3["Cliente"]?></td>
                            <td><?php echo $row3["Producto"]?></td>
                            <td>$<?php echo $row3["Precio"]?></td>
                            <td><?php echo $row3["Cantidad"]?></td>
                            <td>$<?php echo $row3["Total"]?></td>
                            <td><?php echo $row3["Fecha"]?></td>
                            <td><?php echo $row3["Hora"]?></td>
                            <td style="color:red"><?php echo $row3["Estado"]?></td>
                            <td></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="/hj/js/menu.js"></script>
    <script src="/hj/js/modal-user.js"></script>
    <script src="/hj/js/confirmation.js"></script>
</body>
</html>