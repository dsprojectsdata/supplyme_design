<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function RequestCompany()
    {
        return $this->hasMany('App\Models\RequestCompany', 'company_id');
    }
    public function State()
    {
        return $this->belongsTo('App\Models\State', 'state_id');
    }
    public function Countrie()
    {
        return $this->belongsTo('App\Models\Countrie', 'countrie_id');
    }
    public function City()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function requestCompanies()
    {
        return $this->hasMany(RequestCompany::class, 'company_id', 'id');
    }

    public function companyLocations()
    {
        return $this->hasMany(Companylocation::class, 'company_id', 'id');
    }
    public function companyprofilebrandlogos()
    {
        return $this->hasMany(Companyprofilebrandlogo::class, 'company_id', 'id');
    }
    public function companyprofile()
    {
        return $this->hasOne(CompanyProfile::class, 'company_id');
    }
    public function RfqSupplierRequest()
    {
        return $this->hasOne(RfqSupplierRequest::class, 'company_id');
    }
    public function companyprofilecustomerandclients()
    {
        return $this->hasMany(Companyprofilecustomerandclient::class, 'company_id');
    }
    public function companyproductandservices()
    {
        return $this->hasMany(Companyproductandservice::class, 'company_id');
    }
    public function annualrevenue()
    {
        return $this->hasMany(AnnualRevenue::class, 'company_id');
    }
    public function companyproductandservicesWithRelationships()
    {
        return $this->hasMany(Companyproductandservice::class)
            ->with('typeofoffering', 'categories', 'subcategories', 'countries');
    }

    // ccg groups

    public function myGroups()
    {
        return $this->hasMany(CompanyCollaboratorsGroup::class, 'company_id');
    }

    public function joinedGroups()
    {
        return $this->belongsToMany(CompanyCollaboratorsGroup::class, 'group_suppliers', 'supplier_id', 'group_id')->wherePivot('status', '=', 1);
    }

    // feed groups

    public function feedGroups()
    {
        $feedGroups = $this->myGroups->merge($this->joinedGroups);

        return $feedGroups;
    }

    public function isCreated($ccgId)
    {
        return in_array($ccgId, $this->myGroups->pluck('id')->toArray());
    }

    public function isJoined($ccgId)
    {
        return in_array($ccgId, $this->joinedGroups->pluck('id')->toArray());
    }
    
    public function groupSuppliers()
    {
        return $this->hasMany(GroupSupplier::class, 'supplier_id');
    }
    
    public function groupTeamMembers()
    {
        return $this->hasMany(GroupTeamMember::class, 'company_id');
    }
    
    public function teamMembers()
    {
        return $this->hasMany(User::class, 'company_id');
    }
}
