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
        
        Schema::create('ras_ayams', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ras_ayam');
            $table->string('jenis_ayam');
            $table->unsignedBigInteger('id_peternak');

            $table->foreign('id_peternak')
                    ->references('id')
                    ->on('users')
                    ->onDelete('no action')
                    ->onUpdate('no action');;

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

        Schema::dropIfExists('ras_ayams');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
