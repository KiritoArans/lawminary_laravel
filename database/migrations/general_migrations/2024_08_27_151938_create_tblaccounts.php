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
            $table->id('user_id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('firstName');
            $table->string('middleName')->nullable();
            $table->string('lastName');
            $table->date('birthDate');
            $table->string('nationality');
            $table->enum('sex', ['male', 'female', 'other']);
            $table->string('contactNumber');
            $table->boolean('restrict')->default(false);
            $table->integer('restrictDays')->nullable();
            $table->timestamp('date_created')->useCurrent();
            $table->enum('account_type', ['user', 'moderator', 'lawyer', 'admin']);
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

