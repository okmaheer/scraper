<?php

namespace Database\Seeders;

use App\Models\Manhwa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use Carbon\Carbon;

class ManhwaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Dragon-Devouring Mage',
                // 'manhwafast_link' => 'https://manhuafast.com/manga/dragon-devouring-mage/',
                'manhwaclan_link'=> 'https://manhwaclan.com/manga/dragon-devouring-mage/',
                // 'starting_limit'=> 10,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
    
        
          
            // Add more data as needed
        ];

        Manhwa::insert($data);
    }
}
