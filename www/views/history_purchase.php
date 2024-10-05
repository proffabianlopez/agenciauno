<?php
session_start();
include_once "../models/functions.php";
$purchases = get_purchase_history();
$show = show_state("suppliers");
$showP = show_state("products");

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
    <title>Agencia UNO - Compras</title>

    <!-- Cargar jQuery antes de cualquier otro script -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- Estilos de AdminLTE y Bootstrap 5 -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/history.css">
</head>

<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper">
        <!-- Incluyendo el header y el menú -->
        <?php include "../views/header.php"; ?>
        <?php include "../views/menu.php"; ?>

        <div class="content-wrapper">
            <div class="container-fluid" style="padding:50px;">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h4><b>Historial de Compras</b></h4>
                    </div>
                    <div class="card-body p-4">
                        <table id="purchaseTable" class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Número de Compra</th>
                                    <th>Proveedor</th>
                                    <th>Número de Remito</th>
                                    <th>Fecha de Remito</th>
                                    <th>Número de Factura</th>
                                    <th>Productos</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($purchases as $purchase) : ?>
                                    <tr>
                                        <td><?= $purchase['id_purchase']; ?></td>
                                        <td><?= $purchase['name_supplier']; ?></td>
                                        <td><?= $purchase['remito_number']; ?></td>
                                        <td><?= $purchase['remito_date']; ?></td>
                                        <td><?= $purchase['invoice_number']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info" onclick="loadProductDetails(<?= $purchase['id_purchase']; ?>)" data-bs-toggle="modal" data-bs-target="#productDetailsModal">
                                                Ver Productos
                                            </button>
                                        </td>
                                        <td><?= $purchase['qty']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para ver detalles de productos -->
        <div class="modal fade" id="productDetailsModal" tabindex="-1" aria-labelledby="productDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productDetailsModalLabel">Detalles de Productos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="productDetailsContent">
                        <!-- Los detalles del producto se cargarán aquí -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <?php include "footer.php"; ?>
    </div>

    <!-- Scripts -->
    <!-- Cargar primero Bootstrap y después otros scripts que dependan de él -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <script src="../assets/js/sweetalert2@11.js"></script>
    <script src="../assets/js/purchase.js"></script>

</body>

</html>