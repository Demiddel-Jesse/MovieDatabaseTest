<?php

declare(strict_types=1);

use App\Entities\Genre;
use App\Data\GenreDAO;
use PHPUnit\Framework\TestCase;

class GenreDAOTest extends TestCase
{
  private $data;
  private $genreObject;
  private $genreDAO;
  private $allObjects;

  public function setUp(): void
  {
    $this->data = ['id' => 1, 'name' => 'Comedy'];
    $this->genreObject = new Genre($this->data['id'], $this->data['name']);
    $this->genreDAO = new GenreDAO();

    $this->allObjects = [new Genre(4, 'Action'), new Genre(1, 'Comedy'), new Genre(2, 'Drama'), new Genre(3, 'Horror'),];

    $this->genreDAO->startTransaction();
  }
  public function tearDown(): void
  {
    $this->genreDAO->rollbackTransaction();
  }

  public function test_getById()
  {
    $this->assertEquals($this->genreObject, $this->genreDAO->getById(1));
  }
  public function test_getByName()
  {
    $this->assertEquals($this->genreObject, $this->genreDAO->getByName('Comedy'));
  }
  public function test_getAll()
  {
    $this->assertEquals($this->allObjects, $this->genreDAO->getAll());
  }
  public function test_createNewGenre()
  {
    $this->genreDAO->createNewGenre('Historical');
    $this->assertEquals('Historical', $this->genreDAO->getByName('Historical'));
  }
  public function test_updateGenre()
  {
    $this->genreDAO->updateGenre('Comedy', 'HiHiHaHa');
    $this->assertEquals('HiHiHaHa', $this->genreDAO->getByName('HiHiHaHa')->getName());
    $this->genreDAO->updateGenre(4, 'helloThere');
    $this->assertEquals('helloThere', $this->genreDAO->getByName('helloThere')->getName());
    $this->assertEquals(4, $this->genreDAO->getByName('helloThere')->getId());
  }
  public function test_removeGenre()
  {
    $this->assertEquals($this->allObjects[1], $this->genreDAO->getByName('Comedy'));
    $this->assertEquals($this->allObjects[0], $this->genreDAO->getById(4));
    $this->genreDAO->removeGenre('Comedy');
    $this->genreDAO->removeGenre(4);
    $this->assertEquals(null, $this->genreDAO->getByName('Comedy'));
    $this->assertEquals(null, $this->genreDAO->getById(4));
  }
}
