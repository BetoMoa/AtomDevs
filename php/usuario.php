<?php
  include_once 'conexion.php';

  class Usuario extends DB{

    private $nombreUsuario;
    private $correoUsuario;
    private $apellido;
    private $id_usuario;

    public function userExists($user, $password){
      $query = $this -> connect() -> prepare("SELECT * FROM usuarios WHERE correo = :correo");
      $query -> bindParam("correo", $user, PDO::PARAM_STR);
      $query -> execute();

      if($query -> rowCount() > 0){
        $infoUsuario = $query -> fetch();
        $pass = $infoUsuario['contrasena'];
    
        if(password_verify($password, $pass)){
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    }

    public function insertarUsuario($user){
      $query = $this -> connect() -> prepare("SELECT * FROM usuarios WHERE correo = :correo");
      $query -> bindParam("correo", $user, PDO::PARAM_STR);
      $query -> execute();
      $row = $query -> fetch();
      $this->nombreUsuario = $row['nombres'];
      $this->apellido = $row['apellidos'];
      $this->correoUsuario = $row['correo'];
      $this->id_usuario = $row['id_usuario'];

    }

    public function nombreUsuario(){
      return $this->nombreUsuario;
    }

    public function apellido(){
      return $this->apellido;
    }

    public function correoUsuario(){
      return $this->correoUsuario;
    }

    public function idUsuario(){
      return $this->id_usuario;
    }
  }
?>