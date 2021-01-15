<?php
include_once 'php/sesiones.php';
include_once 'php/usuario.php';

$usuario = new Usuario();
$sesion = new Sesion();

if (isset($_SESSION['user'])) {
  $usuario->insertarUsuario($sesion->obtenerSesion());
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
          <a class="nav-link" href="#home">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#servicios">Servicios</a>
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

  <!-- Contenedor principal -->
  <div id="home" class="d-flex justify-content-center align-items-center">
    <div class="text-center mx-2">
      <h1>¿Buscas hacer crecer tu negocio?</h1>
      <p>Ve nuestros planes para que tengas tu página web y haz que todo el mundo te vea.</p>
      <a href="#servicios" class="btn btn-primary">Ver más</a>
    </div>
  </div>

  <div class="container-fluid d-sm-flex justify-content-around align-items-center p-4">
    <div class="text-center">
      <h3>¿Por qué es importante que tengas un sitio web para tu negocio?</h3>
      <p class="mt-4">Hoy en dia muchos negocios se estan posicionando en la web para generar mas ventas y que sean
        reconocidos de manera mas rapida, mediante su sitio web.</p>
    </div>
    <img src="assets/img/code.svg" alt="">
  </div>

  <div id="servicios">

    <h4 class="text-center my-4">Nuestros paquetes</h4>

    <div class="d-sm-flex justify-content-around align-items-center mx-auto mb-5">
      <div class="card-group">
        <div class="card tamaño shadow">
          <img src="assets/img/landing.webp" alt="" class="card-img-top">
          <div class="card-body text-center">
            <h4 class="card-title">Landing page</h4>
            <div class="text-left ">
              <ul class="ml-3">
                <li>Sitio personalizado</li>
                <li>Anuncios personalzados</li>
                <li>Portafolio</li>
                <li>Formulario de contacto</li>
                <li>Correo electrónico corporativo</li>
              </ul>
            </div>
            <?php
            if (isset($_SESSION['user'])) {
              echo '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6T46UPX33NZJQ" target="_blank" class="btn btn-dark">Obtener ahora</a>';
            } else {
              echo '<a href="login.php" class="btn btn-dark">Obtener ahora</a>';
            }
            ?>
          </div>
        </div>
      </div>

      <div class="card-group">
        <div class="card tamaño shadow">
        <img src="assets/img/tienda.png" alt="" class="card-img-top">
        <div class="card-body text-center">
          <h4 class="card-title">Tienda en línea</h4>
          <div class="text-left ">
            <ul class="ml-3">
              <li>Sitio personalizado</li>
              <li>Pasarela de pagos con PayPal</li>
              <li>Panel administrativo para agregar <br> tus productos</li>
              <li>Correo electrónico corporativo</li>
            </ul>
          </div>
          <?php
          if (isset($_SESSION['user'])) {
            echo '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9P3ZF7MB59XR4" target="_blank" class="btn btn-dark">Obtener ahora</a>';
          } else {
            echo '<a href="login.php" class="btn btn-dark">Obtener ahora</a>';
          }
          ?>
        </div>
      </div>
      </div>
    </div>
  </div>


  <!-- Footer -->
  <footer class="">
    <div class="text-center bg-dark text-white">
      <p class="py-4">Copyright &copy; 2020 AtomDevs</p>
    </div>
  </footer>

  <!-- Javascript links -->
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>