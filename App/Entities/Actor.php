<?php

declare(strict_types=1);

namespace api\Entities;

class Actor
{
  private int $id;
  private string $firstName;
  private string $lastName;
  private string $image;

  public function __construct(int $id, string $firstName, string $lastName, string $image)
  {
    $this->id = $id;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->image = $image;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getFirstName()
  {
    return $this->firstName;
  }
  public function getLastName()
  {
    return $this->lastName;
  }

  public function getImage()
  {
    return $this->image;
  }
}
