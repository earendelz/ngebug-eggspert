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

        Schema::disableForeignKeyConstraints();

        Schema::create('gudang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal_pembuatan');
            $table->integer('jumlah_telur');
            $table->unsignedBigInteger('id_ras_ayam');
            $table->unsignedBigInteger('id_peternak');

            $table->foreign('id_peternak')
                    ->references('id')
                    ->on('users')
                    ->onDelete('no action')
                    ->onUpdate('no action');
                    
            $table->foreign('id_ras_ayam')
                    ->references('id')
                    ->on('ras_ayams')
                    ->onDelete('no action')
                    ->onUpdate('no action');
                    
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints(); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::dropIfExists('gudang');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
