<?php

session_start();
if (isset($_SESSION['id_player'])) {
    session_write_close();
    header('Location: ../app/views/pages/game.php');
    exit();
}
include('../layouts/header.php');
?>

<body>
    <h1>Settlers Game Online - Register</h1>

    <?php include('../auth/registrationForm.php'); ?>


    <script>
        function onSubmit(token) {
            document.getElementById('recap_form').submit();
        }
    </script>

    </html>