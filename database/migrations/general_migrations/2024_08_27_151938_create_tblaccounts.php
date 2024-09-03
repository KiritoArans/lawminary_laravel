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
        Schema::create('tblaccounts', function (Blueprint $table) {
            $table->id();
            $table->id('user_id', 20);
            $table->string('username', 50)->unique();
            $table->string('email', 100)->unique();
            $table->string('userPhoto', 255)->nullable();
            $table->string('password', 100);
            $table->string('firstName', 100);
            $table->string('middleName', 100)->nullable();
            $table->string('lastName', 100);
            $table->date('birthDate');
            $table->string('nationality', 100);
            $table->enum('sex', ['male', 'female', 'other'], 100);
            $table->string('contactNumber', 11);
            $table->boolean('restrict')->default(false);
            $table->integer('restrictDays', 50)->nullable();
            $table->enum('account_type', ['user', 'moderator', 'lawyer', 'admin'], 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblaccounts');
    }
};

