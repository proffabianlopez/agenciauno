<?php
include_once "../models/functions.php";

$purchases = get_purchase_history();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Compras</title>
    <!-- Incluir CSS y JS de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Historial de Compras</h2>
        <table id="purchaseTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID Compra</th>
                    <th>Número de Remito</th>
                    <th>Fecha de Remito</th>
                    <th>Número de Factura</th>
                    <th>Número de Línea</th>
                    <th>Proveedor</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchases as $purchase) : ?>
                <tr>
                    <td><?= $purchase['id_purchase']; ?></td>
                    <td><?= $purchase['remito_number']; ?></td>
                    <td><?= $purchase['remito_date']; ?></td>
                    <td><?= $purchase['invoice_number']; ?></td>
                    <td><?= $purchase['line_number'] ?? 'N/A'; ?></td>
                    <td><?= $purchase['supplier_name']; ?></td>
                    <td><?= $purchase['product_name']; ?></td>
                    <td><?= $purchase['qty']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#purchaseTable').DataTable();
        });
    </script>
</body>
</html>
