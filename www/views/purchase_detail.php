<?php
session_start();
include_once "../models/functions.php";

if (!isset($_SESSION["id_rol"]) || ($_SESSION["id_rol"] != 1 && $_SESSION["id_rol"] != 2)) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $purchase_number = $_GET['id'];
    $purchase_details = get_purchase_history_in($purchase_number);

    if (empty($purchase_details)) {
        echo "Compra NO encontrada";
        exit;
    }
} else {
    echo "ID de compra no proporcionado";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agencia UNO</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
</head>

<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper">
        <?php include "header.php"; ?>
        <?php include "menu.php"; ?>

        <div class="content-wrapper">
            <div class="container-fluid py-4">
                <!-- Resumen de Compra -->
                <div class="card">
                
                    <div class="card-header d-flex justify-content-between bg-primary text-white">
                        <h4><b>Factura de Compra</b>: <?php echo htmlspecialchars($purchase_number); ?></h4>
                        
                    </div>
                </div>

                <!-- Detalles del Proveedor -->
                <div class="card">
                    <div class="card-header">
                        <b>Detalles del Proveedor</b>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="id_vendor" class="form-label">Proveedor: </label>
                                <input type="text" class="form-control" value="<?php echo $purchase_details[0]['name_supplier']; ?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="remito_date">Fecha de Remito: </label>
                                <input type="date" id="remito_date" name="remito_date" class="form-control"
                                    value="<?php echo $purchase_details[0]['remito_date']; ?>" readonly>
                            </div>

                            <div class="form-group col-md-4 mt-3">
                                <label for="cuit">CUIT/CUIL:</label>
                                <input type="text" id="cuit" name="cuit" class="form-control"
                                    value="<?php echo $purchase_details[0]['tax_identifier']; ?>" readonly>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label for="email_supplier">Email:</label>
                                <input type="email" id="email_supplier" name="email_supplier" class="form-control"
                                    value="<?php echo $purchase_details[0]['email_supplier']; ?>" readonly>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label for="phone_supplier">Teléfono:</label>
                                <input type="text" id="phone_supplier" name="phone_supplier" class="form-control"
                                    value="<?php echo $purchase_details[0]['phone_supplier']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detalles de la Compra -->
                <div class="card">
                    <div class="card-header">
                        <b>Detalles de la Compra</b>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table_products" class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre del Producto</th>
                                        <th>Cantidad</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($purchase_details as $index => $detalle) : ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo htmlspecialchars($detalle['product_description']); ?></td>
                                        <td><?php echo htmlspecialchars($detalle['quantity']); ?></td>                                       
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="d-flex align-items-center mt-4">
                    <a href="purchase_list.php" class="btn btn-outline-primary btn-sm me-3">
                        <i class="fas fa-arrow-left"></i> Volver al Historial
                    </a>                   
                </div>
            </div>
        </div>
        <?php include "footer.php"; ?>
    </div>

    <script src="../assets/plugins/jquery/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <script src="../assets/js/purchase_history.js"></script>

    <script>
    $(document).ready(function() {
        $('#table_products').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            responsive: true,
            language: {
                url: "../assets/dist/js/es-ES.json"
            }
        });
    });
    </script>
</body>
</html>