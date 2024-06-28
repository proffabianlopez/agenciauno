<?php
include_once "../models/functions.php";
$identifier=$_POST["identifier"];
$name_cliente=$_POST["name_cliente"];
$email_cliente=$_POST["email_cliente"];
$telefono=$_POST["telefono"];
$direccion=$_POST["direccion"];
$Altura=$_POST["altura"];
$ciudad=$_POST["ciudad"];
$piso=$_POST["piso"];

$observaciones=$_POST["observaciones"];
$status=1;
$department=$_POST["department"];


if(add_cliente($identifier, $name_cliente, $email_cliente, $telefono, $direccion, $Altura, $ciudad, $observaciones, $status,$piso,$department))
{
    echo '<script>alert("Se creó exitosamente");</script>';
    echo '<script>window.location.href = "../views/crud_cliente.php";</script>';
}