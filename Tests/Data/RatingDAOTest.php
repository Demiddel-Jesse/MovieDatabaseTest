<?php

declare(strict_types=1);

use App\Entities\Rating;
use App\Data\RatingDAO;
use PHPUnit\Framework\TestCase;

class RatingDAOTest extends TestCase
{
  private $data;
  private $ratingObject;
  private $ratingDAO;
  private $allObjects;

  public function setUp(): void
  {
    $this->data = ['id' => 1, 'name' => 'R', 'description' => null];
    $this->ratingObject = new Rating($this->data['id'], $this->data['name'], $this->data['description']);
    $this->ratingDAO = new RatingDAO();

    $this->allObjects = [new Rating(1, 'R'), new Rating(2, 'Unrated'), new Rating(3, 'E'), new Rating(4, 'PG-13')];

    $this->ratingDAO->startTransaction();
  }

  public function tearDown(): void
  {
    $this->ratingDAO->rollbackTransaction();
  }

  public function test_getById()
  {
    $this->assertEquals($this->ratingObject, $this->ratingDAO->getById(1));
  }
  public function test_getByName()
  {
    $this->assertEquals($this->ratingObject, $this->ratingDAO->getByName('R'));
  }
  public function test_getAll()
  {
    $this->assertEquals($this->allObjects, $this->ratingDAO->getAll());
  }
  public function test_createRating()
  {
    $this->ratingDAO->createRating('U-5');
    $this->assertEquals('U-5', $this->ratingDAO->getByName('U-5')->getName());
    $this->ratingDAO->createRating('U-8', 'nice');
    $this->assertEquals('nice', $this->ratingDAO->getByName('U-8')->getDescription());
  }

  public function test_updateRating()
  {
    $this->ratingDAO->updateRating('R', null, 'nice');
    $this->ratingDAO->updateRating('PG-13', 'PEGI-12', 'under 12');
    $this->ratingDAO->updateRating('E', 'E-13', null);

    $this->assertEquals('nice', $this->ratingDAO->getByName('R')->getDescription());

    $this->assertEquals('PEGI-12', $this->ratingDAO->getByName('PEGI-12')->getName());
    $this->assertEquals('under 12', $this->ratingDAO->getByName('PEGI-12')->getDescription());

    $this->assertEquals('E-13', $this->ratingDAO->getByName('E-13')->getName());
  }

  public function test_removeRating()
  {
    $this->ratingDAO->removeRating(1);
    $this->ratingDAO->removeRating('Unrated');

    $this->assertEquals(null, $this->ratingDAO->getByName('Unrated'));
    $this->assertEquals(null, $this->ratingDAO->getById(1));
  }
}
