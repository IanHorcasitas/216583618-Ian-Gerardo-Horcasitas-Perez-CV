<html>
    <head> 
        <title> ELECTRONIK </title> 
        <!-- ESTILOS -->
        <style>
            .titulo
            {
                color: rgb(204, 0, 0);
                font-family:Arial;
                align: center;
                text-align: center;
            }
            .tablaProm
            {
                border: 0;  
                align: center;
                margin-left: auto;
                margin-right: auto;
            }
            .tablaProd
            { 
                align: center;
                margin-left: 370px;
                margin-right: auto;    
            }
            
        </style>
        <!-- JAVASCRIPT -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script>
            function detalle(detId)
            {               
                var url = "productos_detalle.php?id="+detId;
                window.location.href=url;
            }
            function agregarCarrito(idProd)
            {
                var element="cantidadS"+idProd;
                var cant = document.getElementById(element).value;
                var params = 'id='+idProd+
                '&cantidad='+cant;
                var url = "funciones/agregarCarrito.php?"+params;
                window.location.href=url;
            }
        </script>
        
    </head>
    <!-- MENU SUPERIOR -->
    <?php include 'barra_superior.php'; ?>
    <body>
        <table class="tablaProm">
            <tr>
                <td> <h1 class="titulo"> ¡PROMOCION! </h1> <td>
            </tr>
            <tr>
                <?php
                    require "funciones/conecta.php";
                    $con = conecta();
                    $sql = "SELECT * FROM `banners` WHERE status=1 and eliminado=0  ORDER BY rand() LIMIT 1;";
                    $res = $con->query($sql);
                    while($row = $res -> fetch_array())
                    {
                        $img = $row["archivo"];
                        $archivo = "imagenes/".$img;
                        echo "<td> <img src=\"$archivo\" height=\"200\" width=\"600\"/> </td>";
                    } 
                ?>
            </tr>
        </table>
        <br><br> <h1 class="titulo"> Productos por solo menos de 1000 pesos </h1> <br><br>
        <table class="tablaProd">
            <tr>
            <?php
                $contador = 0;
                $con = conecta();
                $sql = "SELECT * FROM `productos` where eliminado=0 and status=1 and stock>1 and costo < 1000;";
                $res = $con->query($sql);
                while($row = $res -> fetch_array())
                {
                    $id = $row["id"];
                    $nombre = $row["nombre"];
                    $costo = $row["costo"];
                    $stock = $row["stock"];    
                    $img = $row["archivo_n"];

                    $archivo = "imagenes/".$img;
                    
                    echo "<td style=\"width: 200; font-family:Arial; font-size: 16; text-align: center;\"> <img src=\"$archivo\" height=\"100\" width=\"100\"/> <br> <br> <h3> $nombre </h3> Precio: $costo <br> Stock: $stock <br> <br> <input style=\"border-color: rgb(204, 0, 0); background-color: white; padding: 5px; margin:5px; color: rgb(204, 0, 0);\" onclick='detalle($id)'\" type=\"button\" value=\"Detalles\"/> <br> <input style=\"border-color: rgb(204, 0, 0); background-color: white; padding: 5px; color: rgb(204, 0, 0);\" onclick=\"agregarCarrito($id)\" type=\"button\" value=\"Agregar al Carrito\"/>";
                    echo " <select id=\"cantidadS$id\" name=\"cantidadS$id\"  style=\"border: 2;border-color: rgb(204, 0, 0);\"> ";
                    for ($i = 1; $i <= $stock; $i++)
                    {
                        if($i==1)
                        {
                            echo "<option value=\"$i\" selected> $i </option>";
                        }
                        else
                        {
                            echo "<option value=\"$i\"> $i </option>";
                        }
                    }
                    echo "</select> </td>";
                } 
            ?>
            </tr>
        </table>
        <footer>
            <br>
            <!-- PIE DE PAGINA-->
            <?php include 'footer.php'; ?>
        </footer>
    </body>   
    
</html>