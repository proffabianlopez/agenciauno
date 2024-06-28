<?php
include_once "../models/functions.php";
$usuarios = obtenerusuarios();
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
                                    <h4><b>Listado de Usuarios</b>
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
                            <table id="table_usuarios" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Teléfono</th>
                                        <th>Contraseña</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($usuarios as $usuario): ?>
                                        <?php if ($usuario['id_status'] == 1): ?>
                                            <tr>
                                                    <td><?php echo $usuario['email_user']; ?></td>
                                                    <td><?php echo $usuario['phone']; ?></td>
                                                    <td><?php echo $usuario['password']; ?></td>
                                                    
                                                    <td>   <a href="#viewEmployeeModal"
                                                        class="view btn btn-success long_letter text-white" data-bs-toggle="modal"
                                                        data-id="<?php echo $usuario['id_user']; ?>"
                                                        data-name="<?php echo $usuario['email_user']; ?>"
                                                        data-phone="<?php echo $usuario['phone']; ?>"
                                                        data-password="<?php echo $usuario['password']; ?>">
                                                        <i style="width: 19px; height: 10px;" class="fas fa-binoculars"></i>
                                                    </a>
                                                    <a href="#editEmployeeModal" class="btn btn-warning float-center editBtn text-white" data-bs-toggle="modal"
                                                        data-id="<?php echo $usuario['id_user']; ?>"
                                                        data-name="<?php echo $usuario['email_user']; ?>"
                                                        data-phone="<?php echo $usuario['phone']; ?>"
                                                        data-password="<?php echo $usuario['password']; ?>">
                                                        <i style="width: 19px; height: 10px;" class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#deleteEmployeeModal" class="btn btn-danger float-center deleteBtn text-white" data-bs-toggle="modal"
                                                        data-id="<?php echo $usuario['id_user']; ?>"
                                                        data-name="<?php echo $usuario['email_user']; ?>"><i class="fas fa-trash-alt"></i>
                                                    </a>
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
                                <form action="../controller/controller_usuario.php" method="post">
                                    <div class="modal-header bg-primary">
                                        <h4 class="modal-title text-white">Crear Usuario</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="create-user">Email de usuario</label>
                                            <input type="email" class="form-control" id="create-user" name="name_user">
                                        </div>
                                        <div class="form-group">
                                            <label for="create-phone">Teléfono</label>
                                            <input type="number" class="form-control" id="create-phone" name="phone" required pattern="^\d{10}$" maxlength="10" title="Debe contener exactamente 10 dígitos">
                                        </div>
                                        <div class="form-group">
                                            <label for="create-password">Contraseña</label>
                                            <input type="password" class="form-control" id="create-password" name="password">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div id="editEmployeeModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="../controller/edit_usuario.php" method="post">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Editar Usuario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="edit-id_user" id="edit-id_user">
                    <div class="form-group">
                        <label for="edit-name">Email de usuario</label>
                        <input type="email" class="form-control" id="edit-name" name="edit-name">
                    </div>
                    <div class="form-group">
                        <label for="edit-phone">Teléfono</label>
                        <input type="text" class="form-control" id="edit-phone" name="edit-phone" pattern="^\d{10}$" maxlength="10" title="Debe contener exactamente 10 dígitos" >
                    </div>
                    <div class="form-group">
                        <label for="edit-password">Contraseña</label>
                        <input type="text" class="form-control" id="edit-password" name="edit-password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
        <!-- View Modal HTML -->
        <div id="viewEmployeeModal" class="modal fade" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <h4 class="modal-title text-white">Detalles del Usuario</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                   
                                    <div class="form-group">
                                        <label for="view-email">Email</label>
                                        <input type="email" class="form-control" id="view-name" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="view-phone">Teléfono</label>
                                        <input type="text" class="form-control" id="view-phone" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="view-password">Contraseña</label>
                                        <input type="text" class="form-control" id="view-password" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div id="deleteEmployeeModal" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="../controller/delete_usuario.php" method="post">
                                    <div class="modal-header bg-danger">
                                        <h4 class="modal-title text-white">Deshabilitar Usuario</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Está seguro que desea deshabilitar este usuario?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="delete-id_user" id="delete-id_user">
                                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
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
    <script src="../assets/js/accions_usuarios.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.1/js/dataTables.searchPanes.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.1/js/searchPanes.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.3/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.3/js/select.bootstrap5.js"></script>

    <script>
        
            $('#table_usuarios').DataTable({
            pageLength: 4,
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json",
        },
        columns: [{
            width: '20%'
        }, {
            width: '20%'
        }, {
            width: '20%'
        }, {
            width: '20%'
        }]

    

    });
    </script>
    

</body>

</html>
