<?php
   date_default_timezone_set('America/Argentina/Buenos_Aires');
   function database()
   {
       $user_password = getenv("MYSQLPASSWORD");
       $user_name = getenv("MYSQLUSER");
       $databasename = getenv("MYSQLDB");
       $hostname = getenv("MYSQLSERVER");
       $database = new PDO("mysql:host=" . $hostname. ";dbname=" . $databasename, $user_name, $user_password);
       $database->query("set names utf8;");
       $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
       $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
       return $database;
   }

   function add_cliente($identifier, $name_cliente, $email_cliente, $telefono, $direccion, $Altura, $ciudad, $observaciones,$status,$piso,$numero_de_piso)
{
    $bd = database();
    $sentence = $bd->prepare("INSERT INTO customers (tax_identifier, customer_name, email_customer, phone_customer, street, height, _location, observaciones,id_status,floor,departament) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    return $sentence->execute([$identifier, $name_cliente, $email_cliente, $telefono, $direccion, $Altura, $ciudad, $observaciones,$status,$piso,$numero_de_piso]);
}

function login($email, $password)
{
    $bd = database();
    $sentence = $bd->prepare("SELECT email_user, password, id_rol, id_status FROM users WHERE email_user = :email");
    $sentence->execute([$email]);
    // Obtiene la fila asociada al correo electrónico proporcionado
    $row = $sentence->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        if ($password == $row['password']) {
            return $row;
        }
    }
    return false;
}
function check_existing_supplier($cuil, $email_Proveedor) {
    $bd = database();
    $sentence = $bd->prepare("SELECT COUNT(*) AS count FROM suppliers WHERE tax_identifier = ? OR email_supplier = ?");
    $sentence->execute([$cuil, $email_Proveedor]);
    $row = $sentence->fetch(PDO::FETCH_ASSOC);
    return $row['count'] > 0;
}
function insert_suppliers($name_Proveedor, $telefono, $email_Proveedor, $direccion, $altura, $piso, $numero_de_piso, $ciudad, $observaciones, $cuil) {
    $bd = database();
    $sentence = $bd->prepare("INSERT INTO suppliers (name_supplier, phone_supplier, email_supplier, street, height, floor, departament, location, id_status,observations, tax_identifier) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    return $sentence->execute([$name_Proveedor, $telefono, $email_Proveedor, $direccion, $altura, $piso, $numero_de_piso, $ciudad,1, $observaciones, $cuil]);
    
}
function show_state($table){
    $bd = database();
    $query= $bd->prepare("SELECT * FROM $table WHERE id_status = 1");
    $query->execute();
    $list_data=$query->fetchAll();
    
    return $list_data;
    
}

function getSupplier($id_supplier)
{
    try {
        $bd = database();
        $query = "SELECT * FROM suppliers WHERE id_supplier = :id_supplier and id_status=1";
        $statement = $bd->prepare($query);
        $statement->bindParam(':id_supplier', $id_supplier, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al obtener el proveedor: " . $e->getMessage();
        return null;
    }
}

// Función para actualizar los datos de un proveedor en la base de datos
function updateSupplier($id_supplier, $name, $phone, $email, $observation, $tax)
{
    try {
        $bd = database();
        $query = "UPDATE suppliers SET
        name_supplier = :name_supplier, 
        phone_supplier = :phone_supplier, 
        email_supplier = :email_supplier,
        observations = :observations,
        tax_identifier = :tax_identifier
        WHERE id_supplier = :id_supplier";

        $statement = $bd->prepare($query);
        $statement->bindParam(':id_supplier', $id_supplier, PDO::PARAM_INT);
        $statement->bindParam(':name_supplier', $name, PDO::PARAM_STR);
        $statement->bindParam(':phone_supplier', $phone, PDO::PARAM_INT);
        $statement->bindParam(':email_supplier', $email, PDO::PARAM_STR);
        $statement->bindParam(':observations', $observation, PDO::PARAM_STR);
        $statement->bindParam(':tax_identifier', $tax, PDO::PARAM_STR);

        $result = $statement->execute();

        return $result; 
    } catch (PDOException $e) {
        echo "Error al actualizar el proveedor: " . $e->getMessage();
        return false;
    }
}

function eliminated_Suppliers($table, $id_user) {
    try {
        // Obtener la conexión a la base de datos
        $bd = database(); // Asumiendo que la función database() está definida en functions.php
        
        // Preparar la consulta de actualización
        $query = "UPDATE $table SET id_status = 0 WHERE id_supplier = :id_supplier";
        $updateStatement = $bd->prepare($query);
        $updateStatement->bindParam(':id_supplier', $id_user, PDO::PARAM_INT);
        
        // Ejecutar la actualización
        $updateStatement->execute();
        
        // Verificar si se actualizó al menos una fila
        $rowCount = $updateStatement->rowCount();
        
        // Devolver verdadero si se actualizó correctamente
        return ($rowCount > 0);
        
    } catch (PDOException $e) {
        // Manejar errores de base de datos
        echo "Error al actualizar: " . $e->getMessage();
        return false;
    }
}

  function getSuppliers($id_supplier)
  {
    $bd = database();
    $query = "SELECT * FROM suppliers WHERE id_supplier = :id_supplier and id_status=1";
    $statement = $bd->prepare($query);
    $statement->bindParam(':id_supplier', $id_supplier, PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

/*
function insert_suppliers($name_Proveedor,$telefono,$email_Proveedor,$direccion,$altura,$piso,$numero_de_piso,$ciudad,$observaciones,$cuil){
 $bd = database();
 $sentence = $bd->prepare("INSERT INTO suppliers (name_supplier, phone_supplier, email_supplier, street, height, floor, departament, location, id_status,observations, tax_identifier)
 VALUES ('name_supplier', 'phone_supplier', 'email_supplier', 'street', height, floor, 'departament', 'location',1,'observations','tax_identifier'");
 return $sentence->execute([$name_Proveedor,$telefono,$email_Proveedor,$direccion,$altura,$piso,$numero_de_piso,$ciudad,$observaciones,$cuil]);
 
}*/
/*  EJEMPLO DE SELECT!!!!! COMO POR EJ UN LOGIN
function getDefaultRole()
{
    $bd = database();
    $query = $bd->query("SELECT id_rol, rol FROM Roles WHERE id_rol= 1");
    $default_role = $query->fetch(PDO::FETCH_ASSOC);
    return $default_role;
}
function getDefaultState()
{
    $bd = database();
    $query = $bd->query("SELECT id_state, _state FROM States WHERE id_state= 1");
    $default_state = $query->fetch(PDO::FETCH_ASSOC);
    return $default_state;
}
EJEMPLOO DE UPDATEEE!!! COMO POR EJEMPLO CAMBIAR UN ESTADO O UN ROL

function deleteSHow($id_libro)
{
    $bd = database();
    $query = $bd->prepare("UPDATE Book_author SET id_state = 2 WHERE id_book = :id");
    $query->execute(array(':id' => $id_libro));

}
function reanudeSHow($id_libro)
{
    $bd = database();
    $query = $bd->prepare("UPDATE Book_author SET id_state = 1 WHERE id_book = :id");
    $query->execute(array(':id' => $id_libro));

}
function UpdateBook($id_book, $titulo, $genero, $anio, $synopsis, $lenguaje, $page)
{
    $bd = database();
    $query = $bd->prepare("UPDATE Books SET book_title = :titulo, id_gender = :genero, published_year = :anio, synopsis = :synopsis, book_language = :lenguaje, page_number = :page WHERE id_book = :id");
    $query->execute(array(':id' => $id_book, ':titulo' => $titulo, ':genero'=> $genero, ':anio' => $anio, ':synopsis' => $synopsis, ':lenguaje' => $lenguaje, ':page' => $page));
}

UN EJEMPLO MAS DE INSERT!!!

function AgregarGenero($genre)
{
    $bd = database();
    $sentence = $bd->prepare("INSERT INTO Genders (gender) VALUES (?)");
    return $sentence->execute([$genre]);
}
*/
?>