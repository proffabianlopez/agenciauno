<?php
session_start();
include_once "../models/functions.php"; // Asegúrate de que este archivo contiene las funciones necesarias

header('Content-Type: application/json');

// Verificar el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['serial_number']) && !empty($_POST['serial_number'])) {
        $serial_number = $_POST['serial_number'];

        // Obtener datos del producto y de la garantía
        $product = get_warranty_by_serial_number($serial_number);
        $warranty = get_warranty_by_serial_numbers($serial_number);

        // Preparar la respuesta con la información combinada
        $response = [
            'product' => $product ?: null, // Si no hay producto, enviar null
            'warranty' => $warranty ?: null, // Si no hay garantía, enviar null
        ];

        // Combinar los datos de producto y garantía en un solo objeto
        // Usamos condicionales que verifican si los datos existen y asignan valores predeterminados cuando no existen.
        $response['name_product'] = $product['name_product'] ?? null;
        $response['serial_number'] = $product['serial_number'] ?? null;
        $response['description'] = $product['description'] ?? null;
        $response['remito_number'] = $product['remito_number'] ?? null;
        $response['created_at'] = $product['created_at'] ?? null;
        $response['name_supplier'] = $product['name_supplier'] ?? null;
        $response['dispatch_date'] = $product['dispatch_date'] ?? null;
        $response['customer_name'] = $product['customer_name'] ?? null;
        $response['sales_number'] = $product['sales_number'] ?? null;
        $response['warranty_period'] = $product['warranty_period'] ?? null;

        // Información de la garantía
        $response['id'] = $warranty['guarantee_id'] ?? null;
        $response['status'] = $warranty['status'] ?? null;
        $response['technician_comments'] = $warranty['technician_comments'] ?? null;
        $response['review_date'] = $warranty['review_date'] ?? null;

        // Enviar la respuesta como JSON
        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'No se ha proporcionado un número de serie.']);
    }
} else {
    echo json_encode(['error' => 'Método no permitido.']);
}
?>
