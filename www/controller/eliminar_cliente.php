<?php
include_once "../models/functions.php";

if (isset($_POST['edit-id_customer'])) {
    $id = $_POST['edit-id_customer'];
    
    deletecliente($id);    
    
    echo '<script>window.location.href = "../views/crud_cliente.php?mensaje=Usuario%20deshabilitado%20con%20éxito&tipo=success";</script>';
} else {
    echo '<script>alert("No se recibió el ID del cliente.");</script>';
    echo '<script>window.location.href = "../views/crud_cliente.php";</script>';
}
?>
