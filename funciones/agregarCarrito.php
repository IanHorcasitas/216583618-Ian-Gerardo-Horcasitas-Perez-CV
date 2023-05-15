<?php
    error_reporting(E_ERROR | E_PARSE);
    session_name("usuarios");
    session_start();
    $nombreS = ($_SESSION['nombre']);

    if($nombreS=="")
    {
        echo "el nombre es " . $nombreS;
        header("Location: ../iniciarSesion.php");
    }

    else
    {
        require "conecta.php";
        $con = conecta();

        //RECIBE VARIABLES//
        $idP = $_REQUEST['id'];
        $cantidadP = $_REQUEST['cantidad'];    

        //OBTENER PRODUCTO//
        $sql = "SELECT * FROM `PRODUCTOS` WHERE ID=$idP";
        $res = $con->query($sql);
        while($row = $res -> fetch_array())
        {
            $precioP = $row["costo"];
            $oldStock = $row["stock"];
        }

        //ACTUALIZAR STOCK//
        $newStock = $oldStock - $cantidadP;
        $sql2 = "UPDATE productos SET STOCK=$newStock WHERE ID = $idP";    
        $res2 = $con -> query($sql2);

        //OBTENER ID DE PEDIDO ABIERTO//
        $sql3 = "SELECT * FROM `pedidos` WHERE status=1";
        $res3 = $con->query($sql3);

        while($row = $res3 -> fetch_array())
        {
            $idPedido = $row["id"];
        }

        if($idPedido == null)
        {
            $sql4 = "INSERT INTO PEDIDOS (usuario, status) VALUES 
                    ('$nombreS','1')";
            $res4 = $con -> query($sql4);
        }

        //OBTENER ID DE PEDIDO ABIERTO//
        $sql5 = "SELECT * FROM `pedidos` WHERE status=1";
        $res5 = $con->query($sql5);
        while($row = $res5 -> fetch_array())
        {
            $idPedido = $row["id"];
        }

        //VERIFICAR SI EL PRODUCTO YA ESTA EN EL CARRITO//
        $sql6 = "SELECT COUNT(*) num FROM `PEDIDOS_PRODUCTOS` WHERE ID_PRODUCTO = $idP and id_pedido = $idPedido";
        $res6 = $con->query($sql6);
        while($row = $res6 -> fetch_array())
        {
            $actualRes = $row["num"];
        }

        //YA EXISTE UN PEDIDO_PRODUCTO CON ESE PRODUCTO//
        if($actualRes==1)
        {
            //OBTENER ID DEL PEDIDO_PRODUCTO//
            $sql6 = "SELECT * FROM `PEDIDOS_PRODUCTOS` WHERE ID_PRODUCTO = $idP";
            $res6 = $con->query($sql6);
            while($row = $res6 -> fetch_array())
            {
                $idPedidoProd = $row["id"];
                $cantidadActual = $row["cantidad"];
            }
            
            //AGREGAR AL ARTICULO EXISTENTE//
            $sql8 = "UPDATE PEDIDOS_PRODUCTOS SET CANTIDAD = $cantidadActual+$cantidadP WHERE ID = $idPedidoProd";
            $res8 = $con -> query($sql8);    
        }
        else
        {
            //CREAR DETALLE_PEDIDO//
            $sql7 = "INSERT INTO PEDIDOS_PRODUCTOS (ID_PEDIDO, ID_PRODUCTO, CANTIDAD, PRECIO) VALUES 
                    ('$idPedido','$idP','$cantidadP','$precioP')";
            $res7 = $con -> query($sql7);
        }

        header("Location: ../carrito01.php");
    }

    

?>