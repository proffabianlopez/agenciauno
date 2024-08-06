<?php
session_start();
include_once "../models/functions.php";

$showP=show_state("products");
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

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    </Link>
    <link rel="stylesheet" href="../assets/css/style_lista_cliente.css">
    </Link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.3.1/css/searchPanes.bootstrap5.css">
    </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.3/css/select.bootstrap5.css">
    </script>
    <!-- Theme style -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Theme style -->

</head>

<body class="sidebar-mini" style="height: auto;">

    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- HEADER -->
        <?php include "header.php"?>
        <!-- HEADER -->

        <!-- MENU -->
        <?php include "menu.php"?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 1604.8px;">

            <div class="container-fluid" style="padding:50px;">
                <div class="card" style="margin-top:5px">
                    <div class="card-header">
                        <div class="row mb-12">
                            <div class="col-sm-6">
                                <h4><b>Venta de Productos</b>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>


                <form action="../contderoller/controllerxxxxx.php" method="post">
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
                            <div class="form-group">

                                <label for="id_customer">Cliente: <sup style="color:red">*</sup></label>
                                <select name="id_customer" class="form-control">
                                    <?php foreach ($clientes as $cliente) : ?>
                                    <option value="<?php echo $cliente->id_customer; ?>">
                                        <?php echo $cliente['customer_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
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
                                <div class="form-group col-md-6">
                                    <label for="purchase_number">Número de Venta: <sup style="color:red">*</sup></label>
                                    <input type="text" name="purchase_number" class="form-control" value="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="purchase_date">Fecha de Venta: <sup style="color:red">*</sup></label>
                                    <input type="date" name="purchase_date" class="form-control"
                                        value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card">
                        <div class="card-header" style="display: block;">
                            <h5>Detalle</h5>
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
                                            <select name="items[0][id_product]" class="form-control">
                                                <?php foreach ($showP as $product) : ?>
                                                <option value="<?php echo $product->id_product; ?>">
                                                    <?php echo $product->name_product; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="items">Cantidad: <sup style="color:red">*</sup></label>
                                    <input type="number" name="items[0][quantity]" class="form-control"
                                        placeholder="Quantity">
                                </div>
                                <div class="form-group col-md-1"></div>
                                <div class="form-group col-md-2">
                                    <div class="info position-absolute fixed-bottom mb-3">
                                        <button type="button" id="addProduct" class="btn btn-primary"><i
                                                class="fas fa-plus-circle fa-lg"></i>&nbspAgregar Producto</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="items">Número de Serie: <sup style="color:red">*</sup></label>
                                <input type="text" name="serial_number" class="form-control"
                                        placeholder="Número de Serie">
                            </div>
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
                                            <th>Número de Serie</th>
                                            <th>Eliminar</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>PRODUCTO001</td>
                                            <td>Primer Producto</td>
                                            <td>5</td>
                                            <td>S/N:001230012</td>
                                            <td><i class="fas fa-trash-alt"></i></td>
                                        </tr>
                                        <tr>
                                            <td>PRODUCTO002</td>
                                            <td>Segundo Producto</td>
                                            <td>10</td>
                                            <td>S/N:001230013</td>
                                            <td><i class="fas fa-trash-alt"></i></td>
                                        </tr>
                                        <tr>
                                            <td>PRODUCTO003</td>
                                            <td>Tercer Producto</td>
                                            <td>10</td>
                                            <td>S/N:001230014</td>
                                            <td><i class="fas fa-trash-alt"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer" style="text-align:right">
                            <input type="submit" class="btn btn-success" value="Registrar Venta">
                        </div>
                    </div>
                </form>
            </div>




        </div>
        <!-- FOOTER -->
        <?php include "footer.php"?>
    </div>


    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <!-- Modal Suppliers JS -->
    <script src="../js.modal/modal_suppliers.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.1/js/dataTables.searchPanes.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.1/js/searchPanes.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.3/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.3/js/select.bootstrap5.js"></script>

    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>

</body>

</html>