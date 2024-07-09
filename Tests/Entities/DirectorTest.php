<?php

declare(strict_types=1);

use api\Entities\Director;
use PHPUnit\Framework\TestCase;

class DirectorTest extends TestCase
{
  private $data;
  private $directorObject;

  public function setUp(): void
  {
    $this->data = ['id' => 1, 'firstName' => 'Armando', 'lastName' => 'Iannucci', 'image' => '<img src="#">'];
    $this->directorObject = new Director($this->data['id'], $this->data['firstName'], $this->data['lastName'], $this->data['image']);
  }

  public function test_getId()
  {
    $this->assertEquals($this->data['id'], $this->directorObject->getId());
  }
  public function test_getFirstName()
  {
    $this->assertEquals($this->data['firstName'], $this->directorObject->getFirstName());
  }
  public function test_getLastName()
  {
    $this->assertEquals($this->data['lastName'], $this->directorObject->getLastName());
  }
  public function test_getImage()
  {
    $this->assertEquals($this->data['image'], $this->directorObject->getImage());
  }
}
