<?php
session_start();
include_once "../models/functions.php";
if (isset($_SESSION["id_rol"]) && ($_SESSION["id_rol"] == 1 || $_SESSION["id_rol"] == 4)) {
    
} else {
    header("Location: login.php");
    exit();
}
?>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </ul>
     

      
  </nav>
  