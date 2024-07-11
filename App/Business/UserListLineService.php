<?php

declare(strict_types=1);

namespace api\Business;

use api\Data\UserListsLineDAO;
use api\Entities\UserListsLine;

class UserListLineService
{
  private $userListLineDAO;

  public function __construct()
  {
    $this->userListLineDAO = new UserListsLineDAO();
  }

  public function getUserListLine(int $userId, int $filmId): ?UserListsLine
  {
    return $this->userListLineDAO->getByUserAndFilmId($userId, $filmId);
  }

  public function getListLinesForUser(int $userId): array
  {
    return $this->userListLineDAO->getAllForUserId($userId);
  }

  public function getListLinesForFilm(int $filmId): array
  {
    return $this->userListLineDAO->getAllForFilmId($filmId);
  }

  public function getListLinesForUserFromList(int $userId, int $listId): array
  {
    return $this->userListLineDAO->getAllForUserIdAndListId($userId, $listId);
  }

  public function calcAverageRatingForFilm(int $filmId): float
  {
    // should do this in the data layer with sql
    $allFilmRatings = $this->getListLinesForFilm($filmId);
    $count = 0;
    $totalRating = 0;

    foreach ($allFilmRatings as $filmRating) {
      $count++;
      $totalRating += $filmRating->getRating();
    }

    if ($totalRating == 0) {
      return 0;
    }

    $averageRating = $totalRating / $count;
    return round($averageRating * 2, 1) / 2;
  }

  public function calcAverageRatingForUser(int $userId): float
  {
    // should do this in the data layer with sql
    $allFilmRatings = $this->getListLinesForUser($userId);
    $count = 0;
    $totalRating = 0;

    foreach ($allFilmRatings as $filmRating) {
      $count++;
      $totalRating += $filmRating->getRating();
    }

    $averageRating = $totalRating / $count;
    return round($averageRating * 2, 1) / 2;
  }

  public function calcGenrePercentages(int $userId): array
  {
    $allLines = $this->getListLinesForUser($userId);
    $genreService = new GenreService();
    $filmService = new FilmService();
    $allGenres = $genreService->getAllGenres();
    $allFilms = array();
    foreach ($allLines as $line) {
      $film = $filmService->getFilm($line->getFilmId());
      array_push($allFilms, $film);
    }
    $genrePercentageList = array();
    $total = count($allLines);

    foreach ($allGenres as $genre) {
      $count = 0;
      foreach ($allFilms as $film) {
        if ($film->getGenreId() == $genre->getId()) {
          $count++;
        }
      }
      array_push($genrePercentageList, ['genre' => $genre, 'percentage' => round($count / $total * 100, 2)]);
    }

    usort($genrePercentageList, function ($a, $b) {
      if ($a['percentage'] > $b['percentage']) {
        return -1;
      } elseif ($a['percentage'] < $b['percentage']) {
        return 1;
      }
      return 0;
    });

    return $genrePercentageList;
  }

  public function createNewLine(int $userId, int $filmId, int $listTypeId, float|null $rating = null): void
  {
    if ($rating == null) {
      $this->userListLineDAO->createNewUserListLine($userId, $filmId, $listTypeId);
    } else {
      $this->userListLineDAO->createNewUserListLine($userId, $filmId, $listTypeId, $rating);
    }
  }

  public function updateRating(int $userId, int $filmId, float $rating): void
  {
    $this->userListLineDAO->updateRating($userId, $filmId, $rating);
  }

  public function updateList(int $userId, int $filmId, int $listTypeId): void
  {
    $this->userListLineDAO->updateListType($userId, $filmId, $listTypeId);
  }

  public function removeLine(int $userId, int $filmId)
  {
    $this->userListLineDAO->removeLine($userId, $filmId);
  }
}
