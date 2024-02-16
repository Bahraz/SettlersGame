<?php

require_once('./recaptcha_key.php');

$recaptcha_key = urlencode($recaptcha_key);
$recaptcha_response = urlencode($_POST['g-recaptcha-response']);

$check_captcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?' . http_build_query([
    'secret' => $recaptcha_key,
    'response' => $recaptcha_response,
]));

$answer_captcha = json_decode($check_captcha);

if ($answer_captcha->success == false) {
    $validation_flag = false;
    $_SESSION['e_bot'] = 'Potwierdź, że nie jesteś botem!';
    session_write_close();
    header('Location: ../views/pages/registration.php');
    exit();
}