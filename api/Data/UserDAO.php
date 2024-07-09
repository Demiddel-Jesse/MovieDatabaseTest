<?php

declare(strict_types=1);

namespace api\Data;

use api\Entities\User;
use api\Data\DBConfig;
use api\Exceptions\IsAdminUser;
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
<<<<<<< HEAD
    $sql = 'SELECT * FROM "Users" WHERE "id"=:id';
=======
    $sql = "SELECT * FROM 'Users' WHERE 'id'=:id";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      return new User($userData["id"], $userData["username"], $userData["password"], $userData["email"], boolval($userData["admin"]));
    }
    return null;
  }

  public function getByEmail(string $email): ?User
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "Users" WHERE "email"=:email';
=======
    $sql = "SELECT * FROM 'Users' WHERE 'email'=:email";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":email", $email);
    $stmt->execute();

    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      return new User($userData["id"], $userData["username"], $userData["password"], $userData["email"], boolval($userData["admin"]));
    }
    return null;
  }

  public function getByUserName(string $userName): ?User
  {
<<<<<<< HEAD
    $sql = 'SELECT * FROM "Users" WHERE "userName"=:userName';
=======
    $sql = "SELECT * FROM 'Users' WHERE 'userName'=:userName";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":userName", $userName);
    $stmt->execute();

    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      return new User($userData["id"], $userData["username"], $userData["password"], $userData["email"], boolval($userData["admin"]));
    }
    return null;
  }

  public function createNewUser(string $username, string $password, string $email)
  {
<<<<<<< HEAD
    $sql = 'INSERT INTO "Users" ("username","password","email","admin") VALUES (:username, :password, :email, 0) ';
=======
    $sql = "INSERT INTO 'Users' ('username','password','email','admin') VALUES (:username, :password, :email, 0) ";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":username", $username);
    $stmt->bindValue(":password", $password);
    $stmt->bindValue(":email", $email);
    $stmt->execute();
  }

  public function updateUser(string $currentUser, string|null $newUsername, string|null $newPassword = null, string|null $newMail = null)
  {
<<<<<<< HEAD
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
=======
    $sql = "UPDATE 'Users' SET";

    if ($newUsername != null) {
      $sql = $sql . " 'username' = :username ";
    }
    if ($newPassword != null) {
      if ($sql !== "UPDATE 'Users' SET") {
        $sql = $sql . ", ";
      }
      $sql = $sql . " 'password' = :password ";
    }
    if ($newMail != null) {
      if ($sql !== "UPDATE 'Users' SET") {
        $sql = $sql . ", ";
      }
      $sql = $sql . " 'email' = :email ";
    }

    $sql = $sql . " WHERE 'username' = :currentUser ;";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2

    $stmt = $this->pdo->prepare($sql);

    if ($newUsername != null) {
      $stmt->bindValue(":username", $newUsername);
    }
    if ($newPassword != null) {
      $stmt->bindValue(":password", $newPassword);
    }
    if ($newMail != null) {
      $stmt->bindValue(":email", $newMail);
    }

    $stmt->bindValue(":currentUser", $currentUser);


    $stmt->execute();
  }

  public function removeUser(string $username): void
  {
<<<<<<< HEAD
    $sql = 'DELETE FROM "Users" WHERE';
=======
    $sql = "DELETE FROM 'Users' WHERE";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    $userObject = $this->getByUserName($username);
    print_r(file_exists("../Exceptions/IsAdminUser.php"));
    if ($userObject != null) {
      if ($userObject->getAdmin() == true) {
        throw new IsAdminUser;
      }
<<<<<<< HEAD
      $sql = $sql . ' "username" = :user';
=======
      $sql = $sql . " 'username' = :user";
>>>>>>> 5d49a6cf0977f58cc23f956c486014b10f62afa2
    }
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":user", $username);

    $stmt->execute();
  }
}
