<?php

declare(strict_types=1);

use App\Entities\Film;
use PHPUnit\Framework\TestCase;

class FilmTest extends TestCase
{
  private $data;
  private $filmObject;
  private $emptyObject;

  public function setUp(): void
  {
    $this->data = ['id' => 2, 'title' => 'Armageddon', 'description' => 'A meteor', 'runtime' => 150, 'releaseDate' => new DateTime('1998-09-01'), 'coverImage' => '~/img/Armageddon.png', 'genreId' => 4, 'categoryId' => 3, 'ratingId' => 4];
    $this->filmObject = new Film($this->data['id'], $this->data['title'], $this->data['ratingId'], $this->data['description'], $this->data['runtime'], $this->data['releaseDate'], $this->data['coverImage'], $this->data['genreId'], $this->data['categoryId']);
    $this->emptyObject = new Film(1, 'nice', 4);
  }
}
