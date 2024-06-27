<?php

class CustomerFactory
{

  public function createFromArray(array $data = null): Customer
  {
    $customer = new Customer;

    foreach ($data as $property => $value) {
      $customer->$property = $value;
    }

    return $customer;
  }

}