<?php
session_start();
include_once "../models/functions.php";
$error_message = isset($_SESSION["error_message"]) ? $_SESSION["error_message"] : "";
unset($_SESSION["error_message"]);


$serial_number = $product_name = $customer_name = $remaining_warranty = $review_date = $status = $technician_comments = '';

if (isset($_GET['id_warranty'])) {
    $id_warranty = intval($_GET['id_warranty']);
    $warranty_details = get_warranty_by_id($id_warranty);

    if ($warranty_details) {
        // Asignar datos del modelo
        $serial_number = $warranty_details['serial_number'];
        $product_name = $warranty_details['name_product'] ?? 'No disponible';
        $customer_name = $warranty_details['name_supplier'] ?? 'No disponible';
        $remaining_warranty = calculate_remaining_warranty($warranty_details['review_date'] ?? '');
        $review_date = $warranty_details['review_date'] ?? '';
        $status = $warranty_details['status'] ?? '';
        $technician_comments = $warranty_details['technician_comments'] ?? '';
    } else {
        echo "<div class='alert alert-danger'>No se encontraron datos para la garantía especificada.</div>";
        exit();
    }
} elseif (isset($_GET['serial_number'])) {
    // Si viene por serial_number
    $serial_number = $_GET['serial_number'];
    $product_name = $_GET['name_product'] ?? '';
    $customer_name = $_GET['customer_name'] ?? '';
    $remaining_warranty = $_GET['remaining_warranty'] ?? '';
} else {
    echo "<div class='alert alert-danger'>No se proporcionaron datos de la garantía.</div>";
    exit();
}

function calculate_remaining_warranty($review_date) {
    if (!$review_date) {
        return 'Indeterminado';
    }
    $current_date = new DateTime();
    $review_date = new DateTime($review_date);
    $interval = $current_date->diff($review_date);
    return max(0, 12 - ($interval->m + $interval->y * 12)); // Garantía de 1 año
}
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
    <!-- SweetAlert -->
    <script src="../assets/js/sweetalert2@11.js"></script>
</head>

<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper">
        <!-- HEADER -->
        <?php include "header.php" ?>
        <!-- MENU -->
        <?php include "menu.php" ?>
        <!-- Contenido Principal -->
        <div class="content-wrapper">
            <div class="container-fluid" style="padding: 30px;">
                <!-- Tarjeta principal -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Gestión de Garantía</h4>
                    </div>
                </div>
              <form id="warrantyForm">
    <!-- Tarjeta de Detalles del Producto -->
    <div class="card mt-4 shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detalles del Producto</h5>
            <button type="button" class="btn btn-tool ms-auto" data-bs-toggle="collapse"
                data-bs-target="#productDetails" aria-expanded="true" aria-controls="productDetails">
                <i class="fas fa-minus"></i>
            </button>
        </div>
        <div id="productDetails" class="collapse show">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="serial_number" class="form-label">Número de Serie</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number"
                                value="<?php echo htmlspecialchars($serial_number); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Producto</label>
                            <input type="text" class="form-control" id="product_name" name="product_name"
                                value="<?php echo htmlspecialchars($product_name); ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Cliente</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name"
                                value="<?php echo htmlspecialchars($customer_name); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="remaining_warranty" class="form-label">Meses Restantes de Garantía</label>
                            <input type="text" class="form-control" id="remaining_warranty" name="remaining_warranty"
                                value="<?php echo htmlspecialchars($remaining_warranty); ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta de Datos Adicionales -->
    <div class="card mt-4 shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Datos Adicionales</h5>
            <button type="button" class="btn btn-tool ms-auto" data-bs-toggle="collapse"
                data-bs-target="#additionalData" aria-expanded="true" aria-controls="additionalData">
                <i class="fas fa-minus"></i>
            </button>
        </div>
        <div id="additionalData" class="collapse show">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="review_date" class="form-label">Fecha gestión</label>
                        <input type="date" class="form-control" id="review_date" name="review_date"
                            value="<?php echo htmlspecialchars($review_date); ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Estado de la Gestión</label>
                        <select class="form-select" id="status" name="status">
                            <option value="En revisión" <?php echo $status == 'En revisión' ? 'selected' : ''; ?>>En revisión</option>
                            <option value="Reparado" <?php echo $status == 'Reparado' ? 'selected' : ''; ?>>Reparado</option>
                            <option value="No reparable" <?php echo $status == 'No reparable' ? 'selected' : ''; ?>>No reparable</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="technician_comments" class="form-label">Comentarios</label>
                        <textarea class="form-control" id="technician_comments" name="technician_comments" rows="4"><?php echo htmlspecialchars($technician_comments); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón de guardar -->
    <div class="text-center mt-4">
        <button type="button" id="submitBtn" class="btn btn-success btn-lg">
            <i class="fas fa-save"></i> Guardar Gestión
        </button>
    </div>
</form>


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
    <script src="../assets/js/warranty_management.js"></script>

</body>

</html>