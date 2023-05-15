<?php 
error_reporting(E_ERROR | E_PARSE);
session_name("usuarios");
session_start();
$nombreS = ($_SESSION['nombre']);

if($nombreS==null)
{
    $nombreS = "NULL";
}
?>

<html>
    <head>
        <style> 
            .titulo
            {
                color: rgb(204, 0, 0);
                font-family:Arial;
                align: center;
                text-align: center;
            }
            .menuSupTabla
            {
                background-color: rgb(204, 0, 0); 
                align: center;
                text-align:center;
                width: 1000;
                margin-left: auto;
                margin-right: auto;
            }
            .menuSupLinks
            {
                color: white; 
                font-size:14px;
            }
            .iniciaSesion
            {
                color: white; 
                font-size:14px;
            }
            .menuSupColumBase
            {
                font-family:Arial; 
                padding-top: 10px; 
                padding-bottom: 10px;
                border-left: 1px solid white;
            }
            .closeLink
            {
                color: white; 
                font-size:14px;
                align: right;
            }
            .timgTitle
            {
                margin-left: 150px;
                margin-right: auto;
            }
            .textTitle
            {
                color: rgb(204, 0, 0); 
                font-family:Arial;
            }
        </style>
    </head>
    <body>
        <!-- MENU SUPERIOR -->
        <table class="timgTitle">
            <tr >
                <td > <img src="imagenes/sistema/Logo.png" width="150" height="100"/> </td>
                <td> <br> <h1 class="textTitle"> Electronik</h1> <br> </td>
            </tr>
        </table>
        
        <?php
            if($nombreS=="NULL")
            {
                echo "<a class=\"menuSupLinks\" style=\"margin-left: 1000px; font-family:Arial; color: rgb(204, 0, 0); \" href=\"iniciarSesion.php\"> Iniciar Sesion </a> <br><br>";
            }
            else
            {
                echo "<a class=\"menuSupLinks\" style=\"margin-left: 990px; font-family:Arial; color: black; \"> $nombreS </a> <br><br>";
                echo "<a class=\"menuSupLinks\" style=\"margin-left: 1000px; font-family:Arial; color: rgb(204, 0, 0); \" href=\"funciones/salir.php\"> Cerrar Sesion </a> <br><br>";
            }
        
        ?>
        <table class="menuSupTabla">
            
            <tr>
                <td class="menuSupColumBase"> <a class="menuSupLinks" href="index.php"> Home </a> </td>
                <td class="menuSupColumBase"> <a class="menuSupLinks" href="productos.php"> Productos </a> </td>
                <td class="menuSupColumBase"> <a class="menuSupLinks" href="contacto.php"> Contacto </a> </td>
                <td class="menuSupColumBase"> <a class="menuSupLinks" href="carrito01.php"> Carrito </a> </td>
            </tr>
        </table> <br><br>
    </body>
</html>