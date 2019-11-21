<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\CurrencyRepository;
use App\Http\Requests\StoreCurrency;

class CurrenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CurrencyRepository $currencyRepository)
    {
        return $currencyRepository->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRepository $currencyRepository, StoreCurrency $request)
    {
        $request->validated();

        $currencyRepository->store([
            'name' => $request->name,
            'currency' => $request->currency,
            'logo' => $request->logo,
            'reserves' => $request->reserves
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CurrencyRepository $currencyRepository, $id)
    {
        return $currencyRepository->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyRepository $currencyRepository, Request $request, $id)
    {
        $currencyRepository->update([
            'name' => $request->name,
            'currency' => $request->currency,
            'logo' => $request->logo,
            'reserves' => $request->reserves
        ], $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CurrencyRepository $currencyRepository, $id)
    {
        $currencyRepository->destroy($id);
    }
}
