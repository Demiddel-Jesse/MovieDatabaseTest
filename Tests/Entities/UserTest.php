<?php

declare(strict_types=1);

use api\Entities\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
  private $data;
  private $object;

  public function setUp(): void
  {
    $this->data = ['id' => 1, 'username' => 'joskeVer', 'password' => 'joske123', 'email' => 'joske@mail.com', 'admin' => true];
    $this->object = new User($this->data['id'], $this->data['username'], $this->data['password'], $this->data['email'], $this->data['admin']);
  }

  public function test_getId()
  {
    $this->assertEquals($this->data['id'], $this->object->getId());
  }
  public function test_getUsername()
  {
    $this->assertEquals($this->data['username'], $this->object->getUsername());
  }
  public function test_getPassword()
  {
    $this->assertEquals($this->data['password'], $this->object->getPassword());
  }
  public function test_getEmail()
  {
    $this->assertEquals($this->data['email'], $this->object->getEmail());
  }
  public function test_getAdmin()
  {
    $this->assertEquals($this->data['admin'], $this->object->getAdmin());
  }
}
