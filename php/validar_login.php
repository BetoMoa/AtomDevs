<?php
  include_once 'usuario.php';
  include_once 'sesiones.php';

  $usuario = new Usuario();
  $sesion = new Sesion();

  $correo = $_POST['email'];
  $password = $_POST['password'];

  if($usuario -> userExists($correo, $password)){
    $sesion -> insertarSesion($correo);
    $usuario -> insertarUsuario($correo);
    
    echo "1";
  } else {
    echo "0";
  } 

?>