<?php
declare(strict_types=1);

class IndexController
{

  /** @var Database */
  private $db;

  /** @var CustomerRepository */
  private $repo;

  /** @var Template */
  private $template;


  public function __construct(Database $db, CustomerRepository $repo, Template $template)
  {
    $this->db = $db;
    $this->repo = $repo;
    $this->template = $template;
  }


  public function process(array $data, string $target): void
  {
    //$this->repo->init();

    if (empty($data['save'])) {
      return;
    }

    $customer = new Customer($data['customer']);
    $this->repo->save($customer);

    header('Location: '.$target);
  }


  public function render(array $data): void
  {
    if (!empty($data['id'])) {
      $customerId = (int) $data['id'];
      $customer = $this->repo->get($customerId);
    } else {
      $customer = new Customer;
    }


    $this->template->setParams([
      'customers' => $this->repo->findAll(),
      'default' => $customer,
    ]);

    $this->template->render('index.php');
  }
}