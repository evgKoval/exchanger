<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\ChargeInterface;

class ChargesController extends Controller
{
    public function create(ChargeInterface $chargeInterface)
    {
    	$chargeInterface->create([
		    'name' => 'Name',
		    'description' => 'Description',
		    'local_price' => [
		        'amount' => 100,
		        'currency' => 'USD',
		    ],
		    'pricing_type' => 'fixed_price',
		]);
    }
}
