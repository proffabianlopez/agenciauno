<?php
include_once "../models/functions.php";


$name_category = $_POST["name_category"];
$status = 1;

// Verificar si la categoría ya existe
if (category_exists($name_category)) {
    echo '<script>alert("La categoría ya existe. Por favor, elija un nombre diferente.");</script>';

    echo '<script>window.location.href = "../views/crud_category.php";</script>';
} else {
    // Insertar la nueva categoría
    if (add_category($name_category, $status)) {
        echo '<script>
                localStorage.setItem("mensaje", "Categoría creada con éxito");
                localStorage.setItem("tipo", "success");
                window.location.href = "../views/crud_category.php";
                    </script>';     
    } else {
        echo '<script>alert("Error en la inserción");</script>';
        echo '<script>window.location.href = "../views/crud_category.php";</script>';
    }
}
?>
