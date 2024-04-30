<?php

declare(strict_types=1);

use App\Entities\DirectorsFilmsLines;
use PHPUnit\Framework\TestCase;

class DirectorsFilmsLinesTest extends TestCase
{
  private $data;
  private $object;

  public function setUp(): void
  {
    $this->data = ['id' => 1, 'directorId' => 1, 'filmId' => 2];
    $this->object = new DirectorsFilmsLines($this->data['id'], $this->data['directorId'], $this->data['filmId']);
  }

  public function test_getId()
  {
    $this->assertEquals($this->data['id'], $this->object->getId());
  }
  public function test_getDirectorId()
  {
    $this->assertEquals($this->data['directorId'], $this->object->getDirectorId());
  }
  public function test_getFilmId()
  {
    $this->assertEquals($this->data['filmId'], $this->object->getFilmId());
  }
}
