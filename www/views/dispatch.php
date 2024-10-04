<?php
session_start();
include_once "../models/functions.php";

$showP = show_state("products");
$clientes = obtenerclientes();
if (isset($_SESSION["id_rol"]) && ($_SESSION["id_rol"] == 1 || $_SESSION["id_rol"] == 2)) {
} else {
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

    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- HEADER -->
        <?php include "header.php" ?>
        <!-- MENU -->
        <?php include "menu.php" ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 1604.8px;">

            <div class="container-fluid" style="padding:50px;">
                <div class="card" style="margin-top:5px">
                    <div class="card-header">
                        <div class="row mb-12">
                            <div class="col-sm-6">
                                <h4>Despacho de la Venta N° <?php echo str_pad($sales_number, 6, "0", STR_PAD_LEFT); ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" style="display: block; text-align:center">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <!-- Formulario para confirmar el despacho -->
                        <form id="dispatchForm" action="../controller/controller_sales.php?action=process_dispatch"
                            method="POST">
                            <input type="hidden" name="sales_number" value="<?php echo $sales_number; ?>">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Número de Serie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sale_details as $detail): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($detail['full_product_name']); ?></td>
                                        <td><?php echo htmlspecialchars($detail['quantity']); ?></td>
                                        <td>
                                            <!-- Botón para seleccionar números de serie -->
                                            <button type="button" class="btn btn-secondary"
                                                onclick="openSerialModal(<?php echo $detail['id_product']; ?>, <?php echo $detail['quantity']; ?>)">
                                                <i class="fas fa-plus-circle fa-lg"></i>
                                            </button>

                                            <!-- Campo oculto para los seriales seleccionados -->
                                            <input type="hidden"
                                                name="serial_numbers[<?php echo $detail['id_product']; ?>]"
                                                id="serials_<?php echo $detail['id_product']; ?>" />

                                            <!-- Aquí se mostrará una lista de los números de serie seleccionados -->
                                            <div id="serial_list_<?php echo $detail['id_product']; ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary">Procesar Despacho</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- FOOTER -->
        <?php include "footer.php" ?>
    </div>
    <div class="modal fade" id="serialModal" tabindex="-1" aria-labelledby="serialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serialModalLabel">Seleccionar Números de Serie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="serial_form">
                        <input type="hidden" id="product_id_modal" />
                        <input type="hidden" id="product_qty_modal" />

                        <table class="table" id="serial_numbers_table">
                            <thead>
                                <tr>
                                    <th>Seleccionar</th>
                                    <th>Código de Serie</th>
                                    <th>Fecha de Compra</th>
                                </tr>
                            </thead>
                            <tbody id="serial_numbers_container">
                                <!-- Aquí se agregarán dinámicamente los seriales -->
                            </tbody>
                        </table>

                        <div id="selected_count" class="mt-3">Seleccionados: 0 de 0</div>

                        <div id="new_serial_container" class="mt-3">
                            <div class="input-group">
                                <input type="text" id="new_serial_input" class="form-control"
                                    placeholder="Nuevo Número de Serie">
                                <button type="button" id="add_new_serial" class="btn btn-success">Agregar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="save_serials">Guardar Selección</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Incluir jQuery una sola vez -->
    <script src="../assets/plugins/jquery/jquery-3.6.0.min.js"></script>
    <!-- Incluir el JS de Select2 -->
    <script src="../assets/js/select2.js"></script>
    <!-- Bootstrap JS -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bumdle-v5.3.js"></script>
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