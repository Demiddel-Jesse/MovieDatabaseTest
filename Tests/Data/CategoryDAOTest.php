<?php

declare(strict_types=1);

use api\Entities\Category;
use api\Data\CategoryDAO;
use PHPUnit\Framework\TestCase;

class CategoryDAOTest extends TestCase
{
  private $data;
  private $categoryObject;
  private $categoryDAO;
  private $allObjects;

  public function setUp(): void
  {
    $this->data = ['id' => 1, 'name' => 'LongFilm'];
    $this->categoryObject = new Category($this->data['id'], $this->data['name']);
    $this->categoryDAO = new CategoryDAO();

    $this->allObjects = [new Category(3, 'BlockBuster'), new Category(4, 'Documentary'),new Category(1, 'LongFilm'), new Category(2, 'Short'), ];

    $this->categoryDAO->startTransaction();
  }

  public function tearDown(): void
  {
    $this->categoryDAO->rollbackTransaction();
  }

  public function test_getById()
  {
    $this->assertEquals($this->categoryObject, $this->categoryDAO->getById($this->data['id']));
    $this->assertEquals(null, $this->categoryDAO->getById(8));
  }

  public function test_getByName()
  {
    $this->assertEquals($this->categoryObject, $this->categoryDAO->getByName($this->data['name']));$this->assertEquals(null, $this->categoryDAO->getByName('joske'));
  }

  public function test_getAll()
  {
    $this->assertEquals($this->allObjects, $this->categoryDAO->getAll());
  }

  public function test_createNewCategory()
  {
    $this->categoryDAO->createNewCategory('Historical Drama');
    $this->assertEquals('Historical Drama', $this->categoryDAO->getByName('Historical Drama')->getName());
  }

  public function test_updateCategory()
  {
    $this->assertEquals('LongFilm', $this->categoryDAO->getById(1)->getName());
    $this->categoryDAO->updateCategory(1, 'LongerFilm');
    $this->assertEquals('LongerFilm', $this->categoryDAO->getById(1)->getName());
    $this->assertEquals('Short', $this->categoryDAO->getById(2)->getName());
    $this->categoryDAO->updateCategory('Short', 'ShorterFilm');
    $this->assertEquals('ShorterFilm', $this->categoryDAO->getById(2)->getName());
  }

  public function test_removeCategory()
  {
    $this->assertEquals('LongFilm', $this->categoryDAO->getById(1)->getName());
    $this->categoryDAO->removeCategory(1);
    $this->assertEquals(null, $this->categoryDAO->getById(1));
    $this->assertEquals('Short', $this->categoryDAO->getById(2)->getName());
    $this->categoryDAO->removeCategory('Short');
    $this->assertEquals(null, $this->categoryDAO->getById(2));
  }
}
