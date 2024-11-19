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
            $table->integer('jumlah_ayam'); // Total number of chickens
            $table->enum('jenis_laporan', ['kelahiran', 'kematian']);
            $table->date('tanggal_peristiwa'); // Date of the report
            $table->foreignId('id_kandang')->constrained('products'); // Foreign key referencing the users table
            $table->foreignId('id_peternak')->constrained('users'); // Foreign key referencing the users table
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
