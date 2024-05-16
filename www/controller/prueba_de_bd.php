<?php
include_once "../models/functions.php";

$genre = "hola";

$conec_sql = new conec_sql(); // Crear una instancia de la clase conec_sql
if ($conec_sql->Agregarol($genre)) {
    echo "Se subió correctamente.";
} else {
    echo "No se subió.";
}
