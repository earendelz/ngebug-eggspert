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
        Schema::create('ras_ayams', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ras_ayam');
            $table->string('jenis_ayam');
            $table->unsignedBigInteger('id_peternak');
            $table->foreign('id_peternak')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ras_ayams');
    }
};
