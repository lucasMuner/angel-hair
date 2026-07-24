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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('table_name')->nullable();
            $table->string('module_name');
            $table->string('route_name');
            $table->string('icon')->nullable();
            $table->boolean('activated')->default(true);
            $table->boolean('scaffolded')->default(false);
            $table->unsignedInteger('order')->default(0);
            $table->foreignId('user_id_created')->nullable()->constrained('users');
            $table->foreignId('user_id_updated')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
