<?php

declare(strict_types=1);

use api\Entities\ActorsFilmsLines;
use PHPUnit\Framework\TestCase;

class ActorsFilmsLinesTest extends TestCase
{
  private $data;
  private $object;

  public function setUp(): void
  {
    $this->data = ['id' => 1, 'actorId' => 1, 'filmId' => 2];
    $this->object = new ActorsFilmsLines($this->data['id'], $this->data['actorId'], $this->data['filmId']);
  }

  public function test_getId()
  {
    $this->assertEquals($this->data['id'], $this->object->getId());
  }
  public function test_getActorId()
  {
    $this->assertEquals($this->data['actorId'], $this->object->getActorId());
  }
  public function test_getFilmId()
  {
    $this->assertEquals($this->data['filmId'], $this->object->getFilmId());
  }
}
