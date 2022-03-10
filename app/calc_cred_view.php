<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
    <head>
        <meta charset="utf-8"/>
        <title>Kalkulator kredytowy </title>
        <!--        <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.6/build/pure-min.css" integrity="sha384-Uu6IeWbM+gzNVXJcM9XV3SohHtmWE+3VGi496jvgX1jyvDTXfdK+rfZc8C1Aehk5" crossorigin="anonymous"> -->
        <!--        <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.6/build/pure-min.css"> -->
        <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.6/build/pure-min.css" integrity="sha384-Uu6IeWbM+gzNVXJcM9XV3SohHtmWE+3VGi496jvgX1jyvDTXfdK+rfZc8C1Aehk5" crossorigin="anonymous">

    </head>

    <body>
        <div style="width:90%; margin: 2em auto;">
            <a href="<?php print(_APP_ROOT); ?>/app/inna_chroniona.php" class="pure-button">kolejna chroniona strona</a>
            <a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
        </div>

        <div style="width:90%; margin: 2em auto;">

            <form action="<?php print(_APP_ROOT); ?>/app/calc_cred.php" method="post" class = "pure-form pure-form-stacked">
                <legend> Kalkulator kredytowy </legend>
                <fieldset>
                    <label for="amount">Kwota: </label>
                    <input id="amount" type="text" name="amt" value="<?php out($_SESSION['amt']); ?>"/>

                    <label for="years">Liczba lat: </label>
                    <input id="years" type="text" name="yrs" value="<?php out($_SESSION['yrs']); ?>"/>

                    <label for="rate">Oprocentowanie (w %): </label>
                    <input id="rate" type="text" name="rt" value="<?php out($_SESSION['rt']); ?>"/>
                </fieldset>

                <input type="submit" value="Oblicz miesięczną ratę" class="pure-button pure-button-active"/>

            </form>	




            <?php
//wyświeltenie listy błędów, jeśli istnieją
            if (isset($messages)) {
                if (count($messages) > 0) {
                    echo '<ol style="margin: 1em; padding: 1em 1em 1em 2em; border-radius: 0.5em; background-color: #f88; width:25em;">';
                    foreach ($messages as $key => $msg) {
                        echo '<li>' . $msg . '</li>';
                    }
                    echo '</ol>';
                }
            }
            ?>

            <?php if (isset($_SESSION['result'])) { ?>
                <div style="margin: 1em; padding: 1em; border-radius: 0.5em; background-color: #0f0; width:25em;"> 
                    <?php echo 'Miesięczna rata wynosi: ' . $_SESSION['result'] . ' zł'; ?>
                </div>
            <?php } ?>
    </body>
</html>