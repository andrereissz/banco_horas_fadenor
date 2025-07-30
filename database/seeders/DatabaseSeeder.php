<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => env('ADMIN_ROLE')]);
        $projetos = Role::create(['name' => 'projetos']);
        $rh = Role::create(['name' => 'rh']);

        Permission::create(['name' => 'administrar bolsa']);
        Permission::create(['name' => 'administrar usuario']);

        $user = User::factory()->create([
            'name' => env('ADMIN_NAME'),
            'username' => env('ADMIN_USERNAME'),
            'password' => env('ADMIN_PASSWORD'),
            'email' => env('ADMIN_EMAIL'),
        ]);

        $admin->givePermissionTo([
            'administrar bolsa',
            'administrar usuario',
        ]);

        $projetos->givePermissionTo([
            'administrar bolsa',
        ]);

        $user->assignRole(env('ADMIN_ROLE'));
    }
}
