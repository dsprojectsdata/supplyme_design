<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCollaboratorsGroup extends Model
{
    use HasFactory;

    public function collaboratorsGroups()
    {
        return $this->hasMany(GroupSupplier::class, 'group_id', 'id');
    }

    public function teamMembers()
    {
        return $this->belongsToMany(User::class, 'group_team_members', 'group_id', 'team_member_id');
    }

    public function suppliers()
    {
        return $this->belongsToMany(Company::class, 'group_suppliers', 'group_id', 'supplier_id');
    }
    // Function to get all team members associated with the group
    public function getTeamMembersAttribute()
    {
        return $this->teamMembers()->get();
    }

    // Function to get all suppliers associated with the group
    public function getSuppliersAttribute()
    {
        return $this->suppliers()->get();
    }

    // Function to get the count of team members associated with the group
    public function getTeamMemberCountAttribute()
    {
        return $this->teamMembers()->count();
    }

    // Function to get the count of suppliers associated with the group
    public function getSupplierCountAttribute()
    {
        return $this->suppliers()->where('status', '<>', 0)->count();
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    public function supplierStatus()
    {
        return $this->belongsTo(GroupSupplier::class, 'id', 'group_id');
    }
    public function supplierTeamMembers()
    {
        return $this->belongsToMany(User::class, 'group_team_members', 'group_id', 'team_member_id')->where('group_team_members.company_id', auth()->user()->company_id);
    }
    public function buyerTeamMembers()
    {
        return $this->belongsToMany(User::class, 'group_team_members', 'group_id', 'team_member_id')->where('group_team_members.company_id', auth()->user()->company_id);
    }

    // ccg feeds
    public function ccgFeeds()
    {
        return $this->hasMany(CcgFeed::class, 'company_collaborator_group_id', 'id');
    }

    public function connectedSuppliers()
    {
        return $this->belongsToMany(Company::class, 'group_suppliers', 'group_id', 'supplier_id')->wherePivot('status', '=', 1);
    }
    
    public function questionnaires()
    {
        return $this->hasManyThrough(Questionnaire::class, CcgFeed::class, 'company_collaborator_group_id', 'typeable_id', 'id', 'id')->whereHasMorph('typeable', CcgFeed::class);
    }
}
