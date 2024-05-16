<?php
include_once "../models/functions.php";
$codigo_cliente=$_POST["codigo_cliente"];
$identifier=$_POST["identifier"];
$name_cliente=$_POST["name_cliente"];
$email_cliente=$_POST["email_cliente"];
$telefono=$_POST["telefono"];
$direccion=$_POST["direccion"];
$Altura=$_POST["altura"];
$ciudad=$_POST["ciudad"];
$piso=$_POST["piso"];
$numero_de_piso=$_POST["numero_de_piso"];
$observaciones=$_POST["observaciones"];
$status=$_POST["status"];
if($status === "on")
{
    $status=1;
}

if(add_cliente($identifier, $name_cliente, $email_cliente, $telefono, $direccion, $Altura, $ciudad, $observaciones, $status,$piso,$numero_de_piso))
{
    echo "se subio";
}
