<?php

namespace App\Interfaces;

interface CurrencyInterface
{
    public function index();
    public function store($params);
    public function show($id);
    public function update($params, $id);
    public function destroy($id);
}