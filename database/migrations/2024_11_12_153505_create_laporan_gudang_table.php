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
            $table->unsignedBigInteger('id_gudang'); // Foreign key to Gudang
            $table->unsignedBigInteger('id_peternak'); // Foreign key to Gudang
            $table->integer('jumlah_telur'); // The number of eggs reduced
            $table->string('keterangan'); // Reason for reduction (e.g., broken, rotten, lost)
            $table->date('tanggal_laporan_gudang'); // Date of the report

            // Foreign Key constraint
            $table->foreign('id_gudang')
                ->references('id')
                ->on('gudang')
                ->onDelete('cascade'); // Deleting Gudang will delete the related reports
            $table->foreign('id_peternak')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // Deleting Gudang will delete the related reports

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
