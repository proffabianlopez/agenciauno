<?php
include_once "../models/functions.php";

if(isset($_POST['delete-id_user'])) {
    $id = $_POST['delete-id_user'];
  
    $resultado = deleteusuarios($id);

    if (!$resultado) {
        
        echo '<script>alert("Usuario eliminado exitosamente");</script>';
        echo '<script>window.location.href = "../views/crud_usuarios.php";</script>';
    } else {
        
        echo '<script>alert("Error al intentar eliminar el usuario");</script>';
        echo '<script>window.location.href = "../views/crud_usuarios.php";</script>';
    }
} else {
    echo '<script>alert("Error: ID de usuario no proporcionado");</script>';
    echo '<script>window.location.href = "../views/crud_usuarios.php";</script>';
}
?>
