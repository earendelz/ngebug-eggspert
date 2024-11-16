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
        Schema::disableForeignKeyConstraints(); // Matikan kunci asing

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('jenis_kandang');
            $table->integer('kapasitas');
            $table->integer('jumlah_ayam');
            $table->unsignedBigInteger('id_ras_ayam');
            $table->unsignedBigInteger('id_pakan');
            $table->string('status_pakan');
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

            $table->foreign('id_pakan')
                    ->references('id')
                    ->on('pakans')
                    ->onDelete('no action')
                    ->onUpdate('no action');

            $table->timestamps();

        });

        Schema::enableForeignKeyConstraints();  // Aktifkan kembali
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');  // Disable foreign key checks

        Schema::dropIfExists('products');  // Drop the 'products' table

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');  // Re-enable foreign key checks
    }
};
