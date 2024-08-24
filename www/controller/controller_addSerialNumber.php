<?php
include_once "../models/functions.php";

function save_serial_numbers() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_product = $_POST['id_product_modal'];
        $remito_number = $_POST['remito_number'];
        $id_supplier = $_POST['id_supplier_modal'];  // Obtener id_supplier
        $serial_numbers = $_POST['items'][0]['serial_numbers'];

        // Depuración
        if (empty($id_product)) {
            die("Error: El ID del producto está vacío.");
        }

        foreach ($serial_numbers as $line_number => $serial_number) {
            add_serial_number($id_product, $serial_number, $remito_number, $line_number + 1, $id_supplier);  // Pasar id_supplier
        }

        echo '<script>
        localStorage.setItem("mensaje", "Agregado con éxito");
        localStorage.setItem("tipo", "success");
        window.location.href = "../views/purchase.php";
            </script>';
    } else {
        echo '<script>
           localStorage.setItem("mensaje", "Error");
           localStorage.setItem("tipo", "error");
           window.location.href = "../views/purchase.php";
               </script>';
    }
}

// Llamar la función
save_serial_numbers();
?>
