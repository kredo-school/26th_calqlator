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
            $table->dropColumn('name');
            $table->dropColumn('email_verified_at');
      
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->longtext('avatar')->nullable();
            $table->string('email');
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
