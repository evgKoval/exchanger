<?php

namespace App;

use GuzzleHttp\Client;

class Coinbase
{
    const BASE_URI = 'https://api.commerce.coinbase.com';

    private $client;

    private $apiKey;

    private $apiVersion;

    public function __construct()
    {
        $this->apiKey = env('COINBASE_API_KEY');
        $this->apiVersion = env('COINBASE_API_VERSION');
        $this->client = new Client([
            'base_uri' => self::BASE_URI,
            'headers' => [
                'Content-Type' => 'application/json',
                'X-CC-Api-Key' => $this->apiKey,
                'X-CC-Version' => $this->apiVersion,
            ]
        ]);
    }

    public function getPrice($currencyTo, $currencyFrom) 
    {
        $pair = $currencyTo . '-' . $currencyFrom;

        $response = $this->client->request("GET", "https://api.coinbase.com/v2/prices/$pair/buy");

        return json_decode((string) $response->getBody(), true);
    }

    // public function createCharge($params)
    // {
    //     \DB::table('charges')->insert([
    //         [
    //             'name' => $params['name'], 
    //             'description' => $params['description'],
    //             'amount' => $params['local_price']['amount'],
    //             'currency' => $params['local_price']['currency'],
    //             'pricing_type' => $params['pricing_type']
    //         ]
    //     ]);
    // }
}