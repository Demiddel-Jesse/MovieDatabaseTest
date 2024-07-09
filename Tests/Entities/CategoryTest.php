<?php

declare(strict_types=1);

use api\Entities\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
  private $data;
  private $categoryObject;

  public function setUp(): void
  {
    $this->data = ['id' => 1, 'name' => 'LongFilm'];
    $this->categoryObject = new Category($this->data['id'], $this->data['name']);
  }

  public function test_getId()
  {
    $this->assertEquals($this->data['id'], $this->categoryObject->getId());
  }
  public function test_getName()
  {
    $this->assertEquals($this->data['name'], $this->categoryObject->getName());
  }
}
