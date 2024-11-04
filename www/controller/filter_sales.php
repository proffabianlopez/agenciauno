<?php
include_once "../models/functions.php";

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);

        // Validación de entrada (temporal para debugging)
        if (!$data) {
            echo json_encode(['error' => 'No se recibieron datos de filtro']);
            exit;
        }

        $dateFrom = !empty($data['date_from']) ? $data['date_from'] : null;
        $dateTo = !empty($data['date_to']) ? $data['date_to'] : null;

        if (($dateFrom && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateFrom)) || 
        ($dateTo && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateTo))) {
        echo json_encode(['error' => 'Formato de fecha incorrecto']);
        exit;
    }
    
        $saleNumberFrom = !empty($data['sale_number_from']) ? $data['sale_number_from'] : null;
        $saleNumberTo = !empty($data['sale_number_to']) ? $data['sale_number_to'] : null;
        $customerName = !empty($data['customer_name']) ? $data['customer_name'] : null;
        
        // Prueba de ejecución de la función con filtros
        $filtered_sales = get_filtered_sales($dateFrom, $dateTo, $saleNumberFrom, $saleNumberTo, $customerName);      
        if ($filtered_sales !== null) {
            echo json_encode(['sales' => $filtered_sales]);
        } else {
            echo json_encode(['error' => 'No se encontraron ventas']);
        }
    } else {
        echo json_encode(['error' => 'Método no permitido']);
    }
} catch (Exception $e) {
    // Captura el error y muestra detalles para debugging
    echo json_encode(['error' => 'Error al procesar la solicitud', 'details' => $e->getMessage()]);
}