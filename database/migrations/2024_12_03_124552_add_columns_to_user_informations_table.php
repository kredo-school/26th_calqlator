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
        Schema::table('user_informations', function (Blueprint $table) {
            $table->decimal('goal_weight')->nullable();
            $table->date('goal_date')->nullable();
            $table->integer('how_to_lose')->nullable()->comment('1:meal | 2:half&half | 3:workout');
            $table->integer('activity_level')->nullable()->comment('1:low | 2:medium | 3:high');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_informations', function (Blueprint $table) {
            //
        });
    }
};
