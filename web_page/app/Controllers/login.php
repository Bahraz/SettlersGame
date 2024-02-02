<?php

require_once('./connection.php');

$pdo_login = isset($_POST['login']) ? $_POST['login'] : '';
$pdo_password = isset($_POST['password']) ? $_POST['password'] : '';

try {
    // Create new PDO connection
    $pdo_connection = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);

    // Set PDO options to throw exceptions on errors
    $pdo_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create query for login
    $login_query = $pdo_connection->prepare("SELECT * FROM players WHERE login = :pdo_login");

    // Assign a value to the parameter and execute
    $login_query->bindParam(':pdo_login', $pdo_login, PDO::PARAM_STR);
    $login_query->execute();

    // Fetch results
    $user_data = $login_query->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists and verify the password
    if ($user_data && password_verify($pdo_password, $user_data['password'])) {
       //TODO: Save session player (add more information about player)
        session_start();
        $_SESSION['id_player'] = $user_data['id_player'];
        $_SESSION['login'] = $user_data['login'];

        $pdo_connection = null;

        header('Location: ../../game.php');

        exit();
    } else {
        //TODO: Display information about incorrect login details
        echo "Błędne dane logowania.";
        exit();
    }
    
    // Close the PDO connection
} catch (PDOException $e) {

    //TODO: Add a script that adds information to the server logs.
    echo "Błąd połączenia z bazą danych: " . $e->getMessage();
} finally{

        $pdo_connection = null;

}