<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable();
            $table->integer('is_correct')->nullable()->default(0);
            $table->integer('status')->nullable()->default(0);
            $table->foreignId('createuser_id')->nullable();
            $table->foreignId('updateuser_id')->nullable();
            $table->string('type')->nullable();
            $table->text('file')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
