<html>
    <head> 
        <title> PRODUCTOS | ELECTRONIK </title> 
        <!-- ESTILOS -->
        <style>
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
            .cantidadSel
            {
                border: 1;  
                color: rgb(204, 0, 0);
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
        <table class="tablaProd">
            <tr>
            <?php
                require "funciones/conecta.php";
                $contador = 0;
                $con = conecta();
                $sql = "SELECT * FROM `productos` where eliminado=0 and status=1 and stock>1;";
                $res = $con->query($sql);
                while($row = $res -> fetch_array())
                {
                    if($contador==0)
                    {
                        echo "<tr>";
                    }
                    $id = $row["id"];
                    $nombre = $row["nombre"];
                    $costo = $row["costo"];
                    $stock = $row["stock"];    
                    $img = $row["archivo_n"];

                    $archivo = "imagenes/".$img;
                    
                    echo "<td style=\"width: 200; font-family:Arial; font-size: 16; text-align: center;\"> <img style=\"padding-top: 20px;\" src=\"$archivo\" height=\"100\" width=\"100\"/> <br> <br> <h3> $nombre </h3> Precio: $costo <br> Stock: $stock <br> <br> <input style=\"border-color: rgb(204, 0, 0); background-color: white; padding: 5px; margin:5px; color: rgb(204, 0, 0);\" onclick='detalle($id)'\" type=\"button\" value=\"Detalles\"/> <br> <input style=\"border-color: rgb(204, 0, 0); background-color: white; padding: 5px; color: rgb(204, 0, 0);\" onclick=\"agregarCarrito($id)\" type=\"button\" value=\"Agregar al Carrito\"/>";
                    echo " <select id=\"cantidadS$id\" name=\"cantidadS$id\" style=\"border: 2;border-color: rgb(204, 0, 0);\"> ";
                    for ($i = 1; $i <= $stock; $i++)
                    {
                        echo "<option value=\"$i\"> $i </option>";
                    }
                    echo "</select > </td>";
                    $contador+=1;
                    if($contador==3)
                    {
                        echo "</tr>";
                        $contador = 0;
                    }
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