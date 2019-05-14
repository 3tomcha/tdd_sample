<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportTest extends TestCase
{
  use RefreshDatabase;

  public function setUp()
  {
    parent::setUp();
    $this->artisan('db:seed',['--class' => 'TestDataSeeder']);
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
    $response = $this->post('api/customers');
    $response->assertStatus(200);
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
}