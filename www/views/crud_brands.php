<?php
include_once "../controller/insert_brands.php";
include_once "../controller/edit_brand.php";
include_once "../controller/delete_brand.php";
include_once "../models/functions.php";
$show=show_state("brands");

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
         <h4> Marcas
          <a href="#" class="btn btn-primary btn-lg create_brands_Btn text-white float-right"><i class="fas fa-plus-circle fa-lg"></i></a>
           </h4>
     </div>

   
    <div class="row py-1">
        <div class="col">
        
           
           <table class="table table-border small" id="myTable">
               <thead>
              
                    
                <tr class="bg-primary">
                    <th class="text-center long_letter">Nombre Marca</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Eliminar</th>
                </tr>
                    

               </thead>
               <tbody>
               
               
                            <?php foreach ($show as $row) { ?>
                                <tr>
                                <td class="text-center long_letter align-middle"><?php echo $row->detail ?></td>
                                <td><a class="btn btn-warning float-right editBtn text-white" data-id_brand="<?php echo $row->id_brand ?>" data-detail="<?php echo $row->detail?>"><i class="fas fa-edit"></i></a></td>
                                <td><a class="btn btn-danger float-right delete_Btn text-white" data-id_brands="<?php echo $row->id_brand ?>"><i class="fas fa-trash-alt"></i></a></td>
               
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
               
                <h5 class="modal-title text-white">Dar de Alta Una Marca</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controller/insert_brands.php" method="post">
                    <div class="form-group">
                        <label for="name_product">Nombre De Marca</label>
                       <input type="text" name="detail" class="form-control form-control-sm" pattern="[A-Za-z]+" minlength="2" maxlength="30" required>

                    </div>
                    <div class="text-center">
                        <a href="../views/crud_products.php" class="btn btn-outline-secondary mr-2">Cerrar</a>
                        <button type="submit" class="btn btn-outline-primary" name="enviar">Guardar Datos</button>
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
                    <h5 class="modal-title text-white">Editar Marca</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="../controller/edit_brand.php" method="post">
                    <input type="hidden" name="id_brand" id="id_brand" class="form-control" value="">
                        <div class="form-group">
                            <label for="edit_name">editar Marca</label>
                            <input type="text" class="form-control" id="detail" name="detail" required value="">
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
                <h5 class="modal-title text-white">Eliminar Marca</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white";>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="advertencia">
                    <h2>Advertencia</h2>
                    <p>¿Seguro que desea eliminar esta Marca?</p>
                    <form action="../controller/delete_brand.php" method="post">
                        <input type="hidden" name="id_brand" id="id_brand_eliminate" value="<?php echo $row->id_product?>">
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
    
    <script src="../js/page_table.js"></script>
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    
   
    <script src="../dist/js/adminlte.min.js"></script>
     <script src="../js.modal/modal_brands.js"></script> 
    <script src="../js.modal/paginated.js"></script>
    
    


</body>

</html>