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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("exam_schedule_id");
            $table->timestamp("start_time", precision: 0)->nullable();
            $table->timestamp("end_time", precision: 0)->nullable();
            $table->tinyInteger("skill_id");
            $table->tinyInteger("score")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
