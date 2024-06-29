<?php
include_once "../models/functions.php";

$show = show_state("brands");

if (isset($_POST['enviar'])) {
    $detail = $_POST['detail'];
    $detail_uppercase = strtoupper($detail);
    
    // Verificar si la marca ya existe
    if (brand_exists($detail_uppercase)) {
        echo '<script>alert("La marca ya existe. Por favor, elija un nombre diferente.");</script>';
        echo '<script>window.location.href = "../views/crud_brands_new.php";</script>';
    } else {
        // Insertar la nueva marca
        $insert = insert_brand($detail_uppercase);
       
        if ($insert) {
            echo '<script>alert("Se creó exitosamente");</script>';
            echo '<script>window.location.href = "../views/crud_brands_new.php";</script>';
        } else {
            echo '<script>alert("Error en la inserción");</script>';
        }
    }
}
