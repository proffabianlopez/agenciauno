<?php
session_start();
include_once "../models/functions.php";

// Verificar si el usuario tiene permisos
$show = show_state("brands");
if (isset($_SESSION["id_rol"]) && ($_SESSION["id_rol"] == 1 || $_SESSION["id_rol"] == 2)) {
} else {
    header("Location: login.php");
    exit();
}

// Procesamiento del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['product_image'])) {
    $description = $_POST['product_description'];
    $targetDir = "../uploads/products/";
    $imageName = basename($_FILES["product_image"]["name"]);
    $targetFilePath = $targetDir . $imageName;

    // Mover el archivo a la carpeta de destino y guardar en la base de datos
    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFilePath)) {
        // Guardar la ruta de la imagen y descripción en la base de datos
        save_product($imageName, $description); // Esta función debe definirse en tu archivo de funciones
        $message = "Producto agregado con éxito.";
    } else {
        $message = "Error al subir la imagen. Intente nuevamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agencia UNO</title>
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
</head>

<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper">
        <?php include "header.php" ?>
        <?php include "menu.php" ?>

        <div class="container mt-5">
            <h2>Add New Product</h2>
            <form method="post" enctype="multipart/form-data" oninput="updatePreview()">
                <div class="form-group">
                    <label for="image">Product Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="showPreview(event)" required>
                </div>
                <div class="form-group">
                    <label for="description">Product Description</label>
                    <input type="text" class="form-control" id="description" name="description" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="stock">Available Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <h3 class="mt-5">Preview</h3>
            <div class="card mt-3" style="width: 18rem;">
                <img id="previewImage" class="card-img-top" alt="Image Preview">
                <div class="card-body">
                    <h5 id="previewDescription" class="card-title">Product Description</h5>
                    <p id="previewPrice" class="card-text">Price: $0.00</p>
                    <p id="previewStock" class="card-text">Available Stock: 0</p>
                </div>
            </div>
        </div>

        <script>
            function showPreview(event) {
                if (event.target.files.length > 0) {
                    var src = URL.createObjectURL(event.target.files[0]);
                    var preview = document.getElementById("previewImage");
                    preview.src = src;
                }
            }

            function updatePreview() {
                document.getElementById("previewDescription").textContent = document.getElementById("description").value;
                document.getElementById("previewPrice").textContent = "Price: $" + document.getElementById("price").value;
                document.getElementById("previewStock").textContent = "Available Stock: " + document.getElementById("stock").value;
            }
        </script>

        <?php include "footer.php" ?>
    </div>

    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/dist/js/adminlte.min.js"></script>
</body>

</html>