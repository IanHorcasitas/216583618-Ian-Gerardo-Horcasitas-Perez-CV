<?php
session_name("usuarios");
session_start();
$nombreS = ($_SESSION['nombre']);

require "conecta.php";
$con = conecta();

//ELIMINAR PEDIDOS ABIERTOS//
$sqlU = "SELECT COUNT(*) num FROM PEDIDOS WHERE usuario = '$nombreS' and status=1";
$resU = $con ->query($sqlU);
while($row = $resU -> fetch_array())
{
    $numPed = $row["num"];
}
echo $numPed;
if($numPed>0)
{
    //OBTENER ID DEL PEDIDO//
    $sqlID = "SELECT * FROM PEDIDOS WHERE usuario = '$nombreS' and status=1";
    $resID = $con ->query($sqlID);
    while($row = $resID -> fetch_array())
    {
        $idPed = $row["id"];
    }

    echo $idPed;

    //ELIMINAR DETALLES//
    $sqlD = "DELETE FROM PEDIDOS_PRODUCTOS WHERE id_pedido = $idPed";
    $resD = $con ->query($sqlD);

    //ELIMINAR PEDIDO//
    $sqlDP = "DELETE FROM PEDIDOS WHERE id = $idPed";
    $resDP = $con ->query($sqlDP);
}

session_destroy();
header("Location: ../index.php")
?>