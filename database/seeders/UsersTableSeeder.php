<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Andrew Vega Reyes',
            'email' => 'Andrew@ejemplo.com',
            'password' => Hash::make('864212111629'),
            'role' => 'admin'
        ]);
    }
}