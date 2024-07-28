<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClinicalSpecializationMenuPolicy
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

    public function viewClinicalSpecializationMenu(User $user) {
        return $user->can('create clinical specialization') || $user->can('read clinical specialization');
    }
}
