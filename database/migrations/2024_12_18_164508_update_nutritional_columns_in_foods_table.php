<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->decimal('protein', 8, 2)->nullable()->change();
            $table->decimal('fat', 8, 2)->nullable()->change();
            $table->decimal('carbs', 8, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->integer('protein')->nullable()->change();
            $table->integer('fat')->nullable()->change();
            $table->integer('carbs')->nullable()->change();
        });
    }
};
