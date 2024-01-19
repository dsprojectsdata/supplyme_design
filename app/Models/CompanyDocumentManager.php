<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDocumentManager extends Model
{
    use HasFactory;
    public function Countrie(){
        return $this->belongsTo('App\Models\Countrie','country_id');
    }
}
