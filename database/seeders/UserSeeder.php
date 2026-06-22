<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (User::where('email', 'admin@pos.com')->doesntExist()) {
            User::create([
                'name'     => 'Admin User',
                'email'    => 'admin@pos.com',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]);

            User::create([
                'name'     => 'Attendant User',
                'email'    => 'attendant@pos.com',
                'password' => Hash::make('password'),
                'role'     => 'attendant',
            ]);
        }
    }
}