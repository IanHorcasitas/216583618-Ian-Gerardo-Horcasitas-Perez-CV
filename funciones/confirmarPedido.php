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

    //OBTENER ID DEL PEDIDO ACTIVO//
    $sql = "UPDATE PEDIDOS SET STATUS=0 WHERE STATUS=1";
    $res = $con->query($sql);

    header("Location: ../carrito02.php?id=$idPed")
?>