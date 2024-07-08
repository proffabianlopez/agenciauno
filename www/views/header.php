  <?php
  session_start();
  include_once "../models/functions.php";
  if (isset($_SESSION["id_rol"]) && ($_SESSION["id_rol"] == 1 || $_SESSION["id_rol"] == 2)) {
      
  } else {
      header("Location: login.php");
      exit();
  }
  $userEmail = $_SESSION['email'];
  // Obtener los detalles del usuario y su rol
$usuario = obtenerUsuarioPorEmail($userEmail);


  ?>
  
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

      <ul class="navbar-nav">
          <li class="nav-item dropdown">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"style="margin-left:15px"></i></a>
      </ul>
      <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <span class="nav-link" style=" font-weight: bold; margin-right: 20px;">Rol: <?php echo htmlspecialchars($usuario['rol']); ?></span>
            </li>
        </ul>
  </nav>
