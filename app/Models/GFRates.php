<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class GFRates extends Model
{
    use HasFactory;
    protected $table ='gfrates';

    protected $sellUSDPrice;
    protected $buyUSDPrice;

    public function getRates(){
        return GFRates::first();
    }
}
