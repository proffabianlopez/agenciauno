<?php
include_once "../models/functions.php"; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email_user = $_POST['name_user'];
    $phone = $_POST['phone'];
    $password = ($_POST['password']); 
    $id_status=1;
    $id_rol=1;
    if (addUsuario($email_user, $phone, $password,$id_status,$id_rol)) {
        header("Location: ../views/crud_usuarios.php"); 
    } else {
        header("Location: ../views/usuarios.php?error=1"); 
    }
}
?>
