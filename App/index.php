<?php

declare(strict_types=1);

session_start();

require_once 'bootstrap.php';

use App\Business\FilmService;

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

include 'Presentation/header.php';

if ($error != "") {
  echo "<span style=\"color:red;\">" . $error . "</span>";
}

include 'Presentation/filmGrid.php';

include 'Presentation/footer.php';
