<?php
session_start();
include_once "../models/functions.php";
$error_message = isset($_SESSION["error_message"]) ? $_SESSION["error_message"] : "";
unset($_SESSION["error_message"]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buscar Garantía</title>
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min5.3.css">
    <!-- SweetAlert -->
    <script src="../assets/js/sweetalert2@11.js"></script>
</head>
<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper">
        <!-- HEADER -->
        <?php include "header.php" ?>
        <!-- MENU -->
        <?php include "menu.php" ?>
        <!-- Contenido Principal -->
        <div class="content-wrapper">
            <div class="container-fluid" style="padding:50px;">
                <div class="card" style="margin-top:5px">
                    <div class="card-header">
                        <h4>Búsqueda de Garantía</h4>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form id="warranty-form">
                            <div class="form-group">
                                <label for="serial_number">Número de Serie del Producto</label>
                                <input type="text" name="serial_number" id="serial_number" class="form-control" placeholder="Ingrese el número de serie" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Buscar Garantía</button>
                        </form>
                        <?php if ($error_message): ?>
                            <div class="alert alert-danger mt-3">
                                <i class="fas fa-exclamation-triangle"></i> 
                                <?php echo htmlspecialchars($error_message); ?>
                            </div>
                        <?php endif; ?>
                        <div id="result"></div> <!-- Contenedor para mostrar resultados -->
                    </div>
                </div>
            </div>
        </div>
        <!-- FOOTER -->
        <?php include "footer.php" ?>
    </div>
    <!-- Incluir jQuery una sola vez -->
    <script src="../assets/plugins/jquery/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle5.3.min.js"></script>
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <script>
    document.getElementById('warranty-form').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevenir el envío tradicional del formulario
        let serialNumber = document.getElementById('serial_number').value;
        // Hacer la solicitud AJAX
        fetch('../controller/warranty_search.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `serial_number=${encodeURIComponent(serialNumber)}`
        })
        .then(response => response.json()) // Parsear la respuesta a JSON
        .then(data => {
            if (data.error) {
                // Mostrar mensaje de error si existe
                document.getElementById('result').innerHTML = `<div class="alert alert-danger">${data.error}</div>`;
            } else {
                // Mostrar los datos de la garantía
                document.getElementById('result').innerHTML = `
                    <div class="card mt-4">
                        <div class="card-header bg-primary text-white">
                            <h5>Información de la Garantía</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr><th>Producto:</th><td>${data.name_product}</td></tr>
                                <tr><th>Descripción:</th><td>${data.description}</td></tr>
                                <tr><th>Fecha de Creación:</th><td>${data.created_at}</td></tr>
                                <tr><th>Proveedor:</th><td>${data.name_supplier}</td></tr>
                                <tr><th>Fecha de Venta:</th><td>${data.dispatch_date}</td></tr>
                                <tr><th>Cliente:</th><td>${data.customer_name}</td></tr>
                            </table>
                        </div>
                    </div>`;
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
            document.getElementById('result').innerHTML = `<div class="alert alert-danger">Error en la solicitud.</div>`;
        });
    });
    </script>
</body>
</htmls