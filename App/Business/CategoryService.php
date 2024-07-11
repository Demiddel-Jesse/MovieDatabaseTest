<?php

declare(strict_types=1);

namespace api\Business;

use api\Data\CategoryDAO;
use api\Entities\Category;

class CategoryService
{
  private $categoryDAO;

  public function __construct()
  {
    $this->categoryDAO = new CategoryDAO();
  }

  public function getCategory(int|string $category): ?Category
  {
    if (is_int($category)) {
      return $this->categoryDAO->getById($category);
    } else if (is_string($category)) {
      return $this->categoryDAO->getByName($category);
    }
    return null;
  }

  public function getAllCategories(): array
  {
    return $this->categoryDAO->getAll();
  }

  public function createNewCategory(string $name): void
  {
    $this->categoryDAO->createNewCategory($name);
  }

  public function updateCategory(string|int $category, string $newName): void
  {
    $this->categoryDAO->updateCategory($category, $newName);
  }

  public function removeCategory(int|string $category): void
  {
    $this->categoryDAO->removeCategory($category);
  }
}
