<?php

declare(strict_types=1);

use App\Entities\ListType;
use App\Data\ListTypeDAO;
use PHPUnit\Framework\TestCase;

class ListTypeDAOTest extends TestCase
{
  private $data;
  private $listTypeObject;
  private $listTypeDAO;
  private $allObjects;

  public function setUp(): void
  {
    $this->data = ['id' => 1, 'name' => 'nog te bekijken'];
    $this->listTypeObject = new ListType($this->data['id'], $this->data['name']);
    $this->listTypeDAO = new ListTypeDAO();

    $this->allObjects = [new ListType(3, 'aan het bekijken'), new ListType(2, 'bekeken'), new ListType(4, 'dropped'), new ListType(1, 'nog te bekijken'),];

    $this->listTypeDAO->startTransaction();
  }

  public function tearDown(): void
  {
    $this->listTypeDAO->rollbackTransaction();
  }

  public function test_getById()
  {
    $this->assertEquals($this->listTypeObject, $this->listTypeDAO->getById(1));
  }
  public function test_getByName()
  {
    $this->assertEquals($this->listTypeObject, $this->listTypeDAO->getByName('nog te bekijken'));
  }
  public function test_getAll()
  {
    $this->assertEquals($this->allObjects, $this->listTypeDAO->getAll());
  }
}
