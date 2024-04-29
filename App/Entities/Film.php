<?php

declare(strict_types=1);

namespace App\Entities;

use DateTime;

class Film
{
  private int $id;
  private string $title;
  private string|null $description;
  private int|null $runtime;
  private DateTime|null $releaseDate;
  private string|null $coverImage;
  private int|null $genreId;
  private int|null $categoryId;
  private int $ratingId;

  public function __construct(int $id, string $title, int $ratingId, string $description = null, int $runtime = null, DateTime $releaseDate = null, string $coverImage = '~/img/placeholder.jpg', int $genreId = null, int $categoryId = null)
  {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
    $this->runtime = $runtime;
    $this->releaseDate = $releaseDate;
    $this->coverImage = $coverImage;
    $this->genreId = $genreId;
    $this->categoryId = $categoryId;
    $this->ratingId = $ratingId;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getTitle()
  {
    return $this->title;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function getRuntime()
  {
    return $this->runtime;
  }
  public function getReleaseDate()
  {
    return $this->releaseDate;
  }
  public function getCoverImage()
  {
    return $this->coverImage;
  }
  public function getGenreId()
  {
    return $this->genreId;
  }
  public function getCategoryId()
  {
    return $this->categoryId;
  }
  public function getRatingId()
  {
    return $this->ratingId;
  }
}
