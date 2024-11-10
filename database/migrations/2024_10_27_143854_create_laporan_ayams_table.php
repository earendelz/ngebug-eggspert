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
        Schema::create('laporan_ayams', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->integer('chicken_count'); // Total number of chickens
            $table->date('date'); // Date of the report
            $table->integer('live_chicken_count'); // Number of live chickens
            $table->integer('dead_chicken_count'); // Number of dead chickens
            $table->foreignId('user_id')->constrained('users'); // Foreign key referencing the users table
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_ayams');
    }
};
