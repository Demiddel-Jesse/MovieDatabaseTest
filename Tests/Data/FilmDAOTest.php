<?php

declare(strict_types=1);

use App\Entities\Film;
use App\Data\FilmDAO;
use PHPUnit\Framework\TestCase;

class FilmDAOTest extends TestCase
{
  private $data;
  private $filmObject;
  private $filmDAO;
  private $allObjects;

  public function setUp(): void
  {
    $this->data = ['id' => 1, 'title' => 'The Death of Stalin', 'ratingId' => 1, 'description' => 'In early-1953 Moscow, under the Great Terror\'s heavy cloak of state paranoia, the ever-watchful Soviet leader, Joseph Stalin, collapses unexpectedly of a brain haemorrhage. As a result, when someone discovers his body the following morning, a frenetic surge of raw panic starts spreading like a virus among the senior members of the Council of Ministers, as they scramble to maintain order, weed out the competition, and ultimately take power. But in the middle of a gut-wrenching rollercoaster of incessant plotting, tireless machinations, and frail allegiances, absolutely no one is safe; not even the feared chief of the secret police, Lavrenti Beria. In the end, who will prevail after the death of Stalin?', 'runtime' => 107, 'releaseDate' => new DateTime('2017-09-08'), 'coverImage' => '~/img/placeholder.jpg', 'genreId' => 1, 'categoryId' => 1];
    $this->filmObject =  new Film(1, 'The Death of Stalin', 1, 'In early-1953 Moscow, under the Great Terror\'s heavy cloak of state paranoia, the ever-watchful Soviet leader, Joseph Stalin, collapses unexpectedly of a brain haemorrhage. As a result, when someone discovers his body the following morning, a frenetic surge of raw panic starts spreading like a virus among the senior members of the Council of Ministers, as they scramble to maintain order, weed out the competition, and ultimately take power. But in the middle of a gut-wrenching rollercoaster of incessant plotting, tireless machinations, and frail allegiances, absolutely no one is safe; not even the feared chief of the secret police, Lavrenti Beria. In the end, who will prevail after the death of Stalin?', 107, new DateTime('2017-09-08'), null, 1, 1);
    $this->filmDAO = new filmDAO();

    $this->allObjects = [
      new Film(1, 'The Death of Stalin', 1, 'In early-1953 Moscow, under the Great Terror\'s heavy cloak of state paranoia, the ever-watchful Soviet leader, Joseph Stalin, collapses unexpectedly of a brain haemorrhage. As a result, when someone discovers his body the following morning, a frenetic surge of raw panic starts spreading like a virus among the senior members of the Council of Ministers, as they scramble to maintain order, weed out the competition, and ultimately take power. But in the middle of a gut-wrenching rollercoaster of incessant plotting, tireless machinations, and frail allegiances, absolutely no one is safe; not even the feared chief of the secret police, Lavrenti Beria. In the end, who will prevail after the death of Stalin?', 107, new DateTime('2017-09-08'), null, 1, 1), new Film(2, 'Armageddon', 4, 'A massive meteor shower destroys the orbiting Space Shuttle Atlantis, before entering the atmosphere and bombarding New York City, Boston, Philadelphia, Moncton, Halifax, and Newfoundland. The meteors were pushed out of the asteroid belt by a collision from a rogue comet and a massive asteroid the size of Texas, and NASA learns that the asteroid will impact Earth in 18 days, potentially wiping out all life on Earth. NASA devises a plan to have a deep hole drilled into the asteroid, into which they will insert and detonate a nuclear bomb to destroy the asteroid. ', 150, new DateTime('1998-09-01'), '~/img/Armageddon.png', 4, 3)
    ];

    $this->filmDAO->startTransaction();
  }

  public function tearDown(): void
  {
    $this->filmDAO->rollbackTransaction();
  }

  public function test_getById()
  {
    $this->assertEquals(
      $this->filmObject,
      $this->filmDAO->getById(1)
    );
    $this->assertEquals(
      null,
      $this->filmDAO->getById(5)
    );
  }
  public function test_getByTitle()
  {
    $this->assertEquals(
      $this->filmObject,
      $this->filmDAO->getByTitle('The Death of Stalin')
    );
    $this->assertEquals(
      null,
      $this->filmDAO->getByTitle('AAAAAA')
    );
  }

  public function test_getAll()
  {
    $this->assertEquals($this->allObjects, $this->filmDAO->getAll());
  }

  public function test_createFilm()
  {
    $this->filmDAO->createFilm('InterStellar', null, null, null, null, null, null, null, 2);
    $this->assertEquals('InterStellar', $this->filmDAO->getByTitle('Interstellar')->getTitle());
    $this->assertEquals(null, $this->filmDAO->getByTitle('Interstellar')->getRunTime());
  }

  public function test_updateFilm()
  {
    $this->filmDAO->updateFilm('The Death of Stalin', 'Deathie stalinium', 'Deathie stalinium', null, null, null, '~/img/stalinium.png', null, null, null);
    $this->assertEquals('Deathie stalinium', $this->filmDAO->getById(1)->getTitle());
    $this->assertEquals('~/img/stalinium.png', $this->filmDAO->getById(1)->getCoverImage());

    $this->filmDAO->updateFilm(2, 'Deathie stalinium', 'Deathie stalinium', null, null, null, '~/img/stalinium.png', null, null, null);
    $this->assertEquals('Deathie stalinium', $this->filmDAO->getById(2)->getTitle());
    $this->assertEquals('~/img/stalinium.png', $this->filmDAO->getById(2)->getCoverImage());
  }

  public function test_removeFilm()
  {
    $this->assertEquals($this->filmObject, $this->filmDAO->getById(1));
    $this->assertEquals($this->filmObject, $this->filmDAO->getById(2));
    $this->filmDAO->removeFilm(1);
    $this->filmDAO->removeFilm('Armageddon');
    $this->assertEquals(null, $this->filmDAO->getById(1));
    $this->assertEquals(null, $this->filmDAO->getById(2));
  }
}
