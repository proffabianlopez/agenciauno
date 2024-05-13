<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agencia 1</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="Resources/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="Resources/plugins/fontawesome-free/css/all.min.css">
    <Link rel="stylesheet" href="Resources/dist/css/agencia1.css">
    </Link>
    <!-- Theme style -->

</head>

<body class="sidebar-mini" style="height: auto;">

<!-- Site wrapper -->
    <div class="wrapper">
    <!-- HEADER -->
    <?php include "Modules/Header.php"?>   
        <!-- HEADER -->       

        <!-- MENU -->
        <?php include "Modules/Menu.php"?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 1604.8px;">

            <div class="row justify-content-start">
                <div class="col-9">
                <b>ACCESOS DIRECTOS
                </div>
            </div>

       
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-4">PRODUCTOS
                        <img src="Resources/img/items_2.png" class="col-md-4" alt="">
                    </div>
                    <div class="col-md-4">PROVEEDORES
                        <img src="Resources/img/proveedores.png" class="col-md-4" alt="">
                    </div>
                </div>
            </div>

            <div class="container text-center">
                <div class="row">
                    <div class="col-md-4">CLIENTES
                        <img src="Resources/img/clientes.png" class="col-md-4" alt="">
                    </div>
                    <div class="col-md-4">TRANSACCIONES
                        <img src="Resources/img/transacciones.png" class="col-md-4" alt="">
                    </div>
                </div>
            </div>

        </div>

        <!-- FOOTER -->
        <?php include "Modules/Footer.php"?>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="Resources/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="Resources/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="Resources/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="Resources/dist/js/demo.js"></script>


</body>

</html>