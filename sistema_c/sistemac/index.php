<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es-419">
    <head>
        <title>Inicio de Sesi&oacute;n</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css"/>
        <!--[if lt IE 9]>
                <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!--<link href="css/styles.css" rel="stylesheet">-->
    </head>
    <body>
        <div class="jumbotron" style="height: 100%!important; width: 100%;">
            <div id="divTtl" class="row container" style="width: 100%; margin: 0px; padding: 0px;">
                <div class="row" style="width: 100%;">
                    <div style="margin: 0px 5px 0px 0px; box-sizing: border-box!important; max-height: 120px;">
                        <img class="img-fluid" src="img/2020logohoriz_4200x1350.png" alt="" style="max-height:120px;"/>
                    </div>
                </div>
                <div class="row" style="width: 100%;">
                    <div style="padding: 0px; margin: 0px 5px 0px 0px;  box-sizing: border-box!important; text-align: center; margin: auto;
                                font-family: 'benchnineregular'; font-size: 2.25em; text-shadow: 2px 2px #CFCFCF; font-weight: bold;">
                        Sistema C - Sistema de Banco de Pagos
                    </div>
                </div>
            </div>
            <div id="divBtnLi" class="row container" style="margin-top: 15px; width: 100%;">
                <div style="font-family: 'Arial'; font-size: 12pt; text-align: center; margin: auto;">
                    <button class="btn btn-primary"type="button" id="btnLi">
                        <i class="fa fa-key"></i>&nbsp;&nbsp;Ingresar al Sistema
                    </button>
                </div>
            </div>
            <div id="divFrm" class="row" style="width: 100%!important; text-align: center; margin: auto;">
                <div class="form-group row" style="margin: 10px 10px 0px 10px;; width: 90%;">
                    <label for="txtct" class="col-form-label" style="width: 35%; text-align: right; font-size: 9pt;">
                        <span class="fa fa-user"></span>&nbsp;&nbsp;Cuenta de Acceso:&nbsp;&nbsp;&nbsp;
                    </label>
                    <input id="txtct" type="text" class="form-control" style="font-family: Arial; font-size: 9pt; width: 40%;"/>
                </div>
                <div class="form-group row" style="margin: 10px 10px 0px 10px;; width: 90%;">
                    <label for="txtp" class="col-form-label" style="width: 35%; text-align: right; font-size: 9pt;">
                        <span class="fa fa-key"></span>&nbsp;&nbsp;&nbsp;&nbsp;Clave de Acceso:&nbsp;&nbsp;&nbsp;
                    </label>
                    <input id="txtp" type="password" class="form-control" style="font-family: Arial; font-size: 9pt; width: 40%;"/>
                </div>
                <div class="btn-group-lg row" style="padding: 10px; width: 90%; text-align: center; margin: auto; float: none; display: flex;">
                    <button type="button" id="btnGo" class="btn btn-success" style="font-size: 10pt; flex-basis: 25%; flex: 1;">
                        <span class="fa fa-arrow-right"></span>&nbsp;&nbsp;Ingresar
                    </button>
                    <button type="button" id="btnClr" class="btn btn-warning" style="font-size: 10pt; flex-basis: 25%; flex: 1;">
                        <span class="fa fa-redo"></span>&nbsp;&nbsp;Limpiar Campos
                    </button>
                </div>
            </div>
        </div>
        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/crypt/sha512.js" type="text/javascript"></script>
        <!--<script src="js/sha256.jquery.debug.js" type="text/javascript"></script>-->
        <script src="js/cust_index.js" type="text/javascript"></script>
    </body>
</html>