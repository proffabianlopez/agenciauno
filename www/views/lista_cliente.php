<?php
include_once "../models/functions.php";
$clientes = obtenerclientes();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agencia 1</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <!-- Custom style -->
    <link rel="stylesheet" href="../assets/dist/css/agencia1.css">
    <link rel="stylesheet" href="../assets/css/style_lista_cliente.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
        width: 290% !important; 
        max-width: 290% !important; 
        height: auto;
    }

    .modal-body {
        overflow-y: auto; 
        max-height: calc(80vh - 120px);
    }
</style>
</head>
<body class="sidebar-mini" style="height: auto;">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- HEADER -->
        <?php include "header.php"?>
        <!-- MENU -->
        <?php include "menu.php"?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 1604.8px;">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title d-flex justify-content-between align-items-center">
                        <h2>Lista de clientes</h2>
                        
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                              
                                <th>Nombre de cliente</th>
                                <th>Email de cliente</th>
                                <th>CUIL/CUIT</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Altura</th>
                                <th>Piso</th>
                                <th>departamento</th>
                                <th>Localidad</th>
                                <th>Observaciones</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientes as $cliente): ?>
                                <?php if ($cliente['id_status'] == 1): ?>
                                <tr>
                                    <td><?php echo $cliente['customer_name']; ?></td>
                                    <td><?php echo $cliente['email_customer']; ?></td>
                                    <td><?php echo $cliente['tax_identifier']; ?></td>
                                    <td><?php echo $cliente['phone_customer']; ?></td>
                                    <td><?php echo $cliente['street']; ?></td>
                                    <td><?php echo $cliente['height']; ?></td>
                                    <td><?php echo $cliente['floor']; ?></td>
                                    <td><?php echo $cliente['departament']; ?></td>
                                    <td><?php echo $cliente['location']; ?></td>
                                    <td><?php echo $cliente['observaciones']; ?></td>
                                    <td>
                                        <a href="#editEmployeeModal" class="edit" data-toggle="modal"
                                           data-id="<?php echo $cliente['id_customer']; ?>"
                                           data-name="<?php echo $cliente['customer_name']; ?>"
                                           data-email="<?php echo $cliente['email_customer']; ?>"
                                           data-cuit="<?php echo $cliente['tax_identifier']; ?>"
                                           data-phone="<?php echo $cliente['phone_customer']; ?>"
                                           data-street="<?php echo $cliente['street']; ?>"
                                           data-height="<?php echo $cliente['height']; ?>"
                                           data-floor="<?php echo $cliente['floor']; ?>"
                                           data-departament="<?php echo $cliente['departament']; ?>"
                                           data-location="<?php echo $cliente['location']; ?>"
                                           data-observaciones="<?php echo $cliente['observaciones']; ?>">
                                            <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                        </a>
                                        <a href="#deleteEmployeeModal" class="delete" data-toggle="modal" data-id="<?php echo $cliente['id_customer']; ?>">
                                            <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
<<<
            <!-- Edit Modal HTML -->
            <div id="editEmployeeModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="../controller/actualiza_cliente.php" method="post">
                            <div class="modal-header">
                                <h4 class="modal-title">Editar Cliente</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="edit-id_customer" id="edit-id_customer">
                                <div class="form-group">
                                    <label for="edit-name">Nombre del cliente</label>
                                    <input type="text" class="form-control" id="edit-name" name="edit-name">
                                </div>
                                <div class="form-group">
                                    <label for="edit-email">Email del cliente</label>
                                    <input type="email" class="form-control" id="edit-email" name="edit-email">
                                </div>
                                <div class="form-group">
                                    <label for="edit-cuit">CUIL/CUIT</label>
                                    <textarea class="form-control" id="edit-cuit" name="edit-cuit"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit-phone">Teléfono</label>
                                    <input type="text" class="form-control" id="edit-phone" name="edit-phone">
                                </div>
                                <div class="form-group">
                                    <label for="edit-street">Dirección</label>
                                    <input type="text" class="form-control" id="edit-street" name="edit-street">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="edit-height">Altura</label>
                                        <input type="text" class="form-control" id="edit-height" name="edit-height">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="edit-floor">Piso</label>
                                        <input type="text" class="form-control" id="edit-floor" name="edit-floor">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="edit-department">Departamento</label>
                                        <input type="text" class="form-control" id="edit-department" name="edit-department">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="edit-location">Localidad</label>
                                    <input type="text" class="form-control" id="edit-location" name="edit-location">
                                </div>
                                <div class="form-group">
                                    <label for="edit-observaciones">Observaciones</label>
                                    <textarea class="form-control" id="edit-observaciones" name="edit-observaciones"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Modal HTML -->
            <div id="deleteEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="../controller/eliminar_cliente.php" method="post">
                            <div class="modal-header">
                                <h4 class="modal-title">Borrar Cliente</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>¿Está seguro que desea eliminar a este cliente?</p>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="edit-id_customer" id="edit-id_customer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                                <input type="submit" class="btn btn-danger" value="Eliminar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- FOOTER -->
            <?php include "footer.php"?>
        </div>
        <!-- ./wrapper -->
        <!-- jQuery -->
        <script src="../assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../assets/dist/js/adminlte.min.js"></script>
        <script src="../assets/js/accions.js"></script>
    </body>
</html>
