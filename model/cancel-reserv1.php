<?php
include("../model/conexion.php");

$id=$_GET["id"];
$cancel="UPDATE reservas SET Estado='Cancelado' WHERE idReserva='$id'";
$check=mysqli_query($conx,$cancel);

if($check){
    header("location:../view/admin-reservs.php");
}else{
    echo "<script>alert('No se pudo');window.history.go(-1);</script>";
}
?>