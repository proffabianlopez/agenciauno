<?php
session_start();
include_once "../models/functions.php";
// Validar si el usuario tiene permisos
if (!isset($_SESSION["id_rol"]) || ($_SESSION["id_rol"] != 1 && $_SESSION["id_rol"] != 2)) {
    header("Location: login.php");
    exit();
}
$guarantees = get_warranty_history();

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
                        <h4 class="mb-0"><b>Histórico de Garantías</b></h4>
                    </div>                 

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="guaranteesTable" class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Garantía</th>
                                        <th>Número de Serie</th>
                                        <th>Comentarios Técnicos</th>
                                        <th>Proveedor</th>
                                        <th>Estado</th>
                                        <th>Fecha de Creación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($guarantees)): ?>
                                    <?php foreach ($guarantees as $guarantee): ?>
                                    <tr>
                                        <td style="width: 20%;">
                                            <a href="warranty_management.php?id_warranty=<?php echo $guarantee['guarantee_id']; ?>"
                                                class="venta-link" title="Ver detalles de la garantía">
                                                <b><?php echo str_pad($guarantee['guarantee_id'], 6, "0", STR_PAD_LEFT); ?></b>
                                                <i class="fas fa-search ms-1"></i>
                                            </a>
                                        </td>
                                        <td><?php echo $guarantee['serial_number']; ?></td>
                                        <td><?php echo $guarantee['technician_comments'] ?? 'No disponible'; ?></td>
                                        <td><?php echo $guarantee['name_supplier'] ?? 'No disponible'; ?></td>
                                        <td><?php echo $guarantee['status'] ?? 'No disponible'; ?></td>
                                        <td><?php echo isset($guarantee['review_date']) ? date('d-m-Y', strtotime($guarantee['review_date'])) : 'No disponible'; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No hay garantías registradas</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
    <script src="../assets/js/history_warranty.js"></script>

</body>

</html>