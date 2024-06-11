<?php
include_once "../models/functions.php";

$show=show_state("brands");

 
if(isset($_POST['enviar'])){

   
    $detail = $_POST['detail'];
    $detail_uppercase = strtoupper($detail);
    
        
        $insert = insert_brand($detail_uppercase);
       
        if ($insert) {
            header("Location: ../views/crud_brands.php?ingreso=check");
        }else
        {
            echo "error en la insersion";
        }
}

?>