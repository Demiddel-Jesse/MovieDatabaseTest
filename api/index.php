<?php

declare(strict_types=1);

session_start();

require_once 'bootstrap.php';

use api\Business\FilmService;

$filmService = new FilmService();
$films = $filmService->getAllFilms();

$error = '';

$searchValue = null;

if (isset($_GET['searchName'])) {
  $searchFilms = $filmService->searchFilms($_GET['searchName']);
  if ($searchFilms != null) {
    $films = $searchFilms;
    $searchValue = $_GET['searchName'];
  } else {
    $error .= 'Geen films gevonden met die naam.<br>';
  }
}

if (isset($_GET['reason']) && $_GET['reason'] == 'none') {
  $error .= 'Geen films in uw lijst, voeg een film toe om uw dashboard te zien.<br>';
}

include 'Presentation/header.php';

$di = new RecursiveDirectoryIterator('./');
foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
    echo $filename . ' - ' . ' bytes <br/>';
}

if ($error != "") {
  echo "<span style=\"color:red;\">" . $error . "</span><br>";
}

include 'Presentation/filmGrid.php';

include 'Presentation/footer.php';
