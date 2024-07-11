<?php

declare(strict_types=1);

namespace api\Business;

use api\Data\ListTypeDAO;
use api\Entities\ListType;
use api\Exceptions\InvalidTypeException;

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
