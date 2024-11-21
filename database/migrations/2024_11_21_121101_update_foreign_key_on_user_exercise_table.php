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
        Schema::table('user_exercise', function (Blueprint $table) {
            $table->dropForeign(['exercise_id']);
            
            $table->foreign('exercise_id')
                ->references('id')
                ->on('exercises')
                ->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_exercise', function (Blueprint $table) {
            $table->dropForeign(['exercise_id']);
            
            $table->foreign('exercise_id')
                ->references('id')
                ->on('exercises');
        });
    }
};
