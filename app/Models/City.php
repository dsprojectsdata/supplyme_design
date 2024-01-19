<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function Company(){
        return $this->hasMany('App\Models\Company','city_id');
    }
    public function RfqLocation(){
        return $this->hasMany('App\Models\RfqLocation','city_id');
    }
}
