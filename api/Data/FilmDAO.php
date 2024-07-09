<?php

declare(strict_types=1);

namespace api\Data;

use api\Entities\Film;
use api\Data\DBConfig;
use api\Exceptions\DoesntExistException;
use api\Exceptions\InvalidTypeException;
use DateTime;
use PDO;

class FilmDAO
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

  public function getById(int $id): ?Film
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "Films" WHERE "id" = :id;';
=======
    $sql = "SELECT * FROM 'Films' WHERE 'id' = :id;";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    $filmData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      $dateTime = null;
      if ($filmData["releaseDate"] != null) {
        $dateTime = new DateTime($filmData["releaseDate"]);
      }
      $film = new Film($filmData["id"], $filmData["title"], $filmData["ratingId"], $filmData["description"], $filmData["runtime"], $dateTime, $filmData["coverImage"], $filmData["genreId"], $filmData["categoryId"], $filmData["sortTitle"]);
      return $film;
    }
    return null;
  }

  public function getByTitle(string $title): ?Film
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "Films" WHERE "title" LIKE :title;';
=======
    $sql = "SELECT * FROM 'Films' WHERE 'title' LIKE :title;";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":title", "%" . $title . "%");
    $stmt->execute();

    $filmData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      $dateTime = null;
      if ($filmData["releaseDate"] != null) {
        $dateTime = new DateTime($filmData["releaseDate"]);
      }
      $film = new Film($filmData["id"], $filmData["title"], $filmData["ratingId"], $filmData["description"], $filmData["runtime"], $dateTime, $filmData["coverImage"], $filmData["genreId"], $filmData["categoryId"], $filmData["sortTitle"]);
      return $film;
    }
    return null;
  }

  public function getAll(): array
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "Films" ORDER BY "sortTitle" ASC';
=======
    $sql = "SELECT * FROM Films ORDER BY sortTitle ASC";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();

    $filmsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $films = array();
    foreach ($filmsData as $filmData) {
      $dateTime = null;
      if ($filmData["releaseDate"] != null) {
        $dateTime = new DateTime($filmData["releaseDate"]);
      }
      $film = new Film($filmData["id"], $filmData["title"], $filmData["ratingId"], $filmData["description"], $filmData["runtime"], $dateTime, $filmData["coverImage"], $filmData["genreId"], $filmData["categoryId"], $filmData["sortTitle"]);

      array_push($films, $film);
    }
    return $films;
  }

  public function createFilm(string $title, string|null $sortTitle, string|null $description, int|null $runtime, string|null $releaseDate, string|null $coverImage, int|null $genreId, int|null $categoryId, int $ratingId)
  {
<<<<<<< HEAD
    $sql = 'INSERT INTO "Films"("title", "sortTitle", "description", "runtime", "releaseDate", "coverImage", "genreId", "categoryId", "ratingId") VALUES (:title,:sortTitle,:description,:runtime,:releaseDate,:coverImage,:genreId,:categoryId,:ratingId);';
=======
    $sql = "INSERT INTO 'Films'('title', 'sortTitle', 'description', 'runtime', 'releaseDate', 'coverImage', 'genreId', 'categoryId', 'ratingId') VALUES (:title,:sortTitle,:description,:runtime,:releaseDate,:coverImage,:genreId,:categoryId,:ratingId);";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":title", $title);
    if ($sortTitle == null) {
      $stmt->bindValue(":sortTitle", $title);
    } else {
      $stmt->bindValue(":sortTitle", $sortTitle);
    }
    $stmt->bindValue(":description", $description);
    $stmt->bindValue(":runtime", $runtime);
    $stmt->bindValue(":releaseDate", $releaseDate);
    $stmt->bindValue(":coverImage", $coverImage);
    $stmt->bindValue(":genreId", $genreId);
    $stmt->bindValue(":categoryId", $categoryId);
    $stmt->bindValue(":ratingId", $ratingId);

    $stmt->execute();
  }

  public function updateFilm(int|string $currentFilm, string|null $title, string|null $sortTitle, string|null $description, int|null $runtime, string|null $releaseDate, string|null $coverImage, int|null $genreId, int|null $categoryId, int|null $ratingId)
  {
<<<<<<< HEAD
    $sql = 'UPDATE "Films" SET';
    if ($title != null) {
      $sql = $sql . '"title" = :title';
    }
    if ($sortTitle != null) {
      if ($sql !== 'UPDATE "Films" SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '"sortTitle" = :sortTitle';
    } else if ($title != null) {
      if ($sql !== 'UPDATE "Films" SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '"sortTitle" = :title';
    }
    if ($description != null) {
      if ($sql !== 'UPDATE "Films" SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '"description" = :description';
    }
    if ($runtime != null) {
      if ($sql !== 'UPDATE "Films" SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '"runtime" = :runtime';
    }
    if ($releaseDate != null) {
      if ($sql !== 'UPDATE "Films" SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '"releaseDate" = :releaseDate';
    }
    if ($coverImage != null) {
      if ($sql !== 'UPDATE "Films" SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '"coverImage" = :coverImage';
    }
    if ($genreId != null) {
      if ($sql !== 'UPDATE "Films" SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '"genreId" = :genreId';
    }
    if ($categoryId != null) {
      if ($sql !== 'UPDATE "Films" SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '"categoryId" = :categoryId';
    }
    if ($ratingId != null) {
      if ($sql !== 'UPDATE "Films" SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . '"ratingId" = :ratingId';
    }

    if (is_int($currentFilm)) {
      $sql = $sql . ' WHERE "id" = :currentFilm';
    } else if (is_string($currentFilm)) {
      $sql = $sql . ' WHERE "title" = :currentFilm';
=======
    $sql = "UPDATE 'Films' SET";
    if ($title != null) {
      $sql = $sql . "'title' = :title";
    }
    if ($sortTitle != null) {
      if ($sql !== "UPDATE 'Films' SET") {
        $sql = $sql . ", ";
      }
      $sql = $sql . "'sortTitle' = :sortTitle";
    } else if ($title != null) {
      if ($sql !== "UPDATE 'Films' SET") {
        $sql = $sql . ", ";
      }
      $sql = $sql . "'sortTitle' = :title";
    }
    if ($description != null) {
      if ($sql !== "UPDATE 'Films' SET") {
        $sql = $sql . ", ";
      }
      $sql = $sql . "'description' = :description";
    }
    if ($runtime != null) {
      if ($sql !== "UPDATE 'Films' SET") {
        $sql = $sql . ", ";
      }
      $sql = $sql . "'runtime' = :runtime";
    }
    if ($releaseDate != null) {
      if ($sql !== "UPDATE 'Films' SET") {
        $sql = $sql . ", ";
      }
      $sql = $sql . "'releaseDate' = :releaseDate";
    }
    if ($coverImage != null) {
      if ($sql !== "UPDATE 'Films' SET") {
        $sql = $sql . ", ";
      }
      $sql = $sql . "'coverImage' = :coverImage";
    }
    if ($genreId != null) {
      if ($sql !== "UPDATE 'Films' SET") {
        $sql = $sql . ", ";
      }
      $sql = $sql . "'genreId' = :genreId";
    }
    if ($categoryId != null) {
      if ($sql !== "UPDATE 'Films' SET") {
        $sql = $sql . ", ";
      }
      $sql = $sql . "'categoryId' = :categoryId";
    }
    if ($ratingId != null) {
      if ($sql !== "UPDATE 'Films' SET") {
        $sql = $sql . ", ";
      }
      $sql = $sql . "'ratingId' = :ratingId";
    }

    if (is_int($currentFilm)) {
      $sql = $sql . " WHERE 'id' = :currentFilm";
    } else if (is_string($currentFilm)) {
      $sql = $sql . " WHERE 'title' = :currentFilm";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    } else {
      throw new InvalidTypeException;
    }

    $stmt = $this->pdo->prepare($sql);

    if ($title != null) {
      $stmt->bindValue(":title", $title);
    }
    if ($sortTitle != null) {
      $stmt->bindValue(":sortTitle", $sortTitle);
    }
    if ($description != null) {
      $stmt->bindValue(":description", $description);
    }
    if ($runtime != null) {
      $stmt->bindValue(":runtime", $runtime);
    }
    if ($releaseDate != null) {
      $stmt->bindValue(":releaseDate", $releaseDate);
    }
    if ($coverImage != null) {
      $stmt->bindValue(":coverImage", $coverImage);
    }
    if ($genreId != null) {
      $stmt->bindValue(":genreId", $genreId);
    }
    if ($categoryId != null) {
      $stmt->bindValue(":categoryId", $categoryId);
    }
    if ($ratingId != null) {
      $stmt->bindValue(":ratingId", $ratingId);
    }
    $stmt->bindValue(":currentFilm", $currentFilm);

    $stmt->execute();
  }

  public function removeFilm(int|string $film)
  {
    if (is_int($film)) {
      if ($this->getById($film) == null) {
        throw new DoesntExistException;
      }
<<<<<<< HEAD
      $sql = 'DELETE FROM "Films" WHERE "id" = :film';
=======
      $sql = "DELETE FROM 'Films' WHERE 'id' = :film";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    } else if (is_string($film)) {
      if ($this->getByTitle($film) == null) {
        throw new DoesntExistException;
      }
<<<<<<< HEAD
      $sql = 'DELETE FROM "Films" WHERE "title" = :film';
=======
      $sql = "DELETE FROM 'Films' WHERE 'title' = :film";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    } else {
      throw new InvalidTypeException;
    }

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":film", $film);
    $stmt->execute();
  }

  public function searchFilms(string $searchString): ?array
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "Films" WHERE "title" LIKE :searchString ORDER BY "sortTitle" ASC';
=======
    $sql = "SELECT * FROM 'Films' WHERE 'title' LIKE :searchString ORDER BY 'sortTitle' ASC";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":searchString", "%" . $searchString . "%");
    $stmt->execute();

    $filmsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
      $films = array();
      foreach ($filmsData as $filmData) {
        $dateTime = null;
        if ($filmData["releaseDate"] != null) {
          $dateTime = new DateTime($filmData["releaseDate"]);
        }
        $film = new Film($filmData["id"], $filmData["title"], $filmData["ratingId"], $filmData["description"], $filmData["runtime"], $dateTime, $filmData["coverImage"], $filmData["genreId"], $filmData["categoryId"], $filmData["sortTitle"]);

        array_push($films, $film);
      }
      return $films;
    } else {
      return null;
    }
  }
}
