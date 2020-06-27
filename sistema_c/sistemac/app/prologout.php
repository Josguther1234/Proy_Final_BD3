<?php

    session_start();
//    include('./proseggetdate.php');
    
    $config= parse_ini_file("../config/verbo.ini");
    $connect= mysqli_connect("localhost", $config['username'], $config['password'], $config['dbname']);
    if ($connect==false){return "ERROR:No se pudo conectar a la Base de Datos<br>".mysqli_error($connect);}
    $luser = $_SESSION['idusuarios'];
    
//    $query = utf8_decode("CALL bitacora_add(".$luser.",2,'O',NULL,'Cierre de Sesión','".$date->format('Y-m-d H:i:s')."')");
//    if (mysqli_query($connect, $query)){
        setcookie("col-e",null,  time()-7200);
        session_destroy();
//    }