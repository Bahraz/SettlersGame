<?php
session_start();
if(isset($_SESSION['id_player'] ))
{
    session_write_close();
    header('Location: ../../game.php');
    exit();
}

if (!isset($_POST['login']) || !isset($_POST['password']) || !isset($_POST['email'])) {
    session_write_close();
    header('Location: ../../index.php');
    exit();
}

require_once('./connection.php');

$pdo_login = isset($_POST['login']) ? $_POST['login'] : '';
$pdo_password = isset($_POST['password']) ? $_POST['password'] : '';
$pdo_email = isset($_POST['email'])? $_POST['email'] : '';
$register_date = date("Ymd");  

// Haszowanie hasła
$pdo_hashpassword = password_hash($pdo_password, PASSWORD_DEFAULT);

try {
    // Tworzenie nowego połączenia PDO
    $pdo_connection = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);

    // Ustawienie opcji PDO, aby wyrzucało wyjątki w przypadku błędów
    $pdo_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Tworzenie zapytania sprawdzającego istnienie gracza
    $check_query = $pdo_connection->prepare("SELECT * FROM players WHERE login = :pdo_login OR email = :pdo_email");
    // Przypisanie wartości do parametru i wykonanie zapytania
    $check_query->bindParam(':pdo_login', $pdo_login, PDO::PARAM_STR);
    $check_query->bindParam(':pdo_email', $pdo_email, PDO::PARAM_STR);
    $check_query->execute();

    // Pobranie wyników
    $num_rows = $check_query->rowCount();
    // Sprawdzenie, czy użytkownik istnieje
    if ($num_rows > 0) {
        //TODO: Wyświetl informacje o nieprawidłowym loginie lub emailu
        echo "Podany login lub email jest już zajęty!";
        exit();
    } else {
        // Tworzenie zapytania rejestracyjnego
        $register_query = $pdo_connection->prepare("INSERT INTO players (login, password, email, create_date) VALUES (:pdo_login, :pdo_hashpassword, :pdo_email, :pdo_register_date)");
        $register_query->bindParam(':pdo_login', $pdo_login, PDO::PARAM_STR);
        $register_query->bindParam(':pdo_hashpassword', $pdo_hashpassword, PDO::PARAM_STR);
        $register_query->bindParam(':pdo_email', $pdo_email, PDO::PARAM_STR);
        $register_query->bindParam(':pdo_register_date', $register_date, PDO::PARAM_STR);

        //TODO: Dodanie użytkownika do bazy danych i przejście do formularza logowania.
        $register_query->execute();
        $pdo_connection = null;
        header('Location: ../../index.php');

        exit();
    }

    // Zamknięcie połączenia PDO
} catch (PDOException $e) {
    //TODO: Dodanie skryptu, który dodaje informacje do logów serwera.
    echo "Błąd połączenia z bazą danych: " . $e->getMessage();
} finally {
    $pdo_connection = null;
}
