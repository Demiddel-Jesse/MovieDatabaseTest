<?php

declare(strict_types=1);

namespace App\Data;

use App\Entities\Category;
use App\Data\DBConfig;
use App\Exceptions\AlreadyExistException;
use App\Exceptions\DoesntExistException;
use App\Exceptions\InvalidTypeException;
use PDO;

class CategoryDAO
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

  public function getById(int $id): ?Category
  {
    $sql = 'SELECT * FROM "Categories" WHERE "id" = :id';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $categoryData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      $copy = new Category($categoryData['id'], $categoryData['name']);
      return $copy;
    }
    return null;
  }

  public function getByName(string $name): ?Category
  {
    $sql = 'SELECT * FROM "Categories" WHERE "name" = :name';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->execute();
    $categoryData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      $copy = new Category($categoryData['id'], $categoryData['name']);
      return $copy;
    }
    return null;
  }

  public function getAll(): array
  {
    $sql = 'SELECT * FROM "Categories"';
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $categoriesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $categories = array();

    foreach ($categoriesData as $categoryData) {
      array_push($categories, new Category($categoryData['id'], $categoryData['name']));
    }

    return $categories;
  }

  public function createNewCategory(string $name): void
  {
    if ($this->getByName($name) != null) {
      throw new AlreadyExistException;
    } else {
      $sql = 'INSERT INTO "Categories"("name") VALUES (:name)';
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':name', $name);
      $stmt->execute();
    }
  }
  public function updateCategory(string|int $lookup, string $name): void
  {
    if (is_int($lookup)) {
      if ($this->getById($lookup) != null) {
        $sql = 'UPDATE "Categories" SET "name" = :name WHERE "id" = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $lookup);
        $stmt->bindValue(':name', $name);
      } else {
        throw new DoesntExistException;
      }
    } else if (is_string($lookup)) {
      if ($this->getByName($lookup) != null) {
        $sql = 'UPDATE "Categories" SET "name" = :name WHERE "name" = :lookupName';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':lookupName', $lookup);
        $stmt->bindValue(':name', $name);
      } else {
        throw new DoesntExistException;
      }
    } else {
      throw new InvalidTypeException;
    }

    $stmt->execute();
  }

  public function removeCategory(string|int $lookup): void
  {
    if (is_int($lookup)) {
      if ($this->getById($lookup) != null) {
        $sql = 'DELETE FROM "Categories" WHERE "id" = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $lookup);
      } else {
        throw new DoesntExistException;
      }
    } else if (is_string($lookup)) {
      if ($this->getByName($lookup) != null) {
        $sql = 'DELETE FROM "Categories" WHERE "name" = :lookupName;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':lookupName', $lookup);
      } else {
        throw new DoesntExistException;
      }
    } else {
      throw new InvalidTypeException;
    }

    $stmt->execute();
  }
}
