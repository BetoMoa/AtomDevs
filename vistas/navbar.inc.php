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

        $conexion = new DB();

        $id = $usuario->idUsuario();

        $consulta = $conexion->connect()->query("SELECT * FROM pedidos INNER JOIN productos ON pedidos.id_producto = productos.id_producto WHERE id_usuario = '$id'");
        $consulta->execute();
        $numero_productos = $consulta -> rowCount();
        $consulta = $consulta->fetchAll();
      ?>
        <li class="nav-item dropdown">
          <button class="nav-link btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user mr-2"></i>
            <?php echo $usuario->nombreUsuario(); ?>
          </button>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenu1">
            <a class="dropdown-item" href="perfil.php">Mi cuenta</a>
            <a class="dropdown-item" href="php/logout.php">Cerrar sesión</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <button class="nav-link btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-shopping-cart"></i><sup class="bg-primary p-1 rounded-sm rounded-circle font-weight-bold text-white"><?php echo $numero_productos; ?></sup>
          </button>
          <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="dropdownMenu2">
            <?php
            foreach ($consulta as $producto) {
            ?>
              <div class="carrito card mx-1 d-sm-flex justify-content-center align-items-center my-1">
                <p><?php echo $producto['nombre_producto'] ?></p>
                <p><?php echo "$ " . $producto['precio_producto'] . " MXN" ?></p>
              </div>
            <?php
            }
            ?>
            <?php
              if($numero_productos != 0){
                echo '<a href="perfil.php" class="btn btn-outline-dark text-center">Terminar compra</a>';
              } else {
                echo '<p class="mx-1">Aun no tienes nada en tu carrito</p>';
              }
            ?>
          </div>
        </li>

      <?php
      } else {
        echo '<li class="nav-item">
            <a class="nav-link" href="login.php"><i class="fas fa-user mr-2"></i>Iniciar sesión</a>
          </li>';
      }
      ?>
    </ul>
  </div>
</nav>