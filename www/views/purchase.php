<?php
session_start();
include_once "../models/functions.php";
$show=show_state("suppliers");
$showP=show_state("products");

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.3.1/css/searchPanes.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.3/css/select.bootstrap5.css">

    <!-- Incluir el CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Tu hoja de estilo personalizada -->
    <link rel="stylesheet" href="../assets/css/style_lista_cliente.css">
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
                                <h4><b>Recepción de Compras</b>
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
                            <div class="form-group col-md-8">

                                <label for="id_supplier" class="form-label">Proveedor: <sup
                                        style="color:red">*</sup></label>
                                <select name="id_supplier" class="form-control select2" id="id_supplier">
                                    <option></option> <!-- Placeholder -->
                                    <?php foreach ($show as $supplier) : ?>
                                    <option value="<?php echo $supplier->id_supplier; ?>">
                                        <?php echo $supplier->name_supplier; ?>
                                    </option>
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
                            <div class="form-group col-md-4">
                                    <label for="purchase_date">Número de factura: <sup
                                            style="color:red">*</sup></label>
                                    <input type="text" name="number_factura" class="form-control">
                            </div>
                                    
                            <div class="form-group col-md-4">

                                    <label for="purchase_date">Fecha de Remito: <sup style="color:red">*</sup></label>
                                    <input type="date" name="purchase_date" class="form-control"
                                        value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>    
                            <div class="form-row">
    <div class="form-group col-md-6">
        <label for="purchase_number">Número de Remito: <sup style="color:red">*</sup></label>
        <div class="input-group">
            <!-- Select para el año -->
            <select name="purchase_year" id="purchase_year" class="form-control">
                <?php
                $currentYear = date('Y');
                for ($year = $currentYear; $year >= 2000; $year--) {
                    echo "<option value='$year'>$year</option>";
                }
                /*$purchase_year = $_POST['purchase_year'];
                $purchase_number = $_POST['purchase_number'];
                $full_purchase_number = $purchase_year . '-' . $purchase_number;
                */
                ?>
            </select>
            
            <!-- Input para los 6 dígitos -->
            <input type="text" name="purchase_number" id="purchase_number" class="form-control" maxlength="6" value="000456" pattern="\d{6}">
        </div>
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
                                            <select name="id_product" class="form-control select2" id="id_product">
                                            <option></option>
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
                                                <td>Primer Prodcuto</td>
                                                <td>5</td>
                                                <td>S/N:001230012</td>
                                                <td><i class="fas fa-trash-alt"></i></td>
                                            </tr>
                                            <tr>
                                                <td>PRODUCTO002</td>
                                                <td>Segundo Prodcuto</td>
                                                <td>10</td>
                                                <td>S/N:001230013</td>
                                                <td><i class="fas fa-trash-alt"></i></td>
                                            </tr>
                                            <tr>
                                                <td>PRODUCTO003</td>
                                                <td>Tercer Prodcuto</td>
                                                <td>10</td>
                                                <td>S/N:001230014</td>
                                                <td><i class="fas fa-trash-alt"></i></td>
                                            </tr>
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
        <?php include "footer.php"?>
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

    <!-- Inicializar Select2 después de que todos los scripts necesarios estén cargados -->
      <script>
   $(document).ready(function() {
    $('#id_supplier').select2({
        placeholder: "Seleccione un proveedor",
        allowClear: true,
        width: '100%'
    });

    // Detectar cambios en el select
    $('#id_supplier').on('change', function() {
        var idSupplier = $(this).val();
        
        if(idSupplier) {
            // Enviar la solicitud AJAX al servidor
            $.ajax({
                url: '../controller/get_supplier.php', // Ruta al archivo PHP
                type: 'POST',
                data: { id_supplier: idSupplier },
                dataType: 'json',
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        // Actualizar los campos con la información recibida
                        $('#view_tax').text(data.tax_identifier || '');
                        $('#view_email').text(data.email_supplier || '');
                        $('#view_phone').text(data.phone_supplier || '');
                        // Puedes agregar más campos aquí según sea necesario
                    }
                },
                error: function() {
                    alert('Error al obtener la información del proveedor.');
                }
            });
        } else {
            // Limpiar los campos si no hay proveedor seleccionado
            $('#view_tax').text('');
            $('#view_email').text('');
            $('#view_phone').text('');
        }
    });
});

</script>
<script>
   $(document).ready(function() {
    $('#id_product').select2({
        placeholder: "Seleccione un Producto",
        allowClear: true,
        width: '100%'
    });
});

</script>

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

</body>

</html>