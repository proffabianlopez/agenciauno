<?php
session_start();
include_once "../models/functions.php";

if (!isset($_SESSION["id_rol"]) || ($_SESSION["id_rol"] != 1 && $_SESSION["id_rol"] != 2)) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $sales_number = $_GET['id'];    
    $sale_details = get_sales_details_by_number($sales_number);
  
} else {    
    echo "Venta NO encontrada";
    exit;
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
    <script src="../assets/js/sweetalert2@11.js"></script>
</head>


<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper">
        <?php include "header.php"; ?>
        <?php include "menu.php"; ?>

        <div class="content-wrapper">
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between bg-primary text-white">
                        <h4><b>Nº de Venta: <?php echo str_pad($sales_number, 6, "0", STR_PAD_LEFT); ?></b></h4>
                        <h4><b>Resumen de Venta</b></h4>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"> <b>Detalles del Cliente</b>
                        <div class="card-tools">

                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <input type="hidden" name="sales_number" value="<?php echo $sales_number; ?>">

                            <div class="form-group col-md-8">
                                <label for="id_customer" class="form-label">Cliente: </label>
                                <select name="id_customer" class="form-control select2" id="id_customer" disabled>
                                    <?php if (!empty($sale_details[0]['customer_name'])) : ?>
                                    <option selected><?php echo $sale_details[0]['customer_name']; ?></option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="date_sales">Fecha de Venta: </label>
                                <input type="date" id="date_sales" name="date_sales" class="form-control"
                                    value="<?php echo $sale_details[0]['date_sales']; ?>" readonly>
                            </div>

                            <div class="form-group col-md-4 mt-3">
                                <label for="cuit">CUIT/CUIL:</label>
                                <input type="text" id="cuit" name="cuit" class="form-control"
                                    value="<?php echo $sale_details[0]['tax_identifier']; ?>" readonly>
                            </div>

                            <div class="form-group col-md-4 mt-3">
                                <label for="email_customer">Email:</label>
                                <input type="email" id="email_customer" name="email_customer" class="form-control"
                                    value="<?php echo $sale_details[0]['email_customer']; ?>" readonly>
                            </div>

                            <div class="form-group col-md-4 mt-3">
                                <label for="phone_customer">Teléfono:</label>
                                <input type="text" id="phone_customer" name="phone_customer" class="form-control"
                                    value="<?php echo $sale_details[0]['phone_customer']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><b>Detalles de la Venta</b>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group mt-3">
                            <div class="table-responsive">
                                <table id="table_products" class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre del Producto</th>
                                            <th>Cantidad</th>
                                            <th>Descripción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($sale_details as $index => $detalle) : ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo $detalle['name_product']; ?></td>
                                            <td><?php echo $detalle['quantity']; ?></td>
                                            <td><?php echo $detalle['description']; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-4">                    
                    <a href="sales_list.php" class="btn btn-outline-primary btn-sm me-3">
                        <i class="fas fa-arrow-left"></i> Volver al Historial
                    </a>                    
                    <button class="btn btn-outline-primary btn-sm d-flex align-items-center"
                        onclick="validarYImprimir('<?php echo $sales_number; ?>');" title="Imprimir Remito">
                        <i class="fas fa-print me-1"></i> Imprimir Remito
                    </button>
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
    <script src="../assets/js/history_sales.js"></script>

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