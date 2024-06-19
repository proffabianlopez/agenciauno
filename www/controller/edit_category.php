<?php
include_once "../models/functions.php";

$id = $_POST['edit-id'];
$detail = $_POST['edit-detail'];
$status = 1;
 if (!Updatecategory($id, $detail, $status)) {
    echo '<script>alert("Actualizado exitosamente");</script>';
   echo '<script>window.location.href = "../views/crud_category.php";</script>';
} else {
     echo 'Error al actualizar.';
}
?>
