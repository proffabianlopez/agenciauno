<?php
session_start();
include_once "../models/functions.php";

// Obtener listas de impresoras y clientes
$printers = obtenerImpresoras();
$clientes = obtenerclientes();
//$rentals = get_rentals();

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
    <title>Gestión de Alquileres - Agencia UNO</title>
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Bootstrap JS -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert -->
    <script src="../assets/js/sweetalert2@11.js"></script>
    <link rel="stylesheet" href="../assets/css/datatables.css">
</head>
<body class="sidebar-mini">
    <div class="wrapper">
        <?php include "header.php"; ?>
        <?php include "menu.php"; ?>

        <div class="content-wrapper">
            <div class="container-fluid" style="padding:50px;">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h4><b>Gestión de Alquileres</b></h4>
                    </div>
                    <div class="card-body p-4">
    <form action="../controllers/rental_controller.php" method="POST">
        <div class="row">
            <div class="col-md-6">
                <label for="client_id">Cliente</label>
                <div class="input-group">
                    <select name="id_customer" class="form-control select2" id="id_customer">
                        <option></option>
                        <?php foreach ($clientes as $cliente) : ?>
                            <option value="<?php echo $cliente['id_customer']; ?>">
                                <?php echo $cliente['customer_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                        <i class="fas fa-user-plus"></i>&nbsp;Cliente Nuevo
                    </button>
                </div>
            </div>

            <div class="col-md-6">
                <label for="printer_id">Impresora</label>
                <div class="input-group">
                    <select name="printer_id" id="printer_id" class="form-control">
                        <option></option>
                        <?php foreach ($printers as $printer) : ?>
                            <option value="<?= $printer['id_printer'] ?>"><?= $printer['serial_number'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPrinterModal">
                        <i class="fas fa-plus-circle"></i>&nbsp;Impresora Nueva
                    </button>
                </div>
            </div>

            <div class="col-md-6">
                <label for="start_date">Fecha de Inicio</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="end_date">Fecha de Finalización</label>
                <input type="date" name="end_date" id="end_date" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="initial_page_count">Contador Inicial</label>
                <input type="number" name="initial_page_count" id="initial_page_count" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="final_page_count">Contador Final</label>
                <input type="number" name="final_page_count" id="final_page_count" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="street">Calle</label>
                <input type="text" name="street" id="street" class="form-control" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ0-9\s]+" required
                                title="Ingrese solo letras y números, sin puntos ni comas" max="100">
            </div>
            <div class="col-md-4">
                <label for="height">Altura</label>
                <input type="text" name="height" id="height" class="form-control" required name="altura" max="100000000"
                                    required title="solo se permiten números" value="0">
            </div>
            <div class="col-md-4">
                <label for="location">Localidad</label>
                <input type="text" name="location" id="location" class="form-control" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" minlength="2" maxlength="100" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Guardar Alquiler</button>
    </form>
</div>


        <!-- Modal para agregar clientes -->
        <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addCustomerModalLabel">Agregar cliente nuevo</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="customerForm" action="../controller/insert_custommer_printer.php" method="POST">
                        <div class="mb-3">
                                <label for="tax_identifier" class="form-label">CUIT/CUIL <span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="tax_identifier" id="tax_identifier"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Nombre del Cliente <span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="customer_name" id="customer_name"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="email_customer" class="form-label">Correo Electrónico <span
                                        style="color: red;">*</span></label>
                                <input type="email" class="form-control" name="email_customer" id="email_customer"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="phone_customer" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" name="phone_customer" id="phone_customer">
                            </div>
                            <div class="mb-3">
                                <label for="street" class="form-label">Dirección</label>
                                <input type="text" class="form-control" name="street" id="street">
                            </div>
                            <div class="mb-3">
                                <label for="height" class="form-label">Altura</label>
                                <input type="text" class="form-control" name="height" id="height">
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Ciudad</label>
                                <input type="text" class="form-control" name="location" id="location">
                            </div>
                            <div class="mb-3">
                                <label for="floor" class="form-label">Piso</label>
                                <input type="text" class="form-control" name="floor" id="floor">
                            </div>
                            <div class="mb-3">
                                <label for="department" class="form-label">Departamento</label>
                                <input type="text" class="form-control" name="department" id="department">
                            </div>
                            <div class="mb-3">
                                <label for="observaciones" class="form-label">Observaciones</label>
                                <textarea class="form-control" name="observaciones" id="observaciones"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Guardar</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para agregar impresoras -->
        <div class="modal fade" id="addPrinterModal" tabindex="-1" aria-labelledby="addPrinterModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addPrinterModalLabel">Agregar impresora nueva</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="printerForm" action="../controller/insert_printer.php" method="POST">
                            <div class="mb-3">
                                <label for="serial_number" class="form-label">Número de Serie <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="serial_number" id="serial_number" required>
                            </div>
                            <div class="mb-3">
                                <label for="brand" class="form-label">Marca <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="brand" id="brand" required>
                            </div>
                            <div class="mb-3">
                                <label for="model" class="form-label">Modelo <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="model" id="model" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_added" class="form-label">Fecha de Adquisición</label>
                                <input type="date" class="form-control" name="date_added" id="date_added">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Guardar</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
        <?php include "footer.php"; ?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

