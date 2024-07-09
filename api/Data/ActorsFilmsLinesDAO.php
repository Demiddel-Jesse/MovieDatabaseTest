<?php

declare(strict_types=1);

namespace api\Data;

use api\Entities\ActorsFilmsLine;
use api\Entities\ActorsFilmsLines;
use api\Data\DBConfig;
use PDO;

class ActorsFilmsLinesDAO
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

  public function getById(int $id): ?ActorsFilmsLine
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "ActorsFilmsLines" WHERE "id" = :id';
=======
    $sql = "SELECT * FROM 'ActorsFilmsLines' WHERE 'id' = :id";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
      $line = new ActorsFilmsLine($data["id"], $data["ActorId"], $data["FilmId"]);
      return $line;
    }
    return null;
  }

  public function getAllForActorId(int $actorId): array
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "ActorsFilmsLines" WHERE "ActorId" = :actorId';
=======
    $sql = "SELECT * FROM 'ActorsFilmsLines' WHERE 'ActorId' = :actorId";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":actorId", $actorId);
    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $lines = array();
    foreach ($datas as $data) {
      $line = new ActorsFilmsLine($data["id"], $data["ActorId"], $data["FilmId"]);
      array_push($lines, $line);
    }
    return $lines;
  }

  public function getAllForFilmId(int $filmId): array
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "ActorsFilmsLines" WHERE "FilmId" = :filmId';
=======
    $sql = "SELECT * FROM 'ActorsFilmsLines' WHERE 'FilmId' = :filmId";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":filmId", $filmId);

    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $lines = array();
    foreach ($datas as $data) {
      $line = new ActorsFilmsLine($data["id"], $data["ActorId"], $data["FilmId"]);
      array_push($lines, $line);
    }
    return $lines;
  }

  public function createNewActorFilmLine(int $actorId, int $filmId)
  {
<<<<<<< HEAD
    $sql = 'INSERT INTO "ActorsFilmsLines" ("ActorId","FilmId") VALUES (:actorId, :filmId)';
=======
    $sql = "INSERT INTO 'ActorsFilmsLines' ('ActorId','FilmId') VALUES (:actorId, :filmId)";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":filmId", $filmId);
    $stmt->bindValue(":actorId", $actorId);
    $stmt->execute();
  }

  public function removeActorFilmLine(int $id)
  {
<<<<<<< HEAD
    $sql = 'DELETE FROM "ActorsFilmsLines" WHERE "id" = :id';
=======
    $sql = "DELETE FROM 'ActorsFilmsLines' WHERE 'id' = :id";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
  }
}
