<?php

declare(strict_types=1);

namespace App\Entities;

class Category
{
  private int $id;
  private string $name;

  public function __construct(int $id, string $name)
  {
    $this->id = $id;
    $this->name = $name;
  }
}
