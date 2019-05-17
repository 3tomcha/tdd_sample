<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiController extends Controller
{
  public function getCustomers(CustomerService $customer_service)
  {
    return response()->json($customer_service->getCustomers());
    // 下記のうち、\App\Customer::query()->select(['id', 'name'])->get()部分をサービスクラスに移動
    // return response()->json(\App\Customer::query()->select(['id', 'name'])->get());
  }

  public function postCustomers(Request $request, CustomerService $customer_service)
  {
    $this->validate($request,
    ['name' => 'required'],
  );

  $customer_service->addCustomers($request->json('name'));
  // 下記をサービスクラスでリファクタリング
  // $customer = new \App\Customer();
  // $customer->name = $request->json('name');
  // $customer->save();

  //   $this->validate($request,
  //   ['name' => 'required'],
  // );
  // 下記はvalidateメソッドと同じ意味
  // if ( ! $request->json('name')) {
  //   return response()->json(
  //     [],
  //     \Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY
  //   );
  // }
}

public function getCustomer($customer_id, CustomerService $customer_service)
{
  if (! $customer_service->exists($customer_id)) {
    abort(Response::HTTP_NOT_FOUND);
  }
  $customer = $customer_service->getCustomer($customer_id);
  return $customer->toJson();
}

public function postCustomer(Request $request, $customer_id, CustomerService $customer_service)
{
  if (! $customer_service->exists($customer_id)) {
    abort(Response::HTTP_NOT_FOUND);
  }
  $customer = $customer_service->updateCustomer($customer_id, $request->input('name'));
}

public function deleteCustomer()
{

}

public function getReports()
{

}

public function postReports()
{

}

public function getReport()
{

}

public function postReport()
{

}

public function deleteReport()
{

}


}
