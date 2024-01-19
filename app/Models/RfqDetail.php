<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfqDetail extends Model
{
    use HasFactory;

    public function Category(){
        return $this->belongsTo('App\Models\Category');
    }
    
    public function company()
    {
        return $this->belongsTo(company::class, 'company_id');
    }
    
    public function chatGroup()
    {
        return $this->hasMany(Group::class, 'rfq_id');
    }
}
