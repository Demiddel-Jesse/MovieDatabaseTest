<?php

namespace api\Entities;

class UserListsLine
{
  private int $id;
  private int $userId;
  private int $filmId;
  private float|null $rating;
  private int $listTypeId;

  public function __construct(int $id, int $userId, int $filmId, int $listTypeId, float|null $rating = null)
  {
    $this->id = $id;
    $this->userId = $userId;
    $this->filmId = $filmId;
    $this->rating = $rating;
    $this->listTypeId = $listTypeId;
  }

  public function getId()
  {
    return $this->id;
  }
  public function getUserId()
  {
    return $this->userId;
  }
  public function getFilmId()
  {
    return $this->filmId;
  }
  public function getListTypeId()
  {
    return $this->listTypeId;
  }
  public function getRating()
  {
    return $this->rating;
  }
}
