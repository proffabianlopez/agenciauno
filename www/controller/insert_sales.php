<?php
include_once "../models/functions.php";
if (isset($_POST)) {
    $id_customer = $_POST["id_customer"];
    $sales_number = $_POST["sales_number"];
    $date_sales = $_POST["date_sales"];
   
    $items = $_POST["items"];
    $insertSuccess = true;
  
   foreach ($items as $item) {
        $id_product = $item["id_product"];
        $quantity = !empty($item["quantity"]) ? $item["quantity"] : 0;
        $date = insert_date_sales($date_sales);
        $insert = insert_sales($id_customer, $sales_number, $id_product, $quantity);

        if (!$insert && !$date) {
            $insertSuccess = false;
            break;
        }
    }
    if ($insertSuccess) {

        echo '<script>
            localStorage.setItem("mensaje", "Venta ingresada con éxito");
            localStorage.setItem("tipo", "success");
            window.location.href = "../views/sales.php";
            </script>';
    } else {
        echo '<script>
            localStorage.setItem("mensaje", "Error al ingresar la venta");
            localStorage.setItem("tipo", "error");
            window.location.href = "../views/sales.php";
            </script>';
    }
}