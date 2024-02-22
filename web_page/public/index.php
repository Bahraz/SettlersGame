<?php

//TODO: Fix recaptcha in the future.
// require_once('../app/Controllers/recaptcha.php');
include('../app/routers/router.php');


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