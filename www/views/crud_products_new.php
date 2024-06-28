<?php
include_once "../controller/insert_products.php";
include_once "../controller/edit_product.php";
include_once "../controller/delete_product.php";
include_once "../models/functions.php";
$show=show_state("products");
$brandData=show_state("brands");
$categoryData=show_state("categorys");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agencia 1</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
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
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 1604.8px;">
            <main>
                <div class="container-fluid" style="padding:50px;">
                    <div class="card" style="margin-top:5px">
                        <div class="card-header">
                            <div class="row mb-6">
                                <div class="col-sm-6">
                                    <h4><b>Listado de Productos &nbsp&nbsp&nbsp</b>
                                        <button type="button" class="btn btn-success create_products_Btn"
                                            data-toggle="modal" data-target="#create_products_Bt" data-action="add"
                                            data-placement="right" title="Nuevo"><i
                                                class="fas fa-plus-circle fa-lg"></i></button>
                                    </h4>
                                </div><!-- /.col -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.row -->

                    <div class="table-responsive">
                        <div class="table-wrapper">

                            <table class="table table-striped table-hover" id="table_products">
                                <thead>
                                    <tr>
                                        <!--<th>Numero De Serie</th>-->
                                        <th>Numero De Producto</th>
                                        <th>Nombre Producto</th>
                                        <th>Descripcion</th>
                                        <th>Stock</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($show as $row) { ?>
                                    <tr>
                                        <!--<td><?php echo $row->number_serial; ?></td>-->
                                        <td><?php echo $row->number_product; ?></td>
                                        <td><?php echo $row->name_product; ?></td>
                                        <td><?php echo $row->description; ?></td>
                                        <td><?php echo $row->stock; ?></td>


                                        <td>
                                            <a class="btn btn-success viewBtn long_letter text-white"
                                                data-id_product="<?php echo $row->id_product ?>"
                                                data-number_serial="<?php echo $row->number_serial ?>"
                                                data-number_product="<?php echo $row->number_product ?>"
                                                data-name_product="<?php echo $row->name_product ?>"
                                                data-description="<?php echo $row->description ?>"
                                                data-stock="<?php echo $row->stock ?>"><i
                                                    class="fa fa-binoculars"></i></a>
                                            <a class="btn btn-warning editBtn long_letter text-white"
                                                data-id_product="<?php echo $row->id_product ?>"
                                                data-number_serial="<?php echo $row->number_serial ?>"
                                                data-number_product="<?php echo $row->number_product ?>"
                                                data-name_product="<?php echo $row->name_product ?>"
                                                data-description="<?php echo $row->description ?>"
                                                data-stock="<?php echo $row->stock ?>"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger delete_Btn text-white long_letter"
                                                data-id_products="<?php echo $row->id_product ?>"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </main>
            <!-- Main content -->
        </div>

        <?php include "footer.php"?>
    </div>

    <!-- Modal para Crear Productos-->
    <div id="create_Modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">

            <div class="modal-content">
                <div class="modal-header bg-primary">

                    <h4 class="modal-title text-white">Dar de Alta Un Producto</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../controller/insert_products.php" method="post">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name_product">Nombre</label>
                            <input type="text" name="name_product" class="form-control" required  maxlength="30">

                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <input type="text" name="description" class="form-control" required>

                        </div>

                        <div class="form-group">
                            <label for="name_product">Número de Serie</label>
                            <input type="text" name="number_serial" class="form-control" required min-height="2" maxlength="25">

                        </div>
                        <div class="form-group">
                            <label for="name_product">Número de Producto</label>
                            <input type="text" name="number_product" class="form-control" required min-height="1" maxlength="25">

                        </div>

                        <div class="form-group col-md-3">
                            <label for="stock">Stock</label>
                            <input type="number" name="stock" class="form-control" required  min="0">

                        </div>

                        <div class="form-group">
                            <label for="brand">Marca</label>
                            <select name="id_brand" id="brand" class="form-select" required>
                                <option option value="" selected disabled>-- Seleccione Marca --</option>
                                <?php foreach ($brandData as $brand) { ?>

                                <option value="<?php echo $brand->id_brand; ?>">
                                    <?php echo $brand->detail; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">Categoría</label>
                            <select name="id_category" id="category" class="form-select" required>
                                <option option value="" selected disabled>-- Seleccione Categoría --</option>
                                <?php foreach ($categoryData as $category) { ?>
                                <option value="<?php echo $category->id_category; ?>">
                                    <?php echo $category->detail; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="enviar" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--Modal de Editar Productos-->
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Editar un Producto</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../controller/edit_product.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_product" id="id_product" class="form-control" value="">

                        <div class="form-group">
                            <label for="edit_name">Nombre</label>
                            <input type="text" class="form-control" id="name_product" name="name_product" maxlength="30" required value="">
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Descripcion</label>
                            <input type="text" class="form-control" id="description" name="description" value="">
                        </div>
                        <div class="form-group">
                            <label for="edit_name">Numero de serie</label>
                            <input type="text" class="form-control" id="number_serial" name="number_serial"  minlength="2" maxlength="20" required value="">
                        </div>
                        <div class="form-group">
                            <label for="edit_name">Numero de producto</label>
                            <input type="text" class="form-control" id="number_product" name="number_product"  minlength="2" maxlength="20"required value="">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="edit_stock">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" min="0" required value="">
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" name="save_data" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>


                    </div>
                </form>
            </div>
        </div>
    </div> <!-- Fin Modal para Editar Productos-->



    <!--Modal de Ver Productos-->
    <div id="viewModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title text-white">Detalles del Producto</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <input type="hidden" name="id_product" id="id_product" class="form-control" value="">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="view_name_product">Nombre</label>
                                <input type="text" class="form-control" id="view_name_product" name="view_name_product"
                                    readonly value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="view_description">Descripción</label>
                                <input type="text" class="form-control" id="view_description" name="view_description"
                                    value="" readonly>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="view_number_serial">Numero de serie</label>
                                    <input type="text" class="form-control" id="view_number_serial" readonly
                                        name="view_number_serial" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="view_number_product">Numero de producto</label>
                                    <input type="text" class="form-control" id="view_number_product" readonly
                                        name="view_number_product" value="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="view_stock">Stock</label>
                            <input type="number" class="form-control" id="view_stock" name="view_stock" value=""
                                readonly>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Volver</button>
                    </div>


            </div>
            </form>
        </div>
    </div>
    </div> <!-- Fin Modal para Ver Productos-->



    <!-- Eliminar Producto -->
    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-white">Deshabilitar un Producto</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="color: white"
                        ;>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../controller/delete_product.php" method="post">
                    <div class="modal-body">
                        <br>
                        <h5 style="text-align:center">Estas seguro que desea Deshabilitar el Producto</h5>
                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                            </div>
                            <div class="form-group col-md-6" style="text-align:center">
                                <input type="hidden" name="id_product" id="id_product_eliminate"
                                    value="<?php echo $row->id_product?>">

                            </div>
                        </div>
                        <!-- number_product_eliminate-->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Volver</button>
                        <button type="submit" name="delete" class="btn btn-danger">Deshabilitar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- ./wrapper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js">
    </script>
    <!-- jQuery -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js.modal/modal_products.js"></script>

    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.1/js/dataTables.searchPanes.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.1/js/searchPanes.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.3/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.3/js/select.bootstrap5.js"></script>

    <!--        <script src="../js.modal/paginated.js"></script> -->

    <script>
    $("#table_products").DataTable({
        pageLength: 5,
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json",
        },
        columns: [{
            width: '20%'
        }, {
            width: '25%'
        }, {
            width: '25%'
        }, {
            width: '10%'
        }, {
            width: '20%'
        }, ]
    });
    </script>
</body>

</html>