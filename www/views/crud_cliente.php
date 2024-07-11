<?php
session_start();
include_once "../models/functions.php";

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <!-- Custom style -->
    <!--<link rel="stylesheet" href="../assets/dist/css/agencia1.css">-->
    <link rel="stylesheet" href="../assets/css/style_lista_cliente.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Icons -->
    <link rel="stylesheet" href="../assets/bootstrap/icons-1.9.1/bootstrap-icons.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.3.1/css/searchPanes.bootstrap5.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.3/css/select.bootstrap5.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            <main>
                <div class="container-fluid" style="padding:50px;">
                    <div class="card" style="margin-top:5px">
                        <div class="card-header">
                            <div class="row mb-12">
                                <div class="col-sm-6">
                                    <h4><b>Listado de Clientes&nbsp&nbsp</b>
                                        <?php if (isset($_SESSION["id_rol"])) {
            if($_SESSION["id_rol"]=== 1) {?> <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#createEmployeeModal" data-action="add" data-placement="right"
                                            title="Nuevo"><i class="fas fa-plus-circle fa-lg"></i></button>
                                        <?php }} ?>
                                    </h4>
                                </div><!-- /.col -->
                                <div class="col-sm-6" id="botones" style="text-align: center;">
                                    <!-- Aquí se colocarán los botones de exportación de DataTables -->
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.row -->

                    <div class="table-responsive">
                        <div class="table-wrapper">

                            <table id="table_clientes" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>CUIL/CUIT</th>
                                        <th>Teléfono</th>
                                        <!-- <th>Dirección</th> -->
                                        <!-- <th>Altura</th> -->
                                        <!-- <th>Piso</th> -->
                                        <!-- <th>departamento</th> -->
                                        <!-- <th>Localidad</th> -->
                                        <!-- <th>Observaciones</th> -->
                                        <th>Acciones</th>
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
                                        <!--<td><?php echo $cliente['street']; ?></td>-->
                                        <!--<td><?php echo $cliente['height']; ?></td>-->
                                        <!--<td><?php echo $cliente['floor']; ?></td>-->
                                        <!--<td><?php echo $cliente['departament']; ?></td>-->
                                        <!--<td><?php echo $cliente['location']; ?></td>-->
                                        <!-- <td><?php echo $cliente['observaciones']; ?></td>-->

                                        <td> <a href="#viewEmployeeModal"
                                                class="view btn btn-success long_letter text-white" data-toggle="modal"
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
                                                data-observaciones="<?php echo $cliente['observaciones']; ?>"><i
                                                    style="width: 19px; height: 10px;"
                                                    class="fas fa-binoculars"></i></a>

                                            <?php if (isset($_SESSION["id_rol"])) {
            if($_SESSION["id_rol"]=== 1) {?>
                                            <a href="#editEmployeeModal"
                                                class="edit btn btn-warning long_letter text-white" data-toggle="modal"
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
                                                data-observaciones="<?php echo $cliente['observaciones']; ?>"><i
                                                    style="width: 19px; height: 10px;" class="fas fa-edit"></i></a>



                                            <a href="#deleteEmployeeModal"
                                                class="delete btn btn-danger delete_Btn long_letter text-white"
                                                data-toggle="modal" data-id="<?php echo $cliente['id_customer']; ?>"
                                                data-name="<?php echo $cliente['customer_name']; ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <?php }} ?>
                                        </td>

                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </main>
        </div>
        <!-- FOOTER -->
        <?php include "footer.php"?>
    </div>
    <!-- Create Modal HTML -->
    <div id="createEmployeeModal" class="modal fade">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">

            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Crear Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../controller/controller_clients.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="edit-id_customer" id="edit-id_customer">
                        <div class="form-group">
                            <label for="edit-name">Nombre</label>
                            <input type="text" id="edit-name" name="name_cliente" class="form-control" minlength="2"
                                maxlength="200" required title="Debe contenter solo letras">
                        </div>
                        <div class="form-group">
                            <label for="edit-email">Email</label>
                            <input type="email" class="form-control" id="edit-email" name="email_cliente"
                                maxlength="200" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-cuit">CUIL/CUIT</label>

                            <input type="text" class="form-control" id="edit-cuit" name="identifier" pattern="^\d{11}$"
                                maxlength="11" title="Debe contener exactamente 11 dígitos">


                        </div>
                        <div class="form-group">
                            <label for="edit-phone">Teléfono</label>

                            <input type="text" class="form-control" id="edit-phone" name="telefono" required
                                pattern="^\d{10}$" maxlength="10"
                                title="Debe contener exactamente 10, sin el 0 ni el 15 dígitos">

                        </div>
                        <div class="form-group">
                            <label for="edit-street">Dirección</label>
                            <input type="text" class="form-control" id="edit-street" name="direccion"
                                pattern="[A-Za-záéíóúÁÉÍÓÚñÑ0-9\s]+" required
                                title="Ingrese solo letras y números, sin puntos ni comas">
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="edit-height">Altura</label>
                                <input type="number" class="form-control" id="edit-height" name="altura" max="100000000"
                                    required title="solo se permiten números" value="0">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="edit-floor">Piso</label>
                                <input type="text" class="form-control" name="piso" name="numero_de_piso" maxlength="4">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="edit-department">Departamento</label>
                                <input type="text" class="form-control" id="edit-department" name="department"
                                    maxlength="4">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit-location">Localidad</label>
                            <input type="text" class="form-control" id="edit-location" name="ciudad"
                                pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" minlength="2" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-observaciones">Observaciones</label>
                            <textarea class="form-control" id="edit-observaciones" name="observaciones"></textarea>
                        </div>
                        <!-- "CUANDO CREA DEBERÍA ESTAR SIEMPRE HABILITADO"
                        <div class="form-row">
                            <label for="time" class="col-sm-2 col-form-label">Habilitado:</label>
                            <div class="col-7">
                                <input ID="time" type="checkbox" Class="form-control-sm" name="status" required>
                            </div>
                        </div>
                        -->
                        <br>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Editar Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../controller/actualiza_cliente.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="edit-id_customer" id="edit-id_customer">
                        <div class="form-group">
                            <label for="edit-name">Nombre</label>
                            <input type="text" class="form-control" id="edit-name" name="edit-name" minlength="2"
                                maxlength="200" required title="Debe contenter solo letras">
                        </div>
                        <div class="form-group">
                            <label for="edit-email">Email</label>
                            <input type="email" class="form-control" id="edit-email" name="edit-email" maxlength="200"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="edit-cuit">CUIL/CUIT</label>

                            <input type="text" class="form-control" id="edit-cuit" name="edit-cuit" pattern="^\d{11}$"
                                maxlength="11" title="Debe contener exactamente 11 dígitos"></input>
                        </div>
                        <div class="form-group">
                            <label for="edit-phone">Teléfono</label>
                            <input type="text" class="form-control" id="edit-phone" name="edit-phone" pattern="^\d{10}$"
                                maxlength="10" title="Debe contener exactamente 10, sin el 0 ni el 15 dígitos">

                        </div>
                        <div class="form-group">
                            <label for="edit-street">Dirección</label>
                            <input type="text" class="form-control" id="edit-street" name="edit-street"
                                pattern="[A-Za-záéíóúÁÉÍÓÚñÑ0-9\s]+" required
                                title="Ingrese solo letras y números, sin puntos ni comas">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="edit-height">Altura</label>
                                <input type="number" class="form-control" id="edit-height" name="edit-height"
                                    max="100000000" required title="solo se permiten números">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="edit-floor">Piso</label>
                                <input type="text" class="form-control" id="edit-floor" name="edit-floor" maxlength="4">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="edit-department">Departamento</label>
                                <input type="text" class="form-control" id="edit-department" name="edit-department"
                                    maxlength="4">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit-location">Localidad</label>
                            <input type="text" class="form-control" id="edit-location" name="edit-location"
                                pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" minlength="2" maxlength="100" required>

                        </div>
                        <div class="form-group">
                            <label for="edit-observaciones">Observaciones</label>
                            <textarea class="form-control" id="edit-observaciones" name="edit-observaciones"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Modal HTML -->
    <div id="viewEmployeeModal" class="modal fade">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">
            <div class="modal-content">

                <div class="modal-header bg-success">
                    <h4 class="modal-title text-white">Detalles Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" method="post">
                    <div class="modal-body">
                        <input type="hidden" ename="view-id_customer" id="view-id_customer">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="view-name">Nombre</label>
                                <input type="text" class="form-control" id="view-name" name="view-name" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="view-email">Email</label>
                                <input type="email" class="form-control" id="view-email" name="view-email" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="view-cuit">CUIL/CUIT</label>
                                <input class="form-control" id="view-cuit" name="view-cuit" readonly></input>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="view-phone">Teléfono</label>
                                <input type="text" class="form-control" id="view-phone" name="view-phone" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="view-location">Localidad</label>
                                <input type="text" class="form-control" id="view-location" name="view-location"
                                    readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="view-street">Dirección</label>
                                <input type="text" class="form-control" id="view-street" name="view-street" readonly>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="view-height">Altura</label>
                                <input type="text" class="form-control" id="view-height" name="view-height" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="view-floor">Piso</label>
                                <input type="text" class="form-control" id="view-floor" name="view-floor" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="view-department">Departamento</label>
                                <input type="text" class="form-control" id="view-department" name="view-department"
                                    readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="view-observaciones">Observaciones</label>
                            <textarea class="form-control" id="view-observaciones" name="observaciones"
                                readonly></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Volver</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-white">Deshabilitar Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form action="../controller/eliminar_cliente.php" method="post">
                    <div class="modal-body" style="text-align:center">
                        <h3>¿Estás seguro que deseas Deshabilitar al Cliente?</h3>
                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-3"></div>
                            <div class="form-group col-md-6" style="text-align:center">
                                <input type="text" class="form-control" id="view-name" name="view-name" readonly
                                    style="text-align:center">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="edit-id_customer" id="edit-id_customer">
                        <input type="button" class="btn btn-success" data-dismiss="modal" value="Volver">
                        <input type="submit" class="btn btn-danger" value="Deshabilitar">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
    // Verifica si hay un mensaje en el almacenamiento local
    if (localStorage.getItem('mensaje') && localStorage.getItem('tipo')) {
        Swal.fire({
            title: 'Mensaje',
            text: localStorage.getItem('mensaje'),
            icon: localStorage.getItem('tipo'),
            confirmButtonText: 'Aceptar'
        });

        // Limpia el mensaje después de mostrarlo
        localStorage.removeItem('mensaje');
        localStorage.removeItem('tipo');
    }
    </script>




    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>


    <!-- Bootstrap 4 -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <script src="../assets/js/accions.js"></script>

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


    <script>
    $(document).ready(function() {
        var table = $('#table_clientes').DataTable({
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50, 75, 100], // Opciones de cantidad de registros a mostrar
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json",
            },
            columns: [{
                    width: '20%'
                },
                {
                    width: '20%'
                },
                {
                    width: '20%'
                },
                {
                    width: '20%'
                },
                {
                    width: '20%'
                }
            ],
            dom: '<"top"lf><"table-responsive"t><"bottom"ip>',
            buttons: [{
                    extend: 'excel',
                    className: 'btn btn-success',
                    text: '<i class="far fa-file-excel"></i> Excel'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    text: '<i class="far fa-file-pdf"></i> PDF'
                }
            ],
            initComplete: function() {
                // Mover los botones al contenedor personalizado
                table.buttons().container().appendTo('#botones');
            }
        });
    });
    </script>



</body>

</html>