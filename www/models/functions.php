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
/*  EJEMPLO DE SELECT!!!!! COMO POR EJ UN LOGIN

function login()
{
    $bd=database();
    $sentence=$bd->query("SELECT id_user, user_name, last_name, dni, email ,phone, cuil, _password,id_rol FROM Users");
    return $sentence->fetchAll();
}
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