<?php
  include_once 'conexion.php';
  $conexion = new DB();

  $nombre = $_POST['nombres'];
  $apellido = $_POST['apellidos'];
  $correo = $_POST['email'];
  $password = $_POST['password'];
  $password = password_hash($password, PASSWORD_DEFAULT);

  $query = $conexion -> connect() -> prepare("SELECT correo FROM usuarios WHERE correo = :correo");
  $query -> bindParam("correo", $correo, PDO::PARAM_STR);
  $query -> execute();

  if($query -> rowCount() > 0){
    echo "existe";
  } else {
    $nuevoUsuario = $conexion -> connect() -> prepare("INSERT INTO usuarios(nombres, apellidos, correo, contrasena) VALUES(:nombre, :apellido, :correo, :password)");
    $nuevoUsuario -> bindParam("nombre", $nombre, PDO::PARAM_STR);
    $nuevoUsuario -> bindParam("apellido", $apellido, PDO::PARAM_STR);
    $nuevoUsuario -> bindParam("correo", $correo, PDO::PARAM_STR);
    $nuevoUsuario -> bindParam("password", $password, PDO::PARAM_STR);
    echo $nuevoUsuario -> execute();
  }
?>