<?php
include_once "../models/functions.php";
if (isset($_POST)) {
    $id_supplier = $_POST["supplier_id"];
    $number_remito = $_POST["number_remito"] . "-" . $_POST["remito"];
    $date_remito = $_POST["date_remito"];
    $number_invoice = $_POST["purchase_factura"] . "-" . $_POST["factura"];
    $date_invoice = $_POST["date_factura"];
    $id_product = $_POST["items"][0]["id_product"]; 
    $quantity = !empty($_POST["items"][0]["quantity"]) ? $_POST["items"][0]["quantity"] : 0; 

    $insert = insert_sender($id_supplier, $number_remito, $date_remito, $number_invoice, $date_invoice, $id_product, $quantity);
    
    if (preg_match('/^0+(-0+)?$/', $number_remito)) {
        echo '<script>
            localStorage.setItem("mensaje", "Actualice el número de remitos, no pueden ser todos ceros.");
            localStorage.setItem("tipo", "error");
            window.location.href = "../views/purchase.php";
            </script>';
        exit;
    }
    if ($insert) {
        echo '<script>
            localStorage.setItem("mensaje", "Remito ingresado con éxito");
            localStorage.setItem("tipo", "success");
            window.location.href = "../views/purchase.php";
            </script>';      
    } else {
        echo '<script>
            localStorage.setItem("mensaje", "Error al ingresar el remito");
            localStorage.setItem("tipo", "error");
            window.location.href = "../views/purchase.php";
            </script>';   
    }
}
?>
