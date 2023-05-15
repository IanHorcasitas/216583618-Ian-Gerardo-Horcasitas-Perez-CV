<?php
    require "conecta.php";
    $con = conecta();

    //OBTENER ID DEL PEDIDO ACTIVO//
    $sql = "SELECT * FROM PEDIDOS WHERE STATUS=1";
    $res = $con->query($sql);
    while($row = $res -> fetch_array())
    {
        $idPed = $row["id"];
    }

    //ELIMINAR TODOS LOS DETALLES//
    $sqlD = "DELETE FROM PEDIDOS_PRODUCTOS WHERE ID_PEDIDO = $idPed";
    $resD = $con->query($sqlD);

    //ELIMINAR PEDIDO ACTIVO//
    $sqlP = "DELETE FROM PEDIDOS WHERE ID = $idPed";
    $res = $con->query($sqlP);

    header("Location: ../carrito01.php")
?>