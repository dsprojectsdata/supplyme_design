<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupSupplier extends Model
{
    use HasFactory;
    public function supplier()
    {
        return $this->belongsTo(Company::class, 'supplier_id', 'id');
    }
}
