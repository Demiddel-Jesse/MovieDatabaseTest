<?php

declare(strict_types=1);

namespace App\Business;

use App\Data\GenreDAO;
use App\Entities\Genre;
use App\Exceptions\InvalidTypeException;

class GenreService
{
  private $dao;

  public function __construct()
  {
    $this->dao = new GenreDAO();
  }

  public function getGenre(int|string $genre): Genre
  {
    if (is_int($genre)) {
      return $this->dao->getById($genre);
    } else if (is_string($genre)) {
      return $this->dao->getByName($genre);
    } else {
      throw new InvalidTypeException;
    }
  }

  public function getAllGenres(): array
  {
    return $this->dao->getAll();
  }

  public function createNewGenre(string $name): void
  {
    $this->dao->createNewGenre($name);
  }

  public function updateGenre(int|string $genre, string $newName): void
  {
    $this->dao->updateGenre($genre, $newName);
  }

  public function removeGenre(int|string $genre): void
  {
    $this->dao->removeGenre($genre);
  }
}
