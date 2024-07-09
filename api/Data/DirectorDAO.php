<?php

declare(strict_types=1);

namespace api\Data;

use api\Entities\Director;
use api\Data\DBConfig;
use PDO;

class DirectorDAO
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

  public function getById(int $id): ?Director
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "Directors" WHERE "id" = :id';
=======
    $sql = "SELECT * FROM 'Directors' WHERE 'id' = :id";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    $directorData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      if ($directorData["image"] == null) {
        $image = '<img alt="" . $directorData["firstName"] . " " . $directorData["lastName"] . "" src="~/img/placeholderPerson.jpg">';
      } else {
        $image = '<img alt="" . $directorData["firstName"] . " " .  $directorData["lastName"] . "" src="data:image/jpeg;base64," . base64_encode($directorData["image"]) . ""/>';
      }
      return new Director($directorData["id"], $directorData["firstName"], $directorData["lastName"], $image);
    }
    return null;
  }
  public function getByName(string $firstName, string $lastName): ?Director
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "Directors" WHERE "firstName" = :firstName AND "lastName" = :lastName';
=======
    $sql = "SELECT * FROM 'Directors' WHERE 'firstName' = :firstName AND 'lastName' = :lastName";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":firstName", $firstName);
    $stmt->bindValue(":lastName", $lastName);
    $stmt->execute();

    $directorData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      if ($directorData["image"] == null) {
        $image = '<img alt="" . $directorData["firstName"] . " " . $directorData["lastName"] . "" src="~/img/placeholderPerson.jpg">';
      } else {
        $image = '<img alt="" . $directorData["firstName"] . " " .  $directorData["lastName"] . "" src="data:image/jpeg;base64," . base64_encode($directorData["image"]) . ""/>';
      }
      return new Director($directorData["id"], $directorData["firstName"], $directorData["lastName"], $image);
    }
    return null;
  }
  public function getAll(): array
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "Directors" ORDER BY "lastName", "firstName" ASC';
=======
    $sql = "SELECT * FROM 'Directors' ORDER BY 'lastName', 'firstName' ASC";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();

    $directorsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $directors = array();

    foreach ($directorsData as $directorData) {
      if ($directorData["image"] == null) {
        $image = '<img alt="" . $directorData["firstName"] . " " . $directorData["lastName"] . "" src="~/img/placeholderPerson.jpg">';
      } else {
        $image = '<img alt="" . $directorData["firstName"] . " " .  $directorData["lastName"] . "" src="data:image/jpeg;base64," . base64_encode($directorData["image"]) . ""/>';
      }
      array_push($directors, new Director($directorData["id"], $directorData["firstName"], $directorData["lastName"], $image));
    }
    return $directors;
  }
  public function createNewDirector(string $firstName, string $lastName, string|null $imagePath): void
  {
    if ($imagePath != null) {
      $image = file_get_contents($imagePath, true);
    } else {
      $image = null;
    }

<<<<<<< HEAD
    $sql = 'INSERT INTO "Directors" ("firstName", "lastName", "image") VALUES (:firstName, :lastName, :image)';
=======
    $sql = "INSERT INTO 'Directors' ('firstName', 'lastName', 'image') VALUES (:firstName, :lastName, :image)";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":firstName", $firstName);
    $stmt->bindValue(":lastName", $lastName);
    $stmt->bindValue(":image", $image);
    $stmt->execute();
  }

  public function updateDirector(int $id, string|null $firstName, string|null $lastName, string|null $imagePath): void
  {
    if ($imagePath != null) {
      $image = file_get_contents($imagePath, true);
    } else {
      $image = null;
    }

<<<<<<< HEAD
    $sql = 'UPDATE "Directors" SET';

    if ($firstName != null) {
      $sql = $sql . ' "firstName" = :firstName ';
    }
    if ($lastName != null) {
      if ($sql !== 'UPDATE "Directors" SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . ' "lastName" = :lastName ';
    }
    if ($image != null) {
      if ($sql !== 'UPDATE "Directors" SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . ' "image" = :image ';
    }

    $sql = $sql . 'WHERE "id" = :id';
=======
    $sql = "UPDATE 'Directors' SET";

    if ($firstName != null) {
      $sql = $sql . " 'firstName' = :firstName ";
    }
    if ($lastName != null) {
      if ($sql !== "UPDATE 'Directors' SET") {
        $sql = $sql . ", ";
      }
      $sql = $sql . " 'lastName' = :lastName ";
    }
    if ($image != null) {
      if ($sql !== "UPDATE 'Directors' SET") {
        $sql = $sql . ", ";
      }
      $sql = $sql . " 'image' = :image ";
    }

    $sql = $sql . "WHERE 'id' = :id";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
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

  public function removeDirector(int $id): void
  {
<<<<<<< HEAD
    $sql = 'DELETE FROM "Directors" WHERE "id" = :id';
=======
    $sql = "DELETE FROM 'Directors' WHERE 'id' = :id";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
  }

  // this is how images should be got
  public function testGetImage()
  {
<<<<<<< HEAD
    $sql = 'SELECT "image" FROM "Directors" WHERE "id" = 2';
=======
    $sql = "SELECT 'image' FROM 'Directors' WHERE 'id' = 2";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $return = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($return);
    print_r('<img src="data:image/jpeg;base64," . base64_encode($return["image"]) . ""/>');
  }
}
