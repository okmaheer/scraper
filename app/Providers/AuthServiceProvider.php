<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\PatientMenuPolicy;
use App\Policies\AdministrativeMenuPolicy;
use App\Policies\BranchMenuPolicy;
use App\Policies\ChairMenuPolicy;
use App\Policies\ClinicalSpecializationMenuPolicy;
use App\Policies\TreatmentServiceMenuPolicy;
use App\Policies\TreatmentProcedureMenuPolicy;
use App\Policies\EmploymentMenuPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Implicitly grant "Super Admin" role some permissions
        Gate::before(function ($user, $ability) {
            if (in_array($ability, ['read role', 'read permission'])) {
                return $user->hasRole('Admin') ? true : null;
            }
        });

        Gate::define('view patient menu', [PatientMenuPolicy::class, 'viewPatientMenu']);
        Gate::define('view administrative menu', [AdministrativeMenuPolicy::class, 'viewAdministrativeMenu']);
        Gate::define('view branch menu', [BranchMenuPolicy::class, 'viewBranchMenu']);
        Gate::define('view chair menu', [ChairMenuPolicy::class, 'viewChairMenu']);
        Gate::define('view clinical specialization menu', [ClinicalSpecializationMenuPolicy::class, 'viewClinicalSpecializationMenu']);
        Gate::define('view treatment service menu', [TreatmentServiceMenuPolicy::class, 'viewTreatmentServiceMenu']);
        Gate::define('view treatment procedure menu', [TreatmentProcedureMenuPolicy::class, 'viewTreatmentProcedureMenu']);
        Gate::define('view employment menu', [EmploymentMenuPolicy::class, 'viewEmploymentMenu']);
    }
}
