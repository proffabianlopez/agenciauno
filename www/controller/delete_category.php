<?php
include_once "../models/functions.php";
if(isset($_POST['edit-id_category'])) {
    $id = $_POST['edit-id_category'];
  
    deletecategory($id);
    echo '<script>alert("Borrado exitosamente");</script>';
    echo '<script>window.location.href = "../views/crud_category.php";</script>';
   
    
}
