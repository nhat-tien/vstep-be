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
        Schema::table('users', function (Blueprint $table) {
            $table->integer("role_id")->nullable();
            $table->string("phone_number", length: 20)->nullable();
            $table->string("candidate_id", length: 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("role_id");
            $table->dropColumn("phone_number");
            $table->dropColumn("candidate_id");
        });
    }
};
