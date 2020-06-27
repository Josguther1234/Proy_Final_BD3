<?php

    class server
    {
        private $con;
        
        public function __construct() {
            $this->con = (is_null($this->con)) ? self::connect() : $this->con;
        }
        
        static function connect() {
            $con = mysqli_connect("localhost","dba","MopeItoLindo#1973","dbpayments");
            return $con;
        }
        
        public function getOrderState($dpi_array) {
            $dpi = $dpi_array;
            $sql = "SELECT CONCAT(CASE paid WHEN 1 THEN 'PAGADO' WHEN 0 THEN 'NO PAGADO' END,'   CORREL.:',order_id) AS result ".
                     "FROM certiforder ".
                    "WHERE dpi = '$dpi' ORDER BY order_id DESC LIMIT 1";
            $qry = mysqli_query($this->con, $sql);
            if (mysqli_num_rows($qry)==1) {
                $res = mysqli_fetch_array($qry);
                return $res['result'];
            } else {
                return "ORDEN DE PAGO NO EXISTE";
            }
        }
        
        public function createCertifOrder($dpi_array) {
            $dpi = $dpi_array;
            $sql = "INSERT INTO certiforder(dpi,paid) VALUES('$dpi',0)";
            $qry = mysqli_query($this->con, $sql);
            if (mysqli_affected_rows($this->con)==1) {
                $res = mysqli_insert_id($this->con);
                
                return "ORDEN DE PAGO CREADA CORREL.:$res";
            } else {
                if (mysqli_errno($this->con)==45000) {
                    return "DPI NO HA PAGADO ORNATO";
                } else {
                    return "NO SE HA GRABADO: ". mysqli_error($this->con);
                }
            }            
        }
        
        public function payOrder($dpi_array) {
            list($dpi, $usr) = explode(",", $dpi_array);
            
            $sql = "SELECT * FROM certiforder WHERE dpi = '$dpi' AND paid = 0 ORDER BY order_id DESC LIMIT 1";
            $qry = mysqli_query($this->con, $sql);
            if (mysqli_num_rows($qry)==1) {
                $res = mysqli_fetch_array($qry);
                $numero = $res['order_id'];
                mysqli_free_result($qry);
                $sql = "UPDATE certiforder SET paid = 1, datepaid = CURRENT_DATE(), userpay = ".$usr." WHERE order_id = $numero";
                $qry = mysqli_query($this->con, $sql);
                if (mysqli_affected_rows($this->con)==1) {
                    return "PAGO REGISTRADO";
                } else {
                    return "PAGO NO REGISTRADO:". mysqli_error($this->con);
                }
            } else {
                if (mysqli_error($this->con)==="Unhandled user-defined exception condition") {
                    return "DPI NO HA PAGADO ORNATO";
                } else {
                    return "NO SE HA GRABADO: ". mysqli_error($this->con);
                }
            }            
        }
        
        public static function authenticate($header_params) {
            $uname = $header_params->uname;
            $ukey = $header_params->upass;
            
            $sql = "SELECT * FROM users WHERE acct_name = '$uname' AND userkey = SHA2('$ukey',512) AND role = 'W'";
            $qry = mysqli_query($this->con, $sql);
            if (mysqli_num_rows($qry)==1) {
                return true;
            } else {
                throw new SoapFault("CREDENCIALES INCORRECTAS", 401);
            }
        }
        
    }
    
    $params = array('uri' => './server.php');
    $server = new SoapServer(null, $params);
    $server->setClass('server');
    $server->handle();