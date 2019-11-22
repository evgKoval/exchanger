<?php

namespace App;

use GuzzleHttp\Client;

class Coinbase
{
    const BASE_URI = 'https://api.coinbase.com';

    private $client;

    private $apiKey;

    private $apiVersion;

    public function __construct()
    {
        // $this->apiKey = env('COINBASE_API_KEY');
        // $this->apiVersion = env('COINBASE_API_VERSION');
        $this->client = new Client([
            'base_uri' => self::BASE_URI,
            'headers' => [
                'Content-Type' => 'application/json',
                'cache-control' => 'no-cache',
                'Connection' => 'keep-alive',
                'Cookie' => '__cfduid=da26fcb070cf6d27c69cf713efe7002371574412903; coinbase_device_id=f824ae38-74df-4453-aa57-675f7ff23b85; amplitude_device_id=f824ae38-74df-4453-aa57-675f7ff23b85; amplitude_device_id=; _coinbase_session=OS9RNHgwSkw5TVcydzlqR3ZFWG1HL3g1WTlRdWdZa3FkZEdPbnN0bU8xM0JPK3grbmFVNnFmT1d1UlRFTVJtejY5NWJYalFPakhGemdmeUViZzlHYzhxRXBabXJGS0pKMkpjcEYvcVJiWVllNGVTdlk3cXdWSnBnaEdKRnpNcmktLUVvbGIzc0E5cmFEazIxb0xLcENVZ1E9PQ%3D%3D--07769f0758eaf60ee4c38959d4231577ceaa72a6',
                'Accept-Encoding' => 'gzip, deflate',
                'Host' => 'api.coinbase.com',
                'Postman-Token' => '9b1fb966-1018-4538-ac27-bcc1ffc2a143,581eb61d-f226-4817-8727-059f6c4f13ac',
                'Cache-Control' => 'no-cache',
                'Accept' => '*/*',
                'User-Agent' => 'PostmanRuntime/7.19.0',
                'Authorization' => 'Bearer 28e0bfe3f4b30ceac2c0358380049e8f38bdcaeb856bcb7e5dd83045161753f1'
            ]
        ]);
    }

    public function getPrice($currencyTo, $currencyFrom) 
    {
        $pair = $currencyTo . '-' . $currencyFrom;

        $response = $this->client->request("GET", "https://api.coinbase.com/v2/prices/$pair/buy");

        return json_decode((string) $response->getBody(), true);
    }

    public function user()
    {
        try {
            $response = $this->client->get("/v2/user");
        } catch (Guzzle\Http\Exception\BadResponseException $e) {
            echo 'Uh oh! ' . $e->getMessage();
        }

        return json_decode((string) $response->getBody(), true);
    }

    public function buy($params)
    {
        try {
            $response = $this->client->post("/v2/accounts/e5ea640f-ec62-5b02-8834-4dc5cbf18e77/buys", [
                'body' => [
                    'amount' => $params['amount'],
                    'currency' => $params['currency']
                ]
            ]);
        } catch (Guzzle\Http\Exception\BadResponseException $e) {
            echo 'Uh oh! ' . $e->getMessage();
        }

        return json_decode((string) $response->getBody(), true);
    }
}