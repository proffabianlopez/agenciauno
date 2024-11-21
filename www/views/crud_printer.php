<?php
session_start();
//include_once "../controller/insert_printer.php";
//include_once "../controller/edit_printer.php";
//include_once "../controller/delete_printer.php";
include_once "../models/functions.php";
$show=show_state("suppliers");
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
    <script src="../assets/js/sweetalert2@11.js"></script>
    <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Bootstrap JS -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert -->
    <script src="../assets/js/sweetalert2@11.js"></script>
    <link rel="stylesheet" href="../assets/css/datatables.css">
</head>

<body class="sidebar-mini" style="height: auto;">
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
                                    <h4><b>Listado de Impresoras</b>
                                        <?php if (isset($_SESSION["id_rol"])) {
                                        if($_SESSION["id_rol"]=== 1) {?>
                                        <button type="button" class="btn btn-success create_suppliers_Btn"
                                            data-toggle="modal" data-target="#create_suppliers_Bt" data-action="add"
                                            data-placement="right" title="Nuevo"><i
                                                class="fas fa-plus-circle fa-lg"></i></button>
                                        <?php }} ?>
                                    </h4>
                                </div>
                                <div class="col-sm-6" id="botones" style="text-align: center;">
                                    <!-- Botones de exportación de DataTables -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <table id="table_proveedores" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Numero de serie</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>                                                                                                                                                                                                                                 
                                </thead>
                                <tbody>
    <?php foreach ($printers as $printer) { ?>
    <tr>
        <td>
            <?php echo $printer->serial_number; ?>
        </td>
        <td><?php echo $printer->brand; ?></td>
        <td>
            <?php echo $printer->model; ?>
        </td>
        <td>
            <?php echo ucfirst($printer->status); ?>
        </td>
        <td> 
            <!-- Ver detalles de la impresora -->
            <a class="btn btn-success viewBtn long_letter text-white"
               data-id="<?php echo $printer->id ?>"
               data-serial="<?php echo $printer->serial_number ?>"
               data-brand="<?php echo $printer->brand ?>"
               data-model="<?php echo $printer->model ?>"
               data-status="<?php echo $printer->status ?>"
               data-created="<?php echo $printer->created_at ?>">
                <i class="fa fa-binoculars"></i> Ver
            </a>

            <?php if (isset($_SESSION["id_rol"])) {
                if ($_SESSION["id_rol"] === 1) { ?>
                    <!-- Editar impresora -->
                    <a class="btn btn-warning editBtn long_letter text-white"
                       data-id="<?php echo $printer->id ?>"
                       data-serial="<?php echo $printer->serial_number ?>"
                       data-brand="<?php echo $printer->brand ?>"
                       data-model="<?php echo $printer->model ?>"
                       data-status="<?php echo $printer->status ?>">
                        <i style="width: 19px; height: 10px" class="fas fa-edit"></i> Editar
                    </a>
                    <!-- Cambiar estado de la impresora -->
                    <a class="btn btn-info changeStatusBtn long_letter text-white"
                       data-id="<?php echo $printer->id ?>"
                       data-status="<?php echo $printer->status ?>">
                        <i class="fas fa-sync-alt"></i> Cambiar Estado
                    </a>
                    <!-- Eliminar impresora -->
                    <a class="btn btn-danger delete_Btn long_letter text-white"
                       data-id="<?php echo $printer->id ?>"
                       data-serial="<?php echo $printer->serial_number ?>">
                        <i class="fas fa-trash-alt"></i> Eliminar
                    </a>
                <?php }} ?>
        </td>
    </tr>
    <?php } ?>
</tbody>

        <!-- FOOTER -->
        <?php include "footer.php"?>
    </div>
    <!-- crear impresoras-->
    <div id="create_Modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Nueva impresora</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../controller/insert_printer.php" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label for="serial_number">Número de Serie</label>
            <input type="text" name="serial_number" class="form-control" minlength="2" maxlength="200" required>
        </div>
                <div class="form-group">
            <label for="model">Modelo</label>
            <input type="text" name="model" class="form-control" minlength="2" maxlength="100" required>
        </div>
                <div class="form-group">
            <label for="brand">Marca</label>
            <input type="text" name="brand" class="form-control" minlength="2" maxlength="100" required>
        </div>
        <div class="form-group">
            <label for="supplier">Contador de hojas</label>
            <input type="number" name="supplier" class="form-control" minlength="2" maxlength="10000000" required>
        </div>
        <div class="form-group">
            <label for="status">Estado</label>
            <select name="status" class="form-control" required>
                <option value="activo">Disponible</option>
                <option value="inactivo">No disponible</option>
            </select>
        </div>
        <div class="form-group">
            <label for="acquisition_date">Fecha de Adquisición</label>
            <input type="date" name="acquisition_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="observations">Observaciones</label>
            <textarea name="observations" class="form-control" rows="3"></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" name="add_printer" class="btn btn-success">Guardar</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
    </div>
</form>

<div id="edit_Modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Editar Impresora</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../controller/update_printer.php" method="post">
                <div class="modal-body">
               
                    <input type="hidden" name="id_printer" value="{ID_ACTUAL}">
                    
                    <div class="form-group">
                        <label for="serial_number">Número de Serie</label>
                        <input type="text" name="serial_number" class="form-control" minlength="2" maxlength="200" value="{SERIAL_NUMBER}" required>
                    </div>
                    <div class="form-group">
                        <label for="model">Modelo</label>
                        <input type="text" name="model" class="form-control" minlength="2" maxlength="100" value="{MODEL}" required>
                    </div>
                    <div class="form-group">
                        <label for="brand">Marca</label>
                        <input type="text" name="brand" class="form-control" minlength="2" maxlength="100" value="{BRAND}" required>
                    </div>
                    <div class="form-group">
                        <label for="supplier">Contador de hojas</label>
                        <input type="number" name="supplier" class="form-control" min="0" max="10000000" value="{SUPPLIER}" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Estado</label>
                        <select name="status" class="form-control" required>
                            <option value="activo" {STATUS_ACTIVO}>Disponible</option>
                            <option value="inactivo" {STATUS_INACTIVO}>No disponible</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="acquisition_date">Fecha de Adquisición</label>
                        <input type="date" name="acquisition_date" class="form-control" value="{ACQUISITION_DATE}" required>
                    </div>
                    <div class="form-group">
                        <label for="observations">Observaciones</label>
                        <textarea name="observations" class="form-control" rows="3">{OBSERVATIONS}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update_printer" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="view_Modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Ver Impresora</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="serial_number">Número de Serie</label>
                    <p class="form-control-plaintext">{SERIAL_NUMBER}</p>
                </div>
                <div class="form-group">
                    <label for="model">Modelo</label>
                    <p class="form-control-plaintext">{MODEL}</p>
                </div>
                <div class="form-group">
                    <label for="brand">Marca</label>
                    <p class="form-control-plaintext">{BRAND}</p>
                </div>
                <div class="form-group">
                    <label for="count">Contador de hojas</label>
                    <p class="form-control-plaintext">{COUNT}</p>
                </div>
                <div class="form-group">
                    <label for="status">Estado</label>
                    <p class="form-control-plaintext">
                        {STATUS}
                    </p>
                </div>
                <div class="form-group">
                    <label for="acquisition_date">Fecha de Adquisición</label>
                    <p class="form-control-plaintext">{ACQUISITION_DATE}</p>
                </div>
                <div class="form-group">
                    <label for="observations">Observaciones</label>
                    <p class="form-control-plaintext">{OBSERVATIONS}</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

    <!-- eliminar impresoras -->
    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-white">Deshabilitar Impresora</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="color: white">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../controller/delete_printer.php" method="post">
                    <div class="modal-body" style="text-align:center">
                        <h3>¿Estás seguro que deseas deshabilitar la impresora?</h3>
                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-3"></div>
                            <div class="form-group col-md-6" style="text-align:center">
                                <input type="text" class="form-control" id="view-name" readonly
                                    style="text-align:center">
                            </div>
                        </div>
                        <input type="hidden" name="id_supplier" id="id_supplier_eliminate" value="">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-success" data-bs-dismiss="modal" value="Volver">
                        <input type="submit" class="btn btn-danger" name="delete" value="Deshabilitar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="../assets/plugins/jquery/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bumdle-v5.3.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <!-- Modal Suppliers JS -->
    <script src="../assets/js/modal_suppliers.js"></script>
    <!-- DataTables JS -->
    <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/js/datatables.bootstrap5.min.js"></script>
    <script src="../assets/js/dataTables.js"></script>
    <script src="../assets/js/dataTables.bootstrap5.js"></script>
    <script src="../assets/js/dataTables.searchPanes.js"></script>
    <script src="../assets/js/searchPanes.bootstrap5.js"></script>
    <script src="../assets/js/dataTables.select.js"></script>
    <script src="../assets/js/select.bootstrap5.js"></script>
    <!-- DataTables Buttons JS -->
    <script src="../assets/js/datatable.buttons2.1.1.js"></script>
    <script src="../assets/js/buttons.bootstrap5.min.js"></script>
    <script src="../assets/plugins/jszip/jszip.min.js"></script>
    <script src="../assets/plugins/pdfmake/pdfmakev0.1.js"></script>
    <script src="../assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../assets/js/buttons.html5.min.js"></script>
    <script src="../assets/js/buttons.print.min.js"></script>
</body>

</html>