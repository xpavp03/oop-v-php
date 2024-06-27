<?php

class TemplateEngine
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
      $content = $this->renderContent($fileName);

      extract($this->params);
      require $this->path . '/@layout.php';
  }


    private function renderContent(string $fileName): string
    {
        extract($this->params);

        ob_start();
        require $this->path . '/' . $fileName . '.php';
        return ob_get_clean();
    }
}