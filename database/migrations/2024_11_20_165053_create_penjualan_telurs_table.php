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
        Schema::create('penjualan_telurs', function (Blueprint $table) {
            $table->id();
            $table->string('kondisi_telur');
            $table->integer('harga_perbutir');
            $table->integer('telur_terjual');
            $table->integer('harga_total');
            $table->foreignId('id_gudang')->nullable()->constrained('gudang')->onDelete('set null');
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

        Schema::dropIfExists('penjualan_telurs');
    
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');  // Re-enable foreign key checks
    
    }
};
