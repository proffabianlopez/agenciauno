<?php 
include_once "../models/functions.php";

// Verificar si se ha enviado una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha enviado el formulario de eliminación
    if (isset($_POST['delete'])) {
        // Obtener el ID del proveedor a eliminar del formulario
        $id_supplier = $_POST['id_supplier']; // Corregido el nombre de la variable
        
        // Llamada a la función para eliminar el proveedor
        $eliminated = eliminated_Suppliers("suppliers", $id_supplier);
        
        // Verificar si la eliminación fue exitosa
        if ($eliminated) {
            // Redireccionar de vuelta a la página de CRUD con un mensaje de éxito
            header("Location: ../views/crud_suppliers_new.php?borrado=correcto");
            exit(); // Salir del script después de la redirección
        } else {
            // Mostrar un mensaje de error específico si la eliminación falla
            echo "Error al intentar eliminar el proveedor.";
        }
    }
} 
?>
