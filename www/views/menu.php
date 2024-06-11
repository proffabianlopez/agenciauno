<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->    
    <a href="home.php" class="brand-link bg-white">
    
    <div class="container text-center">                
                    <div class="col-xs-9">
                    <img src="../assets/img/app/Agencia_1_F.png" class="col-xs-9" height="35%" width="35%" alt="">                
                </div>
            </div>    
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
       

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Productos
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="crud_products.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear Producto</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="home.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Volver</p>
                            </a>
                        </li>                                           
                    </ul>
                </li>       
                
                <!--Customers-->

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Proveedores
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../views/crud_suppliers.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear Proveedores</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../views/home.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Volver</p>
                                
                            </a>
                        </li>
                                            
                    </ul>
                </li> 


                <!--Vendors-->

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Marcas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../views/crud_brands.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear Marcas</p>
                            </a>
                        </li>

                            <a href="lista_cliente.php" class="nav-link">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Volver</p>
                            </a>
                        </li>
                                              
                    </ul>
                </li> 


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>