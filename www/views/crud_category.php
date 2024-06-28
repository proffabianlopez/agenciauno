<?php
include_once "../models/functions.php";
$categorys = obtenercategorys();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agencia 1</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/css/style_lista_cliente.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.3.1/css/searchPanes.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.3/css/select.bootstrap5.css">
    <style>
        .modal-dialog {
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
            height: auto !important;
            max-height: 80vh !important;
        }

        .modal-content {
            width: 100% !important;
            max-width: 100% !important;
            height: auto;
        }

        .modal-body {
            overflow-y: auto;
            max-height: calc(80vh - 120px);
        }
    </style>
</head>

<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper">
        <?php include "header.php"?>
        <?php include "menu.php"?>
        <div class="content-wrapper" style="min-height: 1604.8px;">
            <main>
                <div class="container-fluid" style="padding:50px;">
                    <div class="card" style="margin-top:5px">
                        <div class="card-header">
                            <div class="row mb-12">
                                <div class="col-sm-6">
                                    <h4><b>Listado de Categorias</b>
                                    <a type="button" class="btn btn-success btn btn-primary btn-lg create_brands_Btn text-white"
                                        data-bs-toggle="modal" data-bs-target="#createEmployeeModal" data-action="add" data-placement="right"
                                        title="Nuevo"><i class="fas fa-plus-circle fa-lg"></i></a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <table id="table_clientes" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Categorias</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($categorys as $categoria): ?>
                                    <?php if ($categoria['id_status'] == 1): ?>
                                    <tr>
                                        <td><?php echo $categoria['detail']; ?></td>
                                        <td>
                                            <a class="btn btn-warning float-center editBtn text-white"
                                                data-bs-toggle="modal"
                                                data-id="<?php echo $categoria['id_category']; ?>" 
                                                data-detail="<?php echo $categoria['detail']; ?>"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger float-center delete_Btn text-white"
                                                data-bs-toggle="modal"
                                                data-id="<?php echo $categoria['id_category']; ?>" 
                                                data-detail="<?php echo $categoria['detail']; ?>"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="createEmployeeModal" class="modal fade" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h4 class="modal-title text-white">Crear Categoria</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="color: white;">&times;</span>
                                    </button>
                                </div>
                                <form action="../controller/controller_categorys.php" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="create-detail">Nombre de la categoria</label>
                                            <input type="text" class="form-control" id="create-detail" name="name_category" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" minlength="2" maxlength="30" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div id="editEmployeeModal" class="modal fade" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h4 class="modal-title text-white">Editar Categoria</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="color: white;">&times;</span>
                                    </button>
                                </div>
                                <form action="../controller/edit_category.php" method="post">
                                    <div class="modal-body">
                                        <input type="hidden" name="edit-id" id="edit-id">
                                        <div class="form-group">
                                            <label for="edit-detail">Nombre de la categoria</label>
                                            <input type="text" class="form-control" id="edit-detail" name="edit-detail" pattern="[A-Za-z]+" minlength="2" maxlength="30" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div id="deleteEmployeeModal" class="modal fade" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h4 class="modal-title text-white">Deshabilitar Categoria</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="color: white;">&times;</span>
                                    </button>
                                </div>
                                <form action="../controller/delete_category.php" method="post">
                                    <div class="modal-body">
                                        <p>¿Está seguro que desea Deshabilitar esta categoria?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="edit-id_category" id="edit-id_category">
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Deshabilitar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
        <?php include "footer.php"?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <script src="../assets/js/accions_categorys.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.1/js/dataTables.searchPanes.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.1/js/searchPanes.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.3/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.3/js/select.bootstrap5.js"></script>

    <script>
    $("#table_clientes").DataTable({
        pageLength: 15,
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json",
        },
        searchPanes: {
            viewTotal: true,
            columns: [2]
        },
        dom: 'Plfrtip',
        columnDefs: [{
            searchPanes: {
                show: true
            },
            targets: [1]
        }]
    });

    $(document).on("click", ".editBtn", function () {
        var id_category = $(this).data('id');
        var detail = $(this).data('detail');
        $("#editEmployeeModal #edit-id").val(id_category);
        $("#editEmployeeModal #edit-detail").val(detail);
        $("#editEmployeeModal").modal("show");
    });

    $(document).on("click", ".delete_Btn", function () {
        var id_category = $(this).data('id');
        var detail = $(this).data('detail');
        $("#deleteEmployeeModal #edit-id_category").val(id_category);
        $("#deleteEmployeeModal").modal("show");
    });
    </script>
</body>
</html>
