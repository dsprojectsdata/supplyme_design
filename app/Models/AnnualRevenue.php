<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualRevenue extends Model
{
    use HasFactory;
    
    // AnnualRevenue model
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

}
