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
    <title>Agencia UNO</title>
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min5.3.css">
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="../assets/css/searchPanes.bootstrap5.css">
    <link rel="stylesheet" href="../assets/css/buttons.bootstrap5.css">

    <link rel="stylesheet" href="../assets/css/select.bootstrap5.css">
    <!-- SweetAlert -->
    <script src="../assets/js/sweetalert2@11.js"></script>
    <!-- Incluir el CSS de Select2 -->
    <link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" />

    <!-- Estilos personalizados para DataTables -->
    <style>
        .dataTables_paginate {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px; /* Espacio entre la tabla y el paginador */
        }

        .dataTables_paginate .paginate_button {
            padding: 5px 10px;
            margin: 0 2px;
        }

        /* Estilo para la información de la tabla (Mostrando página) */
        .dataTables_info {
            text-align: center;
            margin-bottom: 10px; /* Espacio entre la info y la tabla */
        }

        /* Ajustar el estilo de los botones de paginación */
        .dataTables_paginate a {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 6px 12px;
            color: #007bff;
        }

        .dataTables_paginate a:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper">
        <?php include "header.php"; ?>
        <?php include "menu.php"; ?>

        <div class="content-wrapper">
            <div class="container-fluid" style="padding:50px;">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h4><b>Historial de Compras</b></h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <div class="table-wrapper">
                                <table id="purchaseTable" class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
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
                                            <td><?= $purchase['name_supplier']; ?></td>
                                            <td><?= $purchase['remito_number']; ?></td>
                                            <td><?= date('d-m-Y', strtotime($purchase['remito_date'])); ?></td>
                                            <td><?= $purchase['invoice_number']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-info"
                                                    onclick="loadHistoryDetails('<?php echo $purchase['remito_number']; ?>')"
                                                    data-bs-toggle="modal" data-bs-target="#productHistoryModal">
                                                    Ver Productos
                                                </button>
                                            </td>

                                            <td><?= $purchase['total_qty']; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal para ver detalles de productos -->
        <div class="modal fade" id="productHistoryModal" tabindex="-1" aria-labelledby="productHistoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productHistoryModalLabel">Detalles de Compra</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="HistoryDetailsContent">
                        <!-- Los detalles del producto se cargarán aquí -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FOOTER -->
        <?php include "footer.php"; ?>
    </div>
   <!-- Incluir jQuery -->
   <script src="../assets/plugins/jquery/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="../assets/js/jquery.datatables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap5.js"></script>
    <!-- Bootstrap JS -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle-v5.3.js"></script>
    <script src="../assets/js/bootstrapt.bundle5.3.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>

    <!-- Otros scripts adicionales -->
    <script src="../assets/js/history.js"></script>
    <script src="../assets/js/select2.js"></script>
    <script src="../assets/js/dataTables.searchPanes.js"></script>
    <script src="../assets/js/searchPanes.bootstrap5.js"></script>
    <script src="../assets/js/dataTables.select.js"></script>
    <script src="../assets/js/select.bootstrap5.js"></script>

</body>

</html>