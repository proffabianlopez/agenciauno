<?php
include_once "../models/functions.php";

$genre = "hola";

if (Agregarol($genre)) {
    echo "Se subió correctamente.";
    
} else {
    echo "No se subió.";
}
?>

