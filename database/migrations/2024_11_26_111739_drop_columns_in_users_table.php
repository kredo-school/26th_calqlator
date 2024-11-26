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
            $table->dropColumn('email');
            $table->dropColumn('password');
            $table->dropColumn('remember_token');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
      
            $table->string('email')->unique();;
            $table->string('name');
            $table->string('password');
            $table->integer('role_id')->default(2)->comment('1:admin | 2:user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::dropIfExists('users');
        });
    }
};
