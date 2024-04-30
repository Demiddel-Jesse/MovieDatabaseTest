<?php

declare(strict_types=1);

namespace App\Data;

use App\Entities\UserListsLine;
use App\Data\DBConfig;
use App\Exception\InvalidTypeException;
use PDO;

class UserListsLineDAO
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

  public function getById(int $id): ?UserListsLine
  {
    $sql = 'SELECT * FROM `UserListsLines` WHERE `id` = :id';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $userListLineData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      $userListLine = new UserListsLine($userListLineData['id'], $userListLineData['UserId'], $userListLineData['FilmId'], $userListLineData['ListTypesId'], floatVal($userListLineData['rating']));
      return $userListLine;
    }
    return null;
  }

  public function getByUserAndFilmId(int $userId, int $filmId): ?UserListsLine
  {
    $sql = 'SELECT * FROM `UserListsLines` WHERE `UserId` = :userId AND `FilmId`  = :filmId';

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':filmId', $filmId);
    $stmt->execute();
    $userListLineData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      $userListLine = new UserListsLine($userListLineData['id'], $userListLineData['UserId'], $userListLineData['FilmId'], $userListLineData['ListTypesId'], floatVal($userListLineData['rating']));
      return $userListLine;
    }
    return null;
  }

  public function getAll(): array
  {
    $sql = 'SELECT * FROM `UserListsLines` ORDER BY `id` ASC';
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $userListLinesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $userListLines = array();

    foreach ($userListLinesData as $userListLineData) {
      array_push($userListLines, new UserListsLine($userListLineData['id'], $userListLineData['UserId'], $userListLineData['FilmId'], $userListLineData['ListTypesId'], floatVal($userListLineData['rating'])));
    }

    return $userListLines;
  }

  public function getAllForUserId(int $userId): array
  {
    $sql = 'SELECT * FROM `UserListsLines` WHERE `UserId` = :userId ORDER BY `id` ASC';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':userId', $userId);
    $stmt->execute();
    $userListLinesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $userListLines = array();

    foreach ($userListLinesData as $userListLineData) {
      array_push($userListLines, new UserListsLine($userListLineData['id'], $userListLineData['UserId'], $userListLineData['FilmId'], $userListLineData['ListTypesId'], floatVal($userListLineData['rating'])));
    }

    return $userListLines;
  }

  public function getAllForFilmId(int $filmId): array
  {
    $sql = 'SELECT * FROM `UserListsLines` WHERE `FilmId` = :filmId ORDER BY `id` ASC';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':filmId', $filmId);
    $stmt->execute();
    $userListLinesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $userListLines = array();

    foreach ($userListLinesData as $userListLineData) {
      array_push($userListLines, new UserListsLine($userListLineData['id'], $userListLineData['UserId'], $userListLineData['FilmId'], $userListLineData['ListTypesId'], floatVal($userListLineData['rating'])));
    }

    return $userListLines;
  }

  public function createNewUserListLine(int $userId, int $filmId, int $listTypeId, float $rating = null): void
  {
    $sql = 'INSERT INTO `UserListsLines`(`UserId`, `FilmId`, `rating`, `ListTypesId`) VALUES (:userId, :filmId, :rating, :listTypeId)';

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':filmId', $filmId);
    $stmt->bindValue(':rating', $rating);
    $stmt->bindValue(':listTypeId', $listTypeId);
    $stmt->execute();
  }

  public function updateRating(int $userId, int $filmId, float $rating): void
  {
    $sql = 'UPDATE `UserListsLines` SET `rating` = :rating WHERE `UserId` = :userId AND `FilmId`  = :filmId';

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':filmId', $filmId);
    $stmt->bindValue(':rating', $rating);
    $stmt->execute();
  }

  public function updateListType(int $userId, int $filmId, int $listType): void
  {
    $sql = 'UPDATE `UserListsLines` SET `ListTypesId` = :listType WHERE `UserId` = :userId AND `FilmId`  = :filmId';

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':filmId', $filmId);
    $stmt->bindValue(':listType', $listType);
    $stmt->execute();
  }

  public function removeLine(int $userId, int $filmId): void
  {
    $sql = 'DELETE FROM `UserListsLines` WHERE `UserId` = :userId AND `FilmId`  = :filmId';

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':filmId', $filmId);
    $stmt->execute();
  }
}
