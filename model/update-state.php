<?php
include("../model/conexion.php");

//CAMBIAR ESTADO//
$id=$_GET["id"];
$v="UPDATE reservas SET Estado='Retirado' WHERE idReserva='$id'";
$result=mysqli_query($conx,$v);

if($result){
    header("location:../view/admin-reservs.php");
}else{
    echo "Error";
}

//RESTAR CANTIDAD//
$id=$_GET["id"];
$c="SELECT Cantidad AS cant FROM reservas WHERE idReserva='$id'";
$cr=mysqli_query($conx,$c);
$cc=mysqli_fetch_assoc($cr);

$p="SELECT Producto AS prd FROM reservas WHERE idReserva='$id'";
$pz=mysqli_query($conx,$p);
$px=mysqli_fetch_assoc($pz);

$up="UPDATE productos SET Cantidad=(Cantidad - {$cc["cant"]}) WHERE Nombre='{$px["prd"]}'";
$upx=mysqli_query($conx,$up);

if($upx){
    header("location:../view/admin-reservs.php");
}else{
    echo "Error";
}
?>