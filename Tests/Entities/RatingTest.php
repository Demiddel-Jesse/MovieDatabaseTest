<?php

declare(strict_types=1);

use api\Entities\Rating;
use PHPUnit\Framework\TestCase;

class RatingTest extends TestCase
{
  private $data;
  private $object;

  public function setUp(): void
  {
    $this->data = ['id' => 1, 'name' => 'R', 'description' => null];
    $this->object = new Rating($this->data['id'], $this->data['name']);
  }

  public function test_getId()
  {
    $this->assertEquals($this->data['id'], $this->object->getId());
  }

  public function test_getName()
  {
    $this->assertEquals($this->data['name'], $this->object->getName());
  }

  public function test_getDescription()
  {
    $this->assertEquals($this->data['description'], $this->object->getDescription());
  }
}
