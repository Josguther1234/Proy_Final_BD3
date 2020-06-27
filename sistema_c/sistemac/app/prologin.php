<?php
    session_start();
    include('./proseggetdate.php');
    
    $config= parse_ini_file("../config/sistemac.ini");
    $connect= mysqli_connect("localhost", $config['username'], $config['password'], $config['dbname']);
    if ($connect==false){return "ERROR:No se pudo conectar a la Base de Datos<br>".mysqli_error($connect);}

    if ($_SERVER['REQUEST_METHOD']==='POST') { $getparams=filter_input_array(INPUT_POST); } else { $getparams=filter_input_array(INPUT_GET); }
    $output = "";

    $query = "CALL config_usuarios_login('".$getparams['l']."',SHA2('".$getparams['w']."',512))";
    $result = mysqli_query($connect, $query) or trigger_error(mysqli_error($connect));
    if (mysqli_num_rows($result)===1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['uname'] = $row['elno'];
            $_SESSION['ucta'] = $getparams['l'];
            $_SESSION['uid'] = $row['elid'];
            $_SESSION['utipo'] = $row['elti'];
            $_SESSION['nomrol'] = $row['elrol'];
            $_SESSION['ultact'] = time();
            $outarr = json_encode(
                        array(
                            'response'=>1,
                            'descrip'=>utf8_encode('Ok'),
                            'elno'=>utf8_encode($row['elno']),
                            'elid'=>$row['elid'],
                            'elti'=>$row['elti'],
                            'elrol'=>utf8_encode($row['elrol'])
                        )
                      );
        }
    } else {
        $outarr = json_encode(array("response"=>0,"descrip"=>"CREDENCIALES INVALIDAS"));
    }
    echo $outarr;
