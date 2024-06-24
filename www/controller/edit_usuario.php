<?php

include_once "../models/functions.php";


if (isset($_POST['edit-id_user'], $_POST['edit-phone'], $_POST['edit-name'])) {
    // Recuperar datos del formulario
    $id = $_POST['edit-id_user'];
    $phone = $_POST['edit-phone'];
    $email = $_POST['edit-name'];
    $status = 1; 

    
    if (Updateusuario($id, $email, $phone, $status)) {
        echo '<script>alert("Usuario actualizado exitosamente");</script>';
        echo '<script>window.location.href = "../views/crud_usuarios.php";</script>';
    } else {
        echo '<script>alert("Error al actualizar usuario");</script>';
        echo '<script>window.location.href = "../views/crud_usuarios.php";</script>';
    }
} else {
    echo '<script>alert("Error: Parámetros no proporcionados correctamente");</script>';
    echo '<script>window.location.href = "../views/crud_usuarios.php";</script>';
}
?>
