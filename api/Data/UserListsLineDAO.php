<?php

declare(strict_types=1);

namespace api\Data;

use api\Entities\UserListsLine;
use api\Data\DBConfig;
use PDO;

class UserListsLineDAO
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

  public function getById(int $id): ?UserListsLine
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "UserListsLines" WHERE "id" = :id';
=======
    $sql = "SELECT * FROM 'UserListsLines' WHERE 'id' = :id";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $userListLineData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      $userListLine = new UserListsLine($userListLineData["id"], $userListLineData["UserId"], $userListLineData["FilmId"], $userListLineData["ListTypesId"], floatVal($userListLineData["rating"]));
      return $userListLine;
    }
    return null;
  }

  public function getByUserAndFilmId(int $userId, int $filmId): ?UserListsLine
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "UserListsLines" WHERE "UserId" = :userId AND "FilmId"  = :filmId';
=======
    $sql = "SELECT * FROM 'UserListsLines' WHERE 'UserId' = :userId AND 'FilmId'  = :filmId";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":userId", $userId);
    $stmt->bindValue(":filmId", $filmId);
    $stmt->execute();
    $userListLineData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      $userListLine = new UserListsLine($userListLineData["id"], $userListLineData["UserId"], $userListLineData["FilmId"], $userListLineData["ListTypesId"], floatVal($userListLineData["rating"]));
      return $userListLine;
    }
    return null;
  }

  public function getAll(): array
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "UserListsLines" ORDER BY "id" ASC';
=======
    $sql = "SELECT * FROM 'UserListsLines' ORDER BY 'id' ASC";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $userListLinesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $userListLines = array();

    foreach ($userListLinesData as $userListLineData) {
      array_push($userListLines, new UserListsLine($userListLineData["id"], $userListLineData["UserId"], $userListLineData["FilmId"], $userListLineData["ListTypesId"], floatVal($userListLineData["rating"])));
    }

    return $userListLines;
  }

  public function getAllForUserId(int $userId): array
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "UserListsLines" WHERE "UserId" = :userId ORDER BY "id" ASC';
=======
    $sql = "SELECT * FROM 'UserListsLines' WHERE 'UserId' = :userId ORDER BY 'id' ASC";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":userId", $userId);
    $stmt->execute();
    $userListLinesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $userListLines = array();

    foreach ($userListLinesData as $userListLineData) {
      array_push($userListLines, new UserListsLine($userListLineData["id"], $userListLineData["UserId"], $userListLineData["FilmId"], $userListLineData["ListTypesId"], floatVal($userListLineData["rating"])));
    }

    return $userListLines;
  }

  public function getAllForUserIdAndListId(int $userId, int $listId): array
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "UserListsLines" WHERE "UserId" = :userId AND "ListTypesId" = :listId ORDER BY "id" ASC';
=======
    $sql = "SELECT * FROM 'UserListsLines' WHERE 'UserId' = :userId AND 'ListTypesId' = :listId ORDER BY 'id' ASC";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":userId", $userId);
    $stmt->bindValue(":listId", $listId);
    $stmt->execute();
    $userListLinesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $userListLines = array();

    foreach ($userListLinesData as $userListLineData) {
      array_push($userListLines, new UserListsLine($userListLineData["id"], $userListLineData["UserId"], $userListLineData["FilmId"], $userListLineData["ListTypesId"], floatVal($userListLineData["rating"])));
    }

    return $userListLines;
  }

  public function getAllForFilmId(int $filmId): array
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "UserListsLines" WHERE "FilmId" = :filmId ORDER BY "id" ASC';
=======
    $sql = "SELECT * FROM 'UserListsLines' WHERE 'FilmId' = :filmId ORDER BY 'id' ASC";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":filmId", $filmId);
    $stmt->execute();
    $userListLinesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $userListLines = array();

    foreach ($userListLinesData as $userListLineData) {
      array_push($userListLines, new UserListsLine($userListLineData["id"], $userListLineData["UserId"], $userListLineData["FilmId"], $userListLineData["ListTypesId"], floatVal($userListLineData["rating"])));
    }

    return $userListLines;
  }

  public function createNewUserListLine(int $userId, int $filmId, int $listTypeId, float $rating = null): void
  {
<<<<<<< HEAD
    $sql = 'INSERT INTO "UserListsLines"("UserId", "FilmId", "rating", "ListTypesId") VALUES (:userId, :filmId, :rating, :listTypeId)';
=======
    $sql = "INSERT INTO 'UserListsLines'('UserId', 'FilmId', 'rating', 'ListTypesId') VALUES (:userId, :filmId, :rating, :listTypeId)";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":userId", $userId);
    $stmt->bindValue(":filmId", $filmId);
    $stmt->bindValue(":rating", $rating);
    $stmt->bindValue(":listTypeId", $listTypeId);
    $stmt->execute();
  }

  public function updateRating(int $userId, int $filmId, float $rating): void
  {
<<<<<<< HEAD
    $sql = 'UPDATE "UserListsLines" SET "rating" = :rating WHERE "UserId" = :userId AND "FilmId"  = :filmId';
=======
    $sql = "UPDATE 'UserListsLines' SET 'rating' = :rating WHERE 'UserId' = :userId AND 'FilmId'  = :filmId";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":userId", $userId);
    $stmt->bindValue(":filmId", $filmId);
    $stmt->bindValue(":rating", $rating);
    $stmt->execute();
  }

  public function updateListType(int $userId, int $filmId, int $listType): void
  {
<<<<<<< HEAD
    $sql = 'UPDATE "UserListsLines" SET "ListTypesId" = :listType WHERE "UserId" = :userId AND "FilmId"  = :filmId';
=======
    $sql = "UPDATE 'UserListsLines' SET 'ListTypesId' = :listType WHERE 'UserId' = :userId AND 'FilmId'  = :filmId";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":userId", $userId);
    $stmt->bindValue(":filmId", $filmId);
    $stmt->bindValue(":listType", $listType);
    $stmt->execute();
  }

  public function removeLine(int $userId, int $filmId): void
  {
<<<<<<< HEAD
    $sql = 'DELETE FROM "UserListsLines" WHERE "UserId" = :userId AND "FilmId"  = :filmId';
=======
    $sql = "DELETE FROM 'UserListsLines' WHERE 'UserId' = :userId AND 'FilmId'  = :filmId";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":userId", $userId);
    $stmt->bindValue(":filmId", $filmId);
    $stmt->execute();
  }
}
