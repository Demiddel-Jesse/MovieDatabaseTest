<?php

declare(strict_types=1);

use App\Entities\Film;
use PHPUnit\Framework\TestCase;

class FilmTest extends TestCase
{
  private $data;
  private $filmObject;
  private $emptyObject;

  public function setUp(): void
  {
    $this->data = ['id' => 2, 'title' => 'Armageddon', 'description' => 'A meteor', 'runtime' => 150, 'releaseDate' => new DateTime('1998-09-01'), 'coverImage' => '~/img/Armageddon.png', 'genreId' => 4, 'categoryId' => 3, 'ratingId' => 4];
    $this->filmObject = new Film($this->data['id'], $this->data['title'], $this->data['ratingId'], $this->data['description'], $this->data['runtime'], $this->data['releaseDate'], $this->data['coverImage'], $this->data['genreId'], $this->data['categoryId']);
    $this->emptyObject = new Film(1, 'nice', 4);
  }

  public function test_getId()
  {
    $this->assertEquals($this->data['id'], $this->filmObject->getId());
  }
  public function test_getTitle()
  {
    $this->assertEquals($this->data['title'], $this->filmObject->getTitle());
  }
  public function test_getDescription()
  {
    $this->assertEquals($this->data['description'], $this->filmObject->getDescription());
    $this->assertEquals(null, $this->emptyObject->getDescription());
  }
  public function test_getRuntime()
  {
    $this->assertEquals($this->data['runtime'], $this->filmObject->getRuntime());
    $this->assertEquals(null, $this->emptyObject->getRuntime());
  }
  public function test_getReleaseDate()
  {
    $this->assertEquals($this->data['releaseDate'], $this->filmObject->getReleaseDate());
    $this->assertEquals(null, $this->emptyObject->getReleaseDate());
  }
  public function test_getCoverImage()
  {
    $this->assertEquals($this->data['coverImage'], $this->filmObject->getCoverImage());
    $this->assertEquals('~/img/placeholder.jpg', $this->emptyObject->getCoverImage());
  }
  public function test_getGenreId()
  {
    $this->assertEquals($this->data['genreId'], $this->filmObject->getGenreId());
    $this->assertEquals(null, $this->emptyObject->getGenreId());
  }
  public function test_getCategoryId()
  {
    $this->assertEquals($this->data['categoryId'], $this->filmObject->getCategoryId());
    $this->assertEquals(null, $this->emptyObject->getCategoryId());
  }
  public function test_getRatingId()
  {
    $this->assertEquals($this->data['ratingId'], $this->filmObject->getRatingId());
  }
}
