<?php
class Sample implements IStringable
{
  /** @var string */
  private $greeting;

  public function __construct(string $greeting)
  {
    $this->greeting = $greeting;
  }


  public function __toString(): string
  {
    return $this->greeting;
  }

}