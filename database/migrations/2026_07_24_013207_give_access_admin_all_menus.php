<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $adminUser = \App\Models\User::where('username', 'admin')->first();

        $adminUser = \App\Models\User::where('username', 'admin')->first();

        if ($adminUser?->role) {
            $syncData = \App\Models\Module::pluck('id')->mapWithKeys(fn ($id) => [
                $id => [
                    'can_view'   => true,
                    'can_create' => true,
                    'can_edit'   => true,
                    'can_delete' => true,
                    'user_id_created' => $adminUser->id,
                    'user_id_updated' => $adminUser->id,
                ],
            ])->toArray();

            $adminUser->role->modules()->sync($syncData);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
