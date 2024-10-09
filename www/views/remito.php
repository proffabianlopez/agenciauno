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

        // Número de remito
        $this->SetXY(150, 20); // Ajustar coordenadas
        $this->Cell(40, 10, utf8_decode($dispatches_data[0]['sales_number']), 0, 1);

        // Fecha de remito
        $this->SetXY(150, 30); // Ajustar coordenadas
        $this->Cell(40, 10, utf8_decode($dispatches_data[0]['dispatch_date']), 0, 1);

        // Información del cliente
        $this->SetXY(20, 50); // Cliente - Nombre
        $this->MultiCell(100, 10, utf8_decode($customer_data['customer_name']), 0, 'L'); // MultiCell para ajustar texto
        $this->Ln(2); // Espacio adicional

        $this->SetXY(130, 50); // Cliente - Teléfono
        $this->Cell(50, 10, utf8_decode($customer_data['phone_customer']), 0, 1);

        $this->SetXY(20, 60); // Cliente - Domicilio
        $this->MultiCell(100, 10, utf8_decode($customer_data['customer_address']), 0, 'L'); // MultiCell para ajustar texto
        $this->Ln(2); // Espacio adicional

        $this->SetXY(130, 60); // Cliente - Localidad
        $this->Cell(50, 10, utf8_decode($customer_data['location']), 0, 1);

        $this->SetXY(130, 70); // Cliente - CUIT
        $this->Cell(50, 10, utf8_decode($customer_data['tax_identifier']), 0, 1);

        // Detalles de productos
        $y_position = 100;
        foreach ($dispatches_data as $detail) {
            $this->SetXY(20, $y_position); // Cantidad
            $this->Cell(30, 10, utf8_decode($detail['qty']), 0, 1);

            $this->SetXY(50, $y_position); // Nombre del producto
            $this->MultiCell(100, 10, utf8_decode($detail['product_name']), 0, 'L'); // MultiCell para ajustar texto
            $y_position += 10; // Avanzar posición en Y
            // Espacio adicional después de cada producto
            $this->Ln(2); // Añadir espacio extra entre productos

            $y_position += 10; // Ajustar el y_position para la siguiente línea
        }
    }
}

// Crear PDF
$pdf = new PDF_Remito();
$pdf->AddPage();
$pdf->ImprimirRemito($remito_data);
$pdf->Output();
