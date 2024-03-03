<?php

namespace Bahraz\SettlersGame\Views\Components;

class Header
{
    public function displayHeader()
    {
        echo <<<END
        <!DOCTYPE html>
        <html lang='pl'>
        
        <head>
            <script src='https://www.google.com/recaptcha/api.js'></script>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Settlers Online Game</title>
        </head>
        <header>
        
        <h1>Settlers Game Online</h1>

        </header>
        <body>
        END;
    }
}
