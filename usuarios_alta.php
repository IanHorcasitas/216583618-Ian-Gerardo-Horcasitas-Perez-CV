<html>
    <head>
        <title>RREGISTRO | ELECTRONIK</title>
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
        .textError
        {
            font-family:Arial;             
            border: 0px;
            width: 350px;
            color:rgb(153, 0, 51);
        }
    </style>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
        var flagCorreo = false;
        function validar()
        {
            if(flagCorreo == true
                && document.getElementById('nombre').value != ""
                && document.getElementById('apellidos').value != ""
                && document.getElementById('correo').value != ""
                && document.getElementById('contrasena').value != "" )
                {
                    var params = 'nombre='+document.getElementById('nombre').value+
                    '&apellidos='+document.getElementById('apellidos').value+
                    '&correo='+document.getElementById('correo').value+
                    '&correoFlag='+flagCorreo+
                    '&contrasena='+document.getElementById('contrasena').value;

                    window.location.href = "usuarios_salva.php?"+params;
                }
            else
            {
                if(flagCorreo==false)
                {
                    $('#generalError').html('Ingresa un correo electronico valido');
                }
                else
                {
                    $('#generalError').html('Favor de llenar todos los campos');
                }
                setTimeout("$('#generalError').html('');",5000);
            }
        }
        function validarCorreo()
        {
            var params = 'correo='+document.getElementById('correo').value;
            $.ajax({
                url: 'funciones/validarCorreo.php',
                type: 'post',
                dataType: 'text',
                data: params, 
                success: function(res)
                {
                    document.getElementById('correo').style.color="black";
                    if(res==0)
                    {
                        flagCorreo = true;
                    }
                    else if (res==-1)
                    {
                        $('#correoError').html("Ingresa un correo electronico");
                        flagCorreo = false;
                    }
                    else
                    {
                        var msg="El correo "+document.getElementById('correo').value+" ya existe";
                        document.getElementById('correo').style.color="red";
                        $('#correoError').html(msg);
                        flagCorreo = false;
                    }
                    setTimeout("$('#correoError').html('');",5000);
                    
                }
                ,error:function()
                {
                    alert('Error archivo no encontrado');
                }
            }); 
        }
    </script>
    <body>

        <!-- MENU SUPERIOR -->
        <?php include 'barra_superior.php'; ?>
        <br> <h1 class="titulo"> REGISTRARSE </h1> 

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
                    <td class="textTable"> Correo Electronico: </td>
                    <td> <input type="text" name="correo" id="correo" onBlur="validarCorreo()"/> </td>
                    <td> 
                        <div>
                            <label class="textError" style="font-size: 12px;" id="correoError"></label>
                        </div>
                    </td> 
                </tr>
                <tr>
                    <td class="textTable"> Contraseña: </td>
                    <td> <input type="password" name="contrasena" id="contrasena"/> </td>
                </tr>    
            </table>

            <table>
                <tr>
                    <td> <br><input onclick="location.href='iniciarSesion.php' " class="buttonTable" type="button" value="Volver"/> </td>
                    <td> <br><input onclick="validar(); return false;" class="buttonTable" type="submit" value="Registrar"/> </td>
                </tr>
            </table><br>

            <div>
                <label class="textError" id="generalError" ></label>
            </div><br><br>           
        </form>

    </body>
</html>