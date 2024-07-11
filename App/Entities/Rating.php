<?php

declare(strict_types=1);

namespace api\Entities;

class Rating
{
  private int $id;
  private string $name;
  private string|null $description;

  public function __construct(int $id, string $name, string|null $description = null)
  {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }
  public function getDescription()
  {
    return $this->description;
  }
}
