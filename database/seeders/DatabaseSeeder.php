<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Llama a tu seeder personalizado
        $this->call(UsersTableSeeder::class);

        // Si quieres más usuarios con factory (opcional)
        // User::factory(10)->create();
    }
}