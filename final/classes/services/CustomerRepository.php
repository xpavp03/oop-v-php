<?php
declare(strict_types=1);

class CustomerRepository
{

  /** @var Database */
  private $db;

  /** @var string */
  private $dataClassName = 'Customer';


  public function __construct(Database $db)
  {
    $this->db = $db;
  }


  public function init(): void
  {
    $this->db->query("DROP TABLE customer");
    $this->db->query("CREATE TABLE customer (id INTEGER PRIMARY KEY, name TEXT)");
  }


  public function save(Customer $data): void
  {
    try {

      if (empty($data->id)) {
        $this->db->query(
          'INSERT INTO customer (name) VALUES (:name)',
          [':name' => $data->name]
        );

      } else {
        $this->db->query(
          'UPDATE customer SET name = :name WHERE id = :id',
          [':id' => $data->id, ':name' => $data->name]
        );
      }

    } catch (PDOException $exception) {
      print $this->db->getLastError();
      exit;
    }
  }


  /**
   * @return PDOStatement|Customer[]
   */
  public function findAll(): PDOStatement
  {
    $result = $this->db->query('SELECT * FROM customer ORDER BY name');
    $result->setFetchMode(PDO::FETCH_CLASS, $this->dataClassName);

    return $result;
  }


  public function get(int $id): Customer
  {
    $result = $this->db->query('SELECT * FROM customer WHERE id = :id', [':id' => $id]);
    $result->setFetchMode(PDO::FETCH_CLASS, $this->dataClassName);

    return $result->fetch();
  }
}