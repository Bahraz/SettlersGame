<?php

namespace Bahraz\SettlersOnline\controllers;

use PDO;
use PDOException;

// $servername = "mysql";
// $database = "settlers_db";
// $dbUsername = "db_settlers_user";
// $dbPassword = "Test123";

class DatabaseConnection
{
    private $connection;

    // private $servername = "mysql";
    // private $database = "settlers_db";
    // private $dbUsername = "db_settlers_user";
    // private $dbPassword = "Test123";

    public function __construct($servername, $database, $dbUsername, $dbPassword)
    {
        try {
            $this->connection = new PDO("mysql:host=$servername;dbname=$database", $dbUsername, $dbPassword);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Błąd połączenia z bazą danych: " . $e->getMessage();
            exit();
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}


// class DatabaseConnection{
// public static function connect(){
//     $servername = "mysql";
// $database = "settlers_db";
// $dbUsername = "db_settlers_user";
// $dbPassword = "Test123";

// $conn = new PDO("mysql:host=$servername;dbname=$database", $dbUsername, $dbPassword);

// // if($conn->PDOException $e){
// //     die("". $conn->connection_error);
// // }
// return $conn;
// // print_r($conn);

// }
// }

// DatabaseConnection::connect();
// $databaseConnection = new DatabaseConnection($servername, $database, $dbUsername, $dbPassword);
// $routerDatabaseConnection = new DatabaseConnection($servername,$database,$dbUsername,$dbPassword);
// $playerModelDatabaseConnection = new DatabaseConnection($servername, $database, $dbUsername, $dbPassword);
// $villageModelDatabaseConnection = new DatabaseConnection($servername, $database, $dbUsername, $dbPassword);
