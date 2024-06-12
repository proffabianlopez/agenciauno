<?php
include_once "../models/functions.php";

$show=show_state("suppliers");

 
if(isset($_POST['agregar'])){

    $cuil = $_POST['cuil'];
    $name_Proveedor = $_POST['name_Proveedor']; 
    $email_Proveedor = $_POST['email_Proveedor'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $altura = $_POST['altura'];
    $piso = $_POST['piso'];
    $numero_de_piso = $_POST['numero_de_piso'];
    $ciudad = $_POST['ciudad'];
    $observaciones = $_POST['observaciones'];
    
    // Verificar si el cuil o el email ya existen en la base de datos
    if (check_existing_supplier($cuil, $email_Proveedor)) {
        echo "Error: El CUIL o el email ya están registrados.";
    } else {
        // Llamada a la función insert_suppliers
        $insert = insert_suppliers($name_Proveedor,$telefono,$email_Proveedor,$direccion,$altura,$piso,$numero_de_piso,$ciudad,$observaciones,$cuil);
        header("Location: ../views/crud_suppliers.php?ingreso=check");
        if (!$insert) {
            echo "Error en la inserción.";
        }
    }
}
