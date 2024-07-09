<?php

declare(strict_types=1);

namespace api\Entities;

class ActorsFilmsLine
{
  private int $id;
  private int $actorId;
  private int $filmId;

  public function __construct(int $id, int $actorId, int $filmId)
  {
    $this->id = $id;
    $this->actorId = $actorId;
    $this->filmId = $filmId;
  }

  public function getId()
  {
    return $this->id;
  }
  public function getActorId()
  {
    return $this->actorId;
  }
  public function getFilmId()
  {
    return $this->filmId;
  }
}
