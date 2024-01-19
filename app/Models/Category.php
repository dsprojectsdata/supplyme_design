<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function parents(){
       return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function RfqDetail(){
        return $this->hasMany('App\Models\RfqDetail','category_id');
    }    

    
}
