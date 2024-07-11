<?php

declare(strict_types=1);

namespace App\Data;

use App\Entities\Rating;
use App\Data\DBConfig;
use App\Exceptions\InvalidTypeException;
use PDO;

class RatingDAO
{
  private PDO $pdo;

  public function __construct()
  {
    $dbConfig = new DBConfig();

    $this->pdo = new PDO(
      $dbConfig->getConnectionString(), $dbConfig->getUser(), $dbConfig->getPassword(), [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
  }

  public function startTransaction()
  {
    $this->pdo->beginTransaction();
  }
  public function rollbackTransaction()
  {
    $this->pdo->rollBack();
  }
  public function commitTransaction()
  {
    $this->pdo->commit();
  }

  public function getById(int $id): ?Rating
  {
    $sql = 'SELECT * FROM "Ratings" WHERE "id" = :id';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $ratingData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      $rating = new Rating($ratingData['id'], $ratingData['name'], $ratingData['description']);
      return $rating;
    }
    return null;
  }

  public function getByName(string $name): ?Rating
  {
    $sql = 'SELECT * FROM "Ratings" WHERE "name" = :name';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->execute();
    $ratingData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      $rating = new Rating($ratingData['id'], $ratingData['name'], $ratingData['description']);
      return $rating;
    }
    return null;
  }

  public function getAll(): array
  {
    $sql = 'SELECT * FROM "Ratings" ORDER BY "id" ASC';
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $ratingsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $ratings = array();

    foreach ($ratingsData as $ratingData) {
      array_push($ratings, new Rating($ratingData['id'], $ratingData['name'], $ratingData['description']));
    }

    return $ratings;
  }

  public function createRating(string $name, string|null $description = null): void
  {
    if ($description != null) {
      $sql = 'INSERT INTO "Ratings"("name", "description") VALUES (:name,:description)';
    } else {
      $sql = 'INSERT INTO "Ratings"("name") VALUES (:name)';
    }

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':name', $name);
    if ($description != null) {
      $stmt->bindValue(':description', $description);
    }
    $stmt->execute();
  }

  public function updateRating(string|int $currentRating, string|null $newName, string|null $description = null): void
  {
    $sql = 'UPDATE "Ratings" SET';
    if ($newName != null) {
      $sql = $sql . '"name" = :name';
    }
    if ($description != null) {
      if ($sql !== 'UPDATE "Ratings" SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . ' "description" = :description';
    }

    if (is_int($currentRating)) {
      $sql = $sql . ' WHERE "id" = :currentRating ;';
    } else if (is_string($currentRating)) {
      $sql = $sql . ' WHERE "name"= :currentRating ;';
    } else {
      throw new InvalidTypeException;
    }

    $stmt = $this->pdo->prepare($sql);

    if ($newName != null) {
      $stmt->bindValue(':name', $newName);
    }
    if ($description != null) {
      $stmt->bindValue(':description', $description);
    }

    $stmt->bindValue(':currentRating', $currentRating);
    $stmt->execute();
  }

  public function removeRating(string|int $rating): void
  {
    $sql = 'DELETE FROM "Ratings" WHERE';
    if (is_int($rating)) {
      $sql = $sql . ' "id" = :rating ;';
    } else if (is_string($rating)) {
      $sql = $sql . ' "name"= :rating ;';
    } else {
      throw new InvalidTypeException;
    }
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':rating', $rating);
    $stmt->execute();
  }
}
