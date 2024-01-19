<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    // this model is for chat group
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function hasUser($user_id)
    {
        foreach ($this->users as $user) {
            if($user->id == $user_id) {
                return true;
            }
        }
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'group_id')->withTrashed()->whereNotNull('group_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Company::class, 'supplier_id');
    }
    
    public function partner()
    {
        return $this->belongsTo(Company::class, 'partner_id');
    }

    public function partner1()
    {
        return $this->belongsTo(Company::class, 'partner_id_1');
    }
    
    public function rfq()
    {
        return $this->belongsTo(RfqDetail::class, 'rfq_id');
    }
}
