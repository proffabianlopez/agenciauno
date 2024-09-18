<?php
session_start();
include_once "../models/functions.php";

// Obtener número de venta y otros datos necesarios
$sales_number = obtener_number_sales();
$showP = show_state("products");
$clientes = obtenerclientes();

// Verificar si el usuario tiene los permisos correctos
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
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min5.3.css">
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="../assets/css/searchPanes.bootstrap5.css">
    <link rel="stylesheet" href="../assets/css/select.bootstrap5.css">
    <link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/style_lista_cliente.css">
    <script src="../assets/js/sweetalert2@11.js"></script>
</head>

<body class="sidebar-mini" style="height: auto;">
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
                                <h4><b>Registro de Ventas</b></h4>
                            </div>
                            <div class="col-sm-6">
                            <h4><b>N° <?php echo str_pad($sales_number, 4, "0", STR_PAD_LEFT); ?></b></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="../controller/insert_sales.php" method="post">
                    <div class="card">
                        <div class="card-header" style="display: block;text-align:center">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="card-body" style="display: block;">
                            <div class="form-row">
                                <!-- Campo oculto para enviar el número de venta -->
                                <input type="hidden" name="sales_number" value="<?php echo $sales_number; ?>">

                                <div class="form-group col-md-8">
                                    <label for="id_customer" class="form-label">Cliente: <sup style="color:red">*</sup></label>
                                    <select name="id_customer" class="form-control select2" id="id_customer">
                                        <option></option> <!-- Placeholder -->
                                        <?php foreach ($clientes as $cliente) : ?>
                                            <option value="<?php echo $cliente['id_customer']; ?>">
                                                <?php echo $cliente['customer_name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-4 d-flex align-items-end">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                                        <i class="fas fa-user-plus"></i>&nbsp;Cliente Nuevo
                                    </button>
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label for="date_sales">Fecha de Venta: <sup style="color:red">*</sup></label>
                                    <?php
                                    $fechas = obtenerFechasLimite();
                                    ?>
                                    <input type="date" id="date_sales" name="date_sales" class="form-control" value="<?php echo $fechas['today']; ?>" min="<?php echo $fechas['minDate']; ?>" max="<?php echo $fechas['maxDate']; ?>">
                                    <small id="dateError" style="color:red; display:none;">La fecha debe ser +/- 7.</small>
                                </div>
                            </div>
                            <!-- Más campos -->
                        </div>
                    </div>

                    <!-- Tabla de productos -->
                    <div class="card">
                        <div class="card-header" style="display: block;">
                            <h5>Detalle</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="card-body" style="display: block;">
                            <div class="form-row">
                                <div class="form-group col-md-4">    
                                    <label for="id_product">Producto: <sup style="color:red">*</sup></label>
                                    <select name="id_product" id="id_product" class="form-control">
                                        <option value=""></option>
                                        <?php foreach ($showP as $product) : ?>
                                            <option value="<?php echo $product->id_product; ?>" data-description="<?php echo $product->description; ?>">
                                                <?php echo $product->name_product; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="product_description" class="form-label">Descripción del Producto:</label>
                                    <input type="text" id="product_description" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="items">Cantidad: <sup style="color:red">*</sup></label>
                                    <input type="number" id="quantity_input" class="form-control" placeholder="Cantidad" min="1">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2 d-flex align-items-center">
                                    <label for="items" class="mb-0">&nbsp;</label>
                                    <button type="button" id="addProduct" class="btn btn-primary">
                                        <i class="fas fa-plus-circle fa-lg"></i>&nbsp;Agregar Producto
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="table_products" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Número de Series</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Filas dinámicas se agregarán aquí -->
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer" style="text-align:right">
                            <input type="submit" class="btn btn-success" value="Registrar Venta">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- FOOTER -->
        <?php include "footer.php" ?>
    </div>

    <!-- Incluir jQuery una sola vez -->
    <script src="../assets/plugins/jquery/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/select2.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.bumdle-v5.3.js"></script>
    <script src="../assets/js/bootstrapt.bundle5.3.min.js"></script>
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <script src="../assets/js/jquery.datatables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap5.js"></script>
    <script src="../assets/js/dataTables.js"></script>
    <script src="../assets/js/dataTables.searchPanes.js"></script>
    <script src="../assets/js/searchPanes.bootstrap5.js"></script>
    <script src="../assets/js/dataTables.select.js"></script>
    <script src="../assets/js/select.bootstra5.js"></script>
    <script src="../assets/js/sales.js"></script>
</body>
</html>
