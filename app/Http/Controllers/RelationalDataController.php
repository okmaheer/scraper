<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\RelationalDataTrait;

class RelationalDataController extends Controller
{
    use RelationalDataTrait;

    public function fetchBranchData(Request $request)
    {
        if ($request->module === 'appointment.create') {
            return response()->json([
                'chairs' => $this->getChairsByBranch($request->branch_id),
                'patients' => $this->getPatientsByBranch($request->branch_id),
                'dentists' => $this->getEmploymentsByBranch($request->branch_id, 'Duty Doctor'),
                'cases' => $this->getCasesByBranch($request->branch_id)
            ], 200);
        } else if ($request->module === 'case.complaint') {
            return response()->json([
                'dentists' => $this->getEmploymentsByBranch($request->branch_id, $request->job_role)
            ], 200);
        }
    }

    public function fetchTreatmentCategoryServices(Request $request, $categoryId)
    {
        return response()->json([
            'services' => $this->getTreatmentServicesByCategory($categoryId)
        ], 200);
    }

    public function fetchTreatmentServiceProcedures(Request $request, $serviceId)
    {
        return response()->json([
            'procedures' => $this->getTreatmentProceduresByService($serviceId)
        ], 200);
    }
}
