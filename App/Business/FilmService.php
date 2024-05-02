<?php

declare(strict_types=1);

namespace App\Business;

use App\Data\FilmDAO;
use App\Business\UserListLineService;
use App\Entities\Film;
use App\Exceptions\InvalidTypeException;
use DateTime;

class FilmService
{
  private $dao;

  public function __construct()
  {
    $this->dao = new FilmDAO();
  }

  public function getFilm(int|string $film): ?Film
  {
    if (is_int($film)) {
      return $this->dao->getById($film);
    } else if (is_string($film)) {
      return $this->dao->getByTitle($film);
    } else {
      throw new InvalidTypeException;
    }
  }

  public function getAllFilms(): array
  {
    return $this->dao->getAll();
  }

  public function getAverageRating(int $filmId): float
  {
    $userListService = new UserListLineService();
    return $userListService->calcAverageRatingForFilm($filmId);
  }

  public function createFilm(string $title, string $sortTitle, string|null $description, int|null $runtime, string|null $releaseDate, string|null $coverImage, int|null $genreId, int|null $categoryId, int $ratingId): void
  {
    $this->dao->createFilm($title, $sortTitle, $description, $runtime, $releaseDate, $coverImage, $genreId, $categoryId, $ratingId);
  }

  public function updateFilm(int|string $currentFilm, string|null $title, string|null $sortTitle, string|null $description, int|null $runtime, string|null $releaseDate, string|null $coverImage, int|null $genreId, int|null $categoryId, int|null $ratingId): void
  {
    $this->dao->updateFilm($currentFilm, $title, $sortTitle, $description, $runtime, $releaseDate, $coverImage, $genreId, $categoryId, $ratingId);
  }

  public function removeFilm(int|string $film): void
  {
    $this->dao->removeFilm($film);
  }
}
