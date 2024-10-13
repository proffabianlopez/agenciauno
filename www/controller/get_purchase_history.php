<?php
include_once "../models/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $remito_number = $data['remito_number'] ?? null;

    if ($remito_number) {
        // Si el número de remito se ha obtenido, llamamos a la función para obtener los detalles
        $product_details = get_product_details_by_remito($remito_number);

        if ($product_details) {
            header('Content-Type: application/json');
            echo json_encode([
                'remito_number' => $remito_number,
                'remito_date' => $product_details[0]['remito_date'],
                'products' => $product_details
            ]);
        } 
    } 
}