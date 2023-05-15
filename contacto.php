<html>
    <head>
        <title>CONTACTANOS | ELECTRONIK</title>
    </head>
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
        function enviarCorreo()
        {
            var params = 'nombre='+document.getElementById('nombre').value+
                ' '+document.getElementById('apellidos').value+
                '&com='+document.getElementById('comentario').value+
                '&subject=Comentario Electronik | ';
            window.location.href = "funciones/enviarCorreo.php?"+params;
        }
    </script>
    <body>
        <!-- MENU SUPERIOR -->
        <?php include 'barra_superior.php'; ?>
        <h1 class="titulo"> CONTACTANOS </h1>

        <form name="Registro" method="post" class="formTable">
            <br>
            <table>
                <tr>
                    <td class="textTable"> Nombre: </td>
                    <td> <input type="text" name="nombre" id="nombre"/> </td>
                </tr>
                <tr>
                    <td class="textTable"> Apellidos: </td>
                    <td> <input type="text" name="apellidos" id="apellidos"/> </td>
                </tr>
                <tr>
                    <td class="textTable"> Comentario: </td>
                    <td> <input type="text" name="comentario" id="comentario"/> </td>
                </tr>  
            </table>

            <table>
                <tr>
                    <td> <br><input onclick="location.href='index.php' " class="buttonTable" type="button" value="Volver"/> </td>
                    <td> <br><input onclick="enviarCorreo(); return false;" class="buttonTable" type="submit" value="Enviar"/> </td>
                </tr>
            </table><br>
          
        </form>

    </body>
</html>