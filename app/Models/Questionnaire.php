<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Questionnaire extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function submissions()
    {
        return $this->belongsToMany(Company::class, 'questionnaire_responses', 'questionnaire_id', 'company_id');
    }

    public function typeable(): MorphTo
    {
        return $this->morphTo();
    }

    public function answers()
    {
        return $this->hasMany(QuestionnaireResponse::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function isSubmittedBy($companyId) {
        return in_array($companyId, $this->submissions->pluck('id')->toArray());
    }

}
