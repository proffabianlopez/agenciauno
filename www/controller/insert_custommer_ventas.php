<?php
include_once "../models/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = $_POST['tax_identifier'];
    $name_cliente = $_POST['customer_name'];
    $email_cliente = strtoupper($_POST['email_customer']);
    $telefono = $_POST['phone_customer'];
    $direccion = $_POST['street'];
    $Altura = $_POST['height'];
    $ciudad = $_POST['location'];
    $piso = $_POST['floor'];
    $observaciones = $_POST['observaciones'];
    $status = 1;
    $department = $_POST['department'];

    if (clients_exists($email_cliente)) {
        header("Location: ../views/sales.php?error=El cliente ya existe");
    } else {
        $id_cliente = add_cliente($identifier, $name_cliente, $email_cliente, $telefono, $direccion, $Altura, $ciudad, $observaciones, $status, $piso, $department);

        if ($id_cliente) {
            header("Location: ../views/sales.php?success=Cliente agregado correctamente");
        } else {
            header("Location: ../views/sales.php?error=Error al agregar el cliente");
        }
    }
}
