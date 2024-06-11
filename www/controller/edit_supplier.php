<?php
include_once "../models/functions.php";

// Obtener el proveedor por su ID si está presente en la URL
if(isset($_GET['id'])){
    $id_supplier = $_GET['id'];
    $get_supplier = getSupplier($id_supplier);
} else {
    // Manejar el caso en el que no se proporciona un ID de proveedor válido
    $get_supplier = null;
}

// Procesamiento del formulario de edición cuando se envía
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['save_data'])){
        
        $id_supplier = $_POST["id_supplier"];
        
        $name = isset($_POST["name"]) ? $_POST["name"] : null;
        $phone = isset($_POST["phone"]) ? $_POST["phone"] : null;
        $email = isset($_POST["email"]) ? $_POST["email"] : null;
        $observation = isset($_POST["observaciones"]) ? $_POST["observaciones"] : null;
        $tax = isset($_POST["cuil"]) ? $_POST["cuil"] : null;
        
        // Actualizar los datos del proveedor en la base de datos
        $updated = updateSupplier($id_supplier, $name, $phone, $email, $observation, $tax);
    
        if ($updated) {
            // Redirigir a la página de gestión de proveedores con un mensaje de éxito en la URL
            header("Location:../views/crud_suppliers.php?editado=correcto");
            exit();
        } else {
            // Mostrar un mensaje de error si falla la actualización
            echo "Error al actualizar los datos.";
        }
    }
}

?>