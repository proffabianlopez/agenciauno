<?php
include_once "../models/functions.php";

$id = $_POST['edit-id'];
$detail = $_POST['edit-detail'];
$detail=strtoupper($detail);
$status = 1;
 if (!Updatecategory($id, $detail, $status)) {
   echo '<script>
   localStorage.setItem("mensaje", "Categoría editada con éxito");
   localStorage.setItem("tipo", "success");
   window.location.href = "../views/crud_category.php";
       </script>';    
} else {
     echo '<script>
   localStorage.setItem("mensaje", "Error al actualizar la categoria");
   localStorage.setItem("tipo", "error");
   window.location.href = "../views/crud_category.php";
       </script>';   
}
?>
