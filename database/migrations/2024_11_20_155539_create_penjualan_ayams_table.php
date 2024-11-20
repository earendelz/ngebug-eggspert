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
        Schema::create('penjualan_ayams', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_terjual');
            $table->integer('harga_perekor');
            $table->integer('harga_total');
            $table->foreignId('id_kandang')->nullable()->constrained('products')->onDelete('set null');
            $table->date('tanggal_penjualan');
            $table->foreignId('id_peternak')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');  // Disable foreign key checks

        Schema::dropIfExists('penjualan_ayams');
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');  // Re-enable foreign key checks
    }
};
