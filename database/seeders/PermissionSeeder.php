<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = Module::all();
        $permissions = array();

        foreach ($modules as $key => $module) {
            $moduleName = explode(' ', strtolower($module->name));
            $permissions[] = [
                'module_id' => $module->id,
                'name' => implode(' ', ['create', ...$moduleName]),
                'guard_name' => 'web',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ];

            $permissions[] = [
                'module_id' => $module->id,
                'name' => implode(' ', ['read', ...$moduleName]),
                'guard_name' => 'web',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ];

            $permissions[] = [
                'module_id' => $module->id,
                'name' => implode(' ', ['update', ...$moduleName]),
                'guard_name' => 'web',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ];

            $permissions[] = [
                'module_id' => $module->id,
                'name' => implode(' ', ['delete', ...$moduleName]),
                'guard_name' => 'web',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ];
        }
        Permission::insert($permissions);
    }
}
