<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['name', 'reserves', 'currency', 'logo'];

    public static function create($params) 
    {
        $charge = new static;
        $charge->fill($params);
        $charge->save();
        return $charge;
    }
}
