<?php
  include_once 'conexion.php';
  $conexion = new DB();

  $id = $_POST['id_usuario'];
  $password_actual = $_POST['password_actual'];
  $nueva_password = $_POST['password'];

  $validar = $conexion -> connect() -> query("SELECT contrasena FROM usuarios WHERE id_usuario = ". $id);
  $validar -> execute();

  $rowPassword = $validar -> fetch();

  if(password_verify($password_actual, $rowPassword['contrasena'])){
    $nueva_password = password_hash($nueva_password, PASSWORD_DEFAULT);

    $query = $conexion -> connect() -> prepare("UPDATE usuarios SET contrasena = :password WHERE id_usuario = :id");
    $query -> bindParam("password", $nueva_password, PDO::PARAM_STR);
    $query -> bindParam("id", $id, PDO::PARAM_INT);
    echo $query -> execute();
  } else {
    echo "incorrecta";
  }
?>