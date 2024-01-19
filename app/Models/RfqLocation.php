<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfqLocation extends Model
{
    use HasFactory;

    public function State(){
        return $this->belongsTo('App\Models\State');
    }
    public function Countrie(){
        return $this->belongsTo('App\Models\Countrie');
    }
    public function City(){
        return $this->belongsTo('App\Models\City');
    }
}
