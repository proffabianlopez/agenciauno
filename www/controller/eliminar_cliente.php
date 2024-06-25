<?php
include_once "../models/functions.php";

if (isset($_POST['edit-id_customer'])) {
    $id = $_POST['edit-id_customer'];
    
    deletecliente($id);
    echo '<script>alert("Borrado exitosamente");</script>';
    echo '<script>window.location.href = "../views/crud_cliente.php";</script>';
} else {
    echo '<script>alert("No se recibió el ID del cliente.");</script>';
    echo '<script>window.location.href = "../views/crud_cliente.php";</script>';
}
?>
