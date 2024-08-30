<?php
session_start();
include 'session_config.php';
include_once "../models/functions.php";
if(isset($_POST['enviar'])){
    $email_user = $_POST['email_user'];
    $email_user=strtoupper($email_user);
    $password = $_POST['password'];
    $compare= login($email_user,$password);
    if ($compare!= false) {       
        $email= $compare['email_user'];
        $id_rol= $compare['id_rol'];
        $id_status= $compare['id_status'];
        $_SESSION['email'] = $email;
        $_SESSION['id_rol'] = $id_rol;
        if ($id_status == 1) {
            $_SESSION['id_status'] = $id_status;
            if ($id_rol == 1 || $id_rol == 2) {
                echo '<script>
                  window.location.href = "../views/home.php";
                    </script>';  
            }       
    }
    } 
    echo '<script>
                localStorage.setItem("mensaje", "Existe algún error, Intente nuevamente!");
                localStorage.setItem("tipo", "error");
                window.location.href = "../views/login.php";
                    </script>';     
}

?>

