<?php

declare(strict_types=1);

use App\Entities\Actor;
use PHPUnit\Framework\TestCase;

class ActorTest extends TestCase
{
  private $data;
  private $actorObject;

  public function setUp(): void
  {
    $this->data = ['id' => 1, 'firstName' => 'steve', 'lastName' => 'Buscemi', 'image' => '<img src="#">'];
    $this->actorObject = new Actor($this->data['id'], $this->data['firstName'], $this->data['lastName'], $this->data['image']);
  }

  public function test_getId()
  {
    $this->assertEquals($this->data['id'], $this->actorObject->getId());
  }
  public function test_getFirstName()
  {
    $this->assertEquals($this->data['firstName'], $this->actorObject->getFirstName());
  }
  public function test_getLastName()
  {
    $this->assertEquals($this->data['lastName'], $this->actorObject->getLastName());
  }
  public function test_getImage()
  {
    $this->assertEquals($this->data['image'], $this->actorObject->getImage());
  }
}
