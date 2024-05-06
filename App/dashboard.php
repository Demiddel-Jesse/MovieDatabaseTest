<?php

declare(strict_types=1);

session_start();

require_once 'bootstrap.php';

use App\Business\UserService;
use App\Business\UserListLineService;
use App\Business\ListTypeService;
use App\Business\FilmService;

$userService = new UserService();
$userListLineService = new UserListLineService();
$listTypeService = new ListTypeService();
$filmService = new FilmService();

if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
  header('index.php');
  exit(0);
}

if (isset($_SESSION['admin'])) {
  $user = unserialize($_SESSION['admin']);
} else if (isset($_SESSION['user'])) {
  $user = unserialize($_SESSION['user']);
}

// print_r($user);

$listTypes = $listTypeService->getAllListTypes();
$listLinesForUser = $userListLineService->getListLinesForUser($user->getId());
$userListsLines = array();
$averageRating = $userListLineService->calcAverageRatingForUser($user->getId());
$totalTime = 0;

foreach ($listLinesForUser as $listLine) {
  $film = $filmService->getFilm($listLine->getFilmId());
  $film->setCoverImage(str_replace('~', '.', $film->getCoverImage()));
  array_push($userListsLines, ['film' => $film, 'rating' => $listLine->getRating(), 'listType' => $listTypeService->getListType($listLine->getListTypeId())]);
  if ($listLine->getListTypeId() != 1) {
    $totalTime += $film->getRuntime();
  }
}

include 'Presentation/header.php';

echo $twig->render('userDashboard.twig', array('listTypes' => $listTypes, 'user' => $user, 'lines' => $userListsLines, 'totalTime' => $totalTime, 'averageRating' => $averageRating));

include 'Presentation/footer.php';