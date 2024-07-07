<?php
session_start();
include_once "../models/functions.php";
if (isset($_SESSION["id_rol"]) && ($_SESSION["id_rol"] == 1 || $_SESSION["id_rol"] == 2)) {
    
} else {
    header("Location: login.php");
    exit();
}
$email_usuario_autenticado = isset($_SESSION['email']) ? $_SESSION['email'] : 'Usuario no autenticado';

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="card card-outline card-primary">
        <div class="container text-center">
            <div class="col-xs-9">
                <div class="card-header text-center">

                    <a href="home.php"
                        style="color: #007bff !important; text-decoration: none !important; background-color: transparent !important;">

                        <h3 class="h3"><b>Agencia</b>UNO</h3>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../assets/img/app/person-circle.svg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <h7 class="d-block" style="color:white"><?php echo htmlspecialchars($email_usuario_autenticado); ?></h7>
            </div>            
        </div>
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cubes"></i>
                        <p>
                            Gestión Interna
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="crud_cliente.php" class="nav-link">
                                <i class="fa fa-address-card nav-icon"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="crud_suppliers_new.php" class="nav-link">
                                <i class="fa fa-truck nav-icon"></i>
                                <p>Proveedores</p>
                            </a>
                        </li>
                        <li class="nav-item">


                            <a href="#" class="nav-link">
                                <i class="fa fa-building nav-icon"></i>
                                <p>Artículos <i class="fas fa-angle-left right"></i></p>

                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="crud_products_new.php" class="nav-link">
                                        <i class="fa fa-microchip nav-icon"></i>
                                        <p>Productos</p>
                                    </a>


                                    <a href="crud_brands_new.php" class="nav-link">

                                        <i class="fa fa-indent nav-icon"></i>
                                        <p>Marcas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="crud_category.php" class="nav-link">
                                        <i class="fa fa-indent nav-icon"></i>
                                        <p>Categorias</p>
                                    </a>
                                </li>
                            </ul>

                        </li>
                        <li class="nav-item">
                        <?php if (isset($_SESSION["id_rol"])) {
            if($_SESSION["id_rol"]=== 1) {?> 
                            <a href="crud_usuarios.php" class="nav-link">

                                <i class="fa fa-user nav-icon"></i>
                                <p>Usuarios</p>
                            </a>
                            <?php }} ?> 
                        </li>


                    </ul>
                </li>

        </nav>
        <br><br>
        <div class="info">
            <a href="../controller/logout.php" style="text-decoration: none !important">
                <h5 class="d-block" style="color:white">&#128274; Cerrar Sesión</h5>
            </a>

        </div>
        <!-- /.sidebar-menu -->
    </div>


    <!-- /.sidebar -->
</aside>

<!-- Font Awesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>