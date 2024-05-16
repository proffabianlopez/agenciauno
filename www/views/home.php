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
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <Link rel="stylesheet" href="../assets/dist/css/agencia1.css">
    </Link>
    <!-- Theme style -->

</head>

<body class="sidebar-mini" style="height: auto;">

    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- HEADER -->
        <?php include "header.php"?>
        <!-- HEADER -->

        <!-- MENU -->
        <?php include "menu.php"?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 1604.8px;">

            <div class="row justify-content-start">
                <div class="col-9">
                    <b>ACCESOS DIRECTOS
                </div>
            </div>


            <div class="container text-center">
                <div class="row">
                    <div class="col-md-4"><a href="template.php"><b>PRODUCTOS</b>
                        <img src="../assets/img/app/items_2.png" class="col-md-4" alt=""></a>
                    </div>
                    <div class="col-md-4"><a href="template.php"><b>PROVEEDORES</b>
                        <img src="../assets/img/app/proveedores.png" class="col-md-4" alt=""></a>
                    </div>
                </div>
            </div>

            <div class="container text-center">
                <div class="row">
                    
                        <div class="col-md-4"><a href="clients.php"><b>CLIENTES</b>
                        <img src="../assets/img/app/clientes.png" class="col-md-4" alt=""></a>
                        </div>
                    

                    <div class="col-md-4"><a href="template.php"><b>TRANSACCIONES</b>
                        <img src="../assets/img/app/transacciones.png" class="col-md-4" alt=""></a>
                    </div>
                </div>
            </div>

        </div>        

        <!-- FOOTER -->
        <?php include "footer.php"?>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>



</body>

</html>