<?php

declare(strict_types=1);

session_start();

require_once 'bootstrap.php';

use App\Business\FilmService;
use App\Business\CategoryService;
use App\Business\GenreService;

if (!isset($_SESSION['admin'])) {
  header('index.php');
  exit(0);
}

$filmService = new FilmService();
$error = '';

if (isset($_GET['action']) && $_GET['action'] == 'edit' && $_GET['film']) {

  if ($_POST['title'] == null) {
    $error .= 'Geef een titel in.<br>';
  }
  if ($_POST['sortTitle'] == null) {
    $error .= 'Geef een sorteer titel in.<br>';
  }
  if ($error == '') {
    $filmService->updateFilm(intval($_GET['film']), $_POST['title'], $_POST['sortTitle'], $_POST['description'], intval($_POST['runtime']), $_POST['releaseDate'], null, intval($_POST['genreId']), intval($_POST['categoryId']), null);
  }
} else if (isset($_GET['action'])) {
  $error .= 'geen film gegeven in url.<br>';
}

if (isset($_GET['film'])) {
  $film = $filmService->getFilm(intval($_GET['film']));

  if ($film->getReleaseDate() != null) {
    $releaseDateDT = $film->getReleaseDate();
    $releaseDate = $releaseDateDT->format('Y-m-d');
  } else {
    $releaseDate = null;
  }

  $categoryService = new CategoryService();
  $genreService = new GenreService();

  $genres = $genreService->getAllGenres();
  $categories = $categoryService->getAllCategories();
} else {
  header('index.php');
  exit(0);
}

include 'Presentation/header.php';

echo $twig->render('filmEdit.twig', array('film' => $film, 'releaseDate' => $releaseDate, 'categories' => $categories, 'genres' => $genres));

include 'Presentation/footer.php';
