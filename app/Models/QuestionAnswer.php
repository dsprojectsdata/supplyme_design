<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'response' => 'array',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
