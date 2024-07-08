<?php

include_once "../models/functions.php";

$message = '';

if ($_POST) {
    $email = trim($_POST['email']);
    $email_password = trim($_POST['email_password']);
    $smtp_address = trim($_POST['smtp_address']);
    $smtp_port = trim($_POST['smtp_port']);

    $errors = [];

    if (empty($email)) {
        $errors[] = "El correo es obligatorio.";
    }

    if (empty($email_password)) {
        $errors[] = "La contraseña es obligatoria.";
    }

    if (empty($smtp_address)) {
        $errors[] = "La dirección SMTP es obligatoria.";
    }

    if (empty($smtp_port) || !is_numeric($smtp_port) || $smtp_port <= 0) {
        $errors[] = "El puerto SMTP es obligatorio y debe ser un número positivo.";
    }

    if (empty($errors)) {
        if (saveConfig($email, $email_password, $smtp_address, $smtp_port)) {
            $message = "Configuración de correo guardada correctamente.";
        } else {
            $message = "No se pudo guardar la configuración de correo.";
        }

        // Refrescar los datos después de la inserción/actualización
        $config = getConfig();
    } else {
        $message = implode('<br>', $errors);
    }
}

// Redirigir a la vista con los datos y el mensaje
include '../views/email_config.php';
?>


