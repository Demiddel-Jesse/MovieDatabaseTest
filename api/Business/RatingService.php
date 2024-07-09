<?php

declare(strict_types=1);

namespace api\Business;

use api\Data\RatingDAO;
use api\Entities\Rating;
use api\Exceptions\InvalidTypeException;

class RatingService
{
  private $ratingDAO;

  public function __construct()
  {
    $this->ratingDAO = new RatingDAO();
  }

  public function getRating(int|string $rating): ?Rating
  {
    if (is_string($rating)) {
      return $this->ratingDAO->getByName($rating);
    } else if (is_int($rating)) {
      return $this->ratingDAO->getById($rating);
    } else {
      throw new InvalidTypeException;
    }
  }

  public function getAll(): array
  {
    return $this->ratingDAO->getAll();
  }

  public function createRating(string $name, string|null $description = null): void
  {
    if ($description == null) {
      $this->ratingDAO->createRating($name);
    } else {
      $this->ratingDAO->createRating($name, $description);
    }
  }

  public function updateRating(int|string $currentRating, string|null $newName, string|null $description = null): void
  {
    $this->ratingDAO->updateRating($currentRating, $newName, $description);
  }

  public function removeRating(int|string $rating): void
  {
    $this->ratingDAO->removeRating($rating);
  }
}
