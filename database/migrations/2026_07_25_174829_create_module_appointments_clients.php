<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $modules =
        [
            'slug' => 'appointments-clients',
            'table_name' => null,
            'name' => 'Agendamentos Clientes',
            'route_name' => 'booking.wizard',
            'icon' => 'fa-solid fa-vertical-timeline',
            'order' => 8,
            'user_id_created' => 1,
        ];

        DB::table('modules')->insert(array_merge($modules, [
            'activated' => true,
            'scaffolded' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('modules')->where('slug', 'appointments-clients')->delete();
    }
};
