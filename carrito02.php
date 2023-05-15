<?php
    require "funciones/conecta.php";
    $idPedidoCerrado = $_REQUEST['id'];
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
            function confirmarPedido()
            {
                window.location.href = "carrito01.php?";
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
            </tr>

            <!-- LLENAR TABLA -->
            <?php
            $con = conecta();
            $totalCarrito = 0;

            $sql2 = "SELECT * FROM PEDIDOS_PRODUCTOS WHERE ID_PEDIDO = $idPedidoCerrado";
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
                    echo "<td style=\" font-family:Arial; border: 1; border-color: rgb(64, 128, 191); color: black;\"> $cantidad </td>";
                    $totalCarrito += $subtotal;
                    echo "<td id=\"sub$idDet\" name=\"sub$idDet\" style=\" font-family:Arial; border: 1; border-color: rgb(64, 128, 191); color: black;\"> $subtotal </td>";
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
            </tr>
        </table>
        <br><br>
        <table style="margin: auto;">
            <tr>
                <?php echo "<td> <input style=\"border-color: rgb(204, 0, 0); background-color: white; padding: 5px; color: rgb(204, 0, 0);\" onclick=\"confirmarPedido()\" type=\"button\" value=\"Continuar\"/> </td>"; ?>            
            </tr>
        </table>
        <footer>
            <br>
            <!-- PIE DE PAGINA-->
            <?php include 'footer.php'; ?>
        </footer>
    </body>