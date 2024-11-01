<?php
require_once "../models/functions.php";

// Verificar el tipo de exportación
if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
    $result = get_sales_history(); // Obtener los datos del historial de ventas

    // Obtener la fecha y hora actual en formato deseado
    $fechaHora = date('Y-m-d_H-i-s'); // Formato: Año-Mes-Día_Hora-Minuto-Segundo

    if ($tipo === 'Excel') {
        // Generar archivo Excel
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=historial_ventas_{$fechaHora}.xls");

        // Encabezados de las columnas
        echo "Número de Venta\tCliente\tCantidad Total\tFecha de Venta\n";

        // Iterar sobre los resultados y escribirlos en el archivo
        foreach ($result as $row) {
            echo "{$row['sales_number']}\t{$row['customer_name']}\t{$row['total_qty']}\t{$row['sale_date']}\n";
        }

    } elseif ($tipo === 'PDF') {
        // Generar archivo PDF usando FPDF
        require('../assets/fpdf/fpdf.php');

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);

        // Encabezados de las columnas
        $pdf->Cell(40, 10, utf8_decode('Número de Venta'), 1);
        $pdf->Cell(60, 10, utf8_decode('Cliente'), 1);
        $pdf->Cell(40, 10, utf8_decode('Cantidad Total'), 1);
        $pdf->Cell(40, 10, utf8_decode('Fecha de Venta'), 1);
        $pdf->Ln();

        // Contenido de las filas
        foreach ($result as $row) {
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(40, 10, utf8_decode($row['sales_number']), 1);
            $pdf->Cell(60, 10, utf8_decode($row['customer_name']), 1);
            $pdf->Cell(40, 10, utf8_decode($row['total_qty']), 1);
            $pdf->Cell(40, 10, utf8_decode(date('d-m-Y', strtotime($row['sale_date']))), 1);
            $pdf->Ln();
        }

        // Forzar descarga del PDF con nombre dinámico
        $pdf->Output('D', "historial_ventas_{$fechaHora}.pdf");
    }
}
?>