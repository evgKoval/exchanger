<?php

namespace App\Interfaces;

use App\Interfaces\CurrencyInterface;
use App\Currency;

final class CurrencyRepository implements CurrencyInterface
{
    public function index()
    {
        return Currency::all();
    }

    public function store($params)
    {
        return Currency::create($params);
    }

    public function show($id)
    {
        return Currency::find($id);
    }

    public function update($params, $id)
    {
        $currency = Currency::find($id);
        $currency->name = $params['name'];
        $currency->currency = $params['currency'];
        $currency->logo = $params['logo'];
        $currency->reserves = $params['reserves'];

        $currency->save();

        return $currency;
    }

    public function destroy($id)
    {
        return Currency::destroy($id);
    }
}