<?php

namespace Bahraz\SettlersGame\Controllers;

use PDO;
use PDOException;

class DatabaseConnection
{
    private $connection;

    public function __construct($servername, $database, $dbUsername, $dbPassword)
    {
        try {
            $this->connection = new PDO("mysql:host=" . $_ENV['DB_HOST'] . "dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
            // $this->connection = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->dbUsername, $this->dbPassword);
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
