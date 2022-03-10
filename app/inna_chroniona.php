<?php
require_once dirname(__FILE__) . '/../config.php';
//ochrona widoku
include _ROOT_PATH . '/app/security/check.php';
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
    <head>
        <meta charset="utf-8" />
        <title>Chroniona strona</title>
        <!--        <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.6/build/pure-min.css"> -->
        <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.6/build/pure-min.css" integrity="sha384-Uu6IeWbM+gzNVXJcM9XV3SohHtmWE+3VGi496jvgX1jyvDTXfdK+rfZc8C1Aehk5" crossorigin="anonymous">
    </head>
    <body>

        <div style="width:90%; margin: 2em auto;">
            <a href="<?php print(_APP_ROOT); ?>/app/calc_cred.php" class="pure-button">Powrót do kalkulatora</a>
            <a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
        </div>

        <div style="width:90%; margin: 2em auto;">
            <p>To jest inna chroniona strona aplikacji internetowej</p>
       
        </div>	

    </body>
</html>