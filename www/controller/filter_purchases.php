<?php
include_once "../models/functions.php";

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);

        $dateFrom = $data['date_from'] ?? null;
        $dateTo = $data['date_to'] ?? null;
        $remitoNumber = $data['remito_number'] ?? null;
        $invoiceNumber = $data['invoice_number'] ?? null;
        $supplierName = $data['supplier_name'] ?? null;

        $filtered_purchases = get_filtered_purchases($dateFrom, $dateTo, $remitoNumber, $invoiceNumber, $supplierName);
        
        if ($filtered_purchases !== null) {
            echo json_encode(['purchases' => $filtered_purchases]);
        } else {
            echo json_encode(['error' => 'No se encontraron compras']);
        }
    } else {
        echo json_encode(['error' => 'Método no permitido']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => 'Error al procesar la solicitud', 'details' => $e->getMessage()]);
}