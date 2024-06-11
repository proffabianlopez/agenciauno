<?php
include_once "../models/functions.php";

if(isset($_GET['id_brand'])){
    $id_brand = $_GET['id_brand'];
    $get_brand = getbrands($id_brand);
} else {
    // Manejar el caso en el que no se proporciona un ID de proveedor válido
    $get_brand = null;
}
// Procesamiento del formulario de edición cuando se envía
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['save_data'])){
        
        $id_brand = $_POST["id_brand"];
        $detail = isset($_POST["detail"]) ? $_POST["detail"] : null;
      
        // Actualizar los datos del proveedor en la base de datos
        $updated = update_brands($id_brand,$detail);
    
        if ($updated) {
            // Redirigir a la página de gestión de proveedores con un mensaje de éxito en la URL
            header("Location:../views/crud_brands.php?editado=correcto");
            exit();
        } else {
            // Mostrar un mensaje de error si falla la actualización
            echo "Error al actualizar los datos.";
        }
    }
}
?>