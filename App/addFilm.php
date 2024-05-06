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
  // if permissions for folder don't work comment out following code 
  if ($_FILES['image']['name'] != null) {
    $target_dir = "img/";
    $target_file = $target_dir . str_replace(' ', '', $_POST['title'] . '.png');
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
      $uploadOk = 1;
    } else {
      $error .= "File is not an image.";
      $uploadOk = 0;
    }
    if (file_exists($target_file)) {
      $error .= "Sorry, file already exists.";
      $uploadOk = 0;
    }
    if ($_FILES["image"]["size"] > 16000000) {
      $error .= "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    if ($uploadOk == 0) {
      $error .= "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], './' . $target_file)) {
        $coverImagePath = '~/' . $target_file;
      } else {
        $error .= "Sorry, there was an error uploading your file.";
      }
    }
  } else {
    $coverImagePath = null;
  }
  // stop commenting out code

  // uncomment following code
  // $coverImagePath = null;

  if ($error == '' && $filmService->getFilm($title) != null) {
    if ($filmService->getFilm($title)->getReleaseDate() == new DateTime($releaseDate)) {
      $error .= 'Deze film bestaat al.<br>';
    }
  }

  if ($error == '') {
    $filmService->createFilm($title, $sortTitle, $description, $runtime, $releaseDate, $coverImagePath, $genreId, $categoryId, 2);
  }
}

include 'Presentation/header.php';

if ($error != "") {
  echo "<span style=\"color:red;\">" . $error . "</span>";
}

echo $twig->render('filmAdd.twig', array('categories' => $categories, 'genres' => $genres));

include 'Presentation/footer.php';
