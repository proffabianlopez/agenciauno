<?php
include_once "../models/functions.php";

if (isset($_GET['id_product'])) {
    $id_product = $_GET['id_product'];
    $get_product = getproducts($id_product);
} else {
    $get_product = null;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['save_data'])) {
        $id_product = $_POST["id_product"];
        $number_product = $_POST["number_product"];
        $name_product = $_POST["name_product"];
        $description = $_POST["description"];        
        $warranty_period = $_POST["edtwarranty_period"];        
        $updated = update_products($number_product, $id_product, $name_product, $description, $warranty_period);

        if ($updated) {
            echo '<script>
                localStorage.setItem("mensaje", "Producto editado con éxito");
                localStorage.setItem("tipo", "success");
                window.location.href = "../views/crud_products_new.php";
                </script>';
        } else {
            echo '<script>
                localStorage.setItem("mensaje", "Error al actualizar los datos");
                localStorage.setItem("tipo", "error");
                window.location.href = "../views/crud_products_new.php";
                </script>';
        }
    }
}
?>