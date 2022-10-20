<?php
include ("../model/conexion.php");
session_start();
if(!isset($_SESSION['usuario'])){
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
$id=$_GET["id"];
$rsv="SELECT * FROM reservas WHERE idReserva='$id'";
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
    <link rel="shortcut icon" href="/hj/images/logo.png">
    <title>Editar reserva</title>
</head>
<body>
<div class="main">
        <div class="sidebar">
            <center><a href="/hj/view/user.php"><img src="/hj/images/logo.png" id="logo"></a></center>
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
                        <i class='bx bxs-message-dots' title="Clientes"></i>
                        <span class="item">Actualizar Correo</span>
                    </a>
                </li>
                <li>
                    <a href="/hj/view//template/personalContra.php">
                        <i class='bx bxs-message-dots' title="Clientes"></i>
                        <span class="item">Actualizar Contraseña</span>
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
                    <h2>EDITAR RESERVA</h2>
                </div>
                <div class="n2">
                    <h4><?php echo $_SESSION['usuario']?></h4>
                    <a href="/hj/model/close_session.php">
                        <i class='bx bx-log-in' title="Cerrar Sesión"></i>
                    </a>
                </div>
            </div>

            <!--TICKET-->
            <div style="padding: 2% ;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <?php $show=mysqli_query($conx,$rsv);
                    while($row=mysqli_fetch_assoc($show)) { ?>
                    <form action="/hj/model/updtreserv.php" method="post">
                    <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalToggleLabel">¡HAZ TU RESERVA YA!</h1>
                            
                        </div>
                        <div class="modal-body">
                            <center><input type=hidden id="user_reserv" value="<?php echo $row['Cliente']?>" readonly name="usuario"></center>
                            <label class="form-label">Escoje tu producto</label>
                            <select id="listproductos" name="product" class="form-select">
                                <option selected>Seleccione</option>
                            </select>
                            <br>
                            <label class="form-label">Precio</label>
                            <select id="listprecios" onselect="calcular()" name="price" class="form-select">
                                <option></option>
                            </select>
                            <br>
                            <label class="form-label">Cantidad</label>
                            <input id="cantidad" type="number" name="amount" min="1" max="5" pattern="^[1-5]" oninput="calcular()" style="outline: none;">
                            <br><br>
                            <label class="form-label">Valor total</label>
                            <br>
                            <h3><p>$<span id="total"></span></p></h3>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Reservar</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><a class="cancelarboton" href="/hj/view/user-home.php">Cancelar</a></button>
                        </div>
                    </form>
                    <?php } mysqli_free_result($show)?>
                </div>
            </div>
            </div>
        </div>
    </div>

    <script src="/hj/js/menu.js"></script>
    <script src="/hj/js/select.js"></script>
    <script src="/hj/js/modal-rsv.js"></script>
    
</body>
</html>
