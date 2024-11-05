<?php
session_start();
include_once "../models/functions.php";
// Validar si el usuario tiene permisos
if (!isset($_SESSION["id_rol"]) || ($_SESSION["id_rol"] != 1 && $_SESSION["id_rol"] != 2)) {
    header("Location: login.php");
    exit();
}

$purchases = get_purchase_history();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agencia UNO</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../assets/css/history_new.css">
    <script src="../assets/js/sweetalert2@11.js"></script>
</head>

<body class="sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- HEADER -->
        <?php include "header.php" ?>
        <!-- MENU -->
        <?php include "menu.php" ?>
        <div class="content-wrapper">
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between bg-primary text-white">
                        <h4 class="mb-0"><b>Histórico de Compras</b></h4>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center bg-secondary text-white">
                            <h5 class="mb-0">Filtros de Búsqueda de Compras</h5>
                            <button class="btn btn-light btn-sm" onclick="limpiarFiltros()">Limpiar Filtros</button>
                        </div>
                        <div class="card-body">
                            <form id="filterForm">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="date_from">Fecha desde:</label>
                                        <input type="text" id="date_from" name="date_from" class="form-control"
                                            placeholder="DD-MM-YYYY" maxlength="10">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="date_to">Fecha hasta:</label>
                                        <input type="text" id="date_to" name="date_to" class="form-control"
                                            placeholder="DD-MM-YYYY" maxlength="10">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="remito_number">Número de Remito:</label>
                                        <input type="text" id="remito_number" name="remito_number" class="form-control"
                                            placeholder="Número de remito">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="invoice_number">Número de Factura:</label>
                                        <input type="text" id="invoice_number" name="invoice_number"
                                            class="form-control" placeholder="Número de factura">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label for="supplier_name">Proveedor:</label>
                                        <input type="text" id="supplier_name" name="supplier_name" class="form-control"
                                            placeholder="Nombre del proveedor">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <button type="button" onclick="aplicarFiltros()"
                                            class="btn btn-primary mt-4">Aplicar Filtros</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="purchaseTable" class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Número de Factura</th>
                                        <th>Fecha de Factura</th>
                                        <th>Proveedor</th>
                                        <th>Número de Remito</th>
                                        <th>Fecha de Remito</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($purchases as $purchase) : ?>
                                    <tr>
                                        <td style="width: 10%;">
                                            <a href="purchase_detail.php?id=<?php echo $purchase['invoice_number']; ?>"
                                                class="venta-link" title="Ver detalles de la compra">
                                                <b><?php echo $purchase['invoice_number']; ?></b>
                                                <i class="fas fa-search ms-1"></i>
                                            </a>
                                        </td>

                                        <td style="width: 15%;">
                                            <?= date('d-m-Y', strtotime($purchase['invoice_date'])); ?></td>
                                        <td style="width: 30%;"><?= $purchase['name_supplier']; ?></td>
                                        <td style="width: 10%;"><?= $purchase['remito_number']; ?></td>
                                        <td style="width: 20%;">
                                            <?= date('d-m-Y', strtotime($purchase['remito_date'])); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-danger btn-shadow" onclick="confirmarExportacion('PDF')"
                        title="Exportar a PDF">
                        <i class="fas fa-file-pdf"></i> PDF
                    </button>
                    <button class="btn btn-success btn-shadow" onclick="confirmarExportacion('Excel')"
                        title="Exportar a Excel">
                        <i class="fas fa-file-excel"></i> Excel
                    </button>
                </div>
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
    <script src="../assets/js/history.js"></script>

</body>

</html>