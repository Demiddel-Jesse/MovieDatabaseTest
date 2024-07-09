<?php

declare(strict_types=1);

namespace api\Data;

use api\Entities\Genre;
use api\Data\DBConfig;
use api\Exceptions\AlreadyExistException;
use api\Exceptions\DoesntExistException;
use api\Exceptions\InvalidTypeException;
use PDO;

class GenreDAO
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

  public function getById(int $id): ?Genre
  {
    $sql = "SELECT * FROM `Genres` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $genreData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      $copy = new Genre($genreData["id"], $genreData["name"]);
      return $copy;
    }
    return null;
  }

  public function getByName(string $name): ?Genre
  {
    $sql = "SELECT * FROM `Genres` WHERE `name` = :name";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":name", $name);
    $stmt->execute();
    $genreData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      $copy = new Genre($genreData["id"], $genreData["name"]);
      return $copy;
    }
    return null;
  }

  public function getAll(): array
  {
    $sql = "SELECT * FROM `Genres`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $genresData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $genres = array();

    foreach ($genresData as $genreData) {
      array_push($genres, new Genre($genreData["id"], $genreData["name"]));
    }

    return $genres;
  }

  public function createNewGenre(string $name): void
  {
    if ($this->getByName($name) != null) {
      throw new AlreadyExistException;
    } else {
      $sql = "INSERT INTO `Genres`(`name`) VALUES (:name)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(":name", $name);
      $stmt->execute();
    }
  }

  public function updateGenre(string|int $genre, string $newName): void
  {
    if (is_int($genre)) {
      if ($this->getById($genre) == null) {
        throw new DoesntExistException;
      }
      $sql = "UPDATE `Genres` SET `name` = :newName WHERE `id` = :genre";
    } else if (is_string($genre)) {
      if ($this->getByName($genre) == null) {
        throw new DoesntExistException;
      }
      $sql = "UPDATE `Genres` SET `name` = :newName WHERE `name` = :genre";
    } else {
      throw new InvalidTypeException;
    }
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":genre", $genre);
    $stmt->bindValue(":newName", $newName);
    $stmt->execute();
  }

  public function removeGenre(string|int $genre): void
  {
    if (is_int($genre)) {
      if ($this->getById($genre) == null) {
        throw new DoesntExistException;
      }
      $sql = "DELETE FROM `Genres` WHERE `id` = :genre";
    } else if (is_string($genre)) {
      if ($this->getByName($genre) == null) {
        throw new DoesntExistException;
      }
      $sql = "DELETE FROM `Genres` WHERE `name` = :genre";
    } else {
      throw new InvalidTypeException;
    }

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":genre", $genre);
    $stmt->execute();
  }
}
