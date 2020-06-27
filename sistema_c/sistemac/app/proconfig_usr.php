<?php
    session_start();
    include('./proseggetdate.php');
    
    $config= parse_ini_file("../config/sistemac.ini");
    $connect= mysqli_connect("localhost", $config['username'], $config['password'], $config['dbname']);
    if ($connect==false){return "ERROR:No se pudo conectar a la Base de Datos<br>".mysqli_error($connect);}
    
    if ($_SERVER['REQUEST_METHOD']==='POST') { $getparams=filter_input_array(INPUT_POST); } else { $getparams=filter_input_array(INPUT_GET); }
    $output = "";

    switch ($getparams['a']) {
    // <editor-fold defaultstate="collapsed" desc="A=0 - SELECCIÓN GENERAL PARA LLENAR GRID">
        case 0:
            $query = "CALL config_usuarios_getrs()";
            $result = mysqli_query($connect, $query);
            $cuantos = mysqli_num_rows($result);
            $output = "";
            if ($cuantos > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    switch($row['role']) {
                        case 'A': $txttipo = 'Administrador'; break;
                        case 'O': $txttipo = 'Operador'; break;
                        case 'Q': $txttipo = 'Consultas'; break;
                        case 'W': $txttipo = 'Web Service'; break;
                    }
                    $output = $output .
                            "<tr class='datarow' data-tip='".$row['role']."' >" .
                            "<td class='idu'>" . $row['id'] . "</td>" .
                            "<td class='cta'>" . utf8_decode($row['acct_name']) . "</td>" .
                            "<td class='nom'>" . utf8_decode($row['full_name']) . "</td>" .
                            "<td class='tip'>" . $txttipo . "</td>" .
                            "</tr>";
                }
            } else {
                $output = "<tr class='datarow col-lg-12 col-md-12 col-sm-12 col-xs-12'>" .
                        "<td colspan='3'>NO HAY REGISTROS INGRESADOS</td></tr>";
            }
            echo utf8_decode($output);
            break; // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="A=1 - INSERCIÓN DE TUPLA">
        case 1:
            $query = "CALL config_usuarios_add('" . 
                        $getparams['acct'] . "','" .utf8_encode($getparams['fnm']) . "','" . 
                        utf8_encode($getparams['role']). "')";
            $result = mysqli_query($connect, $query);
            if (mysqli_num_rows($result)>0) {
                $row = mysqli_fetch_assoc($result);
                if ($row['respu']==2) {
                    $outarr = array("resp"=>0,"reason"=>  mysqli_error($connect));
                }
                if ($row['respu']==3) {
                    $outarr = array("resp"=>0,"reason"=> "CUENTA DE USUARIO INVALIDA");
                }
                if ($row['respu']==1){
                    $outarr = array("resp"=>1);
                }
            }
            echo json_encode($outarr);
            break; // </editor-fold>
            
    // <editor-fold defaultstate="collapsed" desc="A=2 - EDICIÓN DE TUPLA">
        case 2:
            $query = "CALL config_usuarios_upd(" . 
                        $getparams['idu'] . ",'" .utf8_encode($getparams['nom']). "','" . 
                        $getparams['tip']."')";
            $result = mysqli_query($connect, $query);
            if (mysqli_num_rows($result)==1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['resp']==2) {
                    $outarr = array("resp"=>0,"reason"=>  mysqli_error($connect));
                }
                if ($row['resp']==1) {
                    $outarr = array("resp"=>1); 
                }
            } 
            
            echo json_encode($outarr);
            break; // </editor-fold>
            
    // <editor-fold defaultstate="collapsed" desc="A=3 - ELIMINACIÓN DE TUPLA">
        case 3:
            $query = "CALL config_usuarios_del(".$getparams['idu'].")";
            $result = mysqli_query($connect, $query);
            if (mysqli_num_rows($result)==1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['resp']==0) {
                    $outarr = array("resp"=>0,"reason"=>  mysqli_error($connect));
                }
                if ($row['resp']==1) {
                    $outarr = array("resp"=>1); 
                }
            } 
            echo json_encode($outarr);
            break; // </editor-fold>
            
    // <editor-fold defaultstate="collapsed" desc="A=4 - CAMBIO DE PASSWORD">
        case 4:
            $query = "UPDATE users SET userkey = SHA2('" . $getparams['w'] . "',512) " .
                    "WHERE id = " . $getparams['idu'] . ";";
            if (!mysqli_query($connect, $query)) {
                echo json_encode(array("resp" => "0", "reason" => mysqli_error($connect)));
            } else {
                echo json_encode(array("resp" => "1"));
            }
            break; // </editor-fold>
    }
