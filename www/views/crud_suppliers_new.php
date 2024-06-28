<?php
session_start();
include_once "../controller/insert_suppliers.php";
include_once "../controller/edit_supplier.php";
include_once "../controller/delete_supplier.php";
include_once "../models/functions.php";
$show=show_state("suppliers");
if (isset($_SESSION["id_rol"]) && ($_SESSION["id_rol"] == 1 || $_SESSION["id_rol"] == 4)) {
    
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
                            <div class="row mb-12">
                                <div class="col-sm-6">
                                    <h4><b>Listado de Proveedores &nbsp&nbsp&nbsp</b>
                                        <button type="button" class="btn btn-success create_suppliers_Btn"
                                            data-toggle="modal" data-target="#create_suppliers_Bt" data-action="add"
                                            data-placement="right" title="Nuevo"><i
                                                class="fas fa-plus-circle fa-lg"></i></button>
                                    </h4>
                                </div><!-- /.col -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.row -->
                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <table id="table_proveedores" class="table table-striped table-hover">
                                <thead>

                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Cuil</th>
                                        <th>Telefono</th>

                                        <!--<th class="text-center long_letter">Observaciones</th>-->

                                        <th>Acciones</th>

                                    </tr>


                                </thead>
                                <tbody>

                                    <?php foreach ($show as $row) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $row->name_supplier ?>
                                        </td>
                                        <td><?php echo $row->email_supplier ?></td>
                                        <!--<td class="text-center long_letter align-middle">-->
                                        <!--<?php echo $row->observations ?>-->
                                        <!--</td>-->
                                        <td>
                                            <?php echo $row->tax_identifier  ?>
                                        </td>
                                        <td>
                                            <?php echo $row->phone_supplier ?>
                                        </td>

                                        <td> <a class="btn btn-success viewBtn long_letter text-white"                                                
                                                data-id="<?php echo $row->id_supplier ?>"
                                                data-name="<?php echo $row->name_supplier?>"
                                                data-phone="<?php echo $row->phone_supplier ?>"
                                                data-email="<?php echo $row->email_supplier ?>"
                                                data-obs="<?php echo $row->observations; ?>"
                                                data-tax="<?php echo $row->tax_identifier ?>"
                                                data-street="<?php echo $row->street ?>"
                                                data-height="<?php echo $row->height ?>"
                                                data-floor="<?php echo $row->floor ?>"
                                                data-departament="<?php echo $row->departament?>"
                                                data-location="<?php echo $row->location ?>">
                                                <i
                                                    class="fa fa-binoculars"></i></a>
                                            <a class="btn btn-warning editBtn long_letter text-white"
                                                data-id="<?php echo $row->id_supplier ?>"
                                                data-name="<?php echo $row->name_supplier?>"
                                                data-phone="<?php echo $row->phone_supplier ?>"
                                                data-email="<?php echo $row->email_supplier ?>"
                                                data-obs="<?php echo $row->observations; ?>"
                                                data-tax="<?php echo $row->tax_identifier ?>"
                                                data-street="<?php echo $row->street ?>"
                                                data-height="<?php echo $row->height ?>"
                                                data-floor="<?php echo $row->floor ?>"
                                                data-departament="<?php echo $row->departament?>"
                                                data-location="<?php echo $row->location ?>">
                                                <i style="width: 10px; height: 10px;" class="fas fa-edit"></i></a>
                                                   <a class="btn btn-danger delete_Btn long_letter text-white"
                                                data-id_suppliers="<?php echo $row->id_supplier ?>"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>

                                </tbody>
                            </table>

                        </div>
                    </div>
                    <!-- Main content -->
                </div>
            </main>
        </div>

        <!-- FOOTER -->


        <?php include "footer.php"?>
    </div>
    <!-- Modal para Crear Proveedores-->
    <div id="create_Modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">

            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Dar de Alta un Proveedor</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../controller/insert_suppliers.php" method="post">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Nombre </label>
                            <input type="text" name="name_Proveedor" class="form-control" pattern="[A-Za-z]+" minlength="2" maxlength="30" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email_Proveedor" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cuil">CUIL/CUIT</label>

                            <input type="text" name="cuil" class="form-control" required pattern="^\d{11}$" maxlength="11" title="Debe contener exactamente 11 dígitos">

                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" required pattern="^\d{10}$" maxlength="10"
                                title="Debe contener exactamente 10 dígitos">

                        </div>
                        <div class="form-group">
                            <label for="direction">Dirección</label>
                            <input type="text" name="direccion" class="form-control" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" minlength="2" maxlength="30" required>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="height">Altura</label>
                                <input type="number" name="altura" class="form-control" required min="1">

                            </div>
                            <div class="form-group col-md-3">
                                <label for="piso">Piso</label>
                                <input type="text" name="piso" class="form-control" >

                            </div>
                            <div class="form-group col-md-3">
                                <label for="numero_de_piso">Departamento</label>
                                <input type="text" name="numero_de_piso" class="form-control" >

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ciudad">Localidad</label>
                            <input type="text" name="ciudad" class="form-control" pattern="[A-Za-z]+" minlength="2" maxlength="20" required>

                        </div>
                        <div class="form-group">
                            <label for="observaciones">Observaciones</label>
                            <textarea type="text" name="observaciones" class="form-control" ></textarea>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="agregar" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" >Cancelar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--Modal de Editar Proveedores-->
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Editar un Proveedor</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../controller/edit_supplier.php" method="post">
                    <div class="modal-body">

                        <input type="hidden" name="id_supplier" id="id_supplier" class="form-control" value="">
                        <div class="form-group">
                            <label for="edit_name">Nombre</label>
                            <input type="text" class="form-control" id="name_supplier" name="name" required value="">
                        </div>
                        <div class="form-group">
                            <label for="edit_phone">Telefono</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="" pattern="^\d{10}$" title="Debe contener exactamente 10 dígitos">
                        </div>
                        <div class="form-group">
                            <label for="edit_directiòn">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="">
                        </div>
                        <div class="form-group">
                            <label for="edit_heigth">Observaciones</label>
                            <input type="text" class="form-control" id="obs" name="observaciones"  value="">
                        </div>
                        <div class="form-group">
                            <label for="edit_heigth">Cuil</label>
                            <input type="text" class="form-control" id="tax" name="cuil" value="" pattern="^\d{10}$" title="Debe contener exactamente 10 dígitos">
                        </div>

                        <div class="form-row">
                        <div class="form-group col-md-3">
                                <label for="street">calle</label>
                                <input type="text" id="street" name="street"  class="form-control" required>

                            </div>
                            <div class="form-group col-md-3">
                                <label for="height">Altura</label>
                                <input type="text" id="height" name="height"  class="form-control" required>

                            </div>
                            <div class="form-group col-md-3">
                                <label for="floor">piso</label>
                                <input type="text" id="floor" name="floor" class="form-control" >

                            </div>
                            <div class="form-group col-md-3">
                                <label for="departament">Departamento</label>
                                <input type="text" id="departament" name="departament" id="departament" class="form-control" >

                            </div>
                        </div>
                     <div class="form-group">
                            <label for="location">Localidad</label>
                            <input type="text" class="form-control" id="location" name="location" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="save_data">Guardar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        
                        
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- Fin Modal para Editar Proveedor-->



    <!--Modal de Ver Proveedores-->
    <div id="viewModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">
        <div class="modal-content">
    <div class="modal-header bg-primary">
        <h4 class="modal-title text-white">Detalles del Proveedor</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="color: white;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="view_name">Nombre</label>
            <span id="view_name" class="form-control-static"></span>
        </div>
        <div class="form-group">
            <label for="view_phone">Teléfono</label>
            <span id="view_phone" class="form-control-static"></span>
        </div>
        <div class="form-group">
            <label for="view_email">Email</label>
            <span id="view_email" class="form-control-static"></span>
        </div>
        <div class="form-group">
            <label for="view_obs">Observaciones</label>
            <span id="view_obs" class="form-control-static"></span>
        </div>
        <div class="form-group">
            <label for="view_tax">CUIL</label>
            <span id="view_tax" class="form-control-static"></span>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="view_street">Calle</label>
                <span id="view_street" class="form-control-static"></span>
            </div>
            <div class="form-group col-md-3">
                <label for="view_height">Altura</label>
                <span id="view_height" class="form-control-static"></span>
            </div>
            <div class="form-group col-md-3">
                <label for="view_floor">Piso</label>
                <span id="view_floor" class="form-control-static"></span>
            </div>
            <div class="form-group col-md-3">
                <label for="view_departament">Departamento</label>
                <span id="view_departament" class="form-control-static"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="view_location">Localidad</label>
            <span id="view_location" class="form-control-static"></span>
        </div>
    </div>
</div>

        </div>
    </div> 

    <!-- Eliminar Proveedor -->
    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" style="width: 300px">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-white">Deshabilitar un Proveedor</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="color: white" ;>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../controller/delete_supplier.php" method="post">
                    <div class="modal-body" style="text-align:center">
                        <h3>Estas seguro que desea Deshabilitar al Proveedor: </h3>
                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                            </div>
                            <div class="form-group col-md-6" style="text-align:center">
                                <input type="text" class="form-control" id="view-name" name="view-name" readonly
                                value="<?php echo $row->name_supplier?>"    
                                style="text-align:center">
                            </div>
                        </div>                     
                                <input type="hidden" name="id_supplier" id="id_supplier_eliminate"
                                    value="<?php echo $row->id_supplier ?>">                                
                        
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="edit-id_customer" id="edit-id_customer">
                        <input type="button" class="btn btn-success" data-bs-dismiss="modal" value="Volver">
                        <input type="submit" class="btn btn-danger" name="delete" value="Deshabilitar">
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
    <script src="../js.modal/modal_suppliers.js"></script>

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
    $("#table_proveedores").DataTable({
        pageLength: 5,
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
        }, {
            width: '20%'
        }]
    });
    </script>



</body>

</html>