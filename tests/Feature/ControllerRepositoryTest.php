<?php

namespace Tests\Feature;

use App\Currency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ControllerRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * @var
     */
    private $requestData;
    /**
     * @var
     */
    private $uri;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->uri = '/api/v1/currencies';
        $this->requestData = $this->getRequestData();
    }

    public function test_getting_201_post_ControllerRepositoryTest()
    {
        // POST request with data
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', $this->uri, $this->requestData);
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_getting_200_get_ControllerRepositoryTest()
    {
        // GET request with data
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('GET', $this->uri, $this->requestData);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_call_returns_correct_response_for_valid_data()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', $this->uri, $this->requestData);
        $this->assertEquals(201, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('name', $content);
        $this->assertArrayHasKey('currency', $content);
        $this->assertArrayHasKey('logo', $content);
        $this->assertArrayHasKey('reserves', $content);
    }

    public function test_call_saves_data_correctly_in_database()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', $this->uri, $this->requestData);
        $this->assertEquals(201, $response->getStatusCode());

        $responseArray = json_decode($response->getContent(), true);

        $currency = Currency::where('name', $responseArray['name'])->first();

        $this->assertInstanceOf(Currency::class, $currency);
        $this->assertEquals($currency->name, $this->requestData['name']);
        $this->assertEquals($currency->currency, $this->requestData['currency']);
        $this->assertEquals($currency->logo, $this->requestData['logo']);
        $this->assertEquals($currency->reserves, $this->requestData['reserves']);
    }

    public function test_saves_call_does_not_create_duplicate_row()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', $this->uri, $this->requestData);
        $this->assertEquals(201, $response->getStatusCode());

        $count1 = Currency::where('name', $this->requestData['name'])
            ->get()
            ->count();

        // Making the same call

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('GET', $this->uri, $this->requestData);
        $this->assertEquals(200, $response->getStatusCode());

        $count2 = Currency::where('name', $this->requestData['name'])
            ->get()
            ->count();

        $this->assertEquals($count1, $count2);
    }

    public function test_call_gets_data_correctly_from_database()
    {
        // Create new and save, check if correct
        $response = $this->withHeaders([
                    'Content-Type' => 'application/json',
                ])->json('POST', $this->uri, $this->requestData);
                $this->assertEquals(201, $response->getStatusCode());

        $responseArray = json_decode($response->getContent(), true);

        $currency = Currency::where('name', $responseArray['name'])->first();

        $this->assertInstanceOf(Currency::class, $currency);

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('GET', $this->uri . '/' . $currency->id);
        $this->assertEquals(200, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('name', $content);
        $this->assertArrayHasKey('currency', $content);
        $this->assertArrayHasKey('logo', $content);
        $this->assertArrayHasKey('reserves', $content);
    }

    public function test_call_updates_data_correctly_in_database()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', $this->uri, $this->requestData);
        $this->assertEquals(201, $response->getStatusCode());

        $responseArray = json_decode($response->getContent(), true);

        $currency = Currency::where('name', $responseArray['name'])->first();

        $this->assertInstanceOf(Currency::class, $currency);

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('PUT', $this->uri . '/' . $currency->id, $this->requestData);
        $this->assertEquals(200, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);

        $this->assertEquals($content['name'], $currency->name);
        $this->assertEquals($content['currency'], $currency->currency);
        $this->assertEquals($content['logo'], $currency->logo);
        $this->assertEquals($content['reserves'], $currency->reserves);
    }

    public function test_call_removes_data_correctly_in_database()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', $this->uri, $this->requestData);

        $content = json_decode($response->getContent(), true);

        $this->assertEquals(201, $response->getStatusCode());

        // Check for correct data

        $currency = Currency::where('name', $content['name'])->first();
        $this->assertInstanceOf(Currency::class, $currency);

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('DELETE', $this->uri . '/' . $currency->id);
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertSoftDeleted('currencies', [
            'id' => $currency->id
        ]);
    }

    public function test_call_gets_limitation_error()
    {

        $data = $this->getRequestData();

        // set limit to 1 (to get limitation by the next request)
        $update['name'] = 'BitcoinLOL';

        dump(Currency::class);
        Currency::find($data['id'])->update($update);

        $response = $this->call('POST', $this->uri, $data);
        $response->assertStatus(201);

        // create new article for the new pr_user_intel_links row

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', $this->uri, $this->requestData);
        $this->assertEquals(201, $response->getStatusCode());

        $responseArray = json_decode($response->getContent(), true);
        dd($data);
        $data['id'] = $responseArray['id'];

        $response = $this->call('POST', $this->uri, $data);

        // should get limit exception: The limit has already been met.

        $response->assertStatus(400);
        $response->assertSee('The limit has already been met.');
    }

    public function getRequestData()
    {
        // $currency = factory(Currency::class)->create();
        $currency = [
            'id' => 1,
            'name' => 'LitecoinLOL',
            'currency' => 'LTC',
            'logo' => 'https://dynamic',
            'reserves' => 6879
        ];
        return $currency;
    }
}
