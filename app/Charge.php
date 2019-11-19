<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    protected $fillable = ['email', 'currencies_id_from', 'currencies_id_to', 'give', 'take'];

    public static function create($params) 
    {
        $charge = new static;
        $charge->fill($params);
        $charge->save();
        return $charge;
    }
}
