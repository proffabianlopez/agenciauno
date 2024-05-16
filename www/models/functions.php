<?php
function database()
{
    $servername = getenv('MYSQLSERVER');
    $username = getenv('MYSQLUSER');
    $password = getenv('MYSQLPASSWORD');
    $dbname = getenv('MYSQLDB');
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
function Agregarol($genre)
{
    $bd = database();
    $sentence = $bd->prepare("INSERT INTO roles (detail) VALUES (?)");
    $sentence->bind_param("s", $genre);
    $result = $sentence->execute();
    $sentence->close();
    $bd->close();
    return $result;
}
?>