<?php
include_once 'php/sesiones.php';
include_once 'php/usuario.php';
include_once 'php/conexion.php';

$usuario = new Usuario();
$sesion = new Sesion();
$conexion = new DB();

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

  <?php include_once 'vistas/navbar.inc.php'; ?>

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

  <?php
  $landing = $conexion->connect()->query("SELECT id_producto FROM productos WHERE id_producto =" . '1');
  $landing->execute();
  $landing = $landing->fetch();

  $tienda = $conexion->connect()->query("SELECT id_producto FROM productos WHERE id_producto =" . '2');
  $tienda->execute();
  $tienda = $tienda->fetch(); 
  ?>

  <div id="servicios">

    <h4 class="text-center my-4">Nuestros paquetes</h4>

    <div class="d-sm-flex justify-content-sm-center align-items-sm-center mb-2">
      <div class="card tamaño shadow mx-auto mb-3">
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
          ?>
            <form id="landing">
              <input type="text" hidden name="id_producto" value="<?php echo $landing['id_producto']; ?>">
              <input type="text" hidden name="id_usuario" value="<?php echo $usuario->idUsuario(); ?>">
              <button type="submit" class="btn btn-dark">Agregar al carrito</button>
            </form>
          <?php
          } else {
            echo '<a href="login.php" class="btn btn-dark">Obtener ahora</a>';
          }
          ?>
        </div>
      </div>

      <div class="card tamaño shadow mx-auto mb-3">
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
          ?>
            <form id="tienda">
              <input type="text" hidden name="id_producto" value="<?php echo $tienda['id_producto']; ?>">
              <input type="text" hidden name="id_usuario" value="<?php echo $usuario->idUsuario(); ?>">
              <button type="submit" class="btn btn-dark">Agregar al carrito</button>
            </form>
          <?php
          } else {
            echo '<a href="login.php" class="btn btn-dark">Obtener ahora</a>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="">
    <div class="text-center bg-dark text-white py-3">
      <p>Copyright &copy; 2020 AtomDevs</p>
      <div class="d-sm-flex justify-content-center align-items-center">
        <a href="https://www.facebook.com/" target="_blank" class="mx-2 text-decoration-none btn btn-outline-light border-0 rounded-circle"><i class="fab fa-facebook"></i></a>
        <a href="https://github.com/BetoMoa/AtomDevs.git" target="_blank" class="mx-2 text-decoration-none btn btn-outline-light border-0 rounded-circle"><i class="fab fa-github"></i></a>
      </div>
    </div>
  </footer>

  <!-- Javascript links -->
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>