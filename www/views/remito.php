<?php
include_once "../models/functions.php";

// Capturar el número de venta
$sales_number = $_GET['sales_number'] ?? null;

if ($sales_number) {
    $remito_data = get_remito_data($sales_number);
}
 else {
    die("Número de venta no proporcionado");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <title>Formulario de Remito</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body>
    <div class="remito_container">
        <form action="#" method="POST">
            <!-- Header Section -->
            <div class="header">
                <div class="header-left">
                    <h1>U</h1>
                    <p>AGENCIAUNO<br>AGENCIA UNO DE TECNOLOGÍA Y COMUNICACIÓN S.R.L.</p>
                    <p>Juncal 253 - 4° B<br>(1722) Merlo - Prov. Bs. As.<br>estudiounoagencia@gmail.com<br>Tel./Fax:
                        (0220) 483-6292</p>
                    <p><strong>IVA RESPONSABLE INSCRIPTO</strong></p>
                </div>
                <div class="header-right">
                    <h2>REMITO</h2>
                    <p>No <input type="text" name="remito_numero"
                            value="<?= $remito_data['dispatches'][0]['sales_number'] ?? '' ?>"></p>
                    <p>Fecha: <input type="date" name="remito_fecha"
                            value="<?= $remito_data['dispatches'][0]['dispatch_date'] ?? '' ?>"></p>
                    <p>CUIT N°: 30-71659703-9<br>ING. BRUTOS: 30-71659703-9<br>INICIO DE ACTIVIDADES: 11/09/2019</p>
                    <p><em>Documento no válido como factura</em></p>
                </div>
            </div>

            <!-- Info Table Section -->
            <table class="info-table">
                <tr>
                    <td>Señor (es): <input type="text" name="cliente_nombre"
                            value="<?= $remito_data['customer']['customer_name'] ?? '' ?>"></td>
                    <td>Teléfono: <input type="text" name="cliente_telefono"
                            value="<?= $remito_data['customer']['phone_customer'] ?? '' ?>"></td>
                </tr>
                <tr>
                    <td>Domicilio: <input type="text" name="cliente_domicilio"
                            value="<?= $remito_data['customer']['customer_address'] ?? '' ?>"></td>
                    <td>Localidad: <input type="text" name="cliente_localidad"
                            value="<?= $remito_data['customer']['location'] ?? '' ?>"></td>
                </tr>
                <tr>
                    <td>IVA: <input type="text" name="cliente_iva" value="Consumidor Final"></td>
                    <td>CUIT: <input type="text" name="cliente_cuit"
                            value="<?= $remito_data['customer']['tax_identifier'] ?? '' ?>"></td>
                </tr>
                <tr>
                    <td>Entrega en: <input type="text" name="entrega_en" value=""></td>
                    <td>Fecha de vencimiento: <input type="date" name="fecha_vencimiento"></td>
                </tr>
            </table>

            <!-- Details Table Section -->
            <table class="details-table">
                <tr>
                    <td style="width: 20%;">CANTIDAD</td>
                    <td style="width: 80%;">DETALLE</td>
                </tr>
                <?php foreach ($remito_data['dispatches'] as $detail): ?>
                <tr>
                    <td><input type="number" name="cantidad[]" value="<?= $detail['qty'] ?>"></td>
                    <td><textarea name="detalle[]"><?= $detail['product_name'] ?></textarea></td>
                </tr>
                <?php endforeach; ?>
            </table>

            <!-- Footer Section -->
            <div class="footer">
                <div class="footer-left">
                    <p>U AGENCIA UNO</p>
                    <p>TALLERES GRÁFICOS PELAZZO & CIA S.R.L. - C.U.I.T N° 30-5754559-3</p>
                    <p>HAB. 395574 - TELEFAX: 0220-4820499<br>FECHA DE IMPRESIÓN: 07/2024 - NUMERACIÓN: 0002-0000251 AL
                        0002-0002750</p>
                </div>
                <div class="footer-right">
                    <p>CAI Nro: 50309208236427<br>Fecha de Vto: 25/07/2025</p>
                </div>
            </div>
        </form>
    </div>
    <script>
    window.onload = function() {
        generarPDF();
    };
    
    function generarPDF() {
    const contenido = document.querySelector('.remito_container');
    const pdf = new jspdf.jsPDF('portrait', 'mm', 'a4'); // Tamaño A4

    html2canvas(contenido, {
        scale: 2,
        scrollY: -window.scrollY // Capturar todo el contenido
    }).then(canvas => {
        const imgData = canvas.toDataURL('image/png');

        const imgWidth = pdf.internal.pageSize.getWidth(); // Ancho de la página A4
        const pageHeight = pdf.internal.pageSize.getHeight(); // Altura de la página A4
        let imgHeight = (canvas.height * imgWidth) / canvas.width; // Calcular la proporción de altura

        let heightLeft = imgHeight;
        let position = 0;

        // Renderizar la primera página
        pdf.addImage(imgData, 'PNG', 0, position, imgWidth, Math.min(imgHeight, pageHeight));
        heightLeft -= pageHeight;

        // Agregar más páginas si el contenido es mayor que una página
        while (heightLeft > 0) {
            pdf.addPage();
            position = heightLeft - imgHeight + pageHeight; // Ajuste de posición correcto para nueva página
            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, Math.min(imgHeight, pageHeight));
            heightLeft -= pageHeight;
        }

        // Guardar el archivo PDF
        pdf.save('remito_<?= $sales_number ?>.pdf');
        window.location.href = '../views/sales_list.php';

    });
}
</script>
</body>

</html>