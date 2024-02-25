<?php
use Bahraz\SettlersOnline\Router;

//TODO: Fix recaptcha in the future.
// require_once('../app/Controllers/recaptcha.php');

// $router = include('../app/routers/router.php');
// $requestPath = $_SERVER['REQUEST_URI'];

// $match= $router->match($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

// $controller = new $match[0](); 
// $controller->$match[1]();

// $match= $router->match($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

// $$controller = new $match[0](); 
// $controller->$match[1]();

// // require_once('../app/routers/router.php');

// $router = new Router();


session_start();
if (isset($_SESSION['id_player'])) {
    session_write_close();
    header('Location: ../app/views/pages/game.php');
    exit();
}
include('../app/views/layouts/header.php');
?>

<body>
    <h1>Settlers Game Online</h1>

    <?php include('../app/views/auth/loginForm.php'); ?>

    <script>
        function onSubmit(token) {
            document.getElementById('recap_form').submit();
        }
    </script>

    </html>