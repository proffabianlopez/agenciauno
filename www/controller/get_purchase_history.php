<?php
include '../models/functions.php'; 

if (isset($_POST['id_purchase'])) {
    $id_purchase = $_POST['id_purchase'];

    $product_details = get_product_details($id_purchase);

    if ($product_details) {
        foreach ($product_details as $product) {
            echo "<p>Producto: " . $product['name_product'] . " - Cantidad: " . $product['qty'] . "</p>";
        }
    } else {
        // Si no hay productos asociados a esa compra
        echo "No se encontraron productos para esta compra.";
    }
} else {
    // Si no se recibe el ID de la compra
    echo "ID de compra no recibido.";
}
