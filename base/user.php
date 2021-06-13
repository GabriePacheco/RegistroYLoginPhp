<?php 
class User extends Base {
    private $id;
    private $nombre;
    private $email;

    public function registrar($nombre, $email, $pass){
      
         $sql = "INSERT INTO usuarios (nombre, email, password) Value ('$nombre', '$email', '$pass') ";
         $con = $this->conexion();
         $res=$con->query($sql);   
         if (!$res) {
            return $res;
         } else {
            $this->set($con->insert_id, $nombre, $email);
             return true;
         }
    }

    public function getUser($email, $pass){   
        $sql = "SELECT * FROM usuarios WHERE email= '$email'";
        $result = $this->conexion()->query($sql);
        $resultados = $result->num_rows;
        
        if ($resultados ==  1){
            $us = $result->fetch_array(); 
            $this->set($us['id'], $us['nombre'], $us['email']);
             return password_verify($pass, $us['password']);
        } else {
            return false;
        }
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getId() {
        return $this->id;
    }
    private function set($id, $mail,$nombre ){
        $this->id = $id;
        $this->email = $mail;
        $this->nombre =$nombre;
        
    }
}
?>
