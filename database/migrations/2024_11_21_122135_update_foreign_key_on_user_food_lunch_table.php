<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_food_lunch', function (Blueprint $table) {
            $table->dropForeign(['food_id']);
            
            $table->foreign('food_id')
                ->references('id')
                ->on('foods')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_food_lunch', function (Blueprint $table) {
            $table->dropForeign(['food_id']);
            
            $table->foreign('food_id')
                ->references('id')
                ->on('foods');
        });
    }
};
