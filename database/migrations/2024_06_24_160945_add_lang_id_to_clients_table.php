<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.2024_06_24_16094 add_question_id_to_answers_table;add_level_id_to_lang_posts_table;
     * 
     */
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
           
            $table->foreignId('lang_id')->nullable();
 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            //
        });
    }
};
