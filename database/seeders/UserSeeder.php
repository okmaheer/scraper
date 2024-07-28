<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use App\Helper\Helper;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make(123456);
        $data = [
            ['name' => 'Hamza Admin','status'=>'1', 'email' => 'admin@gmail.com', 'password' => $password],
        ];

        foreach ($data as $key => $value) {
            $user = User::create($value);
            UserDetail::create([
                'user_id' => $user->id,
                'contact_number' => Helper::generateRandomPhoneNumber()
            ]);

            if ($key == 0) {
                Role::find(1)->users()->attach($user);
            } else if ($key == 1) {
                Role::find(2)->users()->attach($user);
            } else {
                Role::find(3)->users()->attach($user);
            }
        }
    }
}
