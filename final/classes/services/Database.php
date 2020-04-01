<?php

class Database
{

  /** @var PDO */
  private $pdo;

  public function __construct(string $fileName)
  {
    $this->pdo = new PDO('sqlite:' . $fileName,null,null);

    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  }


  public function query(string $sql, array $params = []): PDOStatement
  {
    if (!empty($params)) {
      $query = $this->pdo->prepare($sql);
      $query->execute($params);
    } else {
      $query = $this->pdo->query($sql);
    }

    return $query;
  }


  public function getLastError(): string
  {
    return $this->pdo->errorInfo()[2];
  }

}