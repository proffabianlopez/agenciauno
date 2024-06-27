<?php
include_once "../models/functions.php";

$show=show_state("brands");

 
if(isset($_POST['enviar'])){

   
    $detail = $_POST['detail'];
    $detail_uppercase = strtoupper($detail);
    
        
        $insert = insert_brand($detail_uppercase);
       
        if ($insert) {
            echo '<script>alert("Se creo exitosamente");</script>';
            echo '<script>window.location.href = "../views/crud_brands_new.php";</script>';
        }else
        {
            echo "error en la insersion";
        }
}

?>