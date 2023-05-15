<?php
require "funciones/conecta.php";
$con = conecta();

//RECIBE VARIABLES//
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['contrasena'];
$passEnc = md5($pass);

$sql = "INSERT INTO usuarios (NOMBRE, APELLIDOS, CORREO, PASS) VALUES 
        ('$nombre','$apellidos','$correo','$passEnc')";

$res = $con -> query($sql);

header("Location: iniciarSesion.php")

?>