<?php

declare(strict_types=1);

use api\Entities\DirectorsFilmsLine;
use api\Data\DirectorsFilmsLinesDAO;
use PHPUnit\Framework\TestCase;

class DirectorsFilmsLinesDAOTest extends TestCase
{
  private $object;
  private $allDirector1;
  private $allFilm2;
  private $dao;

  public function setUp(): void
  {
    $this->object = new DirectorsFilmsLine(1, 1, 1);
    $this->allDirector1 = [new DirectorsFilmsLine(1, 1, 1)];
    $this->allFilm2 = [new DirectorsFilmsLine(2, 2, 2)];

    $this->dao = new DirectorsFilmsLinesDAO();
    $this->dao->startTransaction();
  }
  public function tearDown(): void
  {
    $this->dao->rollbackTransaction();
  }

  public function test_getById()
  {
    $this->assertEquals($this->object, $this->dao->getById(1));
  }
  public function test_getAllForDirectorId()
  {
    $this->assertEquals($this->allDirector1, $this->dao->getAllForDirectorId(1));
  }
  public function test_getAllForFilmId()
  {
    $this->assertEquals($this->allFilm2, $this->dao->getAllForFilmId(2));
  }
  public function test_createNewDirectorFilmLine()
  {
    $this->dao->createNewDirectorFilmLine(2, 2);
    $this->assertEquals(2, $this->dao->getAllForDirectorId(2)[1]->getDirectorId());
  }
  public function test_removeDirectorFilmLine()
  {
    $this->dao->removeDirectorFilmLine(1);
    $this->assertEquals(null, $this->dao->getById(1));
  }
}
