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
      $userListLine = new UserListsLine($userListLineData['id'], $userListLineData['UserId'], $userListLineData['FilmId'], $userListLineData['listTypeId'], $userListLineData['rating']);
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
      array_push($userListLines, new UserListsLine($userListLineData['id'], $userListLineData['UserId'], $userListLineData['FilmId'], $userListLineData['listTypeId'], $userListLineData['rating']));
    }

    return $userListLines;
  }
}
