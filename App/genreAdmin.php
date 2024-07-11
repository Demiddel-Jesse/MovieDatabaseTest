<?php

declare(strict_types=1);

session_start();

require_once 'bootstrap.php';

use App\Business\GenreService;
use App\Exceptions\DoesntExistException;
use App\Exceptions\InvalidTypeException;
use App\Exceptions\AlreadyExistException;

$genreService = new GenreService;
$type = 'genre';

$error = '';

if (isset($_GET['action'])) {
  if ($_GET['action'] == 'add') {
    try {
      $genreService->createNewGenre($_POST['name']);
    } catch (AlreadyExistException $th) {
      $error .= 'genre bestaat al.<br>';
    }
  }
  if ($_GET['action'] == 'adjust') {
    try {
      $genreService->updateGenre(intval($_POST[$type]), $_POST['name']);
    } catch (DoesntExistException $th) {
      $error .= 'genre bestaat niet.<br>';
    } catch (InvalidTypeException $th) {
      $error .= 'Verkeerde waarde gegeven.<br>';
    }
  }
}

$list = $genreService->getAllGenres();

include 'Presentation/header.php';

if ($error != "") {
  echo "<span style=\"color:red;\">" . $error . "</span>";
}

include 'Presentation/adjustForm.php';

include 'Presentation/footer.php';
