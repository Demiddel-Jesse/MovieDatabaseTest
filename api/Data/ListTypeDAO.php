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
<<<<<<< HEAD
    $sql = 'SELECT * FROM "ListTypes" WHERE "id" = :id';
=======
    $sql = "SELECT * FROM 'ListTypes' WHERE 'id' = :id";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
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
<<<<<<< HEAD
    $sql = 'SELECT * FROM "ListTypes" WHERE "name" = :name';
=======
    $sql = "SELECT * FROM 'ListTypes' WHERE 'name' = :name";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
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
<<<<<<< HEAD
    $sql = 'SELECT * FROM "ListTypes" ORDER BY "name" ASC';
=======
    $sql = "SELECT * FROM 'ListTypes' ORDER BY 'name' ASC";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
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
