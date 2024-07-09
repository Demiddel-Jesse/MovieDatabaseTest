<?php

declare(strict_types=1);

use api\Entities\Director;
use api\Data\DirectorDAO;
use PHPUnit\Framework\TestCase;

class DirectorDAOTest extends TestCase
{
  private $data;
  private $directorObject;
  private $directorDAO;
  private $allObjects;

  public function setUp(): void
  {
    $this->data = ['id' => 2, 'firstName' => 'Michael', 'lastName' => 'Bay', 'image' => '<img alt="Michael Bay" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAFA3PEY8MlBGQUZaVVBfeMiCeG5uePWvuZHI////////////////////////////////////////////////////2wBDAVVaWnhpeOuCguv/////////////////////////////////////////////////////////////////////////wAARCAMoAmwDASIAAhEBAxEB/8QAGQABAQEBAQEAAAAAAAAAAAAAAAECAwQF/8QALxABAQACAgEEAQQCAQQCAwAAAAECESExAxJBUWFxEyIygQSRoSNCcrHw8TNiwf/EABcBAQEBAQAAAAAAAAAAAAAAAAABAgP/xAAaEQEBAQADAQAAAAAAAAAAAAAAARECITES/9oADAMBAAIRAxEAPwDzTqBOooAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAO/8Aj56unsxu4+bjdXb2+HPcB2AEGM8JlGwHkz/x/hz/AEMtvfpNQV5cPDl716MMdRrSgACOPmx3jXjxx3np9DKbjjj49Z7FdfHNRtJNKDOWO48nm8Nl3HtS4yg+f48rhk93jy3GMvDjfZrDD0g6ACAAAJbqCuXmy1K8Nu7Xo/yM/Z5wAAQUBGL3XRzvdBudRUnUUAAAAAAAAAAAAAAAAAAAAAAAAAFBBagAAAAAAAAAAAAAADp4s/TXMB9DDOWOj5/j8lxr14eSWA6iS7UQAAAABjLOSAZ5ajnj5Ja4+Xy74jljlcbsV9GXauHi8m47y7AAEAAAAAAHPy5ajo5+XHcorw55erJlc8fTlYgAAAADne66Od7oNzqKk6igAAAAAAAAAAAAAUAAAAAAAAAABfYJ2Czma92Vs1eCz39qgghtRRNqAAAqL7AgAAAAAAADWOdxvDID04ef5dsfLK8CzKzqg+jM4vqj588uUa/WyB7fVEvkkeK+bJm55X3B6s/NJ7vPn5bk5gAANYZ3GvV4/NK8ZLZ0D6UylaeDDzWdu2Pnl9wekcp5Yv6kB0HK+WfLnl55AenY8uHnlrtPLAdCzbn+pF/UgOH+R49zceV788pY8Xkk9XAMgAAAOd7ro53ug3OoqTqKAAAAAAAAAAAAAAAAAC9ggaAAUEBdAiibBqcxMb3jfdZYzlz+fdBL3r3TVbs3N+6a4UZF1tdatA2J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"/>'];
    $this->directorObject = new Director($this->data['id'], $this->data['firstName'], $this->data['lastName'], $this->data['image']);
    $this->directorDAO = new DirectorDAO();

    $this->allObjects = [$this->directorObject, new Director(1, 'Armando', 'Iannucci', '<img alt="Armando Iannucci" src="~/img/placeholderPerson.jpg">')];

    $this->directorDAO->startTransaction();
  }

  public function tearDown(): void
  {
    $this->directorDAO->rollbackTransaction();
  }

  public function test_getById()
  {
    $this->assertEquals($this->directorObject, $this->directorDAO->getById(2));
  }

  public function test_getByName()
  {
    $this->assertEquals($this->directorObject, $this->directorDAO->getByName($this->data['firstName'], $this->data['lastName']));
  }

  public function test_getAll()
  {
    $this->assertEquals($this->allObjects, $this->directorDAO->getAll());
  }

  public function test_createNewDirector()
  {
    $this->directorDAO->createNewDirector('Florence', 'Pugh', null);
    $this->assertEquals('Florence', $this->directorDAO->getByName('Florence', 'Pugh')->getFirstName());
  }

  public function test_updateDirector()
  {
    $this->directorDAO->updateDirector(1, 'Steven', null, null);
    $this->assertEquals('Steven', $this->directorDAO->getById(1)->getFirstName());
    $this->directorDAO->updateDirector(1, null, 'Buscami', null);
    $this->assertEquals('Buscami', $this->directorDAO->getById(1)->getLastName());
  }

  public function test_removeDirector()
  {
    $this->directorDAO->removeDirector(1);
    $this->assertEquals(null, $this->directorDAO->getById(1));
  }

  // public function test_get()
  // {
  //   $this->directorDAO->testGetImage();
  // }
}
