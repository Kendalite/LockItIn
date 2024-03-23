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
        Schema::table('project_answers', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->index()->constrained('users')->onDelete('cascade');
            $table->foreignId('game_id')->after('user_id')->index()->constrained('project_games')->onDelete('cascade');
            $table->foreignId('question_id')->after('game_id')->index()->constrained('project_questions')->onDelete('cascade');
            $table->string('answer', 255)->after('question_id')->nullable();
            $table->unsignedBigInteger('macrotime')->after('answer')->nullable();
            $table->unsignedBigInteger('microtime')->after('macrotime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_answers');
        Schema::create('project_answers', function (Blueprint $table) {
            $table->id();
        });
    }
};
