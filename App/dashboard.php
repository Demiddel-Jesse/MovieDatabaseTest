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

if (!isset($_COOKIE['admin']) && !isset($_COOKIE['user'])) {
  header('location: index.php');
  exit(0);
}

if (isset($_COOKIE['admin'])) {
  $user = unserialize($_COOKIE['admin']);
} else if (isset($_COOKIE['user'])) {
  $user = unserialize($_COOKIE['user']);
}

// print_r($user);

if (isset($_GET['action']) && $_GET['action'] == 'remove') {
  $userListLineService->removeLine($user->getId(), intval($_POST['filmId']));
}

$listTypes = $listTypeService->getAllListTypes();
$listLinesForUser = $userListLineService->getListLinesForUser($user->getId());

if ($listLinesForUser == null) {
  // header('location: index.php?reason=none');
  // exit(0);

  $averageRating = 0;
} else {
  $averageRating = $userListLineService->calcAverageRatingForUser($user->getId());
}
$userListsLines = array();
$totalTime = 0;
$url = basename($_SERVER['REQUEST_URI']);
if($url == 'dashboard.php'){
  $url .= '?action=remove';
} else {
  $url .= '&action=remove';
}
$genrePercentages = $userListLineService->calcGenrePercentages($user->getId());

foreach ($listLinesForUser as $listLine) {
  $film = $filmService->getFilm($listLine->getFilmId());
  $film->setCoverImage(str_replace('~', '.', $film->getCoverImage()));
  array_push($userListsLines, ['film' => $film, 'rating' => $listLine->getRating(), 'listType' => $listTypeService->getListType($listLine->getListTypeId())]);
  if ($listLine->getListTypeId() != 1) {
    $totalTime += $film->getRuntime();
  }
}

include 'Presentation/header.php';

echo $twig->render('userDashboard.twig', array('listTypes' => $listTypes, 'user' => $user, 'lines' => $userListsLines, 'totalTime' => $totalTime, 'averageRating' => $averageRating, 'url' => $url, 'genrePercentages' => $genrePercentages));

include 'Presentation/footer.php';
