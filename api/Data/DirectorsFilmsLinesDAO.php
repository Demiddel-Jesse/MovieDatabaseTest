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
    $dsn = "host=" . $_ENV['PG_HOST'] . " port=" . $_ENV['PG_PORT'] . " dbname=" . $_ENV['PG_DB'];
    $user = $_ENV['PG_USER'];
    $password = $_ENV['PG_PASSWORD'];
    $this->pdo = new PDO(
      $dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
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
    $sql = 'SELECT * FROM `DirectorsFilmsLines` WHERE `id` = :id';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
      $line = new DirectorsFilmsLine($data['id'], $data['DirectorId'], $data['FilmId']);
      return $line;
    }
    return null;
  }

  public function getAllForDirectorId(int $directorId): array
  {
    $sql = 'SELECT * FROM `DirectorsFilmsLines` WHERE `DirectorId` = :directorId';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':directorId', $directorId);
    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $lines = array();
    foreach ($datas as $data) {
      $line = new DirectorsFilmsLine($data['id'], $data['DirectorId'], $data['FilmId']);
      array_push($lines, $line);
    }
    return $lines;
  }

  public function getAllForFilmId(int $filmId): array
  {
    $sql = 'SELECT * FROM `DirectorsFilmsLines` WHERE `FilmId` = :filmId';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':filmId', $filmId);

    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $lines = array();
    foreach ($datas as $data) {
      $line = new DirectorsFilmsLine($data['id'], $data['DirectorId'], $data['FilmId']);
      array_push($lines, $line);
    }
    return $lines;
  }

  public function createNewDirectorFilmLine(int $directorId, int $filmId)
  {
    $sql = 'INSERT INTO `DirectorsFilmsLines` (`DirectorId`,`FilmId`) VALUES (:directorId, :filmId)';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':filmId', $filmId);
    $stmt->bindValue(':directorId', $directorId);
    $stmt->execute();
  }

  public function removeDirectorFilmLine(int $id)
  {
    $sql = 'DELETE FROM `DirectorsFilmsLines` WHERE `id` = :id';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
  }
}
