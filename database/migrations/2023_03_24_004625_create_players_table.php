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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_type_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->integer('life')->default(100);
            $table->integer('attack_points')->default(5);
            $table->integer('defense_points')->default(5);
            $table->integer('ulti_active')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
