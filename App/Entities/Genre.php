<?php

declare(strict_types=1);

namespace App\Entities;

class Genre
{
  private int $id;
  private string $name;

  public function __construct(int $id, string $name)
  {
    $this->id = $id;
    $this->name = $name;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }
}
