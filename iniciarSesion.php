<html>
    <head> 
        <title> BIENVENIDO | ELECTRONIK </title> 
        <!-- ESTILOS CSS -->
        <style>
            .titulo
            {
                color: rgb(204, 0, 0); 
                font-family:Arial;
                align: center;
                text-align: center;
            }
            .textError
            {
                font-family:Arial;             
                border: 0px;
                width: 350px;
                color:rgb(204, 0, 0);
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
        <!-- JAVASCRIPT -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script>
            function validar()
            {
                if($('#usuario').val()=="" || $('#pass').val()=="" )
                {
                    $('#generalError').html('Favor de llenar todos los campos');
                    setTimeout("$('#generalError').html('');",5000);
                }
                else
                {
                    var params = 'usuario='+$('#usuario').val()+
                             '&pass='+$('#pass').val();
                    $.ajax({
                        url: 'funciones/validarSesion.php',
                        type: 'post',
                        dataType: 'text',
                        data: params, 
                        success: function(res)
                        {
                            if(res==1)
                            {
                                window.location.href = "index.php";
                            }
                            else
                            {
                                $('#generalError').html('Datos de inicio de sesión incorrectos');
                                setTimeout("$('#generalError').html('');",5000);
                            } 
                        }
                        ,error:function()
                        {
                            alert('Error archivo no encontrado');
                        }     
                    }); 
                }   
            }
        </script>
    </head>
    <!-- MENU SUPERIOR -->
    <?php include 'barra_superior.php'; ?>
    <body>
        <form name="Registro" method="post" class="formTable">
            <table>
                <tr>
                    <td class="textTable"> Usuario:  </td>
                    <td> <input type="text" name="usuario" id="usuario"/> </td>
                </tr>
                <tr>
                    <td class="textTable"> Contraseña: </td>
                    <td> <input type="password" name="pass" id="pass"/>  </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td> <input onclick="validar(); return false;" class="buttonTable" type="button" value="Iniciar sesión"/> </td>
                </tr>
                <tr>
                    <td> <a class="menuSupLinks" style="margin-left: 10px; font-family:Arial; color: rgb(204, 0, 0); " href="usuarios_alta.php"> Registrarse </a> <br><br> </td>
                </tr>
            </table><br>
            
            <!-- DIV ERROR -->
            <div>
                <label class="textError" id="generalError"></label>
            </div><br><br> 
        </form>
    </body>
    
</html>