<?php

declare(strict_types=1);

namespace App\Data;

use App\Entities\ActorsFilmsLine;
use App\Entities\ActorsFilmsLines;
use App\Data\DBConfig;
use PDO;

class ActorsFilmsLinesDAO
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

  public function getById(int $id): ?ActorsFilmsLine
  {
    $sql = 'SELECT * FROM `ActorsFilmsLines` WHERE `id` = :id';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
      $line = new ActorsFilmsLine($data['id'], $data['ActorId'], $data['FilmId']);
      return $line;
    }
    return null;
  }

  public function getAllForActorId(int $actorId): array
  {
    $sql = 'SELECT * FROM `ActorsFilmsLines` WHERE `ActorId` = :actorId';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':actorId', $actorId);
    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $lines = array();
    foreach ($datas as $data) {
      $line = new ActorsFilmsLine($data['id'], $data['ActorId'], $data['FilmId']);
      array_push($lines, $line);
    }
    return $lines;
  }

  public function getAllForFilmId(int $filmId): array
  {
    $sql = 'SELECT * FROM `ActorsFilmsLines` WHERE `FilmId` = :filmId';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':filmId', $filmId);

    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $lines = array();
    foreach ($datas as $data) {
      $line = new ActorsFilmsLine($data['id'], $data['ActorId'], $data['FilmId']);
      array_push($lines, $line);
    }
    return $lines;
  }

  public function createNewActorFilmLine(int $actorId, int $filmId)
  {
    $sql = 'INSERT INTO `ActorsFilmsLines` (`ActorId`,`FilmId`) VALUES (:actorId, :filmId)';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':filmId', $filmId);
    $stmt->bindValue(':actorId', $actorId);
    $stmt->execute();
  }

  public function removeActorFilmLine(int $id)
  {
    $sql = 'DELETE FROM `ActorsFilmsLines` WHERE `id` = :id';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
  }
}
