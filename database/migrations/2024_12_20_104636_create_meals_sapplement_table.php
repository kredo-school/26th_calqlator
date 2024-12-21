<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('meals_sapplement', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->integer('calories');
            $table->string('amount');
            $table->timestamp('time_eaten')->nullable();
            $table->integer('protein')->nullable();
            $table->integer('carbohydrate')->nullable();
            $table->integer('lipid')->nullable();
            $table->date('date')->default(DB::raw('CURRENT_DATE'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('meals_sapplement');
    }
};