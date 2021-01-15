<?php
  include_once 'conexion.php';

  class Sesion extends DB{
    public function __construct() {
      session_start();
    }

    public function insertarSesion($user){
      $_SESSION['user'] = $user;
    }

    public function obtenerSesion(){
      return $_SESSION['user'];
    }

    public function destruirSesion(){
      session_unset();
      session_destroy();
    }
  }
?>