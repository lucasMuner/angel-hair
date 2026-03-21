<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'admin',
            'name' => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'email' => 'admin@gmail.com',
        ]);

        $user = User::where('username', 'admin')->first();

        $role = Role::firstOrCreate([
            'name' => 'admin',
            'description' => 'Administrador do sistema',
            'user_id_created' => $user->id,
            'user_id_updated' => $user->id,
        ]);

        $user->role_id = $role->id;
        $user->save();

    }
}
