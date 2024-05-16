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
    <style>
    .button1 {
        background-color: #00a135;
        border: none;
        color: white;
        padding: 5px 12px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        margin: 0px 4px 7px;
        cursor: pointer;
    }
    </style>
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


            <main>
                <div class="container-fluid" style="padding-top:50px; padding-left:150px">
                    <div class="card mb-4" style="margin-top:5px; max-width: 860px;">
                        <h4 class="card-header card text-white bg-info"
                            style="text-align:center; height: 40px; padding: 5px;">
                            <b>Agregar Nuevo Cliente</b>
                        </h4>
                        <br>

                        <div class="card-body">
                            <form id="formManualRegister" class="form needs-validation" action="" method="post">
                                <div class="form-row">
                                    <label for="user" class="col col-lg-2 col-form-label">Código Cliente: </label>
                                    <div class="col-sm-10">
                                        <input ID="id_user" placeholder="Código Automático" type="text"
                                            Class="form-control-sm" name="id_user" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="user" class="col-sm-2 col-form-label">CUIT / CUIL: </label>
                                    <div class="col-sm-10">
                                        <input ID="id_user" type="text" Class="form-control-sm" name="id_user" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="user" class="col-sm-2 col-form-label">Cliente: </label>
                                    <div class="col-sm-10">
                                        <input ID="id_user" placeholder="Nombre Cliente" type="text"
                                            Class="form-control-sm" name="id_user" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="user" class="col-sm-2 col-form-label">Email: </label>
                                    <div class="col-sm-10">
                                        <input ID="id_user" type="text" Class="form-control-sm" name="id_user" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="user" class="col-sm-2 col-form-label">Teléfono: </label>
                                    <div class="col-sm-10">
                                        <input ID="id_user" type="text" Class="form-control-sm" name="id_user" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="user" class="col-sm-2 col-form-label">Dirección: </label>
                                    <div class="col-sm-10">
                                    <input ID="id_user" type="text" Class="form-control-sm" name="id_user" required>    
                                        <b>&nbsp&nbsp Altura: </b>
                                        <input ID="id_user" type="text" Class="form-control-sm" name="id_user" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="user" class="col-sm-2 col-form-label">Ciudad: </label>
                                    <div class="col-sm-10">
                                       
                                        <input ID="id_user" type="text" Class="form-control-sm" name="id_user" required>
                                    </div>
                                </div>

                             
                                <div class="form-row">
                                    <label for="user" class="col-sm-2 col-form-label">Observaciones: </label>
                                    <div class="col-sm-10">
                                        <input ID="id_user" type="text" Class="form-control" name="id_user" required>
                                    </div>
                                </div>

                                <br>

                                <div class="form-row">
                                    <label for="time" class="col-sm-2 col-form-label">Habilitado:</label>
                                    <div class="col-7">
                                        <input ID="time" type="checkbox" Class="form-control-sm" name="time" required>
                                    </div>
                                </div>

                                <br>

                                <button type="submit" class="btn btn-success" data-action="new"> <b>Agregar
                                        Cliente</button>
                                
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </main>





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