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
        Schema::create('panen_telurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_gudang')->nullable()->constrained('gudang')->onDelete('set null');
            $table->foreignId('id_kandang')->nullable()->constrained('products')->onDelete('set null');
            $table->foreignId('id_peternak')->nullable()->constrained('users')->onDelete('set null');
            $table->integer('jumlah_telur');
            $table->string('kondisi_telur');
            $table->text('memo')->nullable();
            $table->date('tanggal_panen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');  // Disable foreign key checks

        Schema::dropIfExists('panen_telurs');  // Drop the 'panen_telurs' table

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');  // Re-enable foreign key checks
    }
};
