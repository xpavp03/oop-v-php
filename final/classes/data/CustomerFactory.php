<?php

class CustomerFactory
{

  public function create(array $data = null): Customer
  {
    $customer = new Customer;

    foreach ($data as $property => $value) {
      $customer->$property = $value;
    }

    return $customer;
  }

}