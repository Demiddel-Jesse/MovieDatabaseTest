<?php

declare(strict_types=1);

namespace App\Entities;

class DirectorsFilmsLine
{
  private int $id;
  private int $directorId;
  private int $filmId;

  public function __construct(int $id, int $directorId, int $filmId)
  {
    $this->id = $id;
    $this->directorId = $directorId;
    $this->filmId = $filmId;
  }

  public function getId()
  {
    return $this->id;
  }
  public function getDirectorId()
  {
    return $this->directorId;
  }
  public function getFilmId()
  {
    return $this->filmId;
  }
}
