<?php 
include_once "../models/functions.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['delete'])) {
        
        
        $id_brand = $_POST['id_brand'];
       
        // Llamada a la función para eliminar la marca
        $eliminated = eliminated_brand("brands", $id_brand);
        
        
        if ($eliminated) {
            
            echo '<script>
                localStorage.setItem("mensaje", "Marca deshabilitada con éxito");
                localStorage.setItem("tipo", "success");
                window.location.href = "../views/crud_brands_new.php";
                    </script>';     
            
        } else {
           //
            echo '<script>alert("Eroor esta Marca Pertenece a un Producto");</script>';
    echo '<script>window.location.href = "../views/crud_brands_new.php";</script>'; // Salir del script después de la redirección
        }
    }
} 
?>