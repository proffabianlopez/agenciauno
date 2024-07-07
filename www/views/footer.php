<?php
session_start();
include_once "../models/functions.php";
if (isset($_SESSION["id_rol"]) && ($_SESSION["id_rol"] == 1 || $_SESSION["id_rol"] == 2)) {
    
} else {
    header("Location: login.php");
    exit();
}
?>
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright © 2024 <a href="#">Practicas Profesionalizantes 3</a>.</strong> Todos los derechos Reservados.
</footer>