  <?php
  session_start();
  include_once "../models/functions.php";
  if (isset($_SESSION["id_rol"]) && ($_SESSION["id_rol"] == 1 || $_SESSION["id_rol"] == 2)) {
  } else {
      header("Location: login.php");
      exit();
  }
  $userEmail = $_SESSION['email'];
$usuario = obtenerUsuarioPorEmail($userEmail);
  ?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars" style="margin-left:15px"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <span class="nav-link" style="font-weight: bold;">Rol: <?php echo htmlspecialchars($usuario['rol']); ?></span>
            </li>
        </ul>
    </div>
</nav>

