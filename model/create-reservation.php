<?php
include("conexion.php");

$user = $_POST["username"];
$product = $_POST["product"];
$price = $_POST["price"];
$cant = $_POST["amount"];
$date = date("d/m/y");
$time = time();

$reserv="INSERT INTO reservas (Cliente,Producto,Precio,Cantidad,Fecha,Hora) VALUES ('$user','$product','$price','$cant',now(),now())";
$result=mysqli_query($conx,$reserv);

if($result){
    echo "<script>alert('Reserva guardada. Tienes 3 horas para reclamar el producto.');window.location='/hj/view/user-home.php';</script>";
}else{
    echo "<script>alert('No se pudo');window.history.go(-1);</script>";
}
?>