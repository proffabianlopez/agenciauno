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

    <!--<Link rel="stylesheet" href="../assets/dist/css/agencia1.css"-->
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

            <div class="container-fluid" style="padding:125px;">
                
                <div class="row">

                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header" style="display: block;text-align:center">
                                <h2 class="card-title"><b>Clientes</b></h2>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;text-align:center">
                                <a href="lista_cliente.php">
                                    <img src="../assets/img/app/clientes.png" class="col-md-4" alt=""></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header" style="display: block;text-align:center">
                                <h2 class="card-title"><b>Proveedores</b></h2>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;text-align:center">
                                <a href="home.php">
                                    <img src="../assets/img/app/proveedores.png" class="col-md-4" alt=""></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>

                </div>
                <br><br><br><br>

                <div class="row">

                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header" style="display: block;text-align:center">
                                <h2 class="card-title"><b>Productos</b></h2>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;text-align:center">
                                <a href="home.php">
                                    <img src="../assets/img/app/items_2.png" class="col-md-4" alt=""></a>
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header" style="display: block;text-align:center">
                                <h2 class="card-title"><b>Transacciones</b></h2>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;text-align:center">
                                <a href="home.php">
                                    <img src="../assets/img/app/transacciones.png" class="col-md-4" alt=""></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
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