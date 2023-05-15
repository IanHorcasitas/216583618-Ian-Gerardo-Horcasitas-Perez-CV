<?php
    require "conecta.php";
    $con = conecta();
    $correo = $_REQUEST['correo'];
    if(!empty($correo))
    {
        $sql = "SELECT COUNT(*) total FROM `usuarios` WHERE correo = lower('$correo')";

        $res = $con -> query($sql);
        $total = $res->fetch_assoc()['total'];
    }
    else
    {
        $total=-1;
    }  
    echo $total;
?>