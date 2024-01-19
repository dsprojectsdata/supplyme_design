<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CcgFeed extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id')->latest('id');
    }

    public function ccGroup()
    {
        return $this->belongsTo(CompanyCollaboratorsGroup::class, 'company_collaborator_group_id', 'id');
    }
    
    public function questionnaires()
    {
        return $this->morphMany(Questionnaire::class, 'typeable');
    }
}
