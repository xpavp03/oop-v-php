<?php
declare(strict_types=1);

class IndexController
{

  /** @var Database */
  private $db;

  /** @var CustomerRepository */
  private $customerRepo;

  /** @var CustomerFactory */
  private $customerFactory;

  /** @var Template */
  private $template;


  public function __construct(Database $db, CustomerRepository $repo, CustomerFactory $customerFactory, Template $template)
  {
    $this->db = $db;
    $this->customerRepo = $repo;
    $this->template = $template;
    $this->customerFactory = $customerFactory;
  }


  public function process(array $data, string $target): void
  {
    //$this->repo->init();

    if (empty($data['save'])) {
      return;
    }

    $customer = $this->customerFactory->create($data['customer']);
    $this->customerRepo->save($customer);

    $this->redirect($target);
  }


  public function render(array $data): void
  {
    if (!empty($data['id'])) {
      $customerId = (int) $data['id'];
      $customer = $this->customerRepo->get($customerId);
    } else {
      $customer = new Customer;
    }


    $this->template->setParams([
      'customers' => $this->customerRepo->findAll(),
      'default' => $customer,
    ]);

    $this->template->render('index.php');
  }


  private function redirect(string $target): void
  {
    header('Location: ' . $target);
    exit;
  }
}