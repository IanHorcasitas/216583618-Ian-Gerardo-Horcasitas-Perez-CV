<?php
require "conecta.php";
$con = conecta();

//MENSAJE DE CONFIRMACION//

//RECIBE VARIABLES
$id = $_REQUEST['id'];
$cant = $_REQUEST['cantidad'];

/*PARA ELIMINAR
$sql = "DELETE FROM BANNERS WHERE ID = $id";*/

$sql = "UPDATE pedidos_productos SET cantidad = '$cant'  WHERE ID = $id";

$res = $con ->query($sql);

header("Location: ../carrito01.php");
?>