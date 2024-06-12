<?php
include_once "../models/functions.php";

$show=show_state("products");

 
if(isset($_POST['enviar'])){

   
    $name_product = $_POST['name_product']; 
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    $id_brand = $_POST['id_brand'];
    $id_category = $_POST['id_category'];
    
    
       
        $insert = insert_products($name_product,$description,$stock,$id_brand,$id_category);
       
        if ($insert) {
            header("Location: ../views/crud_products.php?ingreso=check");
        }else
        {
            echo "error en la insersion";
        }
}

?>