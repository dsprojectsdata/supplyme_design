<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobrole extends Model
{
    use HasFactory;
    
    public function User()
    {
        return $this->hasMany('App\Models\User', 'Jobrole_id');
    }
}
