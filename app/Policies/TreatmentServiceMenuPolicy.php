<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TreatmentServiceMenuPolicy
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

    public function viewTreatmentServiceMenu(User $user) {
        return $user->can('create treatment service') || $user->can('read treatment service');
    }
}
