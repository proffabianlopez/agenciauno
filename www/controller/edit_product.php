<?php
include_once "../models/functions.php";

if(isset($_GET['id_product'])){
    $id_product = $_GET['id_product'];
    $get_product = getproducts($id_product);
} else {
    // Manejar el caso en el que no se proporciona un ID de proveedor válido
    $get_product = null;
}
// Procesamiento del formulario de edición cuando se envía
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['save_data'])){
        
        $id_product = $_POST["id_product"];
        $name_product = isset($_POST["name_product"]) ? $_POST["name_product"] : null;
        $description = isset($_POST["description"]) ? $_POST["description"] : null;
        $stock = isset($_POST["stock"]) ? $_POST["stock"] : null;
        
        // Actualizar los datos del proveedor en la base de datos
        $updated = update_products($id_product,$name_product,$description,$stock);
    
        if ($updated) {
            // Redirigir a la página de gestión de proveedores con un mensaje de éxito en la URL
            header("Location:../views/crud_products.php?editado=correcto");
            exit();
        } else {
            // Mostrar un mensaje de error si falla la actualización
            echo "Error al actualizar los datos.";
        }
    }
}
?>