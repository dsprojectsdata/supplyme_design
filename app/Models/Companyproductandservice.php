<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companyproductandservice extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsTo(Category::class, 'product_category');
    }
    public function subcategories()
    {
        return $this->belongsTo(Category::class, 'product_sub_category');
    }
    public function countries()
    {
        return $this->belongsTo(Countrie::class, 'product_country');
    }
    public function typeofoffering()
    {
        return $this->belongsTo(TypeOfOffering::class, 'type_of_offering', 'slug');
    }
}
