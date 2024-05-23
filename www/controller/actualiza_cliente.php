<?php
include_once "../models/functions.php";

$id = $_POST['edit-id_customer'];
$name = $_POST['edit-name'];
$email = $_POST['edit-email'];
$cuil = $_POST['edit-cuit'];
$phone = $_POST['edit-phone'];
$street = $_POST['edit-street'];
$height = $_POST['edit-height'];
$floor = $_POST['edit-floor'];
$departament = $_POST['edit-department'];
$location = $_POST['edit-location'];
$observaciones = $_POST['edit-observaciones'];
$status=1;

if (!Updatecliente($id, $name, $email, $cuil, $phone, $street, $height, $floor, $departament, $status, $location, $observaciones)) {
    echo '<script>alert("Actualizado exitosamente");</script>';
        echo '<script>window.location.href = "../views/lista_cliente.php";</script>';
       
    } else {
        echo 'Error al actualizar.';
    }

?>
