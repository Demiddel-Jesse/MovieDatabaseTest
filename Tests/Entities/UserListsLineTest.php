<?php

declare(strict_types=1);

use api\Entities\UserListsLine;
use PHPUnit\Framework\TestCase;

class UserListsLineTest extends TestCase
{
  private $data;
  private $object;
  private $object2;

  public function setUp(): void
  {
    $this->data = ['id' => 1, 'userId' => 2, 'filmId' => 1, 'rating' => 8.5, 'listTypeId' => 2];
    $this->object = new UserListsLine($this->data['id'], $this->data['userId'], $this->data['filmId'], $this->data['listTypeId'], $this->data['rating']);
    $this->object2 = new UserListsLine($this->data['id'], $this->data['userId'], $this->data['filmId'], $this->data['listTypeId']);
  }

  public function test_getId()
  {
    $this->assertEquals($this->data['id'], $this->object->getId());
  }
  public function test_getUserId()
  {
    $this->assertEquals($this->data['userId'], $this->object->getUserId());
  }
  public function test_getFilmId()
  {
    $this->assertEquals($this->data['filmId'], $this->object->getFilmId());
  }
  public function test_getListTypeId()
  {
    $this->assertEquals($this->data['listTypeId'], $this->object->getListTypeId());
  }
  public function test_getRating()
  {
    $this->assertEquals(null, $this->object2->getRating());
    $this->assertEquals($this->data['rating'], $this->object->getRating());
  }
}
