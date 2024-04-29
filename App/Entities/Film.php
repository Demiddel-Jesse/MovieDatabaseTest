<?php

declare(strict_types=1);

class Film
{
  private int $id;
  private string $title;
  private string $description;
  private int $runtime;
  private DateTime $releaseDate;
  private string $coverImage;
  private int $genreId;
  private int $categoryId;
  private int $ratingId;

  public function __construct(int $id, string $title, string $description = null, int $runtime = null, DateTime $releaseDate = null, string $coverImage = '~/img/placeholder.jpg', int $genreId = null, int $categoryId = null, int $ratingId)
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
}
