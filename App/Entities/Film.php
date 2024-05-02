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
  private string $coverImage;
  private int|null $genreId;
  private int|null $categoryId;
  private int|null $ratingId;

  public function __construct(int $id, string $title, int|null $ratingId, string|null $description = null, int|null $runtime = null, DateTime|null $releaseDate = null, string|null $coverImage = '~/img/placeholder.jpg', int|null $genreId = null, int|null $categoryId = null)
  {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
    $this->runtime = $runtime;
    $this->releaseDate = $releaseDate;

    if ($coverImage == null) {
      $this->coverImage = '~/img/placeholder.jpg';
    } else {
      $this->coverImage = $coverImage;
    }

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
  public function setCoverImage(string $coverImage)
  {
    $this->coverImage = $coverImage;
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
