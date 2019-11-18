<?php

namespace App\Interfaces;

use App\Interfaces\CurrencyInterface;
use App\Currency;
use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration;
use App\Coinbase;

final class ArrayCurrencyRepository implements CurrencyInterface
{
    public function getAll() {
        // $apiKey = 'nKFtZyJZLPxrGVzVxBMxZrhnI48u2kzdiOA1MtYm5j5xL0oScCVAa+c5K16nuz5mtd5JP8/83YmhsGA7NNn+2A==';
        // $apiSecret = 'fcd8d310c68184a8425a723df774e35b';

        // $configuration = Configuration::apiKey($apiKey, $apiSecret);
        // $client = Client::create($configuration);

        // $rates = [];

        // $btc = $client->getBuyPrice('BTC-UAH');
        // $eth = $client->getBuyPrice('ETH-UAH');
        // $bch = $client->getBuyPrice('BCH-UAH');
        // $ltc = $client->getBuyPrice('LTC-UAH');

        // $rates[] = [
        // 	'name' => 'Bitcoin', 
        // 	'currency' => 'BTC', 
        // 	'logo' => 'https://dynamic-assets.coinbase.com/e785e0181f1a23a30d9476038d9be91e9f6c63959b538eabbc51a1abc8898940383291eede695c3b8dfaa1829a9b57f5a2d0a16b0523580346c6b8fab67af14b/asset_icons/b57ac673f06a4b0338a596817eb0a50ce16e2059f327dc117744449a47915cb2.png',
        // 	'rate' => $btc
        // ];
        // $rates[] = [
        // 	'name' => 'Ethereum', 
        // 	'currency' => 'ETH', 
        // 	'logo' => 'https://dynamic-assets.coinbase.com/7796fb1bd5752a156c77e0b1fa28fb17e93d03b4b8e2dcff58dcaf8f99b2e4a3c3af2cd905d5536761c54ac273d62d91a38ef8e5702fa988c37264e7aba36b3b/asset_icons/3af4b33bde3012fd29dd1366b0ad737660f24acc91750ee30a034a0679256d0b.png',
        // 	'rate' => $eth
        // ];
        // $rates[] = [
        // 	'name' => 'Bitcoin Cash', 
        // 	'currency' => 'BCH', 
        // 	'logo' => 'https://dynamic-assets.coinbase.com/93a4303d1b0410b79bb1feac01020e4e7bdf8e6ece68282d0af2c7d0b481c5f5c44c0cec1d7071ae8f84674dbd139e290d50a038a6a4c1bbc856ec0871b5f3e2/asset_icons/3af4b33bde3012fd29dd1366b0ad737660f24acc91750ee30a034a0679256d0b.png',
        // 	'rate' => $bch
        // ];
        // $rates[] = [
        // 	'name' => 'Litecoin', 
        // 	'currency' => 'LTC', 
        // 	'logo' => 'https://dynamic-assets.coinbase.com/f018870b721574ef7f269b9fd91b36042dc05ebed4ae9dcdc340a1bae5b359e8760a8c224bc99466db704d10a3e23cf1f4cd1ff6f647340c4c9c899a9e6595cd/asset_icons/984a4fe2ba5b2c325c06e4c2f3ba3f1c1fef1f157edb3b8ebbfe234340a157a5.png',
        // 	'rate' => $ltc
        // ];

        // return $rates;

        //$coinbase = new Coinbase('i');

        //dd($coinbase->getPrice('BTC-UAH'));

        return '1';
    }

    // public function createChargeFromRepo($params) 
    // {
    // 	$coinbase = new Coinbase();

    // 	$coinbase->createCharge($params);
    // }
}