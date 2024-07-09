<?php

declare(strict_types=1);

namespace api\Data;

use api\Entities\Actor;
use api\Data\DBConfig;
use PDO;

class ActorDAO
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

  public function getById(int $id): ?Actor
  {
    $sql = "SELECT * FROM 'Actors' WHERE 'id' = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    $actorData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      if ($actorData["image"] == null) {
        $image = '<img alt="" . $actorData["firstName"] . " " . $actorData["lastName"] . "" src="~/img/placeholderPerson.jpg">';
      } else {
        $image = '<img alt="" . $actorData["firstName"] . " " .  $actorData["lastName"] . "" src="data:image/jpeg;base64," . base64_encode($actorData["image"]) . ""/>';
      }
      return new Actor($actorData["id"], $actorData["firstName"], $actorData["lastName"], $image);
    }
    return null;
  }
  public function getByName(string $firstName, string $lastName): ?Actor
  {
    $sql = "SELECT * FROM 'Actors' WHERE 'firstName' = :firstName AND 'lastName' = :lastName";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":firstName", $firstName);
    $stmt->bindValue(":lastName", $lastName);
    $stmt->execute();

    $actorData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      if ($actorData["image"] == null) {
        $image = '<img alt="" . $actorData["firstName"] . " " . $actorData["lastName"] . "" src="~/img/placeholderPerson.jpg">';
      } else {
        $image = '<img alt="" . $actorData["firstName"] . " " .  $actorData["lastName"] . "" src="data:image/jpeg;base64," . base64_encode($actorData["image"]) . ""/>';
      }
      return new Actor($actorData["id"], $actorData["firstName"], $actorData["lastName"], $image);
    }
    return null;
  }
  public function getAll(): array
  {
    $sql = "SELECT * FROM 'Actors' ORDER BY 'lastName', 'firstName' ASC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();

    $actorsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $actors = array();

    foreach ($actorsData as $actorData) {
      if ($actorData["image"] == null) {
        $image = '<img alt="" . $actorData["firstName"] . " " . $actorData["lastName"] . "" src="~/img/placeholderPerson.jpg">';
      } else {
        $image = '<img alt="" . $actorData["firstName"] . " " .  $actorData["lastName"] . "" src="data:image/jpeg;base64," . base64_encode($actorData["image"]) . ""/>';
      }
      array_push($actors, new Actor($actorData["id"], $actorData["firstName"], $actorData["lastName"], $image));
    }
    return $actors;
  }
  public function createNewActor(string $firstName, string $lastName, string|null $imagePath): void
  {
    if ($imagePath != null) {
      $image = file_get_contents($imagePath, true);
    } else {
      $image = null;
    }

    $sql = "INSERT INTO 'Actors' ('firstName', 'lastName', 'image') VALUES (:firstName, :lastName, :image)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":firstName", $firstName);
    $stmt->bindValue(":lastName", $lastName);
    $stmt->bindValue(":image", $image);
    $stmt->execute();
  }

  public function updateActor(int $id, string|null $firstName, string|null $lastName, string|null $imagePath): void
  {
    if ($imagePath != null) {
      $image = file_get_contents($imagePath, true);
    } else {
      $image = null;
    }

    $sql = "UPDATE 'Actors' SET";

    if ($firstName != null) {
      $sql = $sql . " 'firstName' = :firstName ";
    }
    if ($lastName != null) {
      if ($sql !== "UPDATE 'Actors' SET") {
        $sql = $sql . ", ";
      }
      $sql = $sql . " 'lastName' = :lastName ";
    }
    if ($image != null) {
      if ($sql !== "UPDATE 'Actors' SET") {
        $sql = $sql . ", ";
      }
      $sql = $sql . " 'image' = :image ";
    }

    $sql = $sql . "WHERE 'id' = :id";
    $stmt = $this->pdo->prepare($sql);

    if ($firstName != null) {
      $stmt->bindValue("firstName", $firstName);
    }
    if ($lastName != null) {
      $stmt->bindValue("lastName", $lastName);
    }
    if ($image != null) {
      $stmt->bindValue("image", $image);
    }

    $stmt->bindValue(":id", $id);

    $stmt->execute();
  }

  public function removeActor(int $id): void
  {
    $sql = "DELETE FROM 'Actors' WHERE 'id' = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
  }

  // this is how images should be got
  public function testGetImage()
  {
    $sql = "SELECT 'image' FROM 'Directors'";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $return = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r('<img src="data:image/jpeg;base64," . base64_encode($return["image"]) . ""/>');
  }
}
