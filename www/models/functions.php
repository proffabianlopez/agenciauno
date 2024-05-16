<?php
class conec_sql {
    private $pdo;

    public function __construct(){
        $this->pdo = $this->conexion_bd();
   }

   private function conexion_bd(){
        $hostname = getenv('MYSQLSERVER');
        $dbname = getenv('MYSQLDB');
        $username = getenv('MYSQLUSER');
        $password= getenv('MYSQLPASSWORD');
        
        try {
            $connection = "mysql:host=" . $hostname . ";dbname=" . $dbname ; 
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $pdo = new PDO($connection, $username, $password, $options);
            return $pdo;
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
            exit;
        }
   }

   public function Agregarol($genre)
   {
       try {
           $query = "INSERT INTO roles (detail) VALUES (:genre)";
           $statement = $this->pdo->prepare($query);
           $statement->bindParam(':genre', $genre, PDO::PARAM_STR); 
           $result = $statement->execute();
           
           // Cerramos el statement
           $statement->closeCursor();
           
           return $result;
       } catch (PDOException $e) {
           // Manejo de errores
           echo "Error: " . $e->getMessage();
           return false;
       }
   }
}

