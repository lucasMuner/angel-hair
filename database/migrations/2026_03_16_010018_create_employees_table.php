<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('phone', 20)->nullable();
            $table->date('hire_date')->nullable();
            $table->foreignId('user_id_created')->nullable()->constrained('users', 'id')->nullOnDelete();
            $table->foreignId('user_id_updated')->nullable()->constrained('users', 'id')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
