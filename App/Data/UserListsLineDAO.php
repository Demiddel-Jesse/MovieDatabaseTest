<?php

declare(strict_types=1);

namespace App\Data;

use App\Entities\UserListLine;
use App\Data\DBConfig;
use App\Exception\InvalidTypeException;
use PDO;

class UserListLineDAO
{
  private PDO $pdo;

  public function __construct()
  {
    $this->pdo = new PDO(
      DBConfig::$DB_CONNSTRING,
      DBConfig::$DB_USERNAME,
      DBConfig::$DB_PASSWORD
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
}
