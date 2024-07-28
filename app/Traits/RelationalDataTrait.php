<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Patient;
use App\Models\Chair;
use App\Models\User;
use App\Models\TreatmentService;
use App\Models\TreatmentProcedure;
use App\Models\CaseRecord;

trait RelationalDataTrait {
    public function getBranchesByAuth() 
    {
        return Branch::where('businessunit_id', Auth::user()->id)
            ->select('id', 'name', 'name_per_incorporation')
            ->get();
    }

    public function getPatientsByBranch($branch_id) 
    {
        return Patient::where('branch_id', $branch_id)
            ->get();
    }

    public function getChairsByBranch($branch_id) 
    {
        return Chair::where('branch_id', $branch_id)
            ->get();
    }

    public function getEmploymentsByBranch($branch_id, $job_role) 
    {
        return User::where('branch_id', $branch_id)
            ->whereHas('roles', function($query) use($job_role){
                $query->where('name', $job_role);
            })
            ->get();
    }

    public function getCasesByBranch($branch_id)
    {
        return CaseRecord::with('patient')
            ->where('branch_id', $branch_id)
            ->get();
    }

    public function getTreatmentServicesByCategory($categoryId)
    {
        return TreatmentService::where('category_id', $categoryId)
            ->get();
    }

    public function getTreatmentProceduresByService($serviceId)
    {
        return TreatmentService::with('procedures')->find($serviceId)->procedures;
    }
}