<?php

// KONTROLER strony kalkulatora
require_once dirname(__FILE__) . '/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.
//ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
include _ROOT_PATH . '/app/security/check.php';

//pobranie parametrów
function getParams(&$varArray) {
    $varArray['amt'] = isset($_REQUEST['amt']) ? $_REQUEST['amt'] : null;
    $varArray['yrs'] = isset($_REQUEST['yrs']) ? $_REQUEST['yrs'] : null;
    $varArray['rt'] = isset($_REQUEST['rt']) ? $_REQUEST['rt'] : null;
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$varArray, &$messages) {
    // sprawdzenie, czy parametry zostały przekazane
    if (!(isset($varArray['amt']) && isset($varArray['yrs']) && isset($varArray['rt']))) {
        // sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
        // teraz zakładamy, ze nie jest to błąd. Po prostu nie wykonamy obliczeń
        return false;
    }

// sprawdzenie, czy potrzebne wartości zostały przekazane
    if ($varArray['amt'] == "") {
        $messages [] = 'Nie podano kwoty';
    }

    if ($varArray['yrs'] == "") {
        $messages [] = 'Nie podano liczby lat';
    }

    if ($varArray['rt'] == "") {
        $messages [] = 'Nie podano oprocentowania';
    }

//nie ma sensu walidować dalej gdy brak parametrów
    if (count($messages) != 0)
        return false;

    // sprawdzenie, czy $amt i $yrs i $rt są liczbami całkowitymi
    if (!is_numeric($varArray['amt'])) {
        $messages [] = 'Podana kwota nie jest liczbą całkowitą';
    }

    if (!is_numeric($varArray['yrs'])) {
        $messages [] = 'Podana liczba lat nie jest liczbą całkowitą';
    }

    if (!is_numeric($varArray['rt'])) {
        $messages [] = 'Podane oprocentowanie nie jest liczbą całkowitą';
    }


    if (count($messages) != 0)
        return false;

    // sprawdzenie, czy $amt i $yrs i $rt są liczbami dodatnimi
    if ($varArray['amt'] < 0) {
        $messages [] = 'Kwota musi być dodatnia (większa od 0)';
    }

    if ($varArray['yrs'] < 0) {
        $messages [] = 'Liczba lat musi być dodatnia (większa od 0)';
    }

    if ($varArray['rt'] < 0) {
        $messages [] = 'Oprocentowanie musi być dodatnie (większe od zera)';
    }

    if (count($messages) != 0)
        return false;
    else
        return true;
}

function process(&$varArray, &$messages, &$result) {
    global $role;

    //konwersja parametrów na int
    $amount = intval($varArray['amt']);
    $years = intval($varArray['yrs']);
    $rate = floatval($varArray['rt']);


    $_SESSION['amt'] = $amount;
    $_SESSION['yrs'] = $years;
    $_SESSION['rt'] = $rate;

    //wykonanie operacji
    $years = $years * 12;
    $rate = $rate / 100;

    $result = ($amount * $rate) / (12 * (1 - ((12 / (12 + $rate)) ** $years))); //wzór na raty równe
    $result = number_format($result, 2, ',', ' '); //zaokrąglanie do 2 miejsc po przecinku - ? notacja francuska ?


    $_SESSION['result'] = $result;
}

//definicja zmiennych kontrolera
$varArray = [];
$messages = [];

//pobierz parametry i wykonaj zadanie jeśli wszystko w porządku
getParams($varArray);
if (validate($varArray, $messages)) {
    process($varArray, $messages, $result);
}


// Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$amt,$yrs,$rt,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_cred_view.php';
