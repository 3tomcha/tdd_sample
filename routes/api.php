<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('customers', function(){});
Route::post('customers', function(\Illuminate\Http\Request $request){
  $customer = new \App\Customer();
  $customer->name = $request->json('name');
  
});

Route::get('customers/{customer_id}', function(){});
Route::put('customers/{customer_id}', function(){});
Route::delete('customers/{customer_id}', function(){});
Route::get('reports', function(){});
Route::post('reports', function(){});
Route::get('reports/{customer_id}', function(){});
Route::put('reports/{customer_id}', function(){});
Route::delete('reports/{customer_id}', function(){});
Route::get('customers', function(){
  return response()->json(\App\Customer::query()->select(['id', 'name'])->get());
});