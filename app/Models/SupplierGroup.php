<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierGroup extends Model
{
    use HasFactory;
  
  	protected $table = 'supplier_groups';
  
    protected $fillable = ['name', 'company_id', 'supplier_id', 'created_by'];
  
}
