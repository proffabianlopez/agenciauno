<?php
session_start();
include_once "../models/functions.php";
$show = show_state("suppliers");
$showP = show_state("products");

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

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.3.1/css/searchPanes.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.3/css/select.bootstrap5.css">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Incluir el CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Tu hoja de estilo personalizada -->
    <link rel="stylesheet" href="../assets/css/style_lista_cliente.css">
    <script src="../assets/js/purchase.js"></script>


</head>

<body class="sidebar-mini" style="height: auto;">

    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- HEADER -->
        <?php include "header.php" ?>
        <!-- HEADER -->

        <!-- MENU -->
        <?php include "menu.php" ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 1604.8px;">

            <div class="container-fluid" style="padding:50px;">
                <div class="card" style="margin-top:5px">
                    <div class="card-header">
                        <div class="row mb-12">
                            <div class="col-sm-6">
                                <h4><b>Compras</b>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>


                <form action="../controller/controllerxxxxx.php" method="post">
                    <div class="card">

                        <div class="card-header" style="display: block;text-align:center">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="id_supplier" class="form-label">Proveedor: <sup
                                            style="color:red">*</sup></label>
                                    <select name="id_supplier" class="form-control select2" id="id_supplier">
                                        <option></option>
                                        <?php foreach ($show as $supplier) : ?>
                                            <option value="<?php echo $supplier->id_supplier; ?>">
                                                <?php echo $supplier->name_supplier; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="view_tax">CUIL/CUIT</label>
                                    <span id="view_tax" class="form-control" readonly></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="view_email">Email</label>
                                    <span id="view_email" class="form-control" readonly></span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="view_phone">Teléfono</label>
                                    <span id="view_phone" class="form-control" readonly></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-1">
                                    <label for="purchase_remito">Número de </label>
                                    <input type="text" name="number_remito" class="form-control" maxlength="4" value="1234">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="remito">Remito: <sup style="color:red">*</sup></label>
                                    <input type="text" name="remito" id="remito" class="form-control"
                                        maxlength="6" value="000456" pattern="\d{6}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="date_remito">Fecha de Remito: <sup style="color:red">*</sup></label>
                                    <input type="date" name="date_remito" class="form-control"
                                        value="<?php echo date('Y-m-d'); ?>"
                                        min="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-1">
                                    <label for="purchase_factura">Número de </label>
                                    <input type="text" name="purchase_factura" class="form-control" maxlength="4" value="1234">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="factura">Factura: <sup style="color:red">*</sup></label>
                                    <input type="text" name="factura" class="form-control" maxlength="6" value="000456">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="date_factura">Fecha de Factura: <sup style="color:red">*</sup></label>
                                    <input type="date" name="date_factura" class="form-control"
                                        value="<?php echo date('Y-m-d'); ?>"
                                        min="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-body -->

                    <div class="card">
                        <div class="card-header" style="display: block;">
                            <h5>Detalle del Remito</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="items">Producto: <sup style="color:red">*</sup></label>
                                    <div id="products">
                                        <div class="product">
                                            <select name="items[0][id_product]" id="id_product" class="form-control">
                                                <option value=""></option>
                                                <?php foreach ($showP as $product) : ?>
                                                    <option value="<?php echo $product->id_product; ?>">
                                                        <?php echo $product->name_product; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>


                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="items">Cantidad: <sup style="color:red">*</sup></label>
                                    <input type="number" name="items[0][quantity]" class="form-control" placeholder="Cantidad" min="1">
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="info mb-3">
                                        <label for="items">&nbsp;</label>
                                        <button type="button" id="addProduct" class="btn btn-primary"><i
                                                class="fas fa-plus-circle fa-lg"></i>&nbsp;Agregar Producto</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8 d-flex align-items-center">
                                    <label for="serial_number" class="mb-0 me-2">Número de Serie:</label>
                                    <input type="checkbox" name="serial_number" id="serial_number"
                                        class="form-check me-2">
                                    <button type="button" id="addSerialNumber" class="btn btn-primary">
                                        <i class="fas fa-plus-circle fa-lg"></i>&nbsp;Agregar N° Serie
                                    </button>
                                </div>
                            </div>





                            <div class="table-responsive">
                                <div class="table-wrapper">
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
                            </div>

                            <div class="card-footer" style="text-align:right">
                                <input type="submit" class="btn btn-success" value="Ingresar Remito">
                            </div>
                        </div>
                </form>
            </div>




        </div>
        <!-- FOOTER -->
        <?php include "footer.php" ?>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="serialNumberModal" tabindex="-1" aria-labelledby="serialNumberModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="serialNumberModalLabel">Ingresar Números de Serie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align:center">
                    <form id="serialForm" action="../controller/controller_addSerialNumber.php" method="POST">
                        <input type="hidden" name="id_product_modal" id="id_product_modal" value="">
                        <input type="hidden" name="remito_number" id="remito_number" value="">
                        <input type="hidden" name="id_supplier_modal" id="id_supplier_modal" value="">

                        <table class="table" id="serialTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Número de Serie</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Filas dinámicas se agregarán aquí -->
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="serialForm" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div>


    </div>
    <!-- Incluir jQuery una sola vez -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Incluir el JS de Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>



    <!-- Otros scripts que necesites -->
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.1/js/dataTables.searchPanes.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.1/js/searchPanes.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.3/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.3/js/select.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            let productCounter = 0;

            const table = $('#table_products').DataTable();

            $('#addProduct').on('click', function() {
                const productId = $('#id_product').val();
                const productName = $('#id_product option:selected').text();
                const quantity = $('input[name="items[0][quantity]"]').val();

                if (productId && quantity) {
                    table.row.add([
                        `<input type="hidden" name="items[${productCounter}][id_product]" value="${productId}">${productId}`,
                        `<input type="hidden" name="items[${productCounter}][name_product]" value="${productName}">${productName}`,
                        `<input type="hidden" name="items[${productCounter}][quantity]" value="${quantity}">${quantity}`,
                        `<button type="button"  data-product-id="${productId}" data-bs-toggle="modal" data-bs-target="#serialNumberModal"><i class="fa fa-binoculars"></i></button>`,
                        `<button type="button" class=" delete-row"><i class="fas fa-trash-alt"></i></button>`
                    ]).draw();

                    productCounter++;

                    $('#id_product').val('').trigger('change');
                    $('input[name="items[0][quantity]"]').val('');
                } else {
                    Swal.fire('Error', 'Debe seleccionar un producto y una cantidad', 'error');
                }
            });

            $('#table_products tbody').on('click', '.delete-row', function() {
                table.row($(this).parents('tr')).remove().draw();
            });

            $('#table_products tbody').on('click', '.view-serial', function() {
                const productId = $(this).data('product-id');
                $('#id_product_modal').val(productId);
            });
        });
    </script>
</body>

</html>