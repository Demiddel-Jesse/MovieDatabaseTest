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

  public function getUserListLine(int $userId, int $filmId): UserListsLine
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

    $averageRating = $totalRating / $count;
    return round($averageRating * 2, 1) / 2;
  }
}
