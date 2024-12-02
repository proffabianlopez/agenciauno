<?php
session_start();
include_once "../models/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    // Obtener parámetros desde el cuerpo de la solicitud (JSON)
    $data = json_decode(file_get_contents('php://input'), true);

$date_from = $_POST['date_from'] ?? null;
$date_to = $_POST['date_to'] ?? null;
$guarantee_id = $_POST['guarantee_id'] ?? null;
$serial_number = $_POST['serial_number'] ?? null;
$technical_comments = $_POST['technical_comments'] ?? null;
$supplier_name = $_POST['supplier_name'] ?? null;
$status = $_POST['status'] ?? null;

$guarantees = get_warranty_history($date_from, $date_to, $guarantee_id, $serial_number, $technical_comments, $supplier_name, $status);
    // Devolver resultados en formato JSON
    if ($result) {
        echo json_encode(["success" => true, "data" => $result]);
    } else {
        echo json_encode(["success" => false, "message" => "No se encontraron resultados."]);
    }
    exit;
} else {
    // Método no permitido
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
    exit;
}