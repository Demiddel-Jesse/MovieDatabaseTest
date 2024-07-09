<?php

declare(strict_types=1);

namespace api\Data;

use api\Entities\DirectorsFilmsLine;
use api\Entities\DirectorsFilmsLines;
use api\Data\DBConfig;
use PDO;

class DirectorsFilmsLinesDAO
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

  public function getById(int $id): ?DirectorsFilmsLine
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "DirectorsFilmsLines" WHERE "id" = :id';
=======
    $sql = "SELECT * FROM 'DirectorsFilmsLines' WHERE 'id' = :id";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
      $line = new DirectorsFilmsLine($data["id"], $data["DirectorId"], $data["FilmId"]);
      return $line;
    }
    return null;
  }

  public function getAllForDirectorId(int $directorId): array
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "DirectorsFilmsLines" WHERE "DirectorId" = :directorId';
=======
    $sql = "SELECT * FROM 'DirectorsFilmsLines' WHERE 'DirectorId' = :directorId";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":directorId", $directorId);
    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $lines = array();
    foreach ($datas as $data) {
      $line = new DirectorsFilmsLine($data["id"], $data["DirectorId"], $data["FilmId"]);
      array_push($lines, $line);
    }
    return $lines;
  }

  public function getAllForFilmId(int $filmId): array
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "DirectorsFilmsLines" WHERE "FilmId" = :filmId';
=======
    $sql = "SELECT * FROM 'DirectorsFilmsLines' WHERE 'FilmId' = :filmId";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":filmId", $filmId);

    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $lines = array();
    foreach ($datas as $data) {
      $line = new DirectorsFilmsLine($data["id"], $data["DirectorId"], $data["FilmId"]);
      array_push($lines, $line);
    }
    return $lines;
  }

  public function createNewDirectorFilmLine(int $directorId, int $filmId)
  {
<<<<<<< HEAD
    $sql = 'INSERT INTO "DirectorsFilmsLines" ("DirectorId","FilmId") VALUES (:directorId, :filmId)';
=======
    $sql = "INSERT INTO 'DirectorsFilmsLines' ('DirectorId','FilmId') VALUES (:directorId, :filmId)";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":filmId", $filmId);
    $stmt->bindValue(":directorId", $directorId);
    $stmt->execute();
  }

  public function removeDirectorFilmLine(int $id)
  {
<<<<<<< HEAD
    $sql = 'DELETE FROM "DirectorsFilmsLines" WHERE "id" = :id';
=======
    $sql = "DELETE FROM 'DirectorsFilmsLines' WHERE 'id' = :id";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
  }
}
