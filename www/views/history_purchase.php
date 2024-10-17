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
    <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">

    <!-- SweetAlert -->
    <script src="../assets/js/sweetalert2@11.js"></script>

    <style>
        .dataTables_paginate {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }

        .special-select.select2-container .select2-selection--single {
            height: 38px;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            padding: 6px 12px;
            display: flex;
            align-items: center;
        }

        .special-select .select2-selection__arrow {
            height: 38px;
            top: 1px;
        }

        #filterOptions {
            margin-right: 10px;
        }

        #searchBox {
            height: 38px;
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
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="filterOptions" class="form-label">Filtrar por:</label>
                                <select id="filterOptions" class="form-control select2 special-select">
                                    <option value="">Seleccione una opción</option>
                                    <option value="supplier">Proveedor</option>
                                    <option value="remito_number">Número de Remito</option>
                                    <option value="remito_date">Fecha de Remito</option>
                                    <option value="invoice_number">Número de Factura</option>
                                    <option value="product">Producto</option>
                                    <option value="quantity">Cantidad</option>
                                </select>
                            </div>
                            <div class="table-responsive">
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php include "footer.php"; ?>
        </div>

        <!-- jQuery -->
        <script src="../assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables & Plugins -->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="../assets/plugins/jszip/jszip.min.js"></script>
        <script src="../assets/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="../assets/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="../assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="../assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <!-- Select2 -->
        <script src="../assets/plugins/select2/js/select2.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../assets/dist/js/adminlte.min.js"></script>

        <script>
            $(document).ready(function() {
                // Inicializar DataTable con botones de exportación
                $('#purchaseTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            text: 'Exportar PDF',
                            className: 'btn btn-danger',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            text: 'Imprimir',
                            className: 'btn btn-info',
                            exportOptions: {
                                columns: ':visible'
                            }
                        }
                    ],
                    paging: true,
                    searching: true,
                    ordering: true,
                    responsive: true,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
                    }
                });

                // Inicializar Select2
                $('.select2').select2();

                // Filtro personalizado de Select2
                $('#filterOptions').on('change', function() {
                    var columnIdx = $(this).val();
                    $('#purchaseTable').DataTable().column(columnIdx).search($('#searchBox').val()).draw();
                });

                // Búsqueda en tiempo real
                $('#searchBox').on('keyup', function() {
                    var searchTerm = $(this).val();
                    $('#purchaseTable').DataTable().search(searchTerm).draw();
                });
            });
        </script>
</body>

</html>