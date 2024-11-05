<?php
session_start();
include_once "../controller/insert_products.php";
include_once "../controller/edit_product.php";
include_once "../controller/delete_product.php";
include_once "../models/functions.php";
$show=show_state("products");
$brandData=show_state("brands");
$categoryData=show_state("categorys");
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
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../assets/css/select.bootstrap5.css">
    <script src="../assets/js/sweetalert2@11.js"></script>
</head>

<body class="sidebar-mini" style="height: auto;">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- HEADER -->
        <?php include "header.php"?>
        <!-- MENU -->
        <?php include "menu.php"?>
        <div class="content-wrapper" style="min-height: 1604.8px;">
            <main>
                <div class="container-fluid" style="padding:50px;">
                    <div class="card" style="margin-top:5px">
                        <div class="card-header">
                            <div class="row mb-12">
                                <div class="col-sm-6">
                                    <h4><b>Listado de Productos&nbsp&nbsp</b>
                                        <?php if (isset($_SESSION["id_rol"])) {
                                        if($_SESSION["id_rol"]=== 1) {?>
                                        <button type="button" class="btn btn-success create_products_Btn"
                                            data-toggle="modal" data-target="#create_products_Bt" data-action="add"
                                            data-placement="right" title="Nuevo"><i
                                                class="fas fa-plus-circle fa-lg"></i></button>
                                        <?php }} ?>
                                    </h4>
                                </div><!-- /.col -->
                                <div class="col-sm-6" id="botones" style="text-align: center;">
                                    <!-- Aquí se colocarán los botones de exportación de DataTables -->
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.row -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-wrapper">
                                    <table id="table_products" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nombre Producto</th>
                                                <th>Descripción</th>
                                                <th>Stock</th>
                                                <th>Meses de Garantía</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($show as $row) { ?>
                                            <tr>
                                                <td><?php echo $row->name_product; ?></td>
                                                <td><?php echo $row->description; ?></td>
                                                <td><?php echo $row->stock; ?></td>
                                                <td><?php echo $row->warranty_period; ?></td>
                                                <td>
                                                    <a class="btn btn-success viewBtn long_letter text-white"
                                                        data-id_product="<?php echo $row->id_product ?>"
                                                        data-number_serial="<?php echo $row->number_serial ?>"
                                                        data-name_product="<?php echo $row->name_product ?>"
                                                        data-description="<?php echo $row->description ?>"
                                                        data-stock="<?php echo $row->stock ?>"
                                                        data-warranty_period="<?php echo $row->warranty_period ?>"
                                                        data-number_product="<?php echo $row->number_product ?>"><i
                                                            class="fa fa-binoculars"></i></a>
                                                    <?php if (isset($_SESSION["id_rol"])) {
                                        if($_SESSION["id_rol"]=== 1) { ?>
                                                    <a class="btn btn-warning editBtn long_letter text-white"
                                                        data-id_product="<?php echo $row->id_product ?>"
                                                        data-number_serial="<?php echo $row->number_serial ?>"
                                                        data-name_product="<?php echo $row->name_product ?>"
                                                        data-description="<?php echo $row->description ?>"
                                                        data-stock="<?php echo $row->stock ?>"
                                                        data-warranty_period="<?php echo $row->warranty_period ?>"
                                                        data-number_product="<?php echo $row->number_product ?>"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a class="btn btn-danger delete_Btn text-white long_letter"
                                                        data-id_products="<?php echo $row->id_product ?>"
                                                        data-name_product="<?php echo $row->name_product ?>"
                                                        data-description="<?php echo $row->description ?>"><i
                                                            class="fas fa-trash-alt"></i></a>
                                                    <?php }} ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <?php include "footer.php"?>
    </div>
    <!-- Modal para Crear Productos-->
    <div id="create_Modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Crear Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../controller/insert_products.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name_product" class="form-label">Nombre</label>
                            <input type="text" name="name_product" class="form-control" required maxlength="200">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <input type="text" name="description" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="number_product" class="form-label">Número de Producto</label>
                                <input type="text" name="number_product" class="form-control" maxlength="200">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="brand" class="form-label">Marca</label>
                                <select name="id_brand" id="brand" class="form-select" required>
                                    <option value="" selected disabled>-- Seleccione Marca --</option>
                                    <?php foreach ($brandData as $brand) { ?>
                                    <option value="<?php echo $brand->id_brand; ?>">
                                        <?php echo $brand->detail; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="category" class="form-label">Categoría</label>
                                <select name="id_category" id="category" class="form-select" required>
                                    <option value="" selected disabled>-- Seleccione Categoría --</option>
                                    <?php foreach ($categoryData as $category) { ?>
                                    <option value="<?php echo $category->id_category; ?>">
                                        <?php echo $category->detail; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="warranty_period" class="form-label">Meses de Garantía</label>
                                <input type="number" class="form-control" id="warranty_period_create"
                                    name="warranty_period" min="0" max="120" required>
                                <div class="invalid-feedback" id="warranty_period_error_create">
                                    Por favor, ingrese un número entre 0 y 120.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="enviar" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Productos-->
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../controller/edit_product.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_product" id="id_product" class="form-control">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name_product" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name_product" name="name_product"
                                    maxlength="200" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="description" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="number_product" class="form-label">Número de Producto</label>
                                <input type="text" class="form-control" id="number_product" name="number_product"
                                    maxlength="200">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="edtwarranty_period" class="form-label">Meses de Garantía</label>
                                <input type="number" class="form-control" id="edtwarranty_period"
                                    name="edtwarranty_period" min="0" max="120" required>
                                <div class="invalid-feedback" id="warranty_period_error_edit">
                                    Por favor, ingrese un número entre 0 y 120.
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="save_data" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Ver Productos-->
    <div id="viewModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white">Detalles Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="view_name_product" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="view_name_product" name="view_name_product"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="view_description" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="view_description" name="view_description"
                                readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="view_number_product" class="form-label">Número de Producto</label>
                                <input type="text" class="form-control" id="view_number_product"
                                    name="view_number_product" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="view_stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="view_stock" name="view_stock" readonly>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="view_warranty_period">Meses de Garantía</label>
                            <input type="number" class="form-control" id="view_warranty_period"
                                name="view_warranty_period" readonly>
                        </div>

                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Volver</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Eliminar Producto-->
    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Deshabilitar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../controller/delete_product.php" method="post">
                    <div class="modal-body text-center">
                        <h5>¿Deshabilitar este producto?</h5>
                        <input type="hidden" name="id_product" id="id_product_eliminate">
                        <input type="text" class="form-control" name="e_name_product" id="e_name_product" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                        <button type="submit" name="delete" class="btn btn-danger">Deshabilitar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/plugins/jquery/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <script src="../assets/js/modal_products.js"></script>

    <script src="../assets/plugins/jszip/jszip.min.js"></script>
    <script src="../assets/plugins/pdfmake/pdfmakev0.1.js"></script>
    <script src="../assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../assets/js/buttons.html5.min.js"></script>
    <script src="../assets/js/buttons.print.min.js"></script>
</body>

</html>