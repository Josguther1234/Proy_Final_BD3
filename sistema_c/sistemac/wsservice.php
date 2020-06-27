<?php

    if ($_SERVER['REQUEST_METHOD']==='POST') { $getparams=filter_input_array(INPUT_POST); } else { $getparams=filter_input_array(INPUT_GET); }
    
    $params = array('location' => 'http://localhost/sistemac/wsserver.php', 'uri' => 'http://localhost/sistemac/', 'trace' => 1);
    $instance = new SoapClient(null,$params);
    
//    $auth_params = new stdClass();
//    $auth_params->uname = "usuarioprueba";
//    $auth_params->upass = "abc123";
    
//    $header_params = new SoapVar($auth_params, SOAP_ENC_OBJECT);
//    $header = new SoapHeader('sistemac','authenticate',$header_params,false);
    
    $action = $getparams['a'];
    if ($action == 2) {
        $dpi_array['dpi'] = $getparams['dpi'].",".$getparams['u'];
    } else {
        $dpi_array["dpi"] = $getparams['dpi'];
    }
//    $instance->__setSoapHeaders(array($header));
    try {
        switch ($action) {
            case 0:
                echo $instance->__soapCall('getOrderState', $dpi_array);
                break;
            case 1:
                echo $instance->__soapCall('createCertifOrder', $dpi_array);
                break;
            case 2:
                echo $instance->__soapCall('payOrder', $dpi_array);
                break;
        }        
    } catch (Throwable $ex) {
        echo "El servicio no está habilitado !!";
    }
