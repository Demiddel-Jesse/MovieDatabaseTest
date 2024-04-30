<?php

declare(strict_types=1);

namespace App\Data;

use App\Entities\Film;
use App\Data\DBConfig;
use App\Exception\DoesntExistException;
use App\Exception\InvalidTypeException;
use DateTime;
use PDO;

class FilmDAO
{
  private PDO $pdo;

  public function __construct()
  {
    $this->pdo = new PDO(
      DBConfig::$DB_CONNSTRING,
      DBConfig::$DB_USERNAME,
      DBConfig::$DB_PASSWORD
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

  public function getById(int $id): ?Film
  {
    $sql = 'SELECT * FROM `Films` WHERE `id` = :id;';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    $filmData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      $dateTime = null;
      if ($filmData['releaseDate'] != null) {
        $dateTime = new DateTime($filmData['releaseDate']);
      }
      $film = new Film($filmData['id'], $filmData['title'], $filmData['ratingId'], $filmData['description'], $filmData['runtime'], $dateTime, $filmData['coverImage'], $filmData['genreId'], $filmData['categoryId']);
      return $film;
    }
    return null;
  }

  public function getByTitle(string $title): ?Film
  {
    $sql = 'SELECT * FROM `Films` WHERE `title` LIKE :title;';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':title', '%' . $title . '%');
    $stmt->execute();

    $filmData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      $dateTime = null;
      if ($filmData['releaseDate'] != null) {
        $dateTime = new DateTime($filmData['releaseDate']);
      }
      $film = new Film($filmData['id'], $filmData['title'], $filmData['ratingId'], $filmData['description'], $filmData['runtime'], $dateTime, $filmData['coverImage'], $filmData['genreId'], $filmData['categoryId']);
      return $film;
    }
    return null;
  }

  public function getAll(): array
  {
    $sql = 'SELECT * FROM `Films` ORDER BY `sortTitle` ASC';
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();

    $filmsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $films = array();
    foreach ($filmsData as $filmData) {
      $dateTime = null;
      if ($filmData['releaseDate'] != null) {
        $dateTime = new DateTime($filmData['releaseDate']);
      }
      $film = new Film($filmData['id'], $filmData['title'], $filmData['ratingId'], $filmData['description'], $filmData['runtime'], $dateTime, $filmData['coverImage'], $filmData['genreId'], $filmData['categoryId']);

      array_push($films, $film);
    }
    return $films;
  }

  public function createFilm(string $title, string|null $sortTitle, string|null $description, int|null $runtime, DateTime|null $releaseDate, string|null $coverImage, int|null $genreId, int|null $categoryId, int $ratingId)
  {
    $sql = 'INSERT INTO `Films`(`title`, `sortTitle`, `description`, `runtime`, `releaseDate`, `coverImage`, `genreId`, `categoryId`, `ratingId`) VALUES (:title,:sortTitle,:description,:runtime,:releaseDate,:coverImage,:genreId,:categoryId,:ratingId);';

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':title', $title);
    if ($sortTitle == null) {
      $stmt->bindValue(':sortTitle', $title);
    } else {
      $stmt->bindValue(':sortTitle', $sortTitle);
    }
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':runtime', $runtime);
    $stmt->bindValue(':releaseDate', $releaseDate);
    $stmt->bindValue(':coverImage', $coverImage);
    $stmt->bindValue(':genreId', $genreId);
    $stmt->bindValue(':categoryId', $categoryId);
    $stmt->bindValue(':ratingId', $ratingId);

    $stmt->execute();
  }

  public function updateFilm(int|string $currentFilm, string|null $title, string|null $sortTitle, string|null $description, int|null $runtime, DateTime|null $releaseDate, string|null $coverImage, int|null $genreId, int|null $categoryId, int|null $ratingId)
  {
    $sql = 'UPDATE `Films` SET';
    if ($title != null) {
      $sql = $sql . '`title` = :title';
    }
    if ($sortTitle != null) {
      if ($sql !== 'UPDATE `Films` SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '`sortTitle` = :sortTitle';
    } else if ($title != null) {
      if ($sql !== 'UPDATE `Films` SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '`sortTitle` = :title';
    }
    if ($description != null) {
      if ($sql !== 'UPDATE `Films` SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '`description` = :description';
    }
    if ($runtime != null) {
      if ($sql !== 'UPDATE `Films` SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '`runtime` = :runtime';
    }
    if ($releaseDate != null) {
      if ($sql !== 'UPDATE `Films` SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '`releaseDate` = :releaseDate';
    }
    if ($coverImage != null) {
      if ($sql !== 'UPDATE `Films` SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '`coverImage` = :coverImage';
    }
    if ($genreId != null) {
      if ($sql !== 'UPDATE `Films` SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '`genreId` = :genreId';
    }
    if ($categoryId != null) {
      if ($sql !== 'UPDATE `Films` SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '`categoryId` = :categoryId';
    }
    if ($ratingId != null) {
      if ($sql !== 'UPDATE `Films` SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '`ratingId` = :ratingId';
    }

    if (is_int($currentFilm)) {
      $sql = $sql . ' WHERE `id` = :currentFilm';
    } else if (is_string($currentFilm)) {
      $sql = $sql . ' WHERE `title` = :currentFilm';
    } else {
      throw new InvalidTypeException;
    }

    $stmt = $this->pdo->prepare($sql);

    if ($title != null) {
      $stmt->bindValue(':title', $title);
    }
    if ($sortTitle != null) {
      $stmt->bindValue(':sortTitle', $sortTitle);
    }
    if ($description != null) {
      $stmt->bindValue(':description', $description);
    }
    if ($runtime != null) {
      $stmt->bindValue(':runtime', $runtime);
    }
    if ($releaseDate != null) {
      $stmt->bindValue(':releaseDate', $releaseDate);
    }
    if ($coverImage != null) {
      $stmt->bindValue(':coverImage', $coverImage);
    }
    if ($genreId != null) {
      $stmt->bindValue(':genreId', $genreId);
    }
    if ($categoryId != null) {
      $stmt->bindValue(':categoryId', $categoryId);
    }
    if ($ratingId != null) {
      $stmt->bindValue(':ratingId', $ratingId);
    }
    $stmt->bindValue(':currentFilm', $currentFilm);

    $stmt->execute();
  }

  public function removeFilm(int|string $film)
  {
    if (is_int($film)) {
      if ($this->getById($film) == null) {
        throw new DoesntExistException;
      }
      $sql = 'DELETE FROM `Films` WHERE `id` = :film';
    } else if (is_string($film)) {
      if ($this->getByTitle($film) == null) {
        throw new DoesntExistException;
      }
      $sql = 'DELETE FROM `Films` WHERE `title` = :film';
    } else {
      throw new InvalidTypeException;
    }

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':film', $film);
    $stmt->execute();
  }
}
