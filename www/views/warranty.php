<?php
session_start();
include_once "../models/functions.php";
$error_message = isset($_SESSION["error_message"]) ? $_SESSION["error_message"] : "";
unset($_SESSION["error_message"]);
$guarantees = get_warranty_history();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agencia UNO</title>
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min5.3.css">
    <!-- SweetAlert -->
    <script src="../assets/js/sweetalert2@11.js"></script>
</head>

<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper">
        <!-- HEADER -->
        <?php include "header.php" ?>
        <!-- MENU -->
        <?php include "menu.php" ?>
        <!-- Contenido Principal -->
        <div class="content-wrapper">
            <div class="container-fluid" style="padding:50px;">
                <div class="card mt-4 shadow-lg border-primary">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-search"></i> Buscar Información de Garantía</h4>
                    </div>
                    <div class="card-body">
                        <form id="warranty-form">
                            <div class="form-group mb-3">
                                <label for="serial_number" class="form-label">Número de Serie del Producto</label>
                                <input type="text" name="serial_number" id="serial_number" class="form-control"
                                    placeholder="Ingrese el número de serie" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Buscar
                                    Garantía</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="result" class="mt-4"></div> <!-- Contenedor para mostrar resultados -->


            </div>
        </div>
    <!-- FOOTER -->
    <?php include "footer.php" ?>   
    </div>
     
    <script src="../assets/plugins/jquery/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>     
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <script src="../assets/js/warranty.js"></script>

</body>

</html>