<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'surname' => 'adminadmin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin1234'),
            'permission_id' => '1',
        ]);
        for($i=0; $i<10; $i++){
            User::create([
                'name' => 'user'.($i+1),
                'surname' => 'user'.($i+1).'user',
                'email' => ('user'.($i+1)).'@user.com',
                'password' => Hash::make('user1234'),
                'permission_id' => '2',
            ]);
        }
    }
}
