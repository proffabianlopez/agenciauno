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
            echo '<script>alert("Se borro exitosamente");</script>';
            echo '<script>window.location.href = "../views/crud_suppliers_new.php";</script>';
            exit(); // Salir del script después de la redirección
        } else {
            // Mostrar un mensaje de error específico si la eliminación falla
            echo "Error al intentar eliminar el proveedor.";
        }
    }
} 
?>
