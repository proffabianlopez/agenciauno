<?php
session_start();
include_once "../models/functions.php";
// Validar si el usuario tiene permisos
if (!isset($_SESSION["id_rol"]) || ($_SESSION["id_rol"] != 1 && $_SESSION["id_rol"] != 2)) {
    header("Location: login.php");
    exit();
}
// Obtener las ventas pendientes directamente en la vista
$sales = get_sales_by_status(4);

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
    <link rel="stylesheet" href="../assets/css/select.bootstrap5.css">
    <!-- SweetAlert -->
    <script src="../assets/js/sweetalert2@11.js"></script>
    <!-- Incluir el CSS de Select2 -->
    <link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <!-- Hoja de estilo personalizada -->
    <script src="../assets/js/sales.js"></script>
</head>

<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper">
        <!-- HEADER -->
        <?php include "header.php" ?>
        <!-- MENU -->
        <?php include "menu.php" ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-fluid" style="padding:50px;">
            <div class="card" style="margin-top:5px">
                    <div class="card-header">
                        <div class="row mb-12">
                            <div class="col-sm-6">
                                <h4>Pendientes de Despacho</h4>
                            </div>
                        </div>
                    </div>
                </div>                
            
            <div class="card">
                   
                    <!-- Contenido del listado de ventas -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-wrapper">
                                <table id="" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Número de Venta</th>
                                            <th>Cliente</th>
                                            <th>Total Cantidad</th>
                                            <th>Despachar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($sales)): ?>
                                        <?php foreach ($sales as $sale): ?>
                                        <tr>
                                            <td><b><?php echo str_pad($sale['sales_number'], 6, "0", STR_PAD_LEFT); ?></b>
                                            </td>

                                            <td><?php echo $sale['customer_name']; ?></td>
                                            <!-- Mostrar nombre del cliente -->
                                            <td><?php echo $sale['total_qty']; ?></td>
                                            <td>
                                                <a href="../controller/controller_sales.php?action=dispatch&sales_number=<?php echo $sale['sales_number']; ?>"
                                                    title="Despachar">
                                                    <i class="fas fa-truck"
                                                        style="font-size: 20px; color: #007bff;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="4" style="text-align: center;">No hay ventas pendientes</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FOOTER -->
        <?php include "footer.php" ?>
    </div>
    <!-- Incluir jQuery una sola vez -->
    <script src="../assets/plugins/jquery/jquery-3.6.0.min.js"></script>
    <!-- Incluir el JS de Select2 -->
    <script src="../assets/js/select2.js"></script>
    <!-- Bootstrap JS -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bumdle-v5.3.js"></script>
    <script src="../assets/js/bootstrapt.bundle5.3.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <!-- DataTables JS -->
    <script src="../assets/js/jquery.datatables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap5.js"></script>
    <script src="../assets/js/dataTables.js"></script>
    <script src="../assets/js/dataTables.searchPanes.js"></script>
    <script src="../assets/js/searchPanes.bootstrap5.js"></script>
    <script src="../assets/js/dataTables.select.js"></script>
    <script src="../assets/js/select.bootstra5.js"></script>
</body>

</html>