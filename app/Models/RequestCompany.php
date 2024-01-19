<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestCompany extends Model
{
    use HasFactory;

    public function User(){
        return $this->belongsTo('App\Models\User', );
    }
    // public function Company(){
    //     return $this->belongsTo('App\Models\Company');
    // }


     public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
