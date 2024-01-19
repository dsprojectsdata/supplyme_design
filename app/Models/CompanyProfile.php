<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function countryLocation()
    {
        return $this->belongsTo(Countrie::class, 'company_location_country_id');
    }
    public function stateLocation()
    {
        return $this->belongsTo(State::class, 'company_location_state_id');
    }
    public function cityLocation()
    {
        return $this->belongsTo(City::class, 'company_location_city_id');
    }

    public function companyCategory()
    {
        return $this->belongsTo(Category::class, 'company_category_id');
    }
    public function companySubCategory()
    {
        return $this->belongsTo(Category::class, 'company_sub_category_id');
    }

    public function companyType()
    {
        return $this->belongsTo(CompanyType::class, 'type_of_company');
    }

    // Getter Function's

    public function getCompanyTypeNameAttribute()
    {
        if (!$this->attributes['type_of_company']) {
            return [];
        }

        $typeIds = explode(',', $this->attributes['type_of_company']);

        $typeIds = array_filter($typeIds);
        if (empty($typeIds)) {
            return [];
        }

        $companyTypes = CompanyType::whereIn('id', $typeIds)->pluck('type_name')->toArray();

        return $companyTypes;
    }

    public function getStartedInYearAttribute()
    {
        return $this->started_in ? date('Y', strtotime($this->started_in)) : null;
    }

    // Define a getter method for company_location_country_name
    public function getCompanyLocationCountryNameAttribute()
    {
        return $this->countryLocation->name ?? null;
    }
    public function getCompanyLocationStateNameAttribute()
    {
        return $this->stateLocation->name ?? null;
    }
    public function getCompanyLocationCityNameAttribute()
    {
        return $this->cityLocation->name ?? null;
    }
    public function getCompanyCategoryNameAttribute()
    {
        return $this->companyCategory->name ?? null;
    }
    public function getCompanySubCategoryNameAttribute()
    {
        return $this->companySubCategory->name ?? null;
    }
}
