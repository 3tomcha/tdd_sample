<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

class ReportTest extends TestCase
{
  use RefreshDatabase;

  public function setUp()
  {
    parent::setUp();
    $this->artisan('migrate:fresh');
    $this->artisan('db:seed');
  }



  /**
  * @test
  */
  public function api_customersにGETメソッドでアクセスできる()
  {
    $response = $this->get('api/customers');
    $response->assertStatus(200);
  }

  /**
  * @test
  */
  public function api_customersにPOSTメソッドでアクセスできる()
  {
    $customer = [
      'name' => 'customer_name',
    ];
    $response = $this->postJson('api/customers', $customer);
    $response->assertStatus(200);
  }

  /**
  * @test
  */
  public function api_customers_customeridに存在しないidでGETメソッドでアクセスできると404エラーになる()
  {
    $response = $this->get('api/customers/10000');
    $response->assertStatus(Response::HTTP_NOT_FOUND);
  }

  /**
  * @test
  */
  public function api_customers_customeridにGETメソッドでアクセスできる()
  {
    $response = $this->get('api/customers/1');
    $response->assertStatus(200);
  }


  /**
  * @test
  */
  public function api_customers_customeridに存在しないidでPUTメソッドでアクセスできると404エラーになる()
  {
    $response = $this->put('api/customers/10000');
    $response->assertStatus(Response::HTTP_NOT_FOUND);
  }

  
  /**
  * @test
  */
  public function api_customers_customeridにPUTメソッドでアクセスできる()
  {
    $response = $this->put('api/customers/1');
    $response->assertStatus(200);
  }

  /**
  * @test
  */
  public function api_customers_customeridにDELETEメソッドでアクセスできる()
  {
    $response = $this->delete('api/customers/1');
    $response->assertStatus(200);
  }

  /**
  * @test
  */
  public function api_reportsにGETメソッドでアクセスできる()
  {
    $response = $this->get('api/reports');
    $response->assertStatus(200);
  }
  /**
  * @test
  */
  public function api_reportsにPOSTメソッドでアクセスできる()
  {
    $response = $this->post('api/reports');
    $response->assertStatus(200);
  }
  /**
  * @test
  */
  public function api_reports_report_idにGETメソッドでアクセスできる()
  {
    $response = $this->get('api/reports/1');
    $response->assertStatus(200);
  }

  /**
  * @test
  */
  public function api_reports_report_idにPUTメソッドでアクセスできる()
  {
    $response = $this->put('api/reports/1');
    $response->assertStatus(200);
  }

  /**
  * @test
  */
  public function api_reports_report_idにDELETEメソッドでアクセスできる()
  {
    $response = $this->delete('api/reports/1');
    $response->assertStatus(200);
  }

  /**
  * @test
  */
  public function api_customersにGETメソッドでアクセスするとJSONが返却される()
  {
    $response = $this->get('api/customers');
    $this->assertThat($response->content(), $this->isJSON());
  }

  /**
  * @test
  */
  public function api_customersにGETメソッドで取得できる顧客情報のJSON形式は用件通りである()
  {
    $response = $this->get('api/customers');
    $customers = $response->json();
    $customer = $customers[0];
    $this->assertSame(['id', 'name'], array_keys($customer));
  }

  /**
  * @test
  */
  public function api_customersにGETメソッドでアクセスすると2件の顧客リストが返却される()
  {
    $response = $this->get('api/customers');
    $response->assertJsonCount(2);
  }

  /**
  * @test
  */
  public function api_customersに顧客名をPOSTするとcustomersテーブルにそのデータが追加される()
  {
    $params = [
      'name' => '顧客名',
    ];
    $this->postJson('api/customers', $params);
    $this->assertDatabaseHas('customers', $params);
  }

  /**
  * @test
  */
  public function POST_api_customersにnameが含まれない場合は422UnprocessableEntityが返却される()
  {
    $params = [];
    $response = $this->postJson('api/customers', $params);
    $response->assertStatus(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
  }

  /**
  * @test
  */
  public function POST_api_customersにnameが空の場合422UnprocessableEntityが返却される()
  {
    $params = ['name' => ''];
    $response = $this->postJson('api/customers', $params);
    $response->assertStatus(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
  }

  /**
  * @test
  */
  public function POST_api_customersのエラーレスポンスの確認()
  {
    $params = ['name' => ''];
    $response = $this->postJson('api/customers', $params);

    $error_response = [
      'errors' => [
        'name' => [
          'name は必須項目です'
        ]
      ],
      'message' => 'The given data was invalid.'
    ];
    $response->assertExactJson($error_response);
  }
}
