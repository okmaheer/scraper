<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use Carbon\Carbon;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            [
                'name' => 'Role',
                'description' => '',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name' => 'Permission',
                'description' => '',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        
      
        
          
            // Add more data as needed
        ];

        Module::insert($modules);
    }
}
