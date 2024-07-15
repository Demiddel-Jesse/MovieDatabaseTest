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

if (isset($_GET['action']) && $_GET['action'] == 'remove') {
  $userListLineService->removeLine($user->getId(), intval($_POST['filmId']));
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
$url = basename($_SERVER['REQUEST_URI']) . '&action=remove';

include 'Presentation/header.php';

if (isset($_GET['film'])) {
  echo $twig->render('list.twig', array('listType' => $listType, 'listTypes' => $listTypes, 'user' => $user, 'lines' => $userListsLines, 'type' => $type, 'url' => $url));
}

include 'Presentation/footer.php';
