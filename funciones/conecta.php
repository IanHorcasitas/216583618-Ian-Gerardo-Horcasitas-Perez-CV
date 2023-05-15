<?php
    //UBICACION DEL ARCHIVO
    // ./funciones/conecta.php
    define ("HOST",'localhost'); //localhost
    define ("BD",'cliente01');
    define ("USER_BD",'root');
    define ("PASS_BD",''); //contraseña

    function conecta()
    {
        $con = new mysqli(HOST, USER_BD, PASS_BD, BD);
        return $con;
    }
?>