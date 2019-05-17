<?php

namespace App\Services;
use \App\Customer;
class CustomerService
{
  public function getCustomers()
  {
    return Customer::query()->select(['id', 'name'])->get();
  }

  public function addCustomers($name)
  {
    $customer = new Customer();
    $customer->name = $name;
    $customer->save();
  }

  public function getCustomer($id)
  {
    return Customer::find($id, ['id','name']);
  }

  public function updateCustomer($id, $name)
  {
    $customer = new Customer;
    if($name){
      $customer->id = $customer_id;
      $customer->name = $name;
      $customer->save();
    }
  }

  public function exists($customer_id)
  {
    return Customer::find($customer_id);
  }
}
