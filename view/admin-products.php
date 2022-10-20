<?php
include ("../model/conexion.php");
session_start();
if(!isset($_SESSION['usuario'])){
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
$products="SELECT * FROM productos";
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
    <title>Panel de Control (Productos) | Huevos Jireth</title>
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
                    <h2>PRODUCTOS</h2>
                </div>
                <div class="n2">
                    <h4><?php echo $_SESSION['usuario']?></h4>
                    <a href="/hj/model/close_session.php">
                        <i class='bx bx-log-in' title="Cerrar Sesión"></i>
                    </a>
                </div>
            </div>

            <!--TABLA DE PRODUCTOS-->
            <div style="padding: 2%;">
                <table class="table table-hover table-bordered border-info text center">
                    <thead class="table-info">
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $show=mysqli_query($conx,$products);
                    while($row=mysqli_fetch_assoc($show)) { ?>
                        <tr>
                            <td><?php echo $row["Nombre"]?></td>
                            <td>$<?php echo $row["Precio"]?></td>
                            <td style="text-align: center;"><?php echo $row["Cantidad"]?></td>
                            <td><?php echo $row["Descripcion"]?></td>
                            <td class="col align-self-center text-center">
                                <a href="/hj/view/admin-product-edit.php?id=<?php echo $row["idProducto"]?>" style="text-decoration: none;">
                                    <button class="btn btn-success btn-sm" title="Editar">
                                        <i class='bx bxs-pencil'></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php } mysqli_free_result($show)?>
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