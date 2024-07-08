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
            
    echo '<script>
    localStorage.setItem("mensaje", "Cliente editado con éxito");
    localStorage.setItem("tipo", "success");
    window.location.href = "../views/crud_cliente.php";
        </script>';            
    } else {
        echo '<script>
        localStorage.setItem("mensaje", "Error al editar el cliente");
        localStorage.setItem("tipo", "success");
        window.location.href = "../views/crud_cliente.php";
            </script>';   
    }
    
?>
