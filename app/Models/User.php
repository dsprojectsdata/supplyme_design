<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use function PHPUnit\Framework\returnSelf;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function Company()
    {
        return $this->hasMany('App\Models\Company', 'user_id');
    }
    
        public function Jobrole()
    {
        return $this->hasOne(User::class, 'id', 'Jobrole_id');
    }

    public function companyName()
    {
        return $this->hasOne(Company::class, 'user_id');
    }

    public function RequestCompany()
    {
        return $this->hasMany('App\Models\RequestCompany', 'user_id');
    }
    
    public function chatGroups() {
        return $this->belongsToMany(Group::class, 'group_user');
    }

    public function chatGroupids() {
        return $this->chatGroups->pluck('id')->toJson();
    }
    
    public function companyData()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    
    public function rfqChats()
    {
        return $this->chatGroups()->whereNotNull('rfq_id')->get();
    }

    public function chatRfqs()
    {
        $rfqIds = $this->rfqChats()->unique('rfq_id')->pluck('rfq_id')->toArray();

        return RfqDetail::whereIn('id', $rfqIds)->get();
    }
}
