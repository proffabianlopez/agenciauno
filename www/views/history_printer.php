<?php
session_start();
include_once "../models/functions.php";

// Obtener datos de impresoras, clientes y alquileres
//$printers = get_printers();
//$clients = get_clients();
//$rentals = get_rentals();

if (!isset($_SESSION["id_rol"]) || ($_SESSION["id_rol"] != 1 && $_SESSION["id_rol"] != 2)) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Alquileres - Agencia UNO</title>
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Bootstrap JS -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert -->
    <script src="../assets/js/sweetalert2@11.js"></script>
    <link rel="stylesheet" href="../assets/css/datatables.css">
    <script src="../assets/js/sweetalert2@11.js"></script>
</head>
<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper">
        <?php include "header.php"; ?>
        <?php include "menu.php"; ?>

        <div class="content-wrapper">
            <div class="container-fluid" style="padding:50px;">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h4><b>Historial de Alquileres</b></h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table id="rentalTable" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Impresora (Número de Serie)</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Finalización</th>
                                        <th>Contador Inicial</th>
                                        <th>Contador Final</th>
                                        <th>Detalles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rentals as $rental) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($rental['client_name']); ?></td>
                                        <td><?= htmlspecialchars($rental['serial_number']); ?></td>
                                        <td><?= date('d-m-Y', strtotime($rental['start_date'])); ?></td>
                                        <td><?= date('d-m-Y', strtotime($rental['end_date'])); ?></td>
                                        <td><?= $rental['initial_page_count']; ?></td>
                                        <td><?= $rental['final_page_count']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info"
                                                data-id-rental="<?= $rental['id_rental']; ?>"
                                                data-bs-toggle="modal" data-bs-target="#rentalDetailsModal">
                                                Ver Detalles
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "footer.php"; ?>
    </div>

    <!-- Modal para ver detalles del alquiler -->
    <div class="modal fade" id="rentalDetailsModal" tabindex="-1" aria-labelledby="rentalDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rentalDetailsModalLabel">Detalles del Alquiler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="rentalDetailsContent">
                    <!-- Los detalles del alquiler se cargarán aquí -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/plugins/jquery/jquery-3.6.0.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="../assets/js/rentals.js"></script>
</body>
</html>
