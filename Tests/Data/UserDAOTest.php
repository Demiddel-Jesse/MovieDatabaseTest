<?php

declare(strict_types=1);

use App\Entities\User;
use App\Data\UserDAO;
use App\Exception\IsAdminUser;
use PHPUnit\Framework\TestCase;

class UserDAOTest extends TestCase
{
  private $userObject;
  private $userDAO;
  private $allObjects;

  public function setUp(): void
  {
    $this->userObject = new User(1, 'joskeVer', 'joske123', 'joske@mail.com', true);
    $this->userDAO = new UserDAO();

    $this->allObjects = [new User(1, 'joskeVer', 'joske123', 'joske@mail.com', true), new User(1, 'jeffreyVer', 'jeffrey123', 'jeffrey@mail.com', false)];

    $this->userDAO->startTransaction();
  }

  public function tearDown(): void
  {
    $this->userDAO->rollbackTransaction();
  }

  public function test_getById()
  {
    $this->assertEquals($this->userObject, $this->userDAO->getById(1));
  }
  public function test_getByEmail()
  {
    $this->assertEquals($this->userObject, $this->userDAO->getByEmail('joske@mail.com'));
  }
  public function test_getByUserName()
  {
    $this->assertEquals($this->userObject, $this->userDAO->getByUserName('joskeVer'));
  }

  public function test_createNewUser()
  {
    $this->userDAO->createNewUser('joshua', 'joske', 'joshua@mail.info');
    $this->assertEquals('joshua', $this->userDAO->getByUserName('joshua')->getUsername());
  }

  public function test_updateUser()
  {
    $this->userDAO->updateUser('joskeVer', 'joske', null, null);
    $this->assertEquals('joske', $this->userDAO->getByUserName('joske')->getUsername());
    $this->userDAO->updateUser('joske', null, 'joskie', null);
    $this->assertEquals('joskie', $this->userDAO->getByUserName('joske')->getPassword());
  }

  public function test_removeUser()
  {
    $this->userDAO->removeUser('jeffrey@mail.com');
    $this->assertEquals(null, $this->userDAO->getByUserName('jeffreyVer'));
  }

  public function test_removeUser_admin()
  {
    try {
      $this->userDAO->removeUser('joskeVer');
    } catch (IsAdminUser $th) {
      $this->markTestSkipped('Admin cannot be deleted');
    }
  }
}
