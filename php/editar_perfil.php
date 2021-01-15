<?php
  include_once 'conexion.php';
  $conexion = new DB();

  $id = $_POST['id_usuario'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];

  $query = $conexion -> connect() -> prepare("UPDATE usuarios SET nombres = :nombre, apellidos = :apellido, correo = :correo WHERE id_usuario = :id");
  $query -> bindParam("nombre", $nombre, PDO::PARAM_STR);
  $query -> bindParam("apellido", $apellido, PDO::PARAM_STR);
  $query -> bindParam("correo", $email, PDO::PARAM_STR);
  $query -> bindParam("id", $id, PDO::PARAM_STR);

  echo $query -> execute();
?>