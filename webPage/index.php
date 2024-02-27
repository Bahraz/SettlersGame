<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    // require_once '../webPage/vendor/autoload.php';
    // require_once '../vendor/autoload.php';
    
    require_once __DIR__ . '/vendor/autoload.php';


    use Bahraz\Views\Components\HeaderViews;

    $test = new HeaderViews;

    $test->displayHeader();

    ?>
</body>

</html>