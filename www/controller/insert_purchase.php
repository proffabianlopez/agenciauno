<?php
include_once "../models/functions.php";
if (isset($_POST)) {
    $id_supplier = $_POST["supplier_id"];
    $number_remito = $_POST["number_remito"] . "-" . $_POST["remito"];
    $date_remito = $_POST["date_remito"];
    $number_invoice = $_POST["purchase_factura"] . "-" . $_POST["factura"];
    $date_invoice = $_POST["date_factura"];

    $items = $_POST["items"];
    $insertSuccess = true;

    foreach ($items as $item) {
        $id_product = $item["id_product"];
        $quantity = !empty($item["quantity"]) ? $item["quantity"] : 0;

        $insert = insert_sender($id_supplier, $number_remito, $date_remito, $number_invoice, $date_invoice, $id_product, $quantity);

        if (!$insert) {
            $insertSuccess = false;
            break;
        }
    }

    if ($insertSuccess) {
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
