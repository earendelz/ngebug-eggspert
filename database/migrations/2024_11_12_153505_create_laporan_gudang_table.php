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
        Schema::create('laporan_gudang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_gudang_telur')->constrained('gudang');  // Make sure this line exists
            $table->string('keterangan');
            $table->string('nama_laporan_gudang');
            $table->integer('jumlah_telur');
            $table->date('tanggal_laporan_gudang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_gudang');
    }
};
