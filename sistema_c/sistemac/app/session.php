<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    session_start();

    if (!isset($_SESSION['ultact'])||(time()-$_SESSION['ultact'])>3600){
        $output = 0;
    } else {
        $_SESSION['ultact']=time();
        $output = json_encode(
                    array(
                        'idu' => $_SESSION['uid'], 
                        'cta' => utf8_decode($_SESSION['ucta']), 
                        'nom' => utf8_decode($_SESSION['uname']), 
                        'rol' => $_SESSION['utipo'],
                        'nomr' => utf8_decode($_SESSION['nomrol']),
                        'ultact' => $_SESSION['ultact']
                        )
                );
    }
    echo $output;