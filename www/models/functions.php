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

   function add_cliente($identifier, $name_cliente, $email_cliente, $telefono, $direccion, $Altura, $ciudad, $observaciones, $status, $piso, $numero_de_piso)
   {
       $bd = database();
       $sentence = $bd->prepare("INSERT INTO customers (tax_identifier, customer_name, email_customer, phone_customer, street, height, location, observaciones, id_status, floor, departament) VALUES (:identifier, :name_cliente, :email_cliente, :telefono, :direccion, :Altura, :ciudad, :observaciones, :status, :piso, :numero_de_piso)");
       
       $sentence->bindParam(':identifier', $identifier);
       $sentence->bindParam(':name_cliente', $name_cliente);
       $sentence->bindParam(':email_cliente', $email_cliente);
       $sentence->bindParam(':telefono', $telefono);
       $sentence->bindParam(':direccion', $direccion);
       $sentence->bindParam(':Altura', $Altura);
       $sentence->bindParam(':ciudad', $ciudad);
       $sentence->bindParam(':observaciones', $observaciones);
       $sentence->bindParam(':status', $status);
       $sentence->bindParam(':piso', $piso);
       $sentence->bindParam(':numero_de_piso', $numero_de_piso);
       
       return $sentence->execute();
   }
   
   function obtenerclientes()
   { 
       $bd = database();
       $sentence = $bd->query("SELECT id_customer, tax_identifier, customer_name, email_customer, phone_customer, street, height, location, observaciones, id_status, floor, departament FROM customers");
       return $sentence->fetchAll(PDO::FETCH_ASSOC); 
   }
   
   function Updatecliente($id, $name, $email, $cuil, $phone, $street, $height, $floor, $departament, $status, $location, $observaciones)
   {
       $bd = database();
       $query = $bd->prepare("UPDATE customers SET 
           tax_identifier = :tax_identifier, 
           customer_name = :customer_name, 
           email_customer = :email_customer, 
           phone_customer = :phone_customer, 
           street = :street, 
           height = :height, 
           location = :location, 
           observaciones = :observaciones, 
           floor = :floor, 
           departament = :departament,
           id_status = :id_status 
       WHERE id_customer = :id");
   
       $query->bindParam(':id', $id);
       $query->bindParam(':tax_identifier', $cuil);
       $query->bindParam(':customer_name', $name);
       $query->bindParam(':email_customer', $email);
       $query->bindParam(':phone_customer', $phone);
       $query->bindParam(':street', $street);
       $query->bindParam(':height', $height);
       $query->bindParam(':floor', $floor);
       $query->bindParam(':departament', $departament);
       $query->bindParam(':location', $location);
       $query->bindParam(':observaciones', $observaciones);
       $query->bindParam(':id_status', $status);
   
       $query->execute();
   }
   
   function deletecliente($id)
   {
       $bd = database();
       $query = $bd->prepare("UPDATE customers SET id_status = 2 WHERE id_customer = :id");
       $query->bindParam(':id', $id);
       $query->execute();
   }
   
/*
function UpdateBook($id_book, $titulo, $genero, $anio, $synopsis, $lenguaje, $page)
{
    $bd = database();
    $query = $bd->prepare("UPDATE Books SET book_title = :titulo, id_gender = :genero, published_year = :anio, synopsis = :synopsis, book_language = :lenguaje, page_number = :page WHERE id_book = :id");
    $query->execute(array(':id' => $id_book, ':titulo' => $titulo, ':genero'=> $genero, ':anio' => $anio, ':synopsis' => $synopsis, ':lenguaje' => $lenguaje, ':page' => $page));
}*/
/*  EJEMPLO DE SELECT!!!!! COMO POR EJ UN LOGIN*/


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
    try {
        $bd = database();
        $sentence = $bd->prepare("INSERT INTO suppliers (name_supplier, phone_supplier, email_supplier, street, height, floor, departament, location, id_status, observations, tax_identifier) VALUES (:name_Proveedor, :telefono, :email_Proveedor, :direccion, :altura, :piso, :numero_de_piso, :ciudad, 1, :observaciones, :cuil)");

        $sentence->bindParam(':name_Proveedor', $name_Proveedor, PDO::PARAM_STR);
        $sentence->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $sentence->bindParam(':email_Proveedor', $email_Proveedor, PDO::PARAM_STR);
        $sentence->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $sentence->bindParam(':altura', $altura, PDO::PARAM_STR);
        $sentence->bindParam(':piso', $piso, PDO::PARAM_STR);
        $sentence->bindParam(':numero_de_piso', $numero_de_piso, PDO::PARAM_STR);
        $sentence->bindParam(':ciudad', $ciudad, PDO::PARAM_STR);
        $sentence->bindParam(':observaciones', $observaciones, PDO::PARAM_STR);
        $sentence->bindParam(':cuil', $cuil, PDO::PARAM_STR);

        return $sentence->execute();
    } catch (PDOException $e) {
        echo "Error al insertar proveedor: " . $e->getMessage();
        return false;
    }
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

  function insert_products($name_product, $description, $stock, $id_brand,$id_category) {
    $bd = database();
    $query = "INSERT INTO products (name_product, description, stock, id_status, id_brand ,id_category) VALUES (:name_product, :description, :stock, 1, :id_brand, :id_category)";
    
    $consulta = $bd->prepare($query);

    // Asociar los parámetros
    $consulta->bindParam(':name_product', $name_product, PDO::PARAM_STR);
    $consulta->bindParam(':description', $description, PDO::PARAM_STR);
    $consulta->bindParam(':stock', $stock, PDO::PARAM_INT);
    $consulta->bindParam(':id_brand', $id_brand, PDO::PARAM_INT);
    $consulta->bindParam(':id_category', $id_category, PDO::PARAM_INT);
    
    try {
        if ($consulta->execute()) {
            return true; // Devuelve verdadero si la inserción fue exitosa
        }
    } catch (PDOException $e) {
        echo "Error en la inserción: " . $e->getMessage();
        return false;
    }
}
function getproducts($id_product)
{
    try {
        $bd = database();
        $query = "SELECT * FROM products WHERE id_product = :id_product and id_status=1";
        $statement = $bd->prepare($query);
        $statement->bindParam(':id_product', $id_product, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al obtener el proveedor: " . $e->getMessage();
        return null;
    }
}
function update_products($id_product, $name_product, $description, $stock)
{
    try {
        $bd = database();
        $query = "UPDATE products SET
        name_product = :name_product, 
        description = :description, 
        stock = :stock
        WHERE id_product = :id_product";

        $consulta = $bd->prepare($query);
        $consulta->bindParam(':id_product', $id_product, PDO::PARAM_INT);
        $consulta->bindParam(':name_product', $name_product, PDO::PARAM_STR);
        $consulta->bindParam(':description', $description, PDO::PARAM_STR);
        $consulta->bindParam(':stock', $stock, PDO::PARAM_INT);

        $result = $consulta->execute();

        return $result; 
    } catch (PDOException $e) {
        echo "Error al actualizar el proveedor: " . $e->getMessage();
        return false;
    }
}
function eliminated_product($table, $id_user) {
    try {
        // Obtener la conexión a la base de datos
        $bd = database(); // Asumiendo que la función database() está definida en functions.php
        
        // Preparar la consulta de actualización
        $query = "UPDATE $table SET id_status = 0 WHERE id_product = :id_product";
        $updateStatement = $bd->prepare($query);
        $updateStatement->bindParam(':id_product', $id_user, PDO::PARAM_INT);
        
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
function insert_brand($detail) {
    $bd = database();
    $query = "INSERT INTO brands (detail,id_status) VALUES (:detail, 1)";
    $consulta = $bd->prepare($query);
    $consulta->bindParam(':detail', $detail, PDO::PARAM_STR);
    
    try {
        if ($consulta->execute()) {
            return true; // Devuelve verdadero si la inserción fue exitosa
        }
    } catch (PDOException $e) {
        echo "Error en la inserción: " . $e->getMessage();
        return false;
    }
}
function getbrands($id_brand)
{
    try {
        $bd = database();
        $query = "SELECT * FROM brands WHERE id_brand = :id_brand and id_status=1";
        $statement = $bd->prepare($query);
        $statement->bindParam(':id_brand', $id_brand, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al obtener el proveedor: " . $e->getMessage();
        return null;
    }
}
function update_brands($id_brand, $detail)
{
    try {
        $bd = database();
        $query = "UPDATE brands SET
        detail = :detail
        WHERE id_brand = :id_brand";

        $consulta = $bd->prepare($query);
        $consulta->bindParam(':id_brand', $id_brand, PDO::PARAM_INT);
        $consulta->bindParam(':detail', $detail, PDO::PARAM_STR);
       

        $result = $consulta->execute();

        return $result; 
    } catch (PDOException $e) {
        echo "Error al actualizar el proveedor: " . $e->getMessage();
        return false;
    }
}
function eliminated_brand($table, $id_brand) {
    try {
        // Obtener la conexión a la base de datos
        $bd = database(); // Asumiendo que la función database() está definida en functions.php
        
        // Preparar la consulta de eliminación
        $query = "DELETE FROM $table WHERE id_brand = :id_brand";
        $deleteStatement = $bd->prepare($query);
        $deleteStatement->bindParam(':id_brand', $id_brand, PDO::PARAM_INT);
        
        // Ejecutar la eliminación
        $deleteStatement->execute();
        
        // Verificar si se eliminó al menos una fila
        $rowCount = $deleteStatement->rowCount();
        
        // Devolver verdadero si se eliminó correctamente
        return ($rowCount > 0);
        
    } catch (PDOException $e) {
        // Manejar errores de base de datos
        return false;
    }
}


?>