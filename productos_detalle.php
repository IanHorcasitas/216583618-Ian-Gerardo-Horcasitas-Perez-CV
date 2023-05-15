<html>
    <head>
        <title>DETALLE DEL PRODUCTO</title>
        <style>
            .titulo
            {
                color: rgb(204, 0, 0);
                font-family:Arial;
                align: center;
                text-align: center;
            }
            .formTable
            {
                width: 100%;
                max-width: 600px;
                margin: 0 auto;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .textTable
            {
                font-family:Arial; 
                color: rgb(204, 0, 0);
                font-weight: bold;
            }
            .infoTable
            {
                font-family:Arial; 
                color: black;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            td
            {
                padding: 10px;
            }
            .buttonTable
            {
                border: 0px;
                color: white;
                background-color: rgb(204, 0, 0);
                padding: 10px;
                font-family:Arial; 
            }
        </style>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script>
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
    <body>
        <?php
            global $nombreR, $descripcion, $codigo, $costo, $stock, $status, $img;
            require "funciones/conecta.php";
            $con = conecta();
            $id = $_REQUEST['id'];
            $sql = "SELECT * FROM productos WHERE id=$id";
            $res = $con->query($sql);
            while($row = $res -> fetch_array())
            {
                $nombreR = $row["nombre"];
                $descripcion = $row["descripcion"];
                $codigo = $row["codigo"];
                $costo = $row["costo"];
                $stock = $row["stock"];
                $status = $row["status"];
                $img = $row["archivo_n"];
            }
        ?>
        <!-- TITULO -->
        <br> <h1 class="titulo"> DETALLE DEL PRODUCTO <?php echo $id; ?> </h1> <br>
        <!-- MENU SUPERIOR -->
        <?php include 'barra_superior.php'; ?>
        <!-- FOMULARIO PARA MOSTRAR -->
        <form name="Registro" method="post" class="formTable">
            <br>
            <table>
                <!-- NOMBRE -->
                <tr>
                    <img id="img" src="imagenes/<?php echo $img;?>" width="200" height="200"/><br>
                </tr>
                <!-- NOMBRE -->
                <tr>
                    <td> <label id="nombre" class="infoTable" style="color: rgb(204, 0, 0); font-weight: bold; " > <?php echo $nombreR ?> </label> </td>
                </tr>
                <!-- DESCRIPCION -->
                <tr>
                    <td> <label id="descripcion" class="infoTable"  > <?php echo $descripcion; ?> </label> </td>
                </tr>
            </table>

            <table>
                <!-- COSTO -->
                <tr>
                    <td class="textTable"> Precio: </td>
                    <td> <label id="costo" class="infoTable"  > <?php echo $costo; ?> </label> </td>
                </tr>
                <!-- STOCK -->
                <tr>
                    <td class="textTable"> Stock: </td>
                    <td> <label id="stock" class="infoTable"  > <?php echo $stock; ?> </label> </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td> <br><input onclick="location.href='productos.php' " class="buttonTable" type="button" value="Regresar"/> </td>
                    
                    <?php
                        echo "<td> <select id=\"cantidadS$id\" name=\"cantidadS$id\"  style=\"border: 2;border-color: rgb(204, 0, 0);\"> ";
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
                        echo "</select>";
                        echo "<br><input onclick=\"agregarCarrito($id)\" class=\"buttonTable\" type=\"button\" value=\"Agregar al Carrito\"/> </td>";
                    ?>
                    
                </tr>
            </table><br>         
        </form>
    </body>
</html>