<?php

declare(strict_types=1);

namespace api\Data;

use api\Entities\ListType;
use api\Data\DBConfig;
use PDO;

class ListTypeDAO
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

  public function getById(int $id): ?ListType
  {
    $sql = "SELECT * FROM 'ListTypes' WHERE 'id' = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $listTypeData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      $copy = new ListType($listTypeData["id"], $listTypeData["name"]);
      return $copy;
    }
    return null;
  }

  public function getByName(string $name): ?ListType
  {
    $sql = "SELECT * FROM 'ListTypes' WHERE 'name' = :name";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":name", $name);
    $stmt->execute();
    $listTypeData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      $copy = new ListType($listTypeData["id"], $listTypeData["name"]);
      return $copy;
    }
    return null;
  }

  public function getAll(): array
  {
    $sql = "SELECT * FROM 'ListTypes' ORDER BY 'name' ASC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $listTypesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $listTypes = array();

    foreach ($listTypesData as $listTypeData) {
      array_push($listTypes, new ListType($listTypeData["id"], $listTypeData["name"]));
    }

    return $listTypes;
  }
}
