<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUid;

class Appointment extends Model
{

    use HasUid, HasFactory;

    protected $guarded = ['id'];
    protected $connection = 'mysql';

    public function branch() {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function chair() {
        return $this->belongsTo(Chair::class, 'chair_id', 'id');
    }

    public function employee() {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function patient() {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
}
