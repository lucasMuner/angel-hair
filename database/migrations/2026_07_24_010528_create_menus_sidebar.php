<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $modules = [
            [
                'slug' => 'home',
                'table_name' => null,
                'module_name' => 'Início',
                'route_name' => 'home',
                'icon' => 'fa-solid fa-house',
                'order' => 1,
                'user_id_created' => 1,
            ],
            [
                'slug' => 'client',
                'table_name' => 'clients',
                'module_name' => 'Clientes',
                'route_name' => 'clients',
                'icon' => 'fa-solid fa-users',
                'order' => 2,
                'user_id_created' => 1,
            ],
            [
                'slug' => 'employee',
                'table_name' => 'employees',
                'module_name' => 'Funcionários',
                'route_name' => 'employees',
                'icon' => 'fa-solid fa-briefcase',
                'order' => 3,
                'user_id_created' => 1,
            ],
            [
                'slug' => 'service',
                'table_name' => 'services',
                'module_name' => 'Serviços',
                'route_name' => 'services',
                'icon' => 'fa-solid fa-scissors',
                'order' => 4,
                'user_id_created' => 1,
            ],
            [
                'slug' => 'appointment',
                'table_name' => 'appointments',
                'module_name' => 'Agendamentos',
                'route_name' => 'appointments',
                'icon' => 'fa-solid fa-calendar-check',
                'order' => 5,
                'user_id_created' => 1,
            ],
            [
                'slug' => 'role',
                'table_name' => 'roles',
                'module_name' => 'Funções',
                'route_name' => 'roles',
                'icon' => 'fa-solid fa-user-tag',
                'order' => 6,
                'user_id_created' => 1,
            ],
            [
                'slug' => 'user',
                'table_name' => 'users',
                'module_name' => 'Usuários',
                'route_name' => 'users',
                'icon' => 'fa-solid fa-user-circle',
                'order' => 7,
                'user_id_created' => 1,
            ],
        ];

        foreach ($modules as $module) {
            DB::table('modules')->insert(array_merge($module, [
                'activated' => true,
                'scaffolded' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('modules')->whereIn('slug', [
            'home', 'client', 'employee', 'service', 'appointment', 'role', 'user',
        ])->delete();
    }
};
