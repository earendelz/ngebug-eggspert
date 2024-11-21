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
        Schema::create('vaksinasis', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_vaksin');
            $table->date('tanggal_vaksinasi');
            $table->foreignId('id_kandang')->constrained('products')->onDelete('cascade');
            $table->foreignId('id_peternak')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaksinasis');
    }
};
