<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_add_date_to_meals_dinner_table.php
public function up()
{
    Schema::table('meals_dinner', function (Blueprint $table) {
        $table->date('date')->default(DB::raw('CURRENT_DATE'));
    });
}

public function down()
{
    Schema::table('meals_dinner', function (Blueprint $table) {
        $table->dropColumn('date');
    });
}

};
