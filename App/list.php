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

if (isset($_GET['film'])) {
  $listType = $listTypeService->getListType(intval($_GET['list']));
  $listTypes = $listTypeService->getAllListTypes();
  $listLinesForUser = $userListLineService->getListLinesForUserFromList($user->getId(), intval($_GET['list']));
  $userListsLines = array();


  foreach ($listLinesForUser as $listLine) {
    $film = $filmService->getFilm($listLine->getFilmId());
    $film->setCoverImage(str_replace('~', '.', $film->getCoverImage()));
    array_push($userListsLines, ['film' => $film, 'rating' => $listLine->getRating(), 'listType' => $listTypeService->getListType($listLine->getListTypeId())]);
  }
}

if (isset($_GET['film'])) {
  $type = 'film';
}

include 'Presentation/header.php';

if (isset($_GET['film'])) {
  echo $twig->render('list.twig', array('listType' => $listType, 'listTypes' => $listTypes, 'user' => $user, 'lines' => $userListsLines, 'type' => $type));
}

include 'Presentation/footer.php';
