<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ras_ayams', function (Blueprint $table) {
            $table->unsignedBigInteger('id_peternak')->nullable()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('ras_ayams', function (Blueprint $table) {
            $table->dropColumn('id_peternak');
        });
    }
};
