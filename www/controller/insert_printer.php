<?php
include_once "../models/functions.php";
$show = show_state("suppliers");

if (isset($_POST['agregar'])) {
    // Recuperar los valores del formulario
    $serial_number = $_POST['serial_number'];
    $model = $_POST['model']; 
    $brand = $_POST['brand'];
    $location = $_POST['location'];
    $supplier = $_POST['supplier'];
    $status = $_POST['status'];
    $acquisition_date = $_POST['acquisition_date'];
      $observations = $_POST['observations'];

    // Llamada a la función insert_printer (debes asegurarte de que esta función esté definida y reciba estos parámetros correctamente)
    $insert = insert_printer($serial_number, $model, $brand, $location, $supplier, $status, $acquisition_date, $observations);

    if ($insert) {
        echo '<script>
            localStorage.setItem("mensaje", "Impresora agregada con éxito");
            localStorage.setItem("tipo", "success");
            window.location.href = "../views/crud_printer.php";
        </script>';
    } else {
        echo '<script>
            localStorage.setItem("mensaje", "Error al agregar la impresora");
            localStorage.setItem("tipo", "error");
            window.location.href = "../views/crud_printer.php";
        </script>';
    }
}
?>
