<?php
  include_once 'sesiones.php';

  $sesion = new Sesion();

  $sesion -> destruirSesion();

  header("Location:../index.php");
?>