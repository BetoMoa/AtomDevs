<?php
  include_once 'conexion.php';
  $conexion = new DB();

  $id = $_POST['id'];

  $query = $conexion -> connect() -> query("DELETE FROM pedidos WHERE id_pedido = '$id'");
  echo $query -> execute();
?>