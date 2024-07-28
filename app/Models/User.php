<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    protected $connection = 'mysql';

    use HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

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

    /**
     * 
     * Relation to get details
     */
    public function details () {
        return $this->hasOne(UserDetail::class, 'user_id', 'id');
    }

    /**
     * 
     * Relation to get details
     */
    public function branch () {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }

    /**
     * 
     * Relation to get partner
     */
    public function partner () {
        return $this->belongsTo(User::class, 'partner_id', 'id');
    }

    /**
     * 
     * Relation to get business unit
     */
    public function businessUnit () {
        return $this->belongsTo(User::class, 'businessunit_id', 'id');
    }
}
