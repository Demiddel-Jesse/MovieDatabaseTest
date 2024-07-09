<?php

declare(strict_types=1);

namespace api\Business;

use api\Data\UserDAO;
use api\Entities\User;
use api\Exceptions\DoesntExistException;
use api\Exceptions\EmailInUseException;
use api\Exceptions\InvalidTypeException;
use api\Exceptions\PasswordIncorrectException;
use api\Exceptions\UsernameInUseException;

class UserService
{
  private $userDAO;

  public function __construct()
  {
    $this->userDAO = new UserDAO();
  }

  public function getUser(string|int $user): ?User
  {
    if (is_int($user)) {
      return $this->userDAO->getById($user);
    } else if (is_string($user)) {
      if ($this->userDAO->getByEmail($user) != null) {
        return $this->userDAO->getByEmail($user);
      } else {
        return $this->userDAO->getByUserName($user);
      }
    } else {
      throw new InvalidTypeException;
    }
  }

  public function register(string $username, string $password, string $email)
  {
    if ($this->userDAO->getByEmail($email) != null) {
      throw new EmailInUseException;
    } else if ($this->userDAO->getByUserName($username) != null) {
      throw new UsernameInUseException;
    } else {
      $this->userDAO->createNewUser($username, password_hash($password, PASSWORD_DEFAULT), $email);
    }
  }

  public function login(string $user, string $password): User
  {
    if ($this->userDAO->getByEmail($user) != null) {
      $user = $this->userDAO->getByEmail($user);
    } else if ($this->userDAO->getByUserName($user) != null) {
      $user = $this->userDAO->getByUserName($user);
    } else {
      throw new DoesntExistException;
    }

    if (password_verify($password, $user->getPassword())) {
      return $user;
    } else {
      throw new PasswordIncorrectException;
    }
  }

  public function delete(string|int $user)
  {
    if (is_int($user)) {
      $this->userDAO->removeUser($this->userDAO->getById($user)->getUsername());
    } else if (is_string(value: $user)) {
      if ($this->userDAO->getByEmail($user) != null) {
        $this->userDAO->removeUser($this->userDAO->getByEmail($user)->getUsername());
      } else {
        $this->userDAO->removeUser($user);
      }
    } else {
      throw new InvalidTypeException;
    }
  }
}
