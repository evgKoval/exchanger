<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\CurrencyInterface;
use App\Coinbase;

class CurrenciesRatesController extends Controller
{
    public function currenciesAll(CurrencyInterface $currencyInterface)
    {
    	$coinbase = new Coinbase();

        return $coinbase->getPrice('BTC', 'UAH');
    }
}
