<?php

namespace App\Entities;

class UserListsLine
{
  private int $id;
  private int $userId;
  private int $filmId;
  private float|null $rating;
  private int $listTypeId;

  public function __construct(int $id, int $userId, int $filmId, int $listTypeId, float $rating = null)
  {
    $this->id = $id;
    $this->userId = $userId;
    $this->filmId = $filmId;
    $this->rating = $rating;
    $this->listTypeId = $listTypeId;
  }
}
