<?php

declare(strict_types=1);

session_start();

require_once 'bootstrap.php';

use App\Business\FilmService;
use App\Business\ListTypeService;
use App\Business\GenreService;
use App\Business\UserListLineService;

if (isset($_GET['film'])) {
  $filmService = new FilmService();
  $film = $filmService->getFilm(intval($_GET['film']));
  $film->setCoverImage(str_replace('~', '.', $film->getCoverImage()));
  $averageRating = $filmService->getAverageRating($film->getId());

  $listTypeService = new ListTypeService();
  $userListLineService = new UserListLineService();
  $genreService = new GenreService();
}

include 'Presentation/header.php';

if (isset($_GET['film'])) {
  include 'Presentation/filmDetail.php';
}

include 'Presentation/footer.php';
