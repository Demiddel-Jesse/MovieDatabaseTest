<?php

declare(strict_types=1);

namespace App\Entities;

class User
{
  private int $id;
  private string $username;
  private string $password;
  private string $email;
  private bool $admin;

  public function __construct(int $id, string $username, string $password, string $email, bool $admin)
  {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->email = $email;
    $this->admin = $admin;
  }

  public function getId()
  {
    return $this->id;
  }
  public function getUsername()
  {
    return $this->username;
  }
  public function getPassword()
  {
    return $this->password;
  }
  public function getEmail()
  {
    return $this->email;
  }
  public function getAdmin()
  {
    return $this->admin;
  }
}
