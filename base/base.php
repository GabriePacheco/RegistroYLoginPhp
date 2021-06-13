<?php 
    class Base {
        private $sevidor;
        private $user;
        private $pass;
        private $bd;

        public function __construct(){
            
            $this->servidor ="localhost";
            $this->user ="root";
            $this->pass ="";
            $this->bd ="gpblog";
        }

        public function conexion (){
            $con = new mysqli ($this->sevidor, $this->user,$this->pass, $this->bd);
            if ($con->connect_errno) {
                echo"error de conexion". $con->connect_error;
                exit();
            }
            return $con;
        } 
    }
?>