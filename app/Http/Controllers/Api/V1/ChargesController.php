<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\ChargeInterface;

class ChargesController extends Controller
{
    public function create(ChargeInterface $chargeInterface, Request $request)
    {
    	$chargeInterface->create([
		    'email' => $request->email,
		    'currencies_id_from' => $request->walletFrom,
		    'currencies_id_to' => $request->walletTo,
		    'give' => $request->give,
		    'take' => $request->take
		]); 
    }
}
