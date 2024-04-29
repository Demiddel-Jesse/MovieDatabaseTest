<?php

declare(strict_types=1);

use App\Entities\ListType;
use PHPUnit\Framework\TestCase;

class ListTypeTest extends TestCase
{
  private $data;
  private $object;

  public function setUp(): void
  {
    $this->data = ['id' => 1, 'name' => 'nog te bekijken'];
    $this->object = new ListType($this->data['id'], $this->data['name']);
  }

  public function test_getId()
  {
    $this->assertEquals($this->data['id'], $this->object->getId());
  }

  public function test_getName()
  {
    $this->assertEquals($this->data['name'], $this->object->getName());
  }
}
