<?php
include_once "../models/functions.php";

if (isset($_POST['enviar'])) {    
    $number_product = $_POST['number_product'];
    $name_product = $_POST['name_product'];
    $description = $_POST['description'];
    $id_brand = $_POST['id_brand'];
    $id_category = $_POST['id_category'];    
    $warranty_period = $_POST['warranty_period'];

    $insert = insert_product($number_product, $name_product, $description, $id_brand, $id_category, $warranty_period);
    if ($insert) {
        echo '<script>
            localStorage.setItem("mensaje", "Producto creado con éxito");
            localStorage.setItem("tipo", "success");
            window.location.href = "../views/crud_products_new.php";
            </script>';
    } else {
        echo '<script>
            localStorage.setItem("mensaje", "Error al crear el producto");
            localStorage.setItem("tipo", "error");
            window.location.href = "../views/crud_products_new.php";
            </script>';
    }
}
?>