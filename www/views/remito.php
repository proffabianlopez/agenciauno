<?php
require('../fpdf/fpdf.php');
include_once "../models/functions.php"; // Aquí incluimos la conexión PDO
$sales_number = '12';

if ($sales_number) {
    $remito_data = get_remito_data($sales_number);
} else {
    die("Número de venta no proporcionado");
}

// Crear clase PDF para remito
class PDF_Remito extends FPDF
{
    // Constructor para cambiar las unidades a milímetros
    function __construct()
    {
        parent::__construct('P', 'mm', 'A4'); // Usar mm como unidad y formato A4
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
    // Función para imprimir los datos del remito
    function ImprimirRemito($remito_data)
    {
        // Extraer datos del cliente y productos
        $customer_data = $remito_data['customer'];
        $dispatches_data = $remito_data['dispatches'];

        // Datos generales del remito
        $this->SetFont('Arial', '', 12);

        // Establecer color de fondo gris
        $this->SetFillColor(244, 244, 244); // Gris claro

        // Número de remito (con fondo gris)
        $this->SetXY(124, 10.5); // Ajustar coordenadas
        $this->Cell(50, 8, utf8_decode($dispatches_data[0]['sales_number']), 0, 1, '', true); // Fondo gris habilitado

        // Fecha de remito (3mm hacia arriba y con fondo gris)
        $this->SetXY(135, 20); // Ajustar coordenadas
        $this->Cell(60, 5, utf8_decode($dispatches_data[0]['dispatch_date']), 0, 1, '', true); // Fondo gris habilitado

        // Información del cliente
        $this->SetXY(26, 52); // Cliente - Nombre (2mm hacia la derecha)
        $this->MultiCell(100, 10, utf8_decode($customer_data['customer_name']), 0, 'L');
        $this->Ln(2); // Espacio adicional

        $this->SetXY(124, 52); // Cliente - Teléfono (sin cambio)
        $this->Cell(50, 10, utf8_decode($customer_data['phone_customer']), 0, 1);

        $this->SetXY(24, 60); // Cliente - Domicilio (2mm hacia la derecha)
        $this->MultiCell(100, 10, utf8_decode($customer_data['customer_address']), 0, 'L');
        $this->Ln(2); // Espacio adicional

        $this->SetXY(126, 60); // Cliente - Localidad (sin cambio)
        $this->Cell(50, 10, utf8_decode($customer_data['location']), 0, 1);

        $this->SetXY(119, 68); // Cliente - CUIT (1mm hacia arriba)
        $this->Cell(50, 10, utf8_decode($customer_data['tax_identifier']), 0, 1);

        // Detalles de productos
        $y_position = 100;
        foreach ($dispatches_data as $detail) {
            $this->SetXY(20, $y_position); // Cantidad
            $this->Cell(30, 12, utf8_decode($detail['qty']), 0, 1);

            $this->SetXY(50, $y_position); // Nombre del producto
            $this->MultiCell(100, 12, utf8_decode($detail['product_name']), 0, 'L');
            $y_position += 10; // Avanzar posición en Y
            $this->Ln(6); // Añadir espacio extra entre productos
            $y_position += 10; // Ajustar la posición para la siguiente línea
        }
    }
}

// Crear PDF
$pdf = new PDF_Remito();
$pdf->AddPage();
// Imprimir los datos del remito
$pdf->ImprimirRemito($remito_data);

$pdf->Output();
