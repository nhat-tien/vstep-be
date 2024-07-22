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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("question_id");
            $table->bigInteger("exam_schedule_id");
            $table->bigInteger("question_select_option_id")->nullable();
            $table->mediumText("text")->nullable();
            $table->string("audio_url", length: 255)->nullable();
            $table->tinyInteger("score")->nullable();
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
