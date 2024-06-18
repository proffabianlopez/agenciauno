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
         <h4> Productos
          <a href="#" class="btn btn-primary btn-lg create_products_Btn text-white float-right"><i class="fas fa-plus-circle fa-lg"></i></a>
           </h4>
     </div>

   
    <div class="row py-1">
        <div class="col">
        
           
           <table class="table table-border small" id="myTable">
               <thead>
              
                    
                <tr class="bg-primary">
                    <th class="text-center long_letter">Nombre Producto</th>
                    <th class="text-center long_letter">Descripcion</th>
                    <th class="text-center long_letter">Stock</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Eliminar</th>
                </tr>
                    

               </thead>
               <tbody>
               
               
                            <?php foreach ($show as $row) { ?>
                                <tr>
                                <td class="text-center long_letter align-middle"><?php echo $row->name_product ?></td>
                                <td class="text-center long_letter align-middle"><?php echo $row->description ?></td>
                                <td class=" align-middle"><?php echo $row->stock ?></td>
                                <td><a class="btn btn-warning float-right editBtn text-white" data-id_product="<?php echo $row->id_product ?>" data-name_product="<?php echo $row->name_product?>" data-description="<?php echo $row->description ?>" data-stock="<?php echo $row->stock ?>"><i class="fas fa-edit"></i></a></td>
                                <td><a class="btn btn-danger float-right delete_Btn text-white" data-id_products="<?php echo $row->id_product ?>"><i class="fas fa-trash-alt"></i></a></td>
               
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
               
                <h5 class="modal-title text-white">Dar de Alta Un Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controller/insert_products.php" method="post">
                    <div class="form-group">
                        <label for="name_product">Nombre Producto</label>
                       <!-- <input type="text" name="name_product" class="form-control form-control-sm" required>  Cambia a form-control-sm para un input más pequeño -->
                       <input type="text" name="name_product" class="form-control form-control-sm" required>

                    </div>
                    <div class="form-group">
                        <label for="description">Descripcion</label>
                        <input type="text" name="description" class="form-control form-control-sm" required> <!-- Cambia a form-control-sm para un input más pequeño -->
                    </div>
                    <div class="form-group">
                        <label for="stock">stock</label>
                        <input type="text" name="stock" class="form-control form-control-sm" required> <!-- Cambia a form-control-sm para un input más pequeño -->
                    </div>
                    
                    <div class="form-group">
                    <label for="brand">marca</label>
                     <select name="id_brand" id="brand">
                            <?php foreach ($brandData as $brand) { ?>
                                <option value="<?php echo $brand->id_brand; ?>"><?php echo $brand->detail; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="category">categoria</label>
                     <select name="id_category" id="category">
                            <?php foreach ($categoryData as $category) { ?>
                                <option value="<?php echo $category->id_category; ?>"><?php echo $category->detail; ?></option>
                            <?php } ?>
                        </select>
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
                    <h5 class="modal-title text-white">Editar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="../controller/edit_product.php" method="post">
                    <input type="hidden" name="id_product" id="id_product" class="form-control" value="">
                        <div class="form-group">
                            <label for="edit_name">editar Nombre</label>
                            <input type="text" class="form-control" id="name_product" name="name_product" required value="">
                        </div>
                        <div class="form-group">
                            <label for="edit_description">editar Descripcion</label>
                            <input type="text" class="form-control" id="description" name="description" value="">
                        </div>
                        <div class="form-group">
                            <label for="edit_stock">editar Stock</label>
                            <input type="text" class="form-control" id="stock" name="stock" required value="">
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
                <h5 class="modal-title text-white">Eliminar al Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white";>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="advertencia">
                    <h2>Advertencia</h2>
                    <p>¿Seguro que desea eliminar este producto?</p>
                    <form action="../controller/delete_product.php" method="post">
                        <input type="hidden" name="id_product" id="id_product_eliminate" value="<?php echo $row->id_product?>">
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
     <script src="../js.modal/modal_products.js"></script> 
    <script src="../js.modal/paginated.js"></script>
    
    


</body>

</html>