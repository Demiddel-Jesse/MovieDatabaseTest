<?php

declare(strict_types=1);

session_start();

require_once 'bootstrap.php';

use App\Business\FilmService;
use App\Business\CategoryService;
use App\Business\GenreService;

if (!isset($_COOKIE['admin'])) {
  header('location: index.php');
  exit(0);
}

$filmService = new FilmService();
$error = '';

if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['film'])) {

  if ($_POST['title'] == null) {
    $error .= 'Geef een titel in.<br>';
  }
  if ($_POST['sortTitle'] == null) {
    $error .= 'Geef een sorteer titel in.<br>';
  }
  if (intval($_POST['runtime']) == 0 || intval($_POST['runtime']) < 0) {
    $runtime = 0;
  } else {
    $runtime = intval($_POST['runtime']);
  }

  // comment code below

  $target_dir = "img/";
  $target_file = $target_dir . str_replace(' ', '', $_POST['title'] . '.png');
  if (!isset($_POST['imageNull'])) {
    if ($_FILES['image']['name'] != null) {
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if ($check !== false) {
        $uploadOk = 1;
      } else {
        $error .= "File is not an image.";
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
  } else {
    if (file_exists($target_file)) {
      unlink($target_file);
    }
    $coverImagePath = '~/img/placeholder.jpg';
  }

  // stop commenting code

  if ($error == '') {
    $filmService->updateFilm(intval($_GET['film']), $_POST['title'], $_POST['sortTitle'], $_POST['description'], $runtime, $_POST['releaseDate'], $coverImagePath, intval($_POST['genreId']), intval($_POST['categoryId']), null);
  }
} else if (isset($_GET['action']) && $_GET['action'] == 'edit') {
  $error .= 'geen film gegeven in url.<br>';
}
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['film'])) {
  $film = $filmService->getFilm(intval($_GET['film']));
  $target_file = './img/' . str_replace(' ', '', $film->getTitle() . '.png');
  if (file_exists($target_file)) {
    unlink($target_file);
  }
  $filmService->removeFilm(intval($_GET['film']));

  header('location: index.php');
  exit(0);
} else if (isset($_GET['action']) && $_GET['action'] == 'remove') {
  $error .= 'geen film gegeven in url.<br>';
}

if (isset($_GET['film'])) {
  $film = $filmService->getFilm(intval($_GET['film']));

  $film->setCoverImage(str_replace('~', '.', $film->getCoverImage()));

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
  header('location: index.php');
  exit(0);
}

include 'Presentation/header.php';

if ($error != "") {
  echo "<span style=\"color:red;\">" . $error . "</span>";
}

echo $twig->render('filmEdit.twig', array('film' => $film, 'releaseDate' => $releaseDate, 'categories' => $categories, 'genres' => $genres));

include 'Presentation/footer.php';
