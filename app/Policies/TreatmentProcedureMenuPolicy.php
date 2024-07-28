<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TreatmentProcedureMenuPolicy
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

    public function viewTreatmentProcedureMenu(User $user) {
        return $user->can('create treatment procedure') || $user->can('read treatment procedure');
    }
}
