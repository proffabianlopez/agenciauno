<?php 
include_once "../models/functions.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['delete'])) {
        
        
        $id_brand = $_POST['id_brand'];
       
        // Llamada a la función para eliminar la marca
        $eliminated = eliminated_brand("brands", $id_brand);
        
        
        if ($eliminated) {
            
            header("Location: ../views/crud_brands.php?borrado=correcto");
            exit();
        } else {
           
            header("Location: ../views/crud_brands.php?borrado=error_marca_contiene_producto");
            exit(); // Salir del script después de la redirección
        }
    }
} 
?>