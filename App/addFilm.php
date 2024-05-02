<?php

declare(strict_types=1);

session_start();

require_once 'bootstrap.php';

use App\Business\FilmService;
use App\Business\CategoryService;
use App\Business\GenreService;

$error = '';

$filmService = new FilmService();
$categoryService = new CategoryService();
$genreService = new GenreService();

$genres = $genreService->getAllGenres();
$categories = $categoryService->getAllCategories();

if (isset($_GET['action']) && $_GET['action'] == 'add') {
  if ($_POST['title'] != null) {
    $title = $_POST['title'];
  } else {
    $error .= 'Geef een titel in.<br>';
  }
  if ($_POST['sortTitle'] == null) {
    $sortTitle = $title;
  } else {
    $sortTitle = $_POST['sortTitle'];
  }
  if (intval($_POST['runtime']) == 0 || intval($_POST['runtime']) < 0) {
    $runtime = null;
  } else {
    $runtime = intval($_POST['runtime']);
  }
  if (intval($_POST['genreId']) == 0 || intval($_POST['genreId']) < 0) {
    $genreId = null;
  } else {
    $genreId = intval($_POST['genreId']);
  }
  if (intval($_POST['categoryId']) == 0 || intval($_POST['categoryId']) < 0) {
    $categoryId = null;
  } else {
    $categoryId = intval($_POST['categoryId']);
  }
  if ($_POST['releaseDate'] == '') {
    $releaseDate = null;
  } else {
    $releaseDate = $_POST['releaseDate'];
  }
  if ($_POST['description'] == '') {
    $description = null;
  } else {
    $description = $_POST['description'];
  }
  if ($filmService->getFilm($title) != null) {
    if ($filmService->getFilm($title)->getReleaseDate() == new DateTime($releaseDate)) {
      $error .= 'Deze film bestaat al.<br>';
    }
  }

  if ($error == '') {
    $filmService->createFilm($title, $sortTitle, $description, $runtime, $releaseDate, null, $genreId, $categoryId, 2);
  }
}

include 'Presentation/header.php';

if ($error != "") {
  echo "<span style=\"color:red;\">" . $error . "</span>";
}

echo $twig->render('filmAdd.twig', array('categories' => $categories, 'genres' => $genres));

include 'Presentation/footer.php';
