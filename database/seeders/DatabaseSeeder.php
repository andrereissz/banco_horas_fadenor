<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => env('ADMIN_NAME'),
            'username' => env('ADMIN_USERNAME'),
            'password' => env('ADMIN_PASSWORD'),
            'role' => env('ADMIN_ROLE'),
            'email' => env('ADMIN_EMAIL'),
        ]);
    }
}
