<?php
include_once "../controller/insert_suppliers.php";
include_once "../controller/edit_supplier.php";
include_once "../controller/delete_supplier.php";
include_once "../models/functions.php";
$show=show_state("suppliers");
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
    <Link rel="stylesheet" href="../assets/dist/css/agencia1.css">
    </Link>
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
        <div class="content-wrapper">
           
            
     
    
     <div class="col">
         <h4> Proveedores
          <a href="#" class="btn btn-primary btn-lg create_suppliers_Btn text-white float-right"><i class="fas fa-plus-circle fa-lg"></i></a>
           </h4>
     </div>

   
    <div class="row py-1">
        <div class="col">
        
           
           <table class="table table-border small" id="myTable">
               <thead>
              
                    
                <tr class="bg-primary">
                    <th class="text-center long_letter">Nombre Proveedor</th>
                    <th class="text-center long_letter">Telefono</th>
                    <th class="text-center long_letter">Email</th>
                    <th class="text-center long_letter">Observaciones</th>
                    <th class="text-center long_letter">Cuil</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Eliminar</th>
                </tr>
                    

               </thead>
               <tbody>
               
               
                            <?php foreach ($show as $row) { ?>
                                <tr>
                                <td class="text-center long_letter align-middle"><?php echo $row->name_supplier ?></td>
                                <td class="text-center long_letter align-middle"><?php echo $row->phone_supplier ?></td>
                                <td class=" align-middle"><?php echo $row->email_supplier ?></td>
                                <td class="text-center long_letter align-middle"><?php echo $row->observations ?> </td>
                                <td class="text-center long_letter align-middle"><?php echo $row->tax_identifier  ?></td>
                           
                                <td><a class="btn btn-warning float-right editBtn text-white" data-id="<?php echo $row->id_supplier ?>" data-name="<?php echo $row->name_supplier?>" data-phone="<?php echo $row->phone_supplier ?>" data-email="<?php echo $row->email_supplier ?>" data-obs="<?php echo $row->observations; ?>" data-tax="<?php echo $row->tax_identifier ?>"><i class="fas fa-edit"></i></a></td>
                                <td><a class="btn btn-danger float-right delete_Btn text-white" data-id_suppliers="<?php echo $row->id_supplier ?>"><i class="fas fa-trash-alt"></i></a></td>
               
                                </tr>
                            <?php } ?>
                        
               </tbody>
           </table>
           </form>
           <!-- <div id="pagination" class="text-center">
           <button id="previous" class="btn-outline-primary">Anterior</button>
            <span id="page">Pagina 1</span>
            <button id="next" class="btn-outline-primary">Siguiente</button>
          </div> -->
          <div id="pagination" class="text-center d-flex justify-content-center align-items-center">
             <button id="previous" class="btn btn-outline-primary mr-2">Anterior</button>
             <span id="page">Pagina 1</span>
             <button id="next" class="btn btn-outline-primary ml-2">Siguiente</button>
           </div>

        </div>
    </div>
    </main>
            <!-- Main content -->

          
<!-- Modal para Crear Alumnos-->
<div id="create_Modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md modal-dialog-scrollable"> <!-- Cambia modal-md para un tamaño mediano y permite el scroll -->
        <div class="modal-content">
            <div class="modal-header bg-primary">
               
                <h5 class="modal-title text-white">Dar de Alta Un Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controller/insert_suppliers.php" method="post">
                    <div class="form-group">
                        <label for="name">Nombre Proveedor</label>
                        <input type="text" name="name_Proveedor" class="form-control form-control-sm" required> <!-- Cambia a form-control-sm para un input más pequeño -->
                    </div>
                    <div class="form-group">
                        <label for="direction">Dirección</label>
                        <input type="text" name="direccion" class="form-control form-control-sm" required> <!-- Cambia a form-control-sm para un input más pequeño -->
                    </div>
                    <div class="form-group">
                        <label for="height">Altura</label>
                        <input type="text" name="altura" class="form-control form-control-sm" required> <!-- Cambia a form-control-sm para un input más pequeño -->
                    </div>
                    <div class="form-group">
                        <label for="piso">Piso</label>
                        <input type="text" name="piso" class="form-control form-control-sm" required> <!-- Cambia a form-control-sm para un input más pequeño -->
                    </div>
                    <div class="form-group">
                        <label for="numero_de_piso">Numero de piso</label>
                        <input type="text" name="numero_de_piso" class="form-control form-control-sm" required> <!-- Cambia a form-control-sm para un input más pequeño -->
                    </div>
                    <div class="form-group">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" name="ciudad" class="form-control form-control-sm" required> <!-- Cambia a form-control-sm para un input más pequeño -->
                    </div>
                    <div class="form-group">
                        <label for="cuil">Cuil</label>
                        <input type="text" name="cuil" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email_Proveedor" class="form-control form-control-sm" required> <!-- Cambia a form-control-sm para un input más pequeño -->
                    </div>
                   
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" class="form-control form-control-sm" required pattern="^\d{10}$" title="Debe contener exactamente 10 dígitos"> <!-- Cambia a form-control-sm para un input más pequeño -->
                    </div>
                    <div class="form-group">
                         <label for="observaciones">Observaciones</label>
                         <input type="text" name="observaciones" class="form-control form-control-sm" required> <!-- Cambia a form-control-sm para un input más pequeño -->
                    </div>
                    
                    <div class="text-center">
                        <a href="../views/crud_suppliers.php" class="btn btn-outline-secondary mr-2">Cerrar</a>
                        <button type="submit" class="btn btn-outline-primary" name="agregar">Guardar Datos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Fin Modal para Crear Alumnos -->
<!--Modal de Editar Alumnos-->
<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Editar Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="../controller/edit_supplier.php" method="post">
                     <input type="hidden" name="id_supplier" id="id_supplier" class="form-control" value="">
                        <div class="form-group">
                            <label for="edit_name">editar Nombre</label>
                            <input type="text" class="form-control" id="name_supplier" name="name" required value="">
                        </div>
                        <div class="form-group">
                            <label for="edit_phone">editar Telefono</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="">
                        </div>
                        <div class="form-group">
                            <label for="edit_directiòn">editar Email</label>
                            <input type="text" class="form-control" id="email" name="email" required value="">
                        </div>
                        <div class="form-group">
                            <label for="edit_heigth">editar Observaciones</label>
                            <input type="text" class="form-control" id="obs" name="observaciones" required value="">
                        </div>
                        <div class="form-group">
                            <label for="edit_heigth">editar Cuil</label>
                            <input type="text" class="form-control" id="tax" name="cuil" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-outline-primary" name="save_data">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- Fin Modal para Editar Alumnos-->


<!-- Eliminar Alumno -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Eliminar al Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white";>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="advertencia">
                    <h2>Advertencia</h2>
                    <p>¿Seguro que desea eliminar este elemento?</p>
                    <form action="../controller/delete_supplier.php" method="post">
                        <input type="hidden" name="id_supplier" id="id_supplier_eliminate" value="<?php echo $row->id_supplier ?>">
                        <div class="btn-group" role="group" aria-label="Botones de acción">
                            <button type="submit" class="btn btn-outline-danger mr-2" name="delete">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- FOOTER -->
        
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
    <script src="../js.modal/modal_suppliers.js"></script>

    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <script src="../js.modal/paginated.js"></script>
    
    


</body>

</html>