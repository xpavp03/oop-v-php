<?php
declare(strict_types=1);

class IndexController
{

  public function __construct(
    private readonly CustomerRepository $customerRepository,
    private readonly CustomerFactory    $customerFactory,
    private readonly TemplateEngine     $templateEngine,
  )
  {
  }


  public function process(array $data, string $urlThisPage): void
  {
    //$this->repo->init();

    if ($this->isFormSubmitted($data)) {
      return;
    }

    $customer = $this->customerFactory->createFromArray($data['customer']);
    $this->customerRepository->save($customer);

    $this->redirect($urlThisPage);
  }


  public function render(array $data): void
  {
    if (!empty($data['id'])) {
      $customerId = (int) $data['id'];
      $customer = $this->customerRepository->get($customerId);
    } else {
      $customer = new Customer;
    }


    $this->templateEngine->setParams([
      'customers' => $this->customerRepository->findAll(),
      'default' => $customer,
    ]);

    $this->templateEngine->render('index');
  }


  private function redirect(string $target): void
  {
    header('Location: ' . $target);
    exit;
  }


    private function isFormSubmitted(array $data): bool
    {
        return empty($data['save']);
    }
}