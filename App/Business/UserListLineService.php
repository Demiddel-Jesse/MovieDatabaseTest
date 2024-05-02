<?php

declare(strict_types=1);

namespace App\Business;

use App\Data\UserListsLineDAO;
use App\Entities\UserListsLine;

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

  public function createNewLine(int $userId, int $filmId, int $listTypeId, float $rating): void
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
