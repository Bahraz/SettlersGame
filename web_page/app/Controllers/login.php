<?php

require_once('./connection.php');

$pdo_login = $_POST['login'];
$pdo_password = $_POST['password'];


try {
    // Create new connection PDO
    $pdo_connection = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);

    // Set options for PDO to throw exceptions on errors
    $pdo_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Create query for login
    $login_query = $pdo_connection->prepare("SELECT * FROM players WHERE name = :pdo_login AND password = :pdo_password");

    // Assign a value to the parameter and execute
    $login_query->bindParam(':pdo_login', $pdo_login, PDO::PARAM_STR);
    $login_query->bindParam(':pdo_password', $pdo_password, PDO::PARAM_STR);
    $login_query->execute();

    // catch results
    $results_query = $login_query->fetchAll(PDO::FETCH_ASSOC);

    // Wyświetl wyniki
    print_r($results_query);
} catch (PDOException $e) {
    echo "Błąd połączenia z bazą danych: " . $e->getMessage();
}