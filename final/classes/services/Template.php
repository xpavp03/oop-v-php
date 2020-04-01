<?php

class Template
{

  /** @var string */
  private $path;

  /** @var array */
  private $params = [];


  public function __construct(string $path)
  {
    $this->path = $path;
  }


  public function setParams(array $params): void
  {
    $this->params += $params;
  }


  public function render(string $fileName): void
  {
    extract($this->params);
    require $this->path . '/'. $fileName;
  }
}