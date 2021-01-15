<?php
include_once 'php/sesiones.php';
include_once 'php/usuario.php';

$usuario = new Usuario();
$sesion = new Sesion();

if (isset($_SESSION['user'])) {
  $usuario->insertarUsuario($sesion->obtenerSesion());
  echo '<script>window.location="index.php"</script>';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Inicia sesión</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <!-- Main CSS -->
  <link rel="stylesheet" href="assets/css/main.css" />
  <!-- Fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>

<body>

  <div id="login" class="text-center shadow-lg">

    <h4 class="my-3">Acceder</h4>

    <form id="iniciar_sesion">
      <div class="form-group">
        <input type="text" name="email" placeholder="Ingresa tu correo electrónico" class="form-control" required>
      </div>

      <div class="form-group">
        <input type="password" name="password" placeholder="Ingresa tu contraseña" class="form-control" required>
      </div>

      <div id="msj"></div>

      <button type="submit" class="btn btn-primary">Iniciar sesión</button>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal3">
        Crear cuenta
      </button>
    </form>
    <button class="btn btn-link my-2">Olvide mi contraseña</button>
    <a href="index.php" class="icono d-block shadow-sm text-decoration-none font-weight-bold p-2 text-dark"><i class="fas fa-atom mr-2"></i>AtomDevs</a>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModal3Label">Crea tu cuenta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="nuevo_usuario">
            <div class="form-group">
              <label for="">Nombres:</label>
              <input type="text" name="nombres" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="">Apellidos:</label>
              <input type="text" name="apellidos" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="">Correo electrónico:</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="">Contraseña:</label>
              <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="">Confirmar contraseña:</label>
              <input type="password" id="confirmar_password" class="form-control" required>
            </div>
            <div id="mensaje"></div>
            <button type="submit" class="btn btn-success">Crear cuenta</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Javascript links -->
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>