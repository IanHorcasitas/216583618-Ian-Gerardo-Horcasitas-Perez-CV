<?php 
error_reporting(E_ERROR | E_PARSE);
session_name("usuarios");
session_start();
$nombreS = ($_SESSION['nombre']);
if($nombreS==null)
{
    header("Location: iniciarSesion.php");
}

?>

<?php
    require "funciones/conecta.php";
    $con = conecta();
    $sql = "SELECT COUNT(*) num FROM `PEDIDOS` WHERE status=1";
    $res = $con->query($sql);
    
    while($row = $res -> fetch_array())
    {
        $numPedido = $row["num"];
    }
    if($numPedido==0 and $nombreS!="")
    {
        $sqlInsert = "INSERT INTO PEDIDOS(usuario, status) VALUES ('$nombreS','1')";
        $res = $con->query($sqlInsert); 
    }
?>
<html>
    <head> 
        <title> CARRITO | ELECTRONIK </title> 
        <!-- ESTILOS -->
        <style>
            .titulo
            {
                color: rgb(204, 0, 0);
                font-family:Arial;
                align: center;
                text-align: center;
            }
            .contentTable
            {
                border: 0; 
                width: 1000px; 
                align: center;
                margin-left: auto;
                margin-right: auto;
            }
            .headerContentTable
            {
                font-family:Arial; 
                background-color: rgb(204, 0, 0);
                text-align:center;
            }
            .headerTextContentTable
            {
                color:white;
            }
            
        </style>
        <!-- JAVASCRIPT -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script>
            function eliminar(delId)
            {
                var respuesta=confirm('¿Estas seguro que quieres eliminar?');
                if(respuesta)
                {
                    var params = 'id='+delId;
                    window.location.href ='funciones/eliminarDetalle.php?'+params;
                }
            }
            function recalcular(idDetalle)
            {
                var element="cantidadS"+idDetalle;
                var cant = document.getElementById(element).value;
                var params = 'id='+idDetalle+
                '&cantidad='+cant;
                window.location.href ='funciones/actualizarDetalle.php?'+params;
            }
            function cancelarPedido()
            {
                window.location.href="funciones/cancelarPedido.php";
            }
            function confirmarPedido()
            {
                window.location.href="funciones/confirmarPedido.php";
            }
        </script>
        
    </head>
    <!-- MENU SUPERIOR -->
    <?php include 'barra_superior.php'; ?>
    <body>
        <h1 class="titulo"> Carrito </h1>
        <!-- TABLA DE DATOS -->
        <table class="contentTable">

            <!-- ENCABEZADOS -->
            <tr class="headerContentTable">
                <td> <b class="headerTextContentTable"> PRODUCTO </b> </td>
                <td> <b class="headerTextContentTable"> PRECIO </b> </td>
                <td> <b class="headerTextContentTable"> CANTIDAD </b> </td>
                <td> <b class="headerTextContentTable"> SUBTOTAL </b> </td>
                <td> <b class="headerTextContentTable"> ELIMINAR </b> </td>
            </tr>

            <!-- LLENAR TABLA -->
            <?php
            $con = conecta();
            $totalCarrito = 0;
            //OBTENER ID DE PEDIDO ABIERTO//
            $sql = "SELECT * FROM `pedidos` WHERE status=1";
            $res = $con->query($sql);
            while($row = $res -> fetch_array())
            {
                $idPedido = $row["id"];
            }           

            $sql2 = "SELECT * FROM PEDIDOS_PRODUCTOS WHERE ID_PEDIDO = $idPedido";
            $res2 = $con->query($sql2);
            while($row = $res2 -> fetch_array())
            {
                //IMPRIMIR//
                echo "<tr align=\"center\" >";
                $idDet = $row["id"];
                $idP = $row["id_producto"];
                $cantidad = $row["cantidad"];
                $precio = $row['precio'];
                $subtotal = $cantidad * $precio;
                $eliminar = "<input style=\"font-family:Arial; border: 0;background-color: red; color: white;\" onClick=\"eliminar($idDet)\" value=\"Eliminar\" type=\"button\"/>"; 

                $sqlProd = "SELECT * FROM PRODUCTOS WHERE ID = $idP";
                $res = $con->query($sqlProd);
                while($row = $res -> fetch_array())
                {
                    $nombreP = $row["nombre"];
                    $cantidadP = $row["stock"];
                    echo "<td style=\" font-family:Arial; border: 1; border-color: rgb(64, 128, 191); color: black;\"> $nombreP </td>";
                    echo "<td style=\" font-family:Arial; border: 1; border-color: rgb(64, 128, 191); color: black;\"> $precio </td>";
                    echo "<td> <select id=\"cantidadS$idDet\" name=\"cantidadS$idDet\" style=\"border: 2;border-color: rgb(204, 0, 0);\" onchange=\"recalcular($idDet)\"> ";
                        for ($i = 1; $i <= $cantidadP; $i++)
                        {
                            if($i == $cantidad)
                            {
                                echo "<option value=\"$i\" selected> $i </option>";
                            }
                            else
                            {
                                echo "<option value=\"$i\" > $i </option>";
                            }
                            
                        }
                    $totalCarrito += $subtotal;
                    echo "</select > </td>";
                    echo "<td id=\"sub$idDet\" name=\"sub$idDet\" style=\" font-family:Arial; border: 1; border-color: rgb(64, 128, 191); color: black;\"> $subtotal </td>";
                    echo "<td style=\" font-family:Arial; color: white;\"> $eliminar <br> </td>";
                    echo "</tr>";
                }     
            }

            ?>
            <tr></tr>
            <tr class="headerContentTable">
                <td></td><td></td>
                <td> <b class="headerTextContentTable"> Total: </b> </td>
                <?php
                    echo "<td> <b class=\"headerTextContentTable\"> $totalCarrito </b> </td>";
                ?>
                <td></td> 
            </tr>
        </table>
        <br><br>
        <table style="margin: auto;">
            <tr>
                <?php echo "<td> <input style=\"border-color: rgb(204, 0, 0); background-color: white; padding: 5px; color: rgb(204, 0, 0);\" onclick=\"cancelarPedido()\" type=\"button\" value=\"Cancelar Pedido\"/> </td>"; ?>
                <?php echo "<td> <input style=\"border-color: rgb(204, 0, 0); background-color: white; padding: 5px; color: rgb(204, 0, 0);\" onclick=\"confirmarPedido()\" type=\"button\" value=\"Confirmar Pedido\"/> </td>"; ?>            
            </tr>
        </table>
        <footer>
            <br>
            <!-- PIE DE PAGINA-->
            <?php include 'footer.php'; ?>
        </footer>
    </body>