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
        $table->datetime('date_of_birth')->nullable()->after('name');          // 構文
        $table->string('gender', 10)->nullable()->after('date_of_birth');     // 例
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
