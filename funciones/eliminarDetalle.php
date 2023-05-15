<?php
require "conecta.php";
$con = conecta();

//MENSAJE DE CONFIRMACION//

//RECIBE VARIABLES
$id = $_REQUEST['id'];

//OBTENER CUANTOS PRODUCTOS SE AGREGARON//
$sqlU = "SELECT * FROM PEDIDOS_PRODUCTOS WHERE ID = $id";
$resU = $con ->query($sqlU);
while($row = $resU -> fetch_array())
{
    $idProducto = $row["id_producto"];
    $cantidad = $row["cantidad"];
}

//OBTENER CUANTOS PRODUCTOS HAY//
$sqlSP = "SELECT * FROM PRODUCTOS WHERE ID = $idProducto";
$resSP = $con ->query($sqlSP);
while($row = $resSP -> fetch_array())
{
    $cantidadProd = $row["stock"];
}

//REGRESAR PRODUCTOS AL STOCK//
$sqlP = "UPDATE PRODUCTOS SET stock = $cantidadProd + $cantidad WHERE ID = $idProducto";
$resP = $con ->query($sqlP);

//ELIMINAR DETALLE//
$sql = "DELETE FROM PEDIDOS_PRODUCTOS WHERE ID = $id";

$res = $con ->query($sql);

header("Location: ../carrito01.php");
?>