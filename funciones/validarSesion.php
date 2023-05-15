<?php
    session_name("usuarios");
    session_start();

    require "conecta.php";
    $con = conecta();
    
    $user = $_REQUEST['usuario'];
    $pass = $_REQUEST['pass'];
    $passEnc = md5($pass);

    $sql = "SELECT COUNT(*) total FROM `usuarios` WHERE correo = '$user' AND pass = '$passEnc' AND eliminado = 0 AND status = 1";

    $res = $con -> query($sql);
    $total = $res->fetch_assoc()['total'];

    if($total == 1 || $total == "1")
    {
        $sql = "SELECT * FROM `usuarios` WHERE correo = '$user' AND pass = '$passEnc' AND eliminado = 0 AND status = 1";
        $res = $con -> query($sql);
        $row = $res->fetch_array();

        $idU = $row["id"];
        $nombre = $row["nombre"].' '.$row["apellidos"];
        $correo = $row["correo"];

        $_SESSION['idU'] = $idU;
        $_SESSION['nombre']=$nombre;
        $_SESSION['correo']=$correo;
    }

    echo $total;
?>