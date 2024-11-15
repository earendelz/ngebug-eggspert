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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('capacity');
            $table->integer('chicken_count');
            $table->string('chicken_breed');
            $table->unsignedBigInteger('id_peternak');

            $table->foreign('id_peternak')
                    ->references('id')
                    ->on('users')
                    ->onDelete('no action')
                    ->onUpdate('no action');

            $table->timestamps();
        });
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
