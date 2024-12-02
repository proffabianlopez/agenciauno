<?php
session_start();
include_once "../models/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $serial_number = $_POST['serial_number'];
    $status = $_POST['status'];
    $technician_comments = $_POST['technician_comments'];
    $review_date = $_POST['review_date'];

    $result = save_warranty_management($serial_number, $status, $technician_comments, $review_date);

    if ($result) {
        echo json_encode(["success" => true, "message" => "Garantía creada con éxito"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al guardar la gestión de la garantía."]);
    }
    exit;
}
?>