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
        Schema::create('answers_clients', function (Blueprint $table) {
            $table->id();
            $table->integer('is_correct')->nullable()->default(0);
            $table->integer('points')->nullable()->default(0);
            $table->foreignId('client_id')->nullable();
            $table->foreignId('answer_id')->nullable();
            $table->foreignId('level_id')->nullable();
            $table->text('question_content')->nullable();
            $table->text('answer_content')->nullable();
            $table->string('question_type')->nullable();
            $table->string('answer_type')->nullable();
            $table->text('question_file')->nullable();
            $table->text('answer_file')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers_clients');
    }
};
