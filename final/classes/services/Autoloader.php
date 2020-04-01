<?php

class Autoloader
{

  /** @var string */
  private $basePath;

  /** @var string */
  private $extension;


  public function __construct(string $basePath, string $extension)
  {

    $this->basePath = $basePath;
    $this->extension = $extension;
  }


  public function register(): void
  {
    spl_autoload_register(function ($className) {
      $fileName = $className . $this->extension;

      $dir = new DirectoryIterator($this->basePath);
      foreach ($dir as $item) {
        if ($item->isDir()) {
          $path = $item->getFilename();
          $fullPath = "$this->basePath/$path/$fileName";

          if (file_exists($fullPath)) {
            include $fullPath;
          }
        }
      }
    });
  }
}