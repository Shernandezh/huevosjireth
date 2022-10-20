<?php
include ("conexion.php");

$nombre=$_POST["user"];
$correo=$_POST["email"];
$contraseña=$_POST["password"];
$contraseña=hash('sha512',$contraseña);

$create="INSERT INTO usuarios (Nombre, Correo, Contraseña) VALUES ('$nombre','$correo','$contraseña')";
$result=mysqli_query($conx,$create);

if($result){
    echo "<script>alert('Usuario registrado');window.location='/hj/view/login.php';</script>";
}else{
    echo "<script>alert('No se realizo el registro');window.history.go(-1)</script>";
}