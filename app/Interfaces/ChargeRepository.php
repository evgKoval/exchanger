<?php

namespace App\Interfaces;

use App\Interfaces\ChargeInterface;

final class ChargeRepository implements ChargeInterface
{
	public function create($params)
	{
		\DB::table('charges')->insert([
		    [
		        'name' => $params['name'], 
		        'description' => $params['description'],
		        'amount' => $params['local_price']['amount'],
		        'currency' => $params['local_price']['currency'],
		        'pricing_type' => $params['pricing_type']
		    ]
		]);
	}
}