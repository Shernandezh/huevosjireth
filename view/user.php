<?php
session_start();
if(!isset($_SESSION['usuario'])){
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
include ("../model/conexion.php");
$products="SELECT * FROM productos";
$I = array(
    "/hj/images/bg_huevos1.jpg",
    "/hj/images/bg_huevos2.jpg",
    "/hj/images/bg_huevos3.jpg",
    "/hj/images/bg_huevos4.jpg"
);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/hj/css/inicio.css">
    <link rel="shortcut icon" href="/hj/images/logo.png" type="image/x-icon">
</head>
<body>
    <?php include ("../view/template/header_user.php")?>
    <!--SLIDER-->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/hj/images/huevos1.jpg" class="d-block w-100" alt="Huevos 1">
            </div>
            <div class="carousel-item">
                <img src="/hj/images/huevos2.jpg" class="d-block w-100" alt="Huevos 2">
            </div>
            <div class="carousel-item">
                <img src="/hj/images/huevos3.jpg" class="d-block w-100" alt="Huevos 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!--PRODUCTOS-->
    <?php $nImg = 0;?>   
    <section id="productos">
        <div class="barrita">
            <br>
            <h1>PRODUCTOS</h1>
            <br>
        </div>      
        <div class="productos">
        <?php $show=mysqli_query($conx,$products);
        while($row=mysqli_fetch_assoc($show)) { ?>
            <div class="pedaso" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3)), url(<?php echo $I[$nImg];?>);">
                <?php $nImg = $nImg + 1;?>
                <h1><?php echo $row["Nombre"]?></h1>
                <p>$<?php echo $row["Precio"]?></p>
                <p style="color: greenyellow">Cantidad disponible: <?php echo $row["Cantidad"]?> Panales</p>
                <p><?php echo $row["Descripcion"]?></p>
            </div>
            <?php } mysqli_free_result($show);?>
        </div>
    </section>

    <!--RESERVAS-->
    <section id="reservar" class="reservation">
        <center>
            <button class="btn-rsv" data-bs-toggle="modal" href="#exampleModalToggle">Reservar</button>
        </center>
        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="/hj/model/create-reservation.php" method="post">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalToggleLabel">¡HAZ TU RESERVA YA!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <center><input type="hidden" id="user_reserv" value="<?php echo $_SESSION['usuario']?>" readonly name="username"></center>
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
                            <label class="form-label">Panales</label>
                            <input id="cantidad" type="number" name="amount" min="1" max="5" pattern="^[0-9]" oninput="calcular()" style="outline: none;">
                            <br><br>
                            <label class="form-label">Valor total</label>
                            <br>
                            <h3><p>$<span id="total"></span></p></h3>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Reservar</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!--RECETAS-->
    <section id="recetas">
        <div class="nreceta">
            <br>
            <h1>RECETAS</h1>
            <br>
        </div>
        <div class="recetas">
            <div class="receta">
                <img src="/hj/images/receta1.jpg" alt="Receta 1">
                <h1>HUEVOS A LA FLAMENCA</h1>
                <a href="/hj/view/recetaA.php" class="re">Ver más</a> 
            </div>
            <div class="receta">
                <img src="/hj/images/receta2.jpg" alt="Receta 2">
                <h1>HUEVOS BENEDICTOS</h1>
                <a href="/hj/view/recetaB.php" class="re">Ver más</a> 
            </div>
            <div class="receta">
                <img src="/hj/images/receta3.jpg" alt="Receta 3">
                <h1>HUEVOS CON PURE DE AGUACATE</h1>
                <a href="/hj/view/recetaC.php" class="re">Ver más</a> 
            </div>
            <div class="receta">
                <img src="/hj/images/receta1.jpg" alt="Receta 4">
                <h1>HUEVOS TURCOS</h1>
                <a href="/hj/view/recetaD.php" class="re">Ver más</a> 
            </div>
        </div>
    </section>

    <?php include ("../view/template/footer.php")?>
    <script src="/hj/js/select.js"></script>
    <script src="/hj/js/modal-rsv.js"></script>
</body>
</html>