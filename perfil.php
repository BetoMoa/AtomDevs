<?php
include_once 'php/sesiones.php';
include_once 'php/usuario.php';
include_once 'php/conexion.php';
$conexion = new DB();

$usuario = new Usuario();
$sesion = new Sesion();

if (isset($_SESSION['user'])) {
  $usuario->insertarUsuario($sesion->obtenerSesion());
} else {
  echo '<script>window.location = "index.php"</script>';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>AtomDevs</title>

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
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="index.php" class="navbar-brand"><i class="fas fa-atom mr-2"></i>AtomDevs</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navegation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Inicio</a>
        </li>
        <?php
        if (isset($_SESSION['user'])) {
          echo '<li class="nav-item dropdown">
                  <button class="nav-link btn dropdown-toggle"
                  type="button" id="dropdownMenu1" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-user mr-2"></i>
                    ' . $usuario->nombreUsuario() . '
                  </button>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenu1">
                    <a class="dropdown-item" href="perfil.php">Mi cuenta</a>
                    <a class="dropdown-item" href="php/logout.php">Cerrar sesión</a>
                  </div>
                </li>';
        } else {
          echo '<li class="nav-item">
            <a class="nav-link" href="login.php"><i class="fas fa-user mr-2"></i>Iniciar sesión</a>
          </li>';
        }
        ?>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="card my-4">
      <div class="card-header font-weight-bold">Información de la cuenta</div>
      <div class="card-body">
        <form id="editar_perfil">
          <input type="text" hidden value="<?php echo $usuario->idUsuario(); ?>" name="id_usuario" id="id_usuario">
          <div class="row">
            <div class="col-sm">
              <div class="form-group">
                <label for="">Nombre:</label>
                <input type="text" value="<?php echo $usuario->nombreUsuario(); ?>" name="nombre" id="nombre" class="form-control">
              </div>
            </div>
            <div class="col-sm">
              <div class="form-group">
                <label for="">Apellidos:</label>
                <input type="text" value="<?php echo $usuario->apellido(); ?>" name="apellido" id="password" class="form-control">
              </div>
            </div>
            <div class="col-sm">
              <div class="form-group">
                <label for="">Correo electrónico:</label>
                <input type="text" value="<?php echo $usuario->correoUsuario(); ?>" name="email" id="email" class="form-control">
              </div>
            </div>
          </div>
          <div id="msj"></div>
          <button class="btn btn-primary">Guardar cambios</button>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal3">
            Cambiar contraseña
          </button>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModal3Label">Cambia tu contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="cambiar_password">
                  <input type="text" hidden value="<?php echo $usuario->idUsuario(); ?>" name="id_usuario">
                  <div class="form-group"><label for="">Contraseña actual:</label>
                    <input type="password" name="password_actual" class="form-control">
                  </div>
                  <div class="form-group"><label for="">Nueva contraseña:</label>
                    <input type="password" name="password" id="n_password" class="form-control">
                  </div>
                  <div class="form-group"><label for="">Confirmar contraseña:</label>
                    <input type="password" id="c_password" class="form-control">
                  </div>
                  <div id="msj_c"></div>
                  <button class="btn btn-primary">Guardar cambios</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="card">
      <div class="card-header font-weight-bold">Mis pedidos</div>
      <div class="card-body">
        <?php

        $id = $usuario->idUsuario();
        $link = '';

        $consulta = $conexion->connect()->query("SELECT * FROM pedidos INNER JOIN productos ON pedidos.id_producto = productos.id_producto WHERE id_usuario = '$id'");
        $consulta->execute();
        $consulta = $consulta->fetchAll();
        ?>

        <div class="table-responsive">
          <table class="table">
            <thead class="thead-dark text-center">
              <tr>
                <th>No. de pedido</th>
                <th>Producto</th>
                <th>Total</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php
              foreach ($consulta as $producto) {

                if($producto['id_producto'] == 1){
                  $link = 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6T46UPX33NZJQ';
                } else {
                  $link = 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9P3ZF7MB59XR4';
                }
              ?>

                <tr>
                  <td><?php echo $producto['id_pedido'] ?></td>
                  <td><?php echo $producto['nombre_producto'] ?></td>
                  <td><?php echo '$ '.$producto['precio_producto'].' MXN' ?></td>
                  <td><a href="<?php echo $link; ?>" target="_blank" class="btn btn-primary">Terminar compra</a></td>
                  <td><button onclick="eliminar(<?php echo $producto['id_pedido']; ?>)" class="btn btn-danger"><i class="fas fa-trash"></i></button></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
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