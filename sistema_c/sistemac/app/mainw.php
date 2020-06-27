<!DOCTYPE html>
<html  lang="es-419">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Sistema C - Sistema de Pagos</title>

    <!-- Bootstrap CSS CDN -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Our Custom CSS -->
    <link href="../css/sbar.css" rel="stylesheet" type="text/css"/>

    <!-- Font Awesome JS -->
    <script src="../js/fontawesome.min.js" type="text/javascript"></script>
    <script src="../js/solid.min.js" type="text/javascript"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header" style="margin-bottom: 5px!important; padding-bottom: 5px!important;">
                <img class="img-fluid" src="../img/2020logosquare_200x194.png" alt="" style="max-height:160px;"/>
                <h5>Sistema de Banco de Pagos</h5>
            </div>

            <ul class="list-unstyled components" style="margin-top: 0px!important; padding-top: 0px!important;">
                <p style="margin: 5px auto 5px auto;">Men&uacute;</p>
                <li class="active">
                    <a href="#confSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-wrench" style="font-size: 10pt;"></i>&nbsp;&nbsp;Configuraci&oacute;n</a>
                    <ul class="collapse list-unstyled" id="confSubmenu">
                        <li>
                            <a href="#" class="destiny" data-dst="config_usr">Usuarios</a>
                        </li>
                        <li>
                            <a href="#" class="destiny" data-dst="config_log">Bit&aacute;cora de Eventos</a>
                        </li>
                    </ul>
                </li>
                <li class="active">
                    <a href="#paySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-dollar-sign" style="font-size: 10pt;"></i>&nbsp;&nbsp;Pagos</a>
                    <ul class="collapse list-unstyled" id="paySubmenu">
                        <li>
                            <a href="#" class="destiny" data-dst="trans">Operar Certificaciones</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="destiny" data-dst="logout">
                        <i class="fa fa-sign-out-alt" style="font-size: 10pt;"></i>&nbsp;&nbsp;Cerrar Sesi&oacute;n</a>
                </li>
            </ul>
        </nav>
        <input type="hidden" id="txtID"/>
        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </nav>
            <div id="ifrContent" class="col-12 container-fluid" 
                 style="min-width: 100%; width: 100%!important; min-height: 60vh!important; height: 100%; margin: 0px; padding: 0px;">
                <iframe id="insideContent" style="margin: 0px; widows: 100%!important" src="" width="100%" height="100%"></iframe>
            </div>
        </div>
    </div>

    <script src="../js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <!-- Popper.JS -->
    <script src="../js/popper.js" type="text/javascript"></script>
    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/cust_mainw.js" type="text/javascript"></script>

</body>

</html>