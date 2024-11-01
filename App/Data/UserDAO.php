<?php

declare(strict_types=1);

namespace App\Data;

use App\Entities\User;
use App\Data\DBConfig;
use App\Exceptions\IsAdminUser;
use PDO;

class UserDAO
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

  public function getById(int $id): ?User
  {
    $sql = 'SELECT * FROM "Users" WHERE "id"=:id';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      return new User($userData['id'], $userData['username'], $userData['password'], $userData['email'], boolval($userData['admin']));
    }
    return null;
  }

  public function getByEmail(string $email): ?User
  {
    $sql = 'SELECT * FROM "Users" WHERE "email"=:email';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      return new User($userData['id'], $userData['username'], $userData['password'], $userData['email'], boolval($userData['admin']));
    }
    return null;
  }

  public function getByUserName(string $userName): ?User
  {
    $sql = 'SELECT * FROM "Users" WHERE "username"=:userName';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':userName', $userName);
    $stmt->execute();

    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      return new User($userData['id'], $userData['username'], $userData['password'], $userData['email'], boolval($userData['admin']));
    }
    return null;
  }

  public function createNewUser(string $username, string $password, string $email)
  {
    $sql = 'INSERT INTO "Users" ("username","password","email","admin") VALUES (:username, :password, :email, 0) ';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
  }

  public function updateUser(string $currentUser, string|null $newUsername, string|null $newPassword = null, string|null $newMail = null)
  {
    $sql = 'UPDATE "Users" SET';

    if ($newUsername != null) {
      $sql = $sql . ' "username" = :username ';
    }
    if ($newPassword != null) {
      if ($sql !== 'UPDATE "Users" SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . ' "password" = :password ';
    }
    if ($newMail != null) {
      if ($sql !== 'UPDATE "Users" SET') {
        $sql = $sql . ', ';
      }
      $sql = $sql . ' "email" = :email ';
    }

    $sql = $sql . ' WHERE "username" = :currentUser ;';

    $stmt = $this->pdo->prepare($sql);

    if ($newUsername != null) {
      $stmt->bindValue(':username', $newUsername);
    }
    if ($newPassword != null) {
      $stmt->bindValue(':password', $newPassword);
    }
    if ($newMail != null) {
      $stmt->bindValue(':email', $newMail);
    }

    $stmt->bindValue(':currentUser', $currentUser);


    $stmt->execute();
  }

  public function removeUser(string $username): void
  {
    $sql = 'DELETE FROM "Users" WHERE';
    $userObject = $this->getByUserName($username);
    print_r(file_exists('../Exceptions/IsAdminUser.php'));
    if ($userObject != null) {
      if ($userObject->getAdmin() == true) {
        throw new IsAdminUser;
      }
      $sql = $sql . ' "username" = :user';
    }
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':user', $username);

    $stmt->execute();
  }
}
