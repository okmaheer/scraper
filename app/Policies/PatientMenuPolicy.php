<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientMenuPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewPatientMenu(User $user) {
        return $user->can('create patient') || 
            $user->can('read patient') || 
            $user->can('create appointment') || 
            $user->can('read appointment');
    }
}
