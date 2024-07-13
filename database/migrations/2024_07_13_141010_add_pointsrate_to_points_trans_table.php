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
        Schema::table('points_trans', function (Blueprint $table) {
            $table->integer('pointsrate')->nullable()->default(0);
            $table->decimal('cash')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('points_trans', function (Blueprint $table) {
            //
        });
    }
};
