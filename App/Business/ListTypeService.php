<?php

declare(strict_types=1);

namespace App\Business;

use App\Data\ListTypeDAO;
use App\Entities\ListType;
use App\Exceptions\InvalidTypeException;

class ListTypeService
{
  private $dao;

  public function __construct()
  {
    $this->dao = new ListTypeDAO();
  }

  public function getListType(int|string $listType): ListType
  {
    if (is_int($listType)) {
      return $this->dao->getById($listType);
    } else if (is_string($listType)) {
      return $this->dao->getByName($listType);
    } else {
      throw new InvalidTypeException;
    }
  }

  public function getAllListTypes(): array
  {
    return $this->dao->getAll();
  }
}
