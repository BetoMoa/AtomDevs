<?php
  include_once 'conexion.php';
  $conexion = new DB();

  $usuario = $_POST['id_usuario'];
  $producto = $_POST['id_producto'];
  $pagado = 0;

  $query = $conexion -> connect() -> prepare("INSERT INTO pedidos(id_producto, id_usuario, pagado) VALUES (:producto, :usuario, :pagado)");
  $query -> bindParam("usuario", $usuario, PDO::PARAM_INT);
  $query -> bindParam("producto", $producto, PDO::PARAM_INT);
  $query -> bindParam("pagado", $pagado, PDO::PARAM_INT);
  echo $query -> execute();
?>  