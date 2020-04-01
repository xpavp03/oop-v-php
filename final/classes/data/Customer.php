<?php
declare(strict_types=1);

class Customer
{
  /** @var int */
  public $id;

  /** @var string */
  public $name;

  public function __construct(array $data = null)
  {
    if (empty($data)) {
      return;
    }

    foreach ($data as $property => $value) {
      $this->$property = $value;
    }
  }
}