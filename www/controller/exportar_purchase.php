<?php
require_once "../models/functions.php";
// Verificar el tipo de exportación
if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
    $result = get_purchase_history(); // Obtener los datos del historial de compras

    // Obtener la fecha y hora actual en formato deseado
    $fechaHora = date('Y-m-d_H-i-s'); // Formato: Año-Mes-Día_Hora-Minuto-Segundo

    // Exportar a Excel
    if ($tipo === 'Excel') {
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=historial_compras_{$fechaHora}.xls");

        // Encabezados de las columnas
        echo "Número de Remito\tFecha de Remito\tNúmero de Factura\tFecha de Factura\tProveedor\tCantidad Total\n";

        // Iterar sobre los resultados y escribirlos en el archivo
        foreach ($result as $row) {
            echo "{$row['remito_number']}\t{$row['remito_date']}\t{$row['invoice_number']}\t{$row['invoice_date']}\t{$row['name_supplier']}\t{$row['total_qty']}\n";
        }
    }
    // Exportar a PDF
    elseif ($tipo === 'PDF') {
        // Generar archivo PDF usando FPDF
        require('../assets/fpdf/fpdf.php');

        $pdf = new FPDF('L', 'mm', 'A4'); // Orientación landscape (L) y tamaño A4
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);

        // Definir los títulos de las columnas
        $titles = ['Número de Remito', 'Fecha de Remito', 'Número de Factura', 'Fecha de Factura', 'Proveedor', 'Cantidad Total'];

        // Calcular el ancho máximo de cada columna
        $widths = [];
        foreach ($titles as $title) {
            $widths[] = $pdf->GetStringWidth(utf8_decode($title)) + 10; // Agregar un poco de espacio extra para márgenes
        }

        // Asegurarse de que las celdas no se solapen
        foreach ($titles as $index => $title) {
            $pdf->Cell($widths[$index], 10, utf8_decode($title), 1);
        }
        $pdf->Ln(); // Salto de línea

        // Configurar la fuente para el contenido
        $pdf->SetFont('Arial', '', 10);

        // Contenido de las filas
        foreach ($result as $row) {
            $pdf->Cell($widths[0], 10, utf8_decode($row['remito_number']), 1);
            $pdf->Cell($widths[1], 10, utf8_decode($row['remito_date']), 1);
            $pdf->Cell($widths[2], 10, utf8_decode($row['invoice_number']), 1);
            $pdf->Cell($widths[3], 10, utf8_decode($row['invoice_date']), 1);
            $pdf->Cell($widths[4], 10, utf8_decode($row['name_supplier']), 1);
            $pdf->Cell($widths[5], 10, utf8_decode($row['total_qty']), 1);
            $pdf->Ln(); // Salto de línea
        }

        // Forzar descarga del PDF con nombre dinámico
        $pdf->Output('D', "historial_compras_{$fechaHora}.pdf");
    }
}

?>