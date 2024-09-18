<?php
include_once "../models/functions.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_customer = isset($_POST["id_customer"]) ? trim($_POST["id_customer"]) : null;
    $sales_number = isset($_POST["sales_number"]) ? trim($_POST["sales_number"]) : null;
    $date_sales = isset($_POST["date_sales"]) ? trim($_POST["date_sales"]) : null;
    $items = isset($_POST["items"]) && is_array($_POST["items"]) ? $_POST["items"] : [];

    if (empty($id_customer) || empty($sales_number) || empty($date_sales) || empty($items)) {
        echo '<script>
            localStorage.setItem("mensaje", "Todos los campos son obligatorios.");
            localStorage.setItem("tipo", "error");
            window.location.href = "../views/sales.php";
            </script>';
        exit(); 
    }
    $insertSuccess = true;
    foreach ($items as $item) {
        $id_product = isset($item["id_product"]) ? trim($item["id_product"]) : null;
        $quantity = isset($item["quantity"]) ? (int)$item["quantity"] : 0;
        if (empty($id_product) || $quantity <= 0) {
            $insertSuccess = false;
            echo "Error: ID del producto o cantidad inválidos.<br>";
            var_dump($id_product, $quantity);
            break;
        }
        $date = insert_date_sales($date_sales);
        $insert = insert_sales($id_customer, $sales_number, $id_product, $quantity);
    
        if (!$insert) {
            echo "Error al insertar la venta para el producto ID: $id_product.<br>";
            $insertSuccess = false;
            break;
        }
    
        if ($insert && $date) {
          
            $updateStock = update_product_stock($id_product, $quantity);
            if (!$updateStock) {
                echo "Error al actualizar el stock del producto ID: $id_product.<br>";
                $insertSuccess = false;
                break;
            }
        } else {
            echo "Error al insertar la fecha o la venta para el producto ID: $id_product.<br>";
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
            localStorage.setItem("mensaje", "Error al ingresar la venta. Verifique los datos ingresados.");
            localStorage.setItem("tipo", "error");
            window.location.href = "../views/sales.php";
            </script>';
    }
}    
?>
