<?php

namespace App\Interfaces;

use App\Interfaces\ChargeInterface;
use App\Charge;

final class ChargeRepository implements ChargeInterface
{
	public function create($params)
	{
		Charge::create($params);
	}
}