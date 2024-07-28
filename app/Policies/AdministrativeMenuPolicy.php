<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdministrativeMenuPolicy
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

    public function viewAdministrativeMenu(User $user) {
        return $user->can('view branch menu') ||
            $user->can('view chair menu') ||
            $user->can('view clinical specialization menu') ||
            $user->can('view tratment service menu') ||
            $user->can('view treatment procedure menu') ||
            $user->can('view employment menu');
    }
}
