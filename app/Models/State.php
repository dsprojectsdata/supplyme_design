<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

     public function Company(){
        return $this->hasMany('App\Models\Company','state_id');
    }

    public function RfqLocation(){
        return $this->hasMany('App\Models\RfqLocation','state_id');
    }
}
