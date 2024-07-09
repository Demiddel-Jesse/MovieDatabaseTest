<?php

declare(strict_types=1);

use api\Entities\UserListsLine;
use api\Data\UserListsLineDAO;
use PHPUnit\Framework\TestCase;

class UserListsLineDAOTest extends TestCase
{
  private $userListsLineObject;
  private $userListsLineDAO;
  private $allObjects;

  public function setUp(): void
  {
    $this->userListsLineObject = new UserListsLine(1, 2, 1, 2, 8.5);
    $this->userListsLineDAO = new UserListsLineDAO();

    $this->allObjects = [new UserListsLine(1, 2, 1, 2, 8.5), new UserListsLine(2, 2, 2, 1), new UserListsLine(3, 1, 2, 3, null), new UserListsLine(4, 1, 1, 4, 3)];

    $this->userListsLineDAO->startTransaction();
  }

  public function tearDown(): void
  {
    $this->userListsLineDAO->rollbackTransaction();
  }

  public function test_getById()
  {
    $this->assertEquals($this->userListsLineObject, $this->userListsLineDAO->getById(1));
  }

  public function test_getByUserAndFilmId()
  {
    $this->assertEquals($this->userListsLineObject, $this->userListsLineDAO->getByUserAndFilmId(2, 1));
  }

  public function test_getAll()
  {
    $this->assertEquals($this->allObjects, $this->userListsLineDAO->getAll());
  }

  public function test_getAllForUserId()
  {
    $allObjectsUser = [new UserListsLine(1, 2, 1, 2, 8.5), new UserListsLine(2, 2, 2, 1)];
    $this->assertEquals($allObjectsUser, $this->userListsLineDAO->getAllForUserId(2));
  }

  public function test_getAllForFilmId()
  {
    $allObjectsUser = [new UserListsLine(2, 2, 2, 1), new UserListsLine(3, 1, 2, 3, null)];
    $this->assertEquals($allObjectsUser, $this->userListsLineDAO->getAllForFilmId(2));
  }

  public function test_createNewUserListLine()
  {
    $this->userListsLineDAO->createNewUserListLine(2, 2, 1);
    $this->userListsLineDAO->createNewUserListLine(2, 2, 2, 5);

    $this->assertEquals(2, $this->userListsLineDAO->getAllForUserId(2)[2]->getUserId());
    $this->assertEquals(2, $this->userListsLineDAO->getAllForUserId(2)[3]->getUserId());
  }

  public function test_updateRating()
  {
    $this->userListsLineDAO->updateRating(2, 2, 8);
    $this->assertEquals(8, $this->userListsLineDAO->getById(2)->getRating());
  }

  public function test_updateListType()
  {
    $this->userListsLineDAO->updateListType(2, 2, 4);
    $this->assertEquals(4, $this->userListsLineDAO->getById(2)->getListTypeId());
  }

  public function test_removeLine()
  {
    $this->userListsLineDAO->removeLine(2, 2);
    $this->assertEquals(null, $this->userListsLineDAO->getById(2));
  }
}
