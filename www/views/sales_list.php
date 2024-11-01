<?php
session_start();
include_once "../models/functions.php";
// Validar si el usuario tiene permisos
if (!isset($_SESSION["id_rol"]) || ($_SESSION["id_rol"] != 1 && $_SESSION["id_rol"] != 2)) {
    header("Location: login.php");
    exit();
}

$sales = get_sales_history();

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
    <script src="../assets/js/sweetalert2@11.js"></script>

    <style>
    /* Sombra mejorada para todos los botones al hacer clic */
    .btn-shadow:active {
        box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.5);
    }

    /* Estilo del enlace de número de venta */
    .venta-link {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .venta-link i {
        color: #6c757d;
        font-size: 0.9em;
    }

    .venta-link:hover {
        color: #0056b3;
        transform: scale(1.05);
        /* Efecto de zoom leve */
        text-decoration: underline;
    }

    .venta-link:hover i {
        color: #007bff;
        /* Cambia el color del ícono al hacer hover */
    }
    </style>
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
                        <h4 class="mb-0"><b>Histórico de Ventas</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="salesTable" class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Número de Venta</th>
                                        <th>Cliente</th>
                                        <th>Fecha de Venta</th>
                                        <th>Imprimir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($sales)): ?>
                                    <?php foreach ($sales as $sale): ?>
                                    <tr>
                                        <td style="width: 20%;">
                                            <a href="sales_detail.php?id=<?php echo $sale['sales_number']; ?>"
                                                class="venta-link" title="Ver detalles de la venta">
                                                <b><?php echo str_pad($sale['sales_number'], 6, "0", STR_PAD_LEFT); ?></b>
                                                <i class="fas fa-search ms-1"></i>
                                            </a>
                                        </td>
                                        <td style="width: 50%;"><?php echo $sale['customer_name']; ?></td>
                                        <td style="width: 20%;">
                                            <?php echo isset($sale['sale_date']) ? date('d-m-Y', strtotime($sale['sale_date'])) : date('d-m-Y'); ?>
                                        </td>
                                        <td style="width: 10%;" class="text-center">
                                            <i class="fas fa-print text-primary"
                                                style="cursor: pointer; font-size: 1.2em;"
                                                onclick="validarYImprimir('<?= $sale['sales_number']; ?>');"
                                                title="Imprimir venta"></i>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No hay ventas pendientes</td>
                                    </tr>
                                    <?php endif; ?>
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
    <script src="../assets/js/history_sales.js"></script>
    
</body>

</html>