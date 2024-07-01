<?php
include_once "../models/functions.php";


if(isset($_POST['edit-id_category'])) {
    $id = $_POST['edit-id_category'];
  
    
   
       
       
        $eliminated = deletecategorys("categorys", $id);
        
        
        if ($eliminated) {
            
            echo '<script>
            localStorage.setItem("mensaje", "Categoría deshabilitada con éxito");
            localStorage.setItem("tipo", "success");
            window.location.href = "../views/crud_category.php";
                </script>';    
            
        } else {
           //
            echo '<script>alert("Eroor esta Marca Pertenece a un Producto");</script>';
    echo '<script>window.location.href = "../views/crud_category.php";</script>'; // Salir del script después de la redirección
        }
    }

?>