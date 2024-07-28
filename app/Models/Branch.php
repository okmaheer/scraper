<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\Helper;
use App\Traits\HasUid;
use App\Models\Patient;

class Branch extends Model
{

    use HasFactory, HasUid;
    

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];
    protected $connection = 'mysql';
    protected $appends = ['full_name', 'full_address'];

    public function patients()
    {
        return $this->hasMany(Patient::class, 'id', 'branch_id');
    }

    public function businessUnit()
    {
        return $this->belongsTo(User::class, 'businessunit_id', 'id');
    }

    public function getFullAddressAttribute()
    {
        return implode(', ', [$this->getAttribute('postal_address'), $this->getAttribute('building_name'), $this->getAttribute('locality_or_colony'), $this->getAttribute('state')]);
    }

    public function getFullNameAttribute()
    {
        return implode('/', [$this->getAttribute('name'), $this->getAttribute('name_per_incorporation')]);
    }
}
