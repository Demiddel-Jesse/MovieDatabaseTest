<?php

declare(strict_types=1);

use api\Entities\ActorsFilmsLine;
use api\Data\ActorsFilmsLinesDAO;
use PHPUnit\Framework\TestCase;

class ActorsFilmsLinesDAOTest extends TestCase
{
  private $object;
  private $allActor1;
  private $allFilm1;
  private $dao;

  public function setUp(): void
  {
    $this->object = new ActorsFilmsLine(1, 1, 1);
    $this->allActor1 = [new ActorsFilmsLine(1, 1, 1), new ActorsFilmsLine(3, 1, 2)];
    $this->allFilm1 = [new ActorsFilmsLine(1, 1, 1), new ActorsFilmsLine(2, 2, 1)];

    $this->dao = new ActorsFilmsLinesDAO();
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
  public function test_getAllForActorId()
  {
    $this->assertEquals($this->allActor1, $this->dao->getAllForActorId(1));
  }
  public function test_getAllForFilmId()
  {
    $this->assertEquals($this->allFilm1, $this->dao->getAllForFilmId(1));
  }
  public function test_createNewActorFilmLine()
  {
    $this->dao->createNewActorFilmLine(2, 2);
    $this->assertEquals(2, $this->dao->getAllForActorId(2)[1]->getActorId());
  }
  public function test_removeActorFilmLine()
  {
    $this->dao->removeActorFilmLine(1);
    $this->assertEquals(null, $this->dao->getById(1));
  }
}
